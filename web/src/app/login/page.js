'use client';

import Link from "next/link";
import { Button } from "@/components/ui/button";
import { useActionState } from 'react';
import { login } from '@/lib/actions/auth';

export default function LoginPage() {
    const [state, formAction, isPending] = useActionState(login, undefined);

    return (
        <div className="min-h-screen bg-[#FDFBF7] flex items-center justify-center p-4">
            <div className="bg-white p-8 rounded-2xl shadow-lg border border-[#E5E0D0] max-w-md w-full">
                <h1 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-6 text-center">Welcome Back</h1>

                <form action={formAction} className="space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-[#6B7C6B] mb-1">Email</label>
                        <input
                            name="email"
                            type="email"
                            className="w-full px-4 py-2 rounded-lg border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] outline-none"
                            placeholder="you@example.com"
                            required
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-[#6B7C6B] mb-1">Password</label>
                        <input
                            name="password"
                            type="password"
                            className="w-full px-4 py-2 rounded-lg border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] outline-none"
                            placeholder="••••••••"
                            required
                        />
                    </div>

                    {state?.error && (
                        <div className="text-red-500 text-sm text-center">{state.error}</div>
                    )}

                    <Button
                        className="w-full bg-[#2C3E2C] hover:bg-[#1E291E] text-white"
                        disabled={isPending}
                    >
                        {isPending ? 'Logging in...' : 'Log in'}
                    </Button>
                </form>

                <div className="mt-4 text-center">
                    <Link href="/register" className="text-sm text-[#C67C5C] hover:underline">Don't have an account? Register</Link>
                </div>
            </div>
        </div>
    );
}
