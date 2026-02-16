import { PrismaClient } from "@prisma/client";

const prisma = new PrismaClient();

export const PairingService = {
    /**
     * Generate a new pairing code for a user.
     * Logic: 10 random characters (uppercase alphanumeric).
     */
    async generateCode(userId) {
        const code = this.generateRandomCode(10);
        const expiresAt = new Date(Date.now() + 24 * 60 * 60 * 1000); // 24 hours

        return await prisma.user.update({
            where: { id: parseInt(userId) },
            data: {
                pairing_code: code,
                pairing_code_expires_at: expiresAt,
            },
            select: { pairing_code: true, pairing_code_expires_at: true }
        });
    },

    /**
     * Connect a user to another user using a pairing code.
     */
    async connectUser(userId, pairingCode) {
        const currentUser = await prisma.user.findUnique({ where: { id: parseInt(userId) } });
        if (currentUser.couple_id) {
            throw new Error("ALREADY_PAIRED");
        }

        const partner = await prisma.user.findUnique({
            where: { pairing_code: pairingCode },
        });

        if (!partner) {
            throw new Error("INVALID_CODE");
        }

        if (partner.id === currentUser.id) {
            throw new Error("CANNOT_PAIR_SELF");
        }

        if (partner.couple_id) {
            throw new Error("PARTNER_ALREADY_PAIRED");
        }

        // Logic: Create Couple
        // Couple pairing code is 6 digits per separate logic, usually for shared access?
        const coupleCode = this.generateRandomCode(6);

        const couple = await prisma.couple.create({
            data: {
                pairing_code: coupleCode,
                husband_id: currentUser.id, // Assigning arbitrarily or based on logic? 
                // Parity note: Laravel might have specific logic for husband/wife assignment.
                // Here we just assign one to one slot.
                // Better: Check gender if available, or just assign to users[] relation to be safe?
                // Schema has specific husband_id/wife_id fields. 
                // We'll assign currentUser to husband_id and partner to wife_id for now, 
                // or leaving them null and just using relations? 
                // The migration has husband_id/wife_id.
                husband_id: currentUser.id,
                wife_id: partner.id,
                current_plan: 'free',
                anniversary_date: new Date(),
            },
        });

        // Update both users
        await prisma.user.update({
            where: { id: currentUser.id },
            data: { couple_id: couple.id, pairing_code: null, pairing_code_expires_at: null },
        });

        await prisma.user.update({
            where: { id: partner.id },
            data: { couple_id: couple.id, pairing_code: null, pairing_code_expires_at: null },
        });

        return couple;
    },

    generateRandomCode(length) {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    },
};
