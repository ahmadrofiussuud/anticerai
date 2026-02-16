import { PrismaClient } from "@prisma/client";

const prisma = new PrismaClient();

export const RouletteService = {
    async spin(filters = {}) {
        const where = {};
        if (filters.category) where.category = filters.category;
        if (filters.estimated_cost) where.estimated_cost = filters.estimated_cost;

        const count = await prisma.activity.count({ where });
        if (count === 0) return null;

        const skip = Math.floor(Math.random() * count);
        const [randomActivity] = await prisma.activity.findMany({
            where,
            take: 1,
            skip,
        });

        return randomActivity;
    },

    async getCategories() {
        const categories = await prisma.activity.groupBy({
            by: ['category'],
        });
        return categories.map(c => c.category);
    }
};
