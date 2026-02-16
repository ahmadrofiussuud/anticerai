import { auth } from "@/auth";
import { NextResponse } from "next/server";
import { db, MOCK_USERS } from "@/lib/mock-data";
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

        // Mock logic: Find user with this code
        const partner = MOCK_USERS.find(u => u.pairing_code === validated.data.code && u.email !== session.user.email);

        if (!partner) {
            throw new Error("INVALID_CODE");
        }

        // Return mock success
        return NextResponse.json({ success: true, message: "Paired successfully (Mock)" });

    } catch (error) {
        const status = error.message === "INVALID_CODE" || error.message === "ALREADY_PAIRED" ? 400 : 500;
        return NextResponse.json({ error: error.message }, { status });
    }
}
