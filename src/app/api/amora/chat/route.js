import { NextResponse } from "next/server";
import { AmoraService } from "@/lib/services/amoraService";

export async function POST(request) {
    try {
        const body = await request.json();
        const { mode, text } = body;

        let result;

        if (mode === "INTERPRETER") {
            if (!text) return NextResponse.json({ error: "Text required" }, { status: 400 });
            result = await AmoraService.interpret(text);
        } else if (mode === "SPARK") {
            result = await AmoraService.spark();
        } else {
            return NextResponse.json({ error: "Invalid mode" }, { status: 400 });
        }

        return NextResponse.json(result);
    } catch (error) {
        console.error("API Amora Error:", error);
        return NextResponse.json({ error: "Internal Server Error" }, { status: 500 });
    }
}
