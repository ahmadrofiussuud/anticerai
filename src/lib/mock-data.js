
// Mock Data for "Database-less" Vibe-Only Prototype

export const MOCK_USERS = [
    {
        id: 1,
        name: 'Adam',
        email: 'husband@example.com',
        password: '$2b$10$XLn3xts6H/egTv06m1vcgOA1/p9Py6RqCkkSRZ9PY.7f2c896GhkG', // 'password' hashed
        couple_id: 1,
        pairing_code: 'HUSB123456',
        love_language: 'Words of Affirmation',
        favorites: 'Coffee, Coding',
        role: 'husband'
    },
    {
        id: 2,
        name: 'Eve',
        email: 'wife@example.com',
        password: '$2b$10$XLn3xts6H/egTv06m1vcgOA1/p9Py6RqCkkSRZ9PY.7f2c896GhkG', // 'password' hashed
        couple_id: 1,
        pairing_code: 'WIFE123456',
        love_language: 'Quality Time',
        favorites: 'Tea, Reading',
        role: 'wife'
    }
];

export const MOCK_COUPLES = [
    {
        id: 1,
        husband_id: 1,
        wife_id: 2,
        pairing_code: 'COUPLE',
        anniversary_date: new Date('2025-01-01'),
        current_plan: 'premium'
    }
];

export const MOCK_ENERGY_LOGS = [
    { id: 1, user_id: 1, energy_level: 80, note: 'Feeling great!', createdAt: new Date() },
    { id: 2, user_id: 1, energy_level: 60, note: 'After work tired', createdAt: new Date() },
    { id: 3, user_id: 2, energy_level: 90, note: 'Morning yoga', createdAt: new Date() }
];

export const MOCK_DAILY_LOGS = [
    { id: 1, user_id: 1, strain_level: 2, note: 'Good day at work', createdAt: new Date() }
];

// Requested Additional Mock Data (Students/Teachers/Journals)
export const MOCK_RELATIONSHIP_PROFILES = [
    {
        id: 1,
        couple_id: 1,
        xp: 120,
        streak_days: 12,
        level: 'Bronze',
        created_at: new Date(Date.now() - 15 * 24 * 60 * 60 * 1000), // 15 days ago
        anniversary_date: '2025-06-15',
        partner_birthday: '1995-10-20'
    }
];

export const MOCK_VOUCHERS = [
    {
        id: 1,
        couple_id: 1,
        type: 'level',
        title: 'Newcomer Bonus',
        merchant: 'Amora Coffee',
        percent: 10,
        status: 'available',
        category: 'Coffee',
        expires_at: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000)
    }
];

export const MOCK_ACTIVITY_LOGS = [
    {
        id: 1,
        couple_id: 1,
        type: 'date',
        title: 'Dinner at Blue Lagoon',
        xp_awarded: 30,
        occurred_at: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000)
    }
];

export const MOCK_STUDENTS = [
    { id: 1, name: 'Alice', grade: '10A', status: 'Active' },
    { id: 2, name: 'Bob', grade: '10B', status: 'At Risk' }
];

export const MOCK_TEACHERS = [
    { id: 1, name: 'Mr. Smith', subject: 'Math' },
    { id: 2, name: 'Ms. Johnson', subject: 'English' }
];

export const MOCK_JOURNALS = [
    { id: 1, title: 'My First Journal', content: 'Today was a good day.', author_id: 1 }
];

export const MOCK_MEMORIES = [
    {
        id: 1,
        couple_id: 1,
        title: 'First Date',
        description: 'We went to the beach.',
        memory_date: new Date('2020-01-01'),
        image_path: null,
        tags: 'love,beach',
        createdAt: new Date()
    }
];

export const MOCK_INSIGHTS = [
    {
        id: 1,
        title: "Selamat Datang di Amora",
        brief_text: "Mulailah perjalanan Anda dengan saling menyapa setiap pagi. Komunikasi kecil membangun jembatan besar.",
        type: "text",
        trigger_context: "general",
        content_path: null,
        createdAt: new Date()
    }
];

