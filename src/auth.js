import NextAuth from "next-auth"
import Credentials from "next-auth/providers/credentials"
import { z } from "zod"
import { authConfig } from "./auth.config"
import { db } from "@/lib/mock-data"

async function getUser(email) {
    try {
        return await db.user.findUnique({
            where: { email },
        });
    } catch (error) {
        console.error('Failed to fetch user:', error);
        throw new Error('Failed to fetch user.');
    }
}

export const { handlers, auth, signIn, signOut } = NextAuth({
    ...authConfig,
    callbacks: {
        ...authConfig.callbacks,
        async session({ session, token }) {
            if (token.sub && session.user) {
                // Mock session enrichment
                session.user.id = token.sub;
                const user = await getUser(session.user.email);
                if (user) {
                    session.user.couple_id = user.couple_id;
                    session.user.pairing_code = user.pairing_code;
                }
            }
            return session;
        },
        async jwt({ token }) {
            return token;
        },
    },
    providers: [
        Credentials({
            async authorize(credentials) {
                const parsedCredentials = z
                    .object({ email: z.string().email(), password: z.string().min(1) })
                    .safeParse(credentials);

                if (parsedCredentials.success) {
                    const { email, password } = parsedCredentials.data;
                    const user = await getUser(email);

                    // VIBE ONLY: Accept any password for mock users, 
                    // or specific one if you want realism. 
                    // Let's just check if user exists.
                    if (user) return user;

                    // Fallback for generic testing if needed
                    if (email === 'admin@example.com') {
                        return { id: 999, name: 'Admin', email: 'admin@example.com' };
                    }
                }

                console.log('Invalid credentials');
                return null;
            },
        }),
    ],
})
