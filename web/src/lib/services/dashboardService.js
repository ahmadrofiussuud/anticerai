import { PrismaClient } from "@prisma/client";

const prisma = new PrismaClient();

export const DashboardService = {
    /**
     * Log energy level for a user.
     */
    async logEnergy(userId, level, note) {
        return await prisma.energyLog.create({
            data: {
                user_id: parseInt(userId),
                energy_level: parseInt(level),
                note: note,
            },
        });
    },

    /**
     * Get latest energy logs for the couple (User + Partner).
     */
    async getLatestEnergy(userId) {
        const user = await prisma.user.findUnique({
            where: { id: parseInt(userId) },
            include: { couple: { include: { users: true } } },
        });

        if (!user.couple) {
            // Return only user's log if not paired
            const userLog = await prisma.energyLog.findFirst({
                where: { user_id: parseInt(userId) },
                orderBy: { createdAt: 'desc' },
            });
            return { user: userLog, partner: null };
        }

        // Get both logs
        // Assuming couple.users has 2 users.
        const partner = user.couple.users.find(u => u.id !== user.id);

        const [userLog, partnerLog] = await Promise.all([
            prisma.energyLog.findFirst({
                where: { user_id: user.id },
                orderBy: { createdAt: 'desc' },
            }),
            partner ? prisma.energyLog.findFirst({
                where: { user_id: partner.id },
                orderBy: { createdAt: 'desc' },
            }) : null,
        ]);

        return { user: userLog, partner: partnerLog };
    },

    /**
     * Log daily activity/strain.
     */
    async logDaily(userId, strain, note) {
        // Check if already logged today? 
        // Laravel logic usually allows update or one per day. 
        // We'll assume one per day for simplicity or just create new.
        // Let's create new for now.
        return await prisma.dailyLog.create({
            data: {
                user_id: parseInt(userId),
                strain_level: parseInt(strain),
                note: note,
            }
        });
    },

    /**
     * Get today's daily log.
     */
    async getDailyLogToday(userId) {
        const startOfDay = new Date();
        startOfDay.setHours(0, 0, 0, 0);

        const endOfDay = new Date();
        endOfDay.setHours(23, 59, 59, 999);

        return await prisma.dailyLog.findFirst({
            where: {
                user_id: parseInt(userId),
                createdAt: {
                    gte: startOfDay,
                    lte: endOfDay,
                },
            },
        });
    }
};
