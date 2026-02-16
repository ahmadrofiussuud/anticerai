"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Copy, Loader2, Heart } from "lucide-react";
import { useSession } from "next-auth/react";

export default function PairingManager() {
    const { data: session, update } = useSession();
    const [joinCode, setJoinCode] = useState("");
    const [isGenerating, setIsGenerating] = useState(false);
    const [isJoining, setIsJoining] = useState(false);
    const [error, setError] = useState("");

    // Function to handle logout if stuck
    const handleLogout = async () => {
        // We need to import signOut from next-auth/react or use a server action
        // Since we are client side, next-auth/react is better but let's check imports
        const { signOut } = await import("next-auth/react");
        await signOut();
    };

    const handleGenerateCode = async () => {
        setIsGenerating(true);
        setError("");
        try {
            const res = await fetch("/api/pairing/generate", { method: "POST" });
            const data = await res.json();
            if (res.ok) {
                await update({ ...session, user: { ...session?.user, pairing_code: data.code } });
            } else {
                setError(data.error || "Failed to generate code");
            }
        } catch (e) {
            setError("Something went wrong");
        } finally {
            setIsGenerating(false);
        }
    };

    const handleConnect = async () => {
        if (!joinCode) return;
        setIsJoining(true);
        setError("");
        try {
            const res = await fetch("/api/pairing/connect", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ code: joinCode }),
            });
            const data = await res.json();

            if (res.ok) {
                // Force session update to reflect new couple_id
                await update();
                window.location.reload(); // Hard reload to ensure all state is fresh
            } else {
                setError(data.error || "Failed to connect");
            }
        } catch (e) {
            setError("Connection failed");
        } finally {
            setIsJoining(false);
        }
    };

    return (
        <div className="max-w-2xl mx-auto py-12 px-4">
            <div className="bg-white rounded-3xl shadow-xl overflow-hidden border border-[#E5E0D0]">
                <div className="bg-[#2A3C2A] px-8 py-8 text-center">
                    <div className="inline-flex items-center justify-center w-16 h-16 bg-[#FDFBF7] rounded-full mb-4">
                        <Heart className="w-8 h-8 text-[#C67C5C] fill-current" />
                    </div>
                    <h2 className="text-2xl font-serif font-bold text-[#FDFBF7] mb-2">Connect with your Partner</h2>
                    <p className="text-[#B5C4B5]">Pair your accounts to start your shared journey.</p>
                </div>

                <div className="p-8 space-y-8">
                    {/* Share Code Section */}
                    <div>
                        <h3 className="text-sm font-bold text-[#6B7C6B] uppercase tracking-wider mb-3">Your Pairing Code</h3>
                        <div className="flex gap-2">
                            <div className="flex-1 bg-[#F5F2EA] border border-[#E5E0D0] rounded-lg px-4 py-3 font-mono text-lg text-[#2A3C2A] text-center tracking-widest">
                                {session?.user?.pairing_code || "••••••••••"}
                            </div>
                            <Button
                                variant="outline"
                                className="border-[#E5E0D0] text-[#6B7C6B] hover:text-[#2A3C2A]"
                                onClick={() => navigator.clipboard.writeText(session?.user?.pairing_code)}
                            >
                                <Copy className="w-4 h-4" />
                            </Button>
                        </div>
                        {!session?.user?.pairing_code && (
                            <Button
                                variant="link"
                                className="text-[#C67C5C] p-0 h-auto mt-2 text-sm"
                                onClick={handleGenerateCode}
                                disabled={isGenerating}
                            >
                                {isGenerating ? "Generating..." : "Generate Code"}
                            </Button>
                        )}
                    </div>

                    <div className="relative">
                        <div className="absolute inset-0 flex items-center">
                            <span className="w-full border-t border-[#E5E0D0]"></span>
                        </div>
                        <div className="relative flex justify-center text-xs uppercase">
                            <span className="bg-white px-2 text-[#B0A69D]">Or enter partner's code</span>
                        </div>
                    </div>

                    {/* Join Section */}
                    <div className="space-y-3">
                        <Input
                            placeholder="Enter 10-character code"
                            className="text-center font-mono uppercase tracking-widest border-[#E5E0D0] focus:ring-[#C67C5C]"
                            maxLength={10}
                            value={joinCode}
                            onChange={(e) => setJoinCode(e.target.value.toUpperCase())}
                        />
                        <Button
                            className="w-full bg-[#C67C5C] hover:bg-[#A66448] text-white"
                            onClick={handleConnect}
                            disabled={isJoining || joinCode.length !== 10}
                        >
                            {isJoining ? <Loader2 className="w-4 h-4 animate-spin mr-2" /> : null}
                            {isJoining ? "Connecting..." : "Connect Partners"}
                        </Button>
                        {error && <p className="text-red-500 text-sm text-center">{error}</p>}
                    </div>
                </div>

                {/* Emergency Logout */}
                <div className="bg-[#FDFBF7] p-4 text-center border-t border-[#E5E0D0]">
                    <p className="text-xs text-[#6B7C6B] mb-2">Salah akun? Atau ingin login ulang?</p>
                    <Button
                        variant="ghost"
                        className="text-red-500 hover:text-red-600 hover:bg-red-50 text-xs"
                        onClick={handleLogout}
                    >
                        Sign Out / Keluar
                    </Button>
                </div>
            </div>
        </div>
    );
}
