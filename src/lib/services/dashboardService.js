import { db, MOCK_USERS, MOCK_ENERGY_LOGS, MOCK_DAILY_LOGS } from "@/lib/mock-data";

export const DashboardService = {
    /**
     * Log energy level for a user.
     */
    async logEnergy(userId, level, note) {
        return await db.energyLog.create({
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
        const uid = parseInt(userId);
        const user = MOCK_USERS.find(u => u.id === uid);

        if (!user) return { user: null, partner: null };

        // Find partner
        let partner = null;
        if (user.couple_id) {
            partner = MOCK_USERS.find(u => u.couple_id === user.couple_id && u.id !== uid);
        }

        // Helper to get latest log
        const getLatest = (id) => {
            const logs = MOCK_ENERGY_LOGS.filter(l => l.user_id === id);
            return logs.sort((a, b) => b.createdAt - a.createdAt)[0] || null;
        };

        return {
            user: getLatest(uid),
            partner: partner ? getLatest(partner.id) : null
        };
    },

    /**
     * Log daily activity/strain.
     */
    async logDaily(userId, strain, note) {
        return await db.dailyLog.create({
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
        const uid = parseInt(userId);
        const startOfDay = new Date();
        startOfDay.setHours(0, 0, 0, 0);

        const endOfDay = new Date();
        endOfDay.setHours(23, 59, 59, 999);

        // Find log created today
        return MOCK_DAILY_LOGS.find(log => {
            return log.user_id === uid && log.createdAt >= startOfDay && log.createdAt <= endOfDay;
        }) || null;
    }
};
