const { PrismaClient } = require('@prisma/client');
const prisma = new PrismaClient();
const bcrypt = require('bcryptjs');

async function main() {
    const password = await bcrypt.hash('password', 10);

    // Create Users
    const husband = await prisma.user.upsert({
        where: { email: 'husband@example.com' },
        update: {},
        create: {
            name: 'Adam',
            email: 'husband@example.com',
            password,
            pairing_code: 'HUSB123456', // 10 chars
            love_language: 'Words of Affirmation',
            favorites: 'Coffee, Coding',
        },
    });

    const wife = await prisma.user.upsert({
        where: { email: 'wife@example.com' },
        update: {},
        create: {
            name: 'Eve',
            email: 'wife@example.com',
            password,
            pairing_code: 'WIFE123456', // 10 chars
            love_language: 'Quality Time',
            favorites: 'Tea, Reading',
        },
    });

    console.log({ husband, wife });

    // Create Couple
    const couple = await prisma.couple.upsert({
        where: { pairing_code: 'COUPLE' },
        update: {},
        create: {
            pairing_code: 'COUPLE', // 6 chars
            husband_id: husband.id,
            wife_id: wife.id,
            anniversary_date: new Date('2025-01-01'),
            current_plan: 'premium',
        },
    });

    console.log({ couple });

    // Link users to couple
    await prisma.user.update({
        where: { id: husband.id },
        data: { couple_id: couple.id },
    });
    await prisma.user.update({
        where: { id: wife.id },
        data: { couple_id: couple.id },
    });

    // Create Energy Logs
    await prisma.energyLog.createMany({
        data: [
            { user_id: husband.id, energy_level: 80, note: 'Feeling great!' },
            { user_id: husband.id, energy_level: 60, note: 'After work tired' },
            { user_id: wife.id, energy_level: 90, note: 'Morning yoga' },
        ],
    });

    // Create Activities
    await prisma.activity.createMany({
        data: [
            { title: 'Sunset Walk', category: 'Chill', description: 'Walk on the beach', estimated_cost: '$' },
            { title: 'Fancy Dinner', category: 'Food', description: 'Michelin star restaurant', estimated_cost: '$$$' },
        ],
    });

    // Create Growth Materials
    await prisma.growthMaterial.createMany({
        data: [
            {
                title: 'Communication 101',
                type: 'article',
                thumbnail_url: '/images/comm.jpg',
                category: 'Communication',
                description: 'How to talk better.',
                url: 'https://example.com/article'
            },
        ],
    });

    console.log('Seeding finished.');
}

main()
    .then(async () => {
        await prisma.$disconnect();
    })
    .catch(async (e) => {
        console.error(e);
        await prisma.$disconnect();
        process.exit(1);
    });
