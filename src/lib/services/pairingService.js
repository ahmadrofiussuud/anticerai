import { supabase } from "@/lib/supabase";

export const PairingService = {
    /**
     * Generate a new pairing code for a user.
     * Logic: 10 random characters (uppercase alphanumeric).
     */
    async generateCode(userId) {
        const code = this.generateRandomCode(10);

        const { data, error } = await supabase
            .from("users")
            .update({
                pairing_code: code
            })
            .eq("id", parseInt(userId))
            .select("pairing_code")
            .single();

        if (error) throw error;
        return data;
    },

    /**
     * Connect a user to another user using a pairing code.
     */
    async connectUser(userId, pairingCode) {
        // Find current user
        const { data: currentUser, error: userError } = await supabase
            .from("users")
            .select()
            .eq("id", parseInt(userId))
            .single();

        if (userError || !currentUser) throw new Error("USER_NOT_FOUND");
        if (currentUser.couple_id) {
            throw new Error("ALREADY_PAIRED");
        }

        // Find partner
        const { data: partner, error: partnerError } = await supabase
            .from("users")
            .select()
            .eq("pairing_code", pairingCode)
            .single();

        if (partnerError || !partner) {
            throw new Error("INVALID_CODE");
        }

        if (partner.id === currentUser.id) {
            throw new Error("CANNOT_PAIR_SELF");
        }

        if (partner.couple_id) {
            throw new Error("PARTNER_ALREADY_PAIRED");
        }

        // Create Couple record
        const coupleCode = this.generateRandomCode(6);
        const { data: couple, error: coupleError } = await supabase
            .from("couples")
            .insert({
                pairing_code: coupleCode,
                husband_id: String(currentUser.id),
                wife_id: String(partner.id),
                current_plan: 'free',
                anniversary_date: new Date().toISOString()
            })
            .select()
            .single();

        if (coupleError) throw coupleError;

        // Update both users with new couple_id
        await supabase
            .from("users")
            .update({ couple_id: String(couple.id), pairing_code: null })
            .eq("id", currentUser.id);

        await supabase
            .from("users")
            .update({ couple_id: String(couple.id), pairing_code: null })
            .eq("id", partner.id);

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
