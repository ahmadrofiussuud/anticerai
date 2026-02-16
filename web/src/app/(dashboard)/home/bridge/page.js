"use client";

import ChatInterface from "@/components/features/bridge/ChatInterface";

export default function BridgePage() {
    return (
        <div className="min-h-screen bg-cover bg-center bg-fixed relative" style={{ backgroundImage: "url('https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?q=80&w=2540&auto=format&fit=crop')" }}>
            <div className="min-h-screen bg-[#FDFBF7]/80 backdrop-blur-sm flex flex-col">

                {/* Hero Section with Gradient */}
                <div className="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white py-8 shadow-lg relative z-10">
                    <div className="max-w-4xl mx-auto px-4 text-center">
                        <h1 className="text-4xl font-serif font-bold mb-2">Invisible Bridge</h1>
                        <p className="text-white/90 text-sm">Private Encrypted Chat</p>
                    </div>
                </div>

                {/* Chat Container */}
                <div className="max-w-4xl mx-auto px-4 py-8 w-full flex-1 flex flex-col">
                    <ChatInterface />
                </div>
            </div>
        </div>
    );
}
