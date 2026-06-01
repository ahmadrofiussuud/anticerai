"use client";

import { useState, useRef, useEffect } from "react";
import { Loader2, Send, Info, X, Trash } from "lucide-react";

export default function ChatInterface() {
    const [messages, setMessages] = useState([
        {
            type: "system",
            content: "Selamat datang di Invisible Bridge. Ceritakan apa yang kamu rasakan, aku siap mendengarkan dan membantu mencari solusi psikologis untuk hubunganmu."
        }
    ]);
    const [input, setInput] = useState("");
    const [isLoading, setIsLoading] = useState(false);
    const [showNVCGuide, setShowNVCGuide] = useState(false);

    // Auto-scroll logic
    const messagesEndRef = useRef(null);
    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    // Load messages from localStorage on mount
    useEffect(() => {
        if (typeof window !== "undefined") {
            const saved = localStorage.getItem("amora_bridge_chats");
            if (saved) {
                try {
                    setMessages(JSON.parse(saved));
                } catch (e) {
                    console.error("Failed to load chats from localStorage:", e);
                }
            }
        }
    }, []);

    // Save messages to localStorage when updated
    useEffect(() => {
        if (typeof window !== "undefined" && messages.length > 1) {
            localStorage.setItem("amora_bridge_chats", JSON.stringify(messages));
        }
        scrollToBottom();
    }, [messages]);

    const handleSendMessage = async (e) => {
        e.preventDefault();
        if (!input.trim() || isLoading) return;

        console.log("💬 [ChatInterface] User sending message:", input);

        const userMsg = { type: "user", content: input };
        setMessages((prev) => [...prev, userMsg]);
        setInput("");
        setIsLoading(true);

        try {
            // Prepare history for API (excluding system message if needed, or keeping it depending on backend)
            // The backend handles the system prompt, so we just send the chat log.
            const history = messages.filter(m => m.type !== 'system');

            console.log("✈️ [ChatInterface] POST Payload to /api/bridge/chat:", {
                message: input,
                history: history
            });

            const res = await fetch("/api/bridge/chat", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    message: input,
                    history: history
                })
            });

            const data = await res.json();
            console.log("📥 [ChatInterface] Received response data:", data);

            if (data.error) {
                console.error("❌ [ChatInterface] API Error Response:", data.error);
                // Fallback message
                setMessages((prev) => [...prev, { type: "amora", content: "Maaf, saya sedang mengalami gangguan koneksi. Mohon coba lagi nanti." }]);
            } else {
                console.log("✨ [ChatInterface] AI Reply:", data.reply);
                setMessages((prev) => [...prev, { type: "amora", content: data.reply }]);
            }

            setIsLoading(false);

        } catch (error) {
            console.error("💥 [ChatInterface] Catch Chat error:", error);
            setMessages((prev) => [...prev, { type: "amora", content: "Maaf, terjadi kesalahan pada sistem." }]);
            setIsLoading(false);
        }
    };

    return (
        <div className="bg-white overflow-hidden relative" style={{ height: "600px" }}>
            {/* Subtle Interior Pattern */}
            <div className="absolute inset-0 opacity-[0.35] pointer-events-none bg-repeat bg-[length:400px]"
                style={{ backgroundImage: "url('https://images.unsplash.com/photo-1574169208507-84376144848b?q=80&w=2079&auto=format&fit=crop')" }}>
            </div>

            <div className="h-full flex flex-col relative z-10">
                {/* Messages Area */}
                <div className="flex-1 overflow-y-auto p-6 space-y-4">
                    {messages.map((msg, idx) => {
                        // ... existing message mapping
                        if (msg.type === 'user') {
                            return (
                                <div key={idx} className="flex justify-end">
                                    <div className="max-w-md">
                                        <div className="bg-[#4A6741] text-white rounded-2xl rounded-tr-sm px-5 py-3 shadow-md">
                                            <div className="text-xs font-bold mb-1 opacity-80">You</div>
                                            <p className="text-sm leading-relaxed">{msg.content}</p>
                                        </div>
                                    </div>
                                </div>
                            );
                        } else if (msg.type === 'amora') {
                            return (
                                <div key={idx} className="flex justify-start">
                                    <div className="max-w-md">
                                        <div className="bg-[#2C3E2C] text-[#E8E6D9] rounded-2xl rounded-tl-sm px-5 py-3 shadow-md">
                                            <div className="text-xs font-bold mb-1 text-[#B5C4B5]">Amora AI</div>
                                            <div className="text-sm leading-relaxed">{msg.content}</div>
                                        </div>
                                    </div>
                                </div>
                            );
                        } else {
                            return (
                                <div key={idx} className="flex justify-center">
                                    <div className="bg-[#E5E0D0] text-[#2A3C2A] rounded-xl px-4 py-2 text-xs text-center max-w-sm">
                                        {msg.content}
                                    </div>
                                </div>
                            );
                        }
                    })}

                    {isLoading && (
                        <div className="flex justify-start">
                            <div className="bg-[#2C3E2C] text-[#E8E6D9] rounded-2xl rounded-tl-sm px-5 py-3 shadow-md">
                                <div className="flex items-center gap-2">
                                    <div className="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce"></div>
                                    <div className="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce delay-75"></div>
                                    <div className="w-2 h-2 bg-[#B5C4B5] rounded-full animate-bounce delay-150"></div>
                                </div>
                            </div>
                        </div>
                    )}
                    <div ref={messagesEndRef} />
                </div>

                {/* NVC Guide Button */}
                <div className="px-6 py-3 border-t border-[#E5E0D0]">
                    <button
                        onClick={() => setShowNVCGuide(true)}
                        className="w-full bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#B56B4B] hover:to-[#C7896A] text-white font-bold py-3 rounded-xl text-sm shadow-lg transition-all"
                    >
                        Read The NVC Communication Guide
                    </button>
                </div>

                {/* Input Area */}
                <div className="p-4 bg-[#FDFBF7]">
                    <form onSubmit={handleSendMessage} className="flex gap-3">
                        <button
                            type="button"
                            onClick={() => {
                                if (confirm("Apakah Anda yakin ingin menghapus semua riwayat chat ini?")) {
                                    setMessages([
                                        {
                                            type: "system",
                                            content: "Selamat datang di Invisible Bridge. Ceritakan apa yang kamu rasakan, aku siap mendengarkan dan membantu mencari solusi psikologis untuk hubunganmu."
                                        }
                                    ]);
                                    localStorage.removeItem("amora_bridge_chats");
                                }
                            }}
                            title="Hapus semua chat"
                            className="bg-red-50 hover:bg-red-100 text-red-600 w-12 h-12 rounded-full flex items-center justify-center shadow-md transition-all hover:scale-105"
                        >
                            <Trash className="w-5 h-5" />
                        </button>
                        <input
                            type="text"
                            value={input}
                            onChange={(e) => setInput(e.target.value)}
                            placeholder="Type a message..."
                            className="flex-1 bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white placeholder-white/70 border-none rounded-full px-6 py-3 focus:ring-2 focus:ring-[#C67C5C] focus:ring-offset-2 text-sm"
                        />
                        <button
                            type="submit"
                            disabled={!input.trim() || isLoading}
                            className="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] hover:from-[#B56B4B] hover:to-[#C7896A] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-105"
                        >
                            <Send className="w-5 h-5" />
                        </button>
                    </form>
                </div>

                {/* NVC Guide Modal (Re-implemented for feature completeness) */}
                {showNVCGuide && (
                    <div className="absolute inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm animate-fadeIn">
                        <div className="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative">
                            <button
                                onClick={() => setShowNVCGuide(false)}
                                className="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
                            >
                                <X className="w-6 h-6" />
                            </button>
                            <h4 className="text-xl font-serif font-bold text-[#2A3C2A] mb-4">Panduan NVC</h4>
                            <div className="space-y-4 text-sm text-[#4A4A4A]">
                                <p className="bg-[#E8F5E9] p-3 rounded-lg border border-[#C8E6C9]">
                                    <strong>1. Observation (Observasi):</strong> Ceritakan fakta tanpa penghakiman.
                                </p>
                                <p className="bg-[#FFF3E0] p-3 rounded-lg border border-[#FFE0B2]">
                                    <strong>2. Feeling (Perasaan):</strong> Ungkapkan emosi murni.
                                </p>
                                <p className="bg-[#E3F2FD] p-3 rounded-lg border border-[#BBDEFB]">
                                    <strong>3. Need (Kebutuhan):</strong> Apa kebutuhan dasar yang tidak terpenuhi?
                                </p>
                                <p className="bg-[#F3E5F5] p-3 rounded-lg border border-[#E1BEE7]">
                                    <strong>4. Request (Permintaan):</strong> Ajukan tindakan konkret.
                                </p>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
}
