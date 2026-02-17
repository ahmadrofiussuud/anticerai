import { db } from "../mock-data";

export const LEVELS = {
    BRONZE: { name: 'Bronze', minDays: 0, nextLevel: 'SILVER' },
    SILVER: { name: 'Silver', minDays: 30, nextLevel: 'GOLD', minDatesPerMonth: 3 },
    GOLD: { name: 'Gold', minDays: 90, nextLevel: 'PLATINUM', minDatesPerMonth: 3, streakRequired: true },
    PLATINUM: { name: 'Platinum', minDays: 180, nextLevel: null, minDatesPerMonth: 3, streakRequired: true }
};

export const XP_VALUES = {
    DATE_COMPLETED: 30,
    DAILY_LOG: 5,
    GROWTH_MODULE: 20,
    NOSTALGIA_ENTRY: 10,
    CONFLICT_RESOLVED: 15
};

export const rewardService = {
    async getProfile(coupleId) {
        return await db.relationshipProfile.findUnique({ where: { couple_id: coupleId } });
    },

    async getMonthlyStats(coupleId) {
        const startOfMonth = new Date();
        startOfMonth.setDate(1);
        startOfMonth.setHours(0, 0, 0, 0);

        const logs = await db.activityLog.findMany({
            where: {
                couple_id: coupleId,
                type: 'date',
                occurred_at: { gte: startOfMonth }
            }
        });

        return {
            datesCompleted: logs.length,
            targetDates: 3
        };
    },

    async awardXP(coupleId, type, title) {
        const xpAmount = XP_VALUES[type] || 0;
        const profile = await this.getProfile(coupleId);

        if (!profile) return null;

        const newXP = profile.xp + xpAmount;

        // Log activity
        await db.activityLog.create({
            data: {
                couple_id: coupleId,
                type: type.toLowerCase().includes('date') ? 'date' : 'activity',
                title: title,
                xp_awarded: xpAmount
            }
        });

        // Update profile
        const updated = await db.relationshipProfile.update({
            where: { couple_id: coupleId },
            data: { xp: newXP }
        });

        // Check for conflict resolution reward
        if (type === 'CONFLICT_RESOLVED') {
            await this.triggerVoucher(coupleId, 'conflict_recovery', 'Conflict Recovery', 'Amora Partner', 10, 'Restaurant');
        }

        return updated;
    },

    async triggerVoucher(coupleId, type, title, merchant, percent, category) {
        const expiresAt = new Date();
        expiresAt.setDate(expiresAt.getDate() + 30);

        return await db.voucher.create({
            data: {
                couple_id: coupleId,
                type,
                title,
                merchant,
                percent,
                category,
                status: 'available',
                expires_at: expiresAt
            }
        });
    },

    async getVouchers(coupleId) {
        return await db.voucher.findMany({ where: { couple_id: coupleId } });
    },

    async redeemVoucher(voucherId) {
        return await db.voucher.update({
            where: { id: voucherId },
            data: { status: 'redeemed' }
        });
    }
};
