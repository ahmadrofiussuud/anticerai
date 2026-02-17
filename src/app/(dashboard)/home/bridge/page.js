import ChatInterface from "@/components/features/bridge/ChatInterface";
import CareCTACard from "@/components/features/bridge/care/CareCTACard";
import { ChevronLeft, Sparkles } from "lucide-react";
import Link from "next/link";

export default function BridgePage() {
    return (
        <div className="min-h-screen bg-[#FDFBF7] pb-20 pt-8">
            <div className="max-w-[1200px] mx-auto px-6 sm:px-10">



                {/* Bento Grid Layout */}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                    {/* Left: AI Chat Interface (Main Module) */}
                    <div className="lg:col-span-7 xl:col-span-8">
                        <div className="bg-white rounded-[2.5rem] shadow-2xl border border-black/5 overflow-hidden">
                            <div className="bg-[#2A3C2A] p-6 flex items-center justify-between text-white">
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-[#C67C5C] rounded-xl flex items-center justify-center">
                                        <Sparkles className="w-5 h-5 text-white" />
                                    </div>
                                    <div>
                                        <div className="text-xs font-bold opacity-60 uppercase tracking-widest">Powered by Amora AI</div>
                                        <div className="text-sm font-bold">Invisible Bridge Chat</div>
                                    </div>
                                </div>
                                <div className="flex items-center gap-1.5">
                                    <div className="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span className="text-[10px] font-bold uppercase tracking-wider opacity-60">Ready</span>
                                </div>
                            </div>
                            <ChatInterface />
                        </div>
                    </div>

                    {/* Right: Bridge Care (Secondary Module) */}
                    <div className="lg:col-span-5 xl:col-span-4 space-y-6">
                        <CareCTACard />

                        {/* Info Card */}
                        <div className="bg-[#2A3C2A] rounded-[2rem] p-8 text-white shadow-xl relative overflow-hidden">
                            <div className="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                            <div className="relative z-10">
                                <h4 className="text-lg font-serif font-bold mb-4">Privasi Prioritas</h4>
                                <p className="text-sm text-white/70 leading-relaxed font-medium">
                                    Seluruh percakapan di Bridge dienkripsi dan bersifat privat. Amora membantu menjembatani perasaan tanpa menghakimi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
