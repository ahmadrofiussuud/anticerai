import { db } from "../mock-data";
import { v4 as uuidv4 } from "uuid";

export const careService = {
    async getBookings(userId) {
        return await db.careBooking.findMany({ where: { userId } });
    },

    async createBooking({ userId, coupleId, goal, scheduledAt }) {
        return await db.careBooking.create({
            data: {
                userId,
                coupleId,
                goal,
                scheduledAt,
                durationMinutes: 60,
                price: 150000,
                status: 'pending',
                meetLink: `https://meet.google.com/${uuidv4().substring(0, 8)}`,
            }
        });
    },

    async getSummaries(userId) {
        return await db.careSessionSummary.findMany({ where: { userId } });
    },

    async getReferrals(userId) {
        return await db.referralRequest.findMany({ where: { userId } });
    },

    async createReferral({ userId, partnerType, partnerName }) {
        const referralCode = `AMORA-${partnerType.toUpperCase()}-${Math.floor(1000 + Math.random() * 9000)}`;
        return await db.referralRequest.create({
            data: {
                userId,
                partnerType,
                partnerName,
                referralCode,
                status: 'requested'
            }
        });
    }
};
