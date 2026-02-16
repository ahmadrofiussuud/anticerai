import { PrismaClient } from "@prisma/client";
import { LocalFileService } from "./localFileService";

const prisma = new PrismaClient();

export const MemoryService = {
    /**
     * Create a new memory.
     */
    async create(userId, data, file) {
        const user = await prisma.user.findUnique({ where: { id: parseInt(userId) } });
        if (!user.couple_id) throw new Error("USER_NOT_PAIRED");

        let imagePath = null;
        if (file) {
            imagePath = await LocalFileService.upload(file);
        }

        return await prisma.memory.create({
            data: {
                couple_id: user.couple_id,
                title: data.title,
                description: data.description,
                memory_date: new Date(data.memory_date),
                image_path: imagePath,
                tags: data.tags // Assuming string/JSON
            }
        });
    },

    /**
     * List memories for the user's couple.
     */
    /**
     * List memories for the user's couple with filtering and sorting.
     */
    async list(userId, { page = 1, limit = 10, search = "", tag = "", sort = "date_desc" } = {}) {
        const user = await prisma.user.findUnique({ where: { id: parseInt(userId) } });
        if (!user.couple_id) return { data: [], total: 0 };

        const skip = (page - 1) * limit;

        // Build where clause
        const where = {
            couple_id: user.couple_id,
            AND: []
        };

        if (search) {
            where.AND.push({
                OR: [
                    { title: { contains: search } },
                    { description: { contains: search } }
                ]
            });
        }

        if (tag) {
            where.AND.push({
                tags: { contains: tag }
            });
        }

        // Build order by
        let orderBy = {};
        switch (sort) {
            case 'date_asc':
                orderBy = { memory_date: 'asc' };
                break;
            case 'title':
                orderBy = { title: 'asc' };
                break;
            case 'date_desc':
            default:
                orderBy = { memory_date: 'desc' };
                break;
        }

        const [data, total] = await Promise.all([
            prisma.memory.findMany({
                where,
                orderBy,
                skip,
                take: limit,
            }),
            prisma.memory.count({ where })
        ]);

        return { data, total, page, limit, totalPages: Math.ceil(total / limit) };
    }
};
