'use client';

import Link from "next/link";
import { Button } from "@/components/ui/button";
import { useActionState } from 'react';
import { register } from '@/lib/actions/auth';

export default function RegisterPage() {
    const [state, formAction, isPending] = useActionState(register, undefined);

    return (
        <div className="min-h-screen bg-[#FDFBF7] flex items-center justify-center p-4">
            <div className="bg-white p-8 rounded-2xl shadow-lg border border-[#E5E0D0] max-w-md w-full">
                <h1 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-6 text-center">Create Account</h1>

                <form action={formAction} className="space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-[#6B7C6B] mb-1">Name</label>
                        <input
                            name="name"
                            type="text"
                            className="w-full px-4 py-2 rounded-lg border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] outline-none"
                            placeholder="Your Name"
                            required
                        />
                    </div>
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
                            minLength={8}
                        />
                    </div>

                    {state?.error && (
                        <div className="text-red-500 text-sm text-center">{state.error}</div>
                    )}

                    <Button
                        className="w-full bg-[#2C3E2C] hover:bg-[#1E291E] text-white"
                        disabled={isPending}
                    >
                        {isPending ? 'creating account...' : 'Register'}
                    </Button>
                </form>

                <div className="mt-4 text-center">
                    <Link href="/login" className="text-sm text-[#C67C5C] hover:underline">Already have an account? Log in</Link>
                </div>
            </div>
        </div>
    );
}
