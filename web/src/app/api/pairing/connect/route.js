import { auth } from "@/auth";
import { PairingService } from "@/lib/services/pairingService";
import { NextResponse } from "next/server";
import { z } from "zod";

const schema = z.object({
    code: z.string().length(10, { message: "Code must be 10 characters" }),
});

export async function POST(req) {
    const session = await auth();
    if (!session || !session.user) {
        return NextResponse.json({ error: "Unauthorized" }, { status: 401 });
    }

    try {
        const body = await req.json();
        const validated = schema.safeParse(body);

        if (!validated.success) {
            return NextResponse.json({ error: validated.error.errors[0].message }, { status: 422 });
        }

        const couple = await PairingService.connectUser(session.user.id, validated.data.code);
        return NextResponse.json({ success: true, couple });

    } catch (error) {
        const status = error.message === "INVALID_CODE" || error.message === "ALREADY_PAIRED" ? 400 : 500;
        return NextResponse.json({ error: error.message }, { status });
    }
}
