import { NextResponse } from "next/server";
import { InsightService } from "@/lib/services/insightService";

export async function GET() {
    try {
        const insight = await InsightService.getDailyInsight();
        return NextResponse.json(insight);
    } catch (error) {
        return NextResponse.json({ error: "Failed to fetch insight" }, { status: 500 });
    }
}
