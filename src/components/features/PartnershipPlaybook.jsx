"use client";
import { useState, useEffect } from "react";
import { Loader2 } from "lucide-react";

export default function PartnershipPlaybook() {
    const [insight, setInsight] = useState(null);
    const [loadingInsight, setLoadingInsight] = useState(true);
    const [isSaved, setIsSaved] = useState(false);

    // Amora AI State
    const [amoraMode, setAmoraMode] = useState("INTERPRETER"); // INTERPRETER | SPARK
    const [userComplaint, setUserComplaint] = useState("");
    const [amoraResponse, setAmoraResponse] = useState(null);
    const [loadingAmora, setLoadingAmora] = useState(false);

    useEffect(() => {
        fetch("/api/insights/daily")
            .then((res) => res.json())
            .then((data) => {
                setInsight(data);
                setLoadingInsight(false);
            })
            .catch((err) => {
                console.error("Failed to fetch insight", err);
                setLoadingInsight(false);
            });
    }, []);

    const toggleSave = () => {
        setIsSaved(!isSaved);
        // Todo: Persist save state
    };

    const askAmora = async () => {
        if (amoraMode === "INTERPRETER" && !userComplaint.trim()) return;

        setLoadingAmora(true);
        setAmoraResponse(null);

        try {
            const res = await fetch("/api/amora/chat", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    mode: amoraMode,
                    text: amoraMode === "INTERPRETER" ? userComplaint : null,
                }),
            });
            const data = await res.json();
            setAmoraResponse(data);
        } catch (error) {
            console.error("Amora Error:", error);
        } finally {
            setLoadingAmora(false);
        }
    };

    const resetAmora = () => {
        setUserComplaint("");
        setAmoraResponse(null);
    };

    return (
        <div className="h-full bg-white rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E5E0D0] p-8 flex flex-col relative overflow-hidden group text-[#2A3C2A] transition-all duration-500 hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] hover:-translate-y-1">
            {/* Natural Background Elements */}
            <div className="absolute top-0 right-0 w-64 h-64 bg-[#E8F5E9] rounded-full blur-[60px] opacity-40 pointer-events-none -mr-16 -mt-16"></div>
            <div className="absolute bottom-0 left-0 w-64 h-64 bg-[#FFF3E0] rounded-full blur-[60px] opacity-40 pointer-events-none -ml-16 -mb-16"></div>

            {/* Header */}
            <div className="flex justify-between items-start mb-8 relative z-10">
                <div>
                    <h3 className="text-3xl font-serif font-bold tracking-tight mb-2 text-[#2A3C2A]">
                        Hikmah Harian
                    </h3>
                    <p className="text-[#6B7C6B] text-sm font-medium tracking-wide uppercase">
                        Dipilih untukmu
                    </p>
                </div>
                <button
                    onClick={toggleSave}
                    className={`w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 ${isSaved
                        ? "bg-[#D86C58] text-white shadow-lg shadow-[#D86C58]/30"
                        : "bg-[#E5E0D0] text-[#6B7C6B] hover:bg-[#D4CEBC]"
                        }`}
                >
                    <svg
                        className={`w-5 h-5 ${isSaved ? "fill-current" : ""}`}
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            strokeWidth="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                        ></path>
                    </svg>
                </button>
            </div>

            {loadingInsight ? (
                <div className="flex-grow flex items-center justify-center">
                    <Loader2 className="animate-spin text-[#2A3C2A]/30 w-8 h-8" />
                </div>
            ) : insight ? (
                <div className="flex-grow flex flex-col relative z-10">
                    <span
                        className={`inline-block py-1.5 px-4 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6 w-fit border ${insight.trigger_context === "low_energy"
                            ? "bg-[#D86C58]/10 text-[#D86C58] border-[#D86C58]/20"
                            : "bg-[#4A6741]/10 text-[#4A6741] border-[#4A6741]/20"
                            }`}
                    >
                        {insight.trigger_context === "low_energy"
                            ? "Istirahat & Pemulihan"
                            : "Pemicu Semangat"}
                    </span>

                    <h4 className="text-3xl font-serif font-medium leading-tight mb-4 text-[#1E2923]">
                        {insight.title}
                    </h4>
                    <p className="text-[#5C6B5C] text-base leading-relaxed mb-8 font-medium">
                        {insight.brief_text}
                    </p>

                    {insight.type === "audio" && (
                        <div className="bg-white/60 backdrop-blur-md rounded-2xl p-4 flex items-center gap-4 border border-[#E5E0D0] hover:bg-white/80 transition-colors cursor-pointer group/audio shadow-sm">
                            <div className="w-12 h-12 bg-[#D86C58] rounded-full flex items-center justify-center shadow-lg group-hover/audio:scale-110 transition-transform text-white">
                                <svg
                                    className="w-5 h-5 ml-0.5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                            <div className="flex-grow">
                                <div className="text-xs font-bold text-[#2A3C2A] mb-1 uppercase tracking-wider">
                                    Putar Audio
                                </div>
                                <div className="h-1 bg-[#E5E0D0] rounded-full w-full overflow-hidden">
                                    <div className="h-full bg-[#D86C58] w-1/3 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            ) : (
                <div className="flex-grow flex items-center justify-center text-[#6B7C6B]">
                    No insights available.
                </div>
            )}

            {/* Amora AI Section */}
            <div className="mt-auto relative z-20 pt-8">
                <div className="bg-[#1E2923] rounded-[1.5rem] p-1 shadow-xl overflow-hidden">
                    {/* Top Controls */}
                    <div className="flex bg-[#2C3E2C] rounded-[1.2rem] p-1 relative z-10">
                        <button
                            onClick={() => setAmoraMode("INTERPRETER")}
                            className={`flex-1 py-3 rounded-xl text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-center gap-2 ${amoraMode === "INTERPRETER"
                                ? "bg-[#FDFBF7] text-[#1E2923] shadow-md"
                                : "text-[#8F9E8F] hover:text-[#E8E6D9] hover:bg-[#1E2923]"
                                }`}
                        >
                            <span>👁️</span> Penerjemah
                        </button>
                        <button
                            onClick={() => setAmoraMode("SPARK")}
                            className={`flex-1 py-3 rounded-xl text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-center gap-2 ${amoraMode === "SPARK"
                                ? "bg-[#D86C58] text-white shadow-md"
                                : "text-[#8F9E8F] hover:text-[#E8E6D9] hover:bg-[#1E2923]"
                                }`}
                        >
                            <span>✨</span> Ide
                        </button>
                    </div>

                    {/* Content Area */}
                    <div className="p-5 text-[#E8E6D9]">
                        {loadingAmora ? (
                            <div className="flex flex-col items-center justify-center space-y-3 py-4">
                                <Loader2 className="w-8 h-8 text-[#4A6741] animate-spin" />
                                <p className="text-[10px] font-bold text-[#8F9E8F] uppercase tracking-widest animate-pulse">
                                    Berkonsultasi...
                                </p>
                            </div>
                        ) : amoraResponse ? (
                            // Result View
                            <div className="animate-fadeIn">
                                {amoraMode === "INTERPRETER" ? (
                                    <>
                                        <div className="flex items-center gap-2 mb-3">
                                            <span
                                                className={`w-2 h-2 rounded-full ${amoraResponse.risk_level === "High"
                                                    ? "bg-red-500"
                                                    : amoraResponse.risk_level === "Medium"
                                                        ? "bg-amber-500"
                                                        : "bg-green-500"
                                                    }`}
                                            ></span>
                                            <span className="text-[10px] font-bold uppercase tracking-wider text-[#8F9E8F]">
                                                Risiko: {amoraResponse.risk_level || "Low"}
                                            </span>
                                        </div>
                                        <p className="text-[#E8E6D9] text-sm leading-relaxed font-serif italic mb-4">
                                            "{amoraResponse.analysis}"
                                        </p>
                                        <div className="bg-[#2C3E2C] p-3 rounded-lg border-l-2 border-[#4A6741]">
                                            <p className="text-xs font-bold text-[#E8E6D9]">
                                                {amoraResponse.suggestion}
                                            </p>
                                        </div>
                                    </>
                                ) : (
                                    <div className="text-center">
                                        <div className="inline-block p-2 bg-[#2C3E2C] rounded-lg mb-3 shadow-lg text-2xl">
                                            {amoraResponse.icon === 'coffee' ? '☕' :
                                                amoraResponse.icon === 'gift' ? '🎁' :
                                                    amoraResponse.icon === 'hug' ? '🤗' :
                                                        amoraResponse.icon === 'chat' ? '💬' :
                                                            amoraResponse.icon === 'date' ? '🎬' : '✨'}
                                        </div>
                                        <h5 className="font-serif font-bold text-lg text-[#FDFBF7] mb-2">
                                            {amoraResponse.spark_title}
                                        </h5>
                                        <p className="text-[#8F9E8F] text-sm mb-4">
                                            {amoraResponse.spark_text}
                                        </p>
                                    </div>
                                )}

                                <button
                                    onClick={resetAmora}
                                    className="mt-4 text-[10px] font-bold text-[#5C6B5C] hover:text-[#E8E6D9] uppercase tracking-widest flex items-center justify-center gap-1 mx-auto"
                                >
                                    {amoraMode === "SPARK" ? "Ide Baru" : "Reset"}
                                </button>
                            </div>
                        ) : (
                            // Input View
                            <div className="relative transition-all duration-500 min-h-[140px] flex flex-col justify-center">
                                {amoraMode === "INTERPRETER" ? (
                                    <div className="space-y-3">
                                        <textarea
                                            value={userComplaint}
                                            onChange={(e) => setUserComplaint(e.target.value)}
                                            className="w-full bg-[#2C3E2C]/50 rounded-xl border-none text-sm text-[#E8E6D9] placeholder-[#5C6B5C] focus:ring-1 focus:ring-[#8F9E8F] resize-none h-16 p-3"
                                            placeholder="Analisis situasi..."
                                        ></textarea>
                                        <button
                                            onClick={askAmora}
                                            disabled={!userComplaint.trim()}
                                            className="w-full bg-[#4A6741] hover:bg-[#5C7C53] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition-all shadow-lg flex items-center justify-center gap-2 disabled:opacity-50"
                                        >
                                            Analisis
                                        </button>
                                    </div>
                                ) : (
                                    <div className="text-center">
                                        <p className="text-sm text-[#8F9E8F] mb-4 font-medium italic">
                                            "Small gestures build big bridges."
                                        </p>
                                        <button
                                            onClick={askAmora}
                                            className="w-full bg-[#D86C58] hover:bg-[#E57D6B] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider shadow-lg flex items-center justify-center gap-2 transition-all hover:scale-[1.02]"
                                        >
                                            Cari Ide
                                        </button>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
}
