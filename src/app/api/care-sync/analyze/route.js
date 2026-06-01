import { NextResponse } from "next/server";
import { GoogleGenerativeAI } from "@google/generative-ai";
import { supabase } from "@/lib/supabase";

const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);

export async function POST(req) {
    try {
        const body = await req.json();
        const { coupleId, partnerId, partnerName } = body;

        if (!coupleId || !partnerId) {
            return NextResponse.json({ error: "Missing required fields" }, { status: 400 });
        }

        // 1. Fetch partner's schedules for today
        const todayStart = new Date();
        todayStart.setHours(0, 0, 0, 0);

        const { data: schedules, error: dbError } = await supabase
            .from("partner_schedules")
            .select()
            .eq("user_id", String(partnerId))
            .eq("couple_id", String(coupleId))
            .gte("created_at", todayStart.toISOString())
            .order("created_at", { ascending: true });

        if (dbError) {
            console.error("Database error fetching schedules:", dbError);
        }

        // 2. Generate AI suggestion based on partner's schedules
        let suggestionText = "";
        
        if (!schedules || schedules.length === 0) {
            suggestionText = `Pasangan Anda (${partnerName}) belum membagikan jadwalnya hari ini. Tanya kabarnya secara langsung untuk memulai hari dengan hangat!`;
        } else {
            // Determine maximum busy level
            const busyLevels = schedules.map(s => s.busy_level);
            let overallBusy = "Low";
            if (busyLevels.includes("High")) overallBusy = "High";
            else if (busyLevels.includes("Medium")) overallBusy = "Medium";

            const activitiesList = schedules.map(s => `${s.activity_name} (${s.notes || 'tanpa catatan'})`).join(", ");

            try {
                const model = genAI.getGenerativeModel({ model: "gemini-2.5-flash" });
                const prompt = `
                    Role: Amora, a romantic relationship mediator and expert in empathy.
                    Context: You are providing a supportive, highly practical suggestion to a user whose partner has a busy day.
                    
                    Partner Name: ${partnerName}
                    Overall Busy Level today: ${overallBusy}
                    Schedules/Activities today: ${activitiesList}
                    
                    Task: Write a highly specific, warm, and romantic recommendation on how the user can welcome or care for ${partnerName} when they get home today (e.g. preparing hot tea, offering a massage, giving them 20 minutes of quiet space, preparing a warm bath, etc.) based on their busy level and notes.
                    
                    Rules:
                    1. Respond in Indonesian.
                    2. Be warm, empathic, and practical.
                    3. Maximum 2 sentences.
                    4. Focus on customized actions tailored to the activities described.
                `;

                const result = await model.generateContent(prompt);
                const response = await result.response;
                suggestionText = response.text().trim();
            } catch (aiError) {
                console.error("Gemini care-sync analyze error:", aiError);
                // Fallback suggestion depending on overall busy level
                if (overallBusy === "High") {
                    suggestionText = `Jadwal ${partnerName} sangat padat hari ini. Sebaiknya siapkan teh hangat dan berikan dia waktu hening 20 menit saat pertama kali tiba di rumah untuk memulihkan energinya.`;
                } else if (overallBusy === "Medium") {
                    suggestionText = `${partnerName} cukup aktif hari ini. Tanya bagaimana harinya berjalan dan tawarkan pijatan punggung santai sambil mengobrol ringan.`;
                } else {
                    suggestionText = `Hari ${partnerName} berjalan cukup santai. Ini kesempatan emas untuk mengajaknya makan malam bersama atau sekadar jalan-jalan sore berdua!`;
                }
            }
        }

        return NextResponse.json({
            schedules: schedules || [],
            suggestion: suggestionText
        });

    } catch (error) {
        console.error("Care Sync Analyze Route Error:", error);
        return NextResponse.json({ error: "Internal Server Error" }, { status: 500 });
    }
}
