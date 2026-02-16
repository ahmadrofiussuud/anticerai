import { auth } from "@/auth";
import { PairingService } from "@/lib/services/pairingService";
import { NextResponse } from "next/server";

export async function POST(req) {
    const session = await auth();
    if (!session || !session.user) {
        return NextResponse.json({ error: "Unauthorized" }, { status: 401 });
    }

    try {
        const result = await PairingService.generateCode(session.user.id);
        return NextResponse.json(result);
    } catch (error) {
        return NextResponse.json({ error: error.message }, { status: 500 });
    }
}
