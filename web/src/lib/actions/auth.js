'use server';

import { signIn, signOut } from '@/auth';
import { PrismaClient } from '@prisma/client';
import bcrypt from 'bcryptjs';
import { AuthError } from 'next-auth';
import { z } from 'zod';

const prisma = new PrismaClient();

const loginSchema = z.object({
    email: z.string().email(),
    password: z.string().min(1, 'Password is required'),
});

const registerSchema = z.object({
    name: z.string().min(2),
    email: z.string().email(),
    password: z.string().min(8),
});

export async function login(prevState, formData) {
    const validatedFields = loginSchema.safeParse(Object.fromEntries(formData.entries()));

    if (!validatedFields.success) {
        return {
            error: 'Invalid fields',
        };
    }

    const { email, password } = validatedFields.data;

    try {
        await signIn('credentials', {
            email,
            password,
            redirectTo: '/home',
        });
    } catch (error) {
        if (error instanceof AuthError) {
            switch (error.type) {
                case 'CredentialsSignin':
                    return { error: 'Invalid credentials.' };
                default:
                    return { error: 'Something went wrong.' };
            }
        }
        throw error;
    }
}

export async function register(prevState, formData) {
    const validatedFields = registerSchema.safeParse(Object.fromEntries(formData.entries()));

    if (!validatedFields.success) {
        return {
            error: 'Invalid fields',
        };
    }

    const { name, email, password } = validatedFields.data;

    try {
        const existingUser = await prisma.user.findUnique({
            where: { email },
        });

        if (existingUser) {
            return { error: 'Email already in use.' };
        }

        const hashedPassword = await bcrypt.hash(password, 10);

        // Create 10 char pairing code
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let pairing_code = '';
        for (let i = 0; i < 10; i++) {
            pairing_code += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        await prisma.user.create({
            data: {
                name,
                email,
                password: hashedPassword,
                pairing_code,
                // Laravel's RegisterController might auto-login? NextAuth signIn will handle session.
            },
        });

    } catch (error) {
        console.error('Registration error:', error);
        return { error: 'Failed to create user.' };
    }

    // Auto-login after registration
    try {
        await signIn('credentials', {
            email,
            password,
            redirectTo: '/home',
        });
    } catch (error) {
        if (error instanceof AuthError) {
            switch (error.type) {
                default:
                    return { error: 'Something went wrong during auto-login.' };
            }
        }
        throw error;
    }
}

export async function logout() {
    await signOut({ redirectTo: '/login' });
}
