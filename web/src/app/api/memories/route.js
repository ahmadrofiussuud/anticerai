import { auth } from "@/auth";
import { MemoryService } from "@/lib/services/memoryService";
import { NextResponse } from "next/server";
import { z } from "zod";

export async function GET(req) {
    const session = await auth();
    if (!session || !session.user) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    const { searchParams } = new URL(req.url);
    const page = parseInt(searchParams.get("page") || "1");
    const limit = parseInt(searchParams.get("limit") || "10");
    const search = searchParams.get("search") || "";
    const tag = searchParams.get("tag") || "";
    const sort = searchParams.get("sort") || "date_desc";

    try {
        const result = await MemoryService.list(session.user.id, { page, limit, search, tag, sort });
        return NextResponse.json(result);
    } catch (error) {
        return NextResponse.json({ error: error.message }, { status: 500 });
    }
}

export async function POST(req) {
    const session = await auth();
    if (!session || !session.user) return NextResponse.json({ error: "Unauthorized" }, { status: 401 });

    try {
        const formData = await req.formData();
        const title = formData.get("title");
        const description = formData.get("description");
        const memory_date = formData.get("memory_date");
        const file = formData.get("image");
        const tags = formData.get("tags");

        // Validation
        if (!title || !memory_date) {
            return NextResponse.json({ error: "Title and Date are required" }, { status: 422 });
        }

        const memory = await MemoryService.create(
            session.user.id,
            { title, description, memory_date, tags },
            file
        );

        return NextResponse.json(memory);
    } catch (error) {
        console.error(error);
        return NextResponse.json({ error: error.message }, { status: 500 });
    }
}
