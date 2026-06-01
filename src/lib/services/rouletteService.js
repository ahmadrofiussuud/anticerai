import { supabase } from "@/lib/supabase";

const FALLBACK_ACTIVITIES = [
    { id: 1, title: "Piknik Sore", description: "Bawa tikar dan cemilan ke taman terdekat, nikmati sunset bersama.", category: "Outdoor", estimated_cost: "low" },
    { id: 2, title: "Memasak Bersama", description: "Pilih resep baru yang belum pernah dicoba, masak dan makan malam romantis berdua.", category: "Indoor", estimated_cost: "medium" },
    { id: 3, title: "Game Night", description: "Matikan gadget, mainkan board game atau card game seru berdua.", category: "Indoor", estimated_cost: "low" },
    { id: 4, title: "Makan Malam Mewah", description: "Berdandan rapi dan pergi ke restoran fine dining romantis.", category: "Outdoor", estimated_cost: "high" },
    { id: 5, title: "Spa Day di Rumah", description: "Saling memijat dengan minyak aroma terapi dan pasang musik relaksasi.", category: "Relaxation", estimated_cost: "low" }
];

export const RouletteService = {
    async spin(filters = {}) {
        try {
            let query = supabase.from("activities").select();

            if (filters.category) query = query.eq("category", filters.category);
            if (filters.estimated_cost) query = query.eq("estimated_cost", filters.estimated_cost);

            const { data, error } = await query;

            if (error || !data || data.length === 0) {
                // Fallback to static list if database table is empty or doesn't exist yet
                let filtered = FALLBACK_ACTIVITIES;
                if (filters.category) filtered = filtered.filter(a => a.category === filters.category);
                if (filters.estimated_cost) filtered = filtered.filter(a => a.estimated_cost === filters.estimated_cost);
                
                if (filtered.length === 0) return FALLBACK_ACTIVITIES[Math.floor(Math.random() * FALLBACK_ACTIVITIES.length)];
                return filtered[Math.floor(Math.random() * filtered.length)];
            }

            const randomIndex = Math.floor(Math.random() * data.length);
            return data[randomIndex];
        } catch (e) {
            return FALLBACK_ACTIVITIES[Math.floor(Math.random() * FALLBACK_ACTIVITIES.length)];
        }
    },

    async getCategories() {
        try {
            const { data, error } = await supabase.from("activities").select("category");
            if (error || !data || data.length === 0) {
                return Array.from(new Set(FALLBACK_ACTIVITIES.map(a => a.category)));
            }
            return Array.from(new Set(data.map(c => c.category)));
        } catch (e) {
            return Array.from(new Set(FALLBACK_ACTIVITIES.map(a => a.category)));
        }
    },

    async completeActivity(userId, activityId, title) {
        // Mock points completion
        const { MOCK_USERS } = await import("../mock-data");
        const user = MOCK_USERS.find(u => u.id === parseInt(userId));
        if (!user || !user.couple_id) return null;

        const { rewardService } = await import("./rewardService");
        return await rewardService.awardXP(user.couple_id, 'DATE_COMPLETED', `Completed Date: ${title}`);
    }
};
