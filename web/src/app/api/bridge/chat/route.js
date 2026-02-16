import { NextResponse } from "next/server";
import { AmoraService } from "@/lib/services/amoraService";

export async function POST(req) {
    try {
        const body = await req.json();
        const { message, history } = body;

        if (!message) {
            return NextResponse.json({ error: "Message is required" }, { status: 400 });
        }

        const result = await AmoraService.chatWithPsychologist(message, history || []);

        return NextResponse.json(result);
    } catch (error) {
        console.error("Bridge Chat Error:", error);
        return NextResponse.json({ error: "Internal Server Error" }, { status: 500 });
    }
}
