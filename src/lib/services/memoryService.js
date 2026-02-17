import { db, MOCK_MEMORIES, MOCK_USERS } from "@/lib/mock-data";
import { LocalFileService } from "./localFileService";

export const MemoryService = {
    /**
     * Create a new memory.
     */
    async create(userId, data, file) {
        const user = MOCK_USERS.find(u => u.id === parseInt(userId));
        if (!user || !user.couple_id) throw new Error("USER_NOT_PAIRED");

        let imagePath = null;
        if (file) {
            imagePath = await LocalFileService.upload(file);
        }

        const memory = await db.memory.create({
            data: {
                couple_id: user.couple_id,
                title: data.title,
                description: data.description,
                memory_date: new Date(data.memory_date),
                image_path: imagePath,
                tags: data.tags
            }
        });

        // Award XP
        try {
            const { rewardService } = await import("./rewardService");
            await rewardService.awardXP(user.couple_id, 'NOSTALGIA_ENTRY', `Memory: ${data.title}`);
        } catch (xpError) {
            console.error("Failed to award XP for memory:", xpError);
        }

        return memory;
    },

    /**
     * List memories for the user's couple with filtering and sorting.
     */
    async list(userId, { page = 1, limit = 10, search = "", tag = "", sort = "date_desc" } = {}) {
        const user = MOCK_USERS.find(u => u.id === parseInt(userId));
        if (!user || !user.couple_id) return { data: [], total: 0 };

        let memories = MOCK_MEMORIES.filter(m => m.couple_id === user.couple_id);

        // Search
        if (search) {
            const lowerSearch = search.toLowerCase();
            memories = memories.filter(m =>
                m.title.toLowerCase().includes(lowerSearch) ||
                m.description.toLowerCase().includes(lowerSearch)
            );
        }

        // Tag
        if (tag) {
            memories = memories.filter(m => m.tags && m.tags.includes(tag));
        }

        // Sort
        memories.sort((a, b) => {
            const dateA = new Date(a.memory_date);
            const dateB = new Date(b.memory_date);

            if (sort === 'date_asc') return dateA - dateB;
            if (sort === 'title') return a.title.localeCompare(b.title);
            return dateB - dateA; // default date_desc
        });

        const total = memories.length;
        const start = (page - 1) * limit;
        const data = memories.slice(start, start + limit);

        return { data, total, page, limit, totalPages: Math.ceil(total / limit) };
    }
};
