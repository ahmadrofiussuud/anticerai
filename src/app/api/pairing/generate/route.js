import { auth } from "@/auth";
import { NextResponse } from "next/server";
import { db } from "@/lib/mock-data";

export async function POST(req) {
    const session = await auth();
    if (!session || !session.user) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    const user = await db.user.findUnique({
        where: { email: session.user.email },
    });

    if (!user) return NextResponse.json({ error: "User not found" }, { status: 404 });

    // In mock mode, we just return the existing code or generate a fake one
    // Since mock db is static, we can't easily "save" a new code unless we mutate the object.
    // Let's just return the user's current code.
    return NextResponse.json({ code: user.pairing_code });
}
