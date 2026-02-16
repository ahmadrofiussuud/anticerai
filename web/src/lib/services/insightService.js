import { PrismaClient } from "@prisma/client";

const prisma = new PrismaClient();

export const InsightService = {
    /**
     * Get a daily insight for the user.
     * For now, it returns a random insight or a fallback if none exist.
     */
    async getDailyInsight() {
        try {
            const count = await prisma.insight.count();

            if (count === 0) {
                return {
                    id: 0,
                    title: "Selamat Datang di Amora",
                    brief_text: "Mulailah perjalanan Anda dengan saling menyapa setiap pagi. Komunikasi kecil membangun jembatan besar.",
                    type: "text",
                    trigger_context: "general"
                };
            }

            const skip = Math.floor(Math.random() * count);
            const insight = await prisma.insight.findFirst({
                skip: skip,
            });

            return insight;
        } catch (error) {
            console.error("Error fetching daily insight:", error);
            return null;
        }
    }
};
