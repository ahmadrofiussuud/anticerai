
export const dynamic = 'force-dynamic';

import { PrismaClient } from '@prisma/client';

const prisma = new PrismaClient();

export async function GET() {
    let dbStatus = 'Checking...';
    let userCount = 0;

    try {
        userCount = await prisma.user.count();
        dbStatus = `Connected. Users found: ${userCount}`;
    } catch (e) {
        dbStatus = `Failed: ${e.message}`;
    }

    const envCheck = {
        AMORA_ENV_CHECK: 'v1.0',
        AUTH_SECRET: process.env.AUTH_SECRET ? 'Present (OK)' : 'MISSING (Critical)',
        GEMINI_API_KEY: process.env.GEMINI_API_KEY ? 'Present (OK)' : 'MISSING',
        DATABASE_URL: process.env.DATABASE_URL ? 'Present (OK)' : 'MISSING',
        NODE_ENV: process.env.NODE_ENV,
        DB_STATUS: dbStatus,
        NEXTAUTH_URL: process.env.NEXTAUTH_URL || 'Not Set (Optional in Vercel)'
    };

    return Response.json(envCheck);
}
