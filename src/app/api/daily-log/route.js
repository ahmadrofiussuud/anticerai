
import { auth } from "@/auth";
import { DashboardService } from "@/lib/services/dashboardService";
import { NextResponse } from "next/server";
import { z } from "zod";

const postSchema = z.object({
    strain_level: z.number().min(1).max(5), // Assuming 1-5 scale
    note: z.string().optional(),
});

export async function GET(req) {
    const session = await auth();
    if (!session || !session.user) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    try {
        const log = await DashboardService.getDailyLogToday(session.user.id);
        return NextResponse.json({ log });
    } catch (error) {
        return NextResponse.json({ error: error.message }, { status: 500 });
    }
}

export async function POST(req) {
    const session = await auth();
    if (!session || !session.user) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    try {
        const body = await req.json();
        const validated = postSchema.safeParse(body);

        if (!validated.success) {
            return NextResponse.json({ error: validated.error.errors[0].message }, { status: 422 });
        }

        const log = await DashboardService.logDaily(session.user.id, validated.data.strain_level, validated.data.note);

        // Award XP
        try {
            const { rewardService } = await import("@/lib/services/rewardService");
            const user = await db.user.findUnique({ where: { id: session.user.id } });
            if (user && user.couple_id) {
                await rewardService.awardXP(user.couple_id, 'DAILY_LOG', 'Daily Log Entry');
            }
        } catch (xpError) {
            console.error("Failed to award XP:", xpError);
        }

        return NextResponse.json(log);
    } catch (error) {
        return NextResponse.json({ error: error.message }, { status: 500 });
    }
}