// Helper functions to simulate DB calls
export const db = {
    user: {
        findUnique: async ({ where }) => {
            return MOCK_USERS.find(user => user.email === where.email || user.id === where.id) || null;
        },
        findFirst: async ({ where }) => {
            return MOCK_USERS.find(user => {
                // Simple matching for now
                if (where.email) return user.email === where.email;
                if (where.pairing_code) return user.pairing_code === where.pairing_code;
                return false;
            }) || null;
        },
        create: async ({ data }) => {
            const newUser = { ...data, id: MOCK_USERS.length + 1 };
            MOCK_USERS.push(newUser);
            return newUser;
        }
    },
    couple: {
        findUnique: async ({ where }) => {
            // Mock finding couple logic
            return MOCK_COUPLES[0];
        }
    },
    energyLog: {
        findMany: async () => MOCK_ENERGY_LOGS,
        create: async ({ data }) => {
            const newLog = { ...data, id: MOCK_ENERGY_LOGS.length + 1, createdAt: new Date() };
            MOCK_ENERGY_LOGS.push(newLog);
            return newLog;
        }
    },
    dailyLog: {
        findMany: async () => MOCK_DAILY_LOGS,
        create: async ({ data }) => {
            const newLog = { ...data, id: MOCK_DAILY_LOGS.length + 1, createdAt: new Date() };
            MOCK_DAILY_LOGS.push(newLog);
            return newLog;
        }
    },
    memory: {
        findMany: async ({ where }) => {
            // specific logic needed for complex filters?
            // For now just return all for couple
            return MOCK_MEMORIES.filter(m => m.couple_id === where.couple_id);
        },
        count: async ({ where }) => {
            return MOCK_MEMORIES.filter(m => m.couple_id === where.couple_id).length;
        },
        create: async ({ data }) => {
            const newMem = { ...data, id: MOCK_MEMORIES.length + 1, createdAt: new Date() };
            MOCK_MEMORIES.push(newMem);
            return newMem;
        }
    },
    insight: {
        count: async () => MOCK_INSIGHTS.length,
        findFirst: async ({ skip }) => MOCK_INSIGHTS[skip || 0] || null
    },
    relationshipProfile: {
        findUnique: async ({ where }) => {
            return MOCK_RELATIONSHIP_PROFILES.find(p => p.couple_id === where.couple_id) || null;
        },
        update: async ({ where, data }) => {
            const index = MOCK_RELATIONSHIP_PROFILES.findIndex(p => p.couple_id === where.couple_id);
            if (index !== -1) {
                MOCK_RELATIONSHIP_PROFILES[index] = { ...MOCK_RELATIONSHIP_PROFILES[index], ...data };
                return MOCK_RELATIONSHIP_PROFILES[index];
            }
            return null;
        }
    },
    voucher: {
        findMany: async ({ where }) => {
            return MOCK_VOUCHERS.filter(v => v.couple_id === where.couple_id);
        },
        create: async ({ data }) => {
            const newVoucher = { ...data, id: MOCK_VOUCHERS.length + 1 };
            MOCK_VOUCHERS.push(newVoucher);
            return newVoucher;
        },
        update: async ({ where, data }) => {
            const index = MOCK_VOUCHERS.findIndex(v => v.id === where.id);
            if (index !== -1) {
                MOCK_VOUCHERS[index] = { ...MOCK_VOUCHERS[index], ...data };
                return MOCK_VOUCHERS[index];
            }
            return null;
        }
    },
    activityLog: {
        findMany: async ({ where }) => {
            let logs = MOCK_ACTIVITY_LOGS.filter(a => a.couple_id === where.couple_id);
            if (where.occurred_at && where.occurred_at.gte) {
                logs = logs.filter(l => l.occurred_at >= where.occurred_at.gte);
            }
            return logs;
        },
        create: async ({ data }) => {
            const newLog = { ...data, id: MOCK_ACTIVITY_LOGS.length + 1, occurred_at: new Date() };
            MOCK_ACTIVITY_LOGS.push(newLog);
            return newLog;
        }
    }
};
