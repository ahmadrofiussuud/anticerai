"use client";

import { useState } from "react";
import { Loader2 } from "lucide-react";

export default function DateRoulette() {
    const [mood, setMood] = useState("Relaxed");
    const [budget, setBudget] = useState("Low");
    const [location, setLocation] = useState("Indoor");
    const [atmosphere, setAtmosphere] = useState("Romantis");

    const [loading, setLoading] = useState(false);
    const [result, setResult] = useState(null);

    const handleSpin = async () => {
        setLoading(true);
        setResult(null);

        try {
            const res = await fetch("/api/date-roulette/spin", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ mood, budget, location, atmosphere }),
            });
            const data = await res.json();

            // Artificial delay to show spinning animation if too fast
            await new Promise(r => setTimeout(r, 1500));

            setResult(data);
        } catch (error) {
            console.error("Spin error", error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="bg-white rounded-[2.5rem] shadow-xl border border-[#E5E0D0] overflow-hidden min-h-[600px] flex flex-col md:flex-row">
            {/* Sidebar Controls */}
            <div className="bg-[#FDFBF7] p-8 md:w-1/3 border-r border-[#E5E0D0] flex flex-col">
                <div className="mb-8">
                    <h3 className="font-serif font-bold text-2xl text-[#2A3C2A] mb-2">Preferensi</h3>
                    <p className="text-[#6B7C6B] text-sm">Sesuaikan kencan impianmu.</p>
                </div>

                <div className="space-y-6 flex-grow">
                    {/* Mood */}
                    <div>
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Mood</label>
                        <select value={mood} onChange={(e) => setMood(e.target.value)} className="w-full p-3 rounded-xl border border-[#E5E0D0] bg-white focus:ring-2 focus:ring-[#C67C5C]">
                            <option value="Relaxed">Santai</option>
                            <option value="Energetic">Berenergi</option>
                            <option value="Adventurous">Petualang</option>
                            <option value="Cozy">Nyaman (Cozy)</option>
                        </select>
                    </div>

                    {/* Location */}
                    <div>
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Lokasi</label>
                        <div className="flex bg-white rounded-xl p-1 border border-[#E5E0D0]">
                            <button onClick={() => setLocation("Indoor")} className={`flex-1 py-2 rounded-lg text-sm font-bold transition-all ${location === 'Indoor' ? 'bg-[#F2EFE5] text-[#2A3C2A]' : 'text-[#6B7C6B]'}`}>Indoor</button>
                            <button onClick={() => setLocation("Outdoor")} className={`flex-1 py-2 rounded-lg text-sm font-bold transition-all ${location === 'Outdoor' ? 'bg-[#F2EFE5] text-[#2A3C2A]' : 'text-[#6B7C6B]'}`}>Outdoor</button>
                        </div>
                    </div>

                    {/* Budget */}
                    <div>
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Budget</label>
                        <div className="flex gap-2">
                            {['Low', 'Medium', 'High'].map((b) => (
                                <button
                                    key={b}
                                    onClick={() => setBudget(b)}
                                    className={`flex-1 py-2 rounded-xl border border-[#E5E0D0] text-sm font-bold transition-all ${budget === b ? 'bg-[#C67C5C] text-white border-[#C67C5C]' : 'bg-white text-[#6B7C6B] hover:bg-[#F2EFE5]'}`}
                                >
                                    {b === 'Low' ? '$' : b === 'Medium' ? '$$' : '$$$'}
                                </button>
                            ))}
                        </div>
                    </div>

                    {/* Atmosphere */}
                    <div>
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Suasana</label>
                        <select value={atmosphere} onChange={(e) => setAtmosphere(e.target.value)} className="w-full p-3 rounded-xl border border-[#E5E0D0] bg-white focus:ring-2 focus:ring-[#C67C5C]">
                            <option value="Romantis">Romantis</option>
                            <option value="Keluarga">Keluarga</option>
                            <option value="Petualangan">Petualangan</option>
                            <option value="Ngobrol Santai">Ngobrol Deep</option>
                        </select>
                    </div>
                </div>

                <button
                    onClick={handleSpin}
                    disabled={loading}
                    className="mt-8 w-full bg-[#2A3C2A] text-white font-serif font-bold py-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-[#1E2923] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed"
                >
                    {loading ? <Loader2 className="w-5 h-5 animate-spin" /> : '✨'}
                    {loading ? 'Sedang Mencari...' : 'Putar Roulette'}
                </button>
            </div>

            {/* Result Area */}
            <div className="md:w-2/3 bg-white relative flex items-center justify-center p-8">
                {/* Background Pattern */}
                <div className="absolute inset-0 opacity-10" style={{ backgroundImage: "radial-gradient(#C67C5C 1px, transparent 1px)", backgroundSize: "20px 20px" }}></div>

                {loading ? (
                    <div className="text-center">
                        <div className="w-32 h-32 rounded-full border-4 border-[#C67C5C] border-t-transparent animate-spin mx-auto mb-6"></div>
                        <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] animate-pulse">Memilih Takdir...</h3>
                    </div>
                ) : result ? (
                    <div className="max-w-md w-full animate-fadeInUp">
                        <div className="bg-white rounded-3xl shadow-2xl border border-[#E5E0D0] overflow-hidden transform hover:scale-[1.02] transition-transform duration-500">
                            <div className="h-48 bg-[#F2EFE5] relative">
                                <img src={result.image} alt={result.title} className="w-full h-full object-cover" />
                                <div className="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-[#2A3C2A] shadow-sm uppercase tracking-wider">
                                    {result.category}
                                </div>
                            </div>
                            <div className="p-8 text-center">
                                <div className="w-16 h-16 bg-[#FDFBF7] rounded-full flex items-center justify-center text-3xl shadow-lg border-4 border-white mx-auto -mt-16 mb-4 relative z-10">
                                    {result.icon}
                                </div>
                                <h2 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-3 leading-tight">{result.title}</h2>
                                <p className="text-[#6B7C6B] leading-relaxed mb-6">{result.description}</p>

                                {result.tips && (
                                    <div className="bg-[#E8F5E9] p-4 rounded-xl text-sm text-[#2E7D32] mb-6">
                                        <strong>Tip:</strong> {result.tips}
                                    </div>
                                )}

                                <button onClick={handleSpin} className="text-[#C67C5C] font-bold text-sm tracking-widest uppercase hover:text-[#B56B4B] transition-colors">
                                    Coba Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                ) : (
                    <div className="text-center max-w-sm">
                        <div className="w-32 h-32 bg-[#F2EFE5] rounded-full flex items-center justify-center text-5xl mb-6 mx-auto shadow-inner text-[#B0A69D]">
                            🎲
                        </div>
                        <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-2">Siap untuk Kejutan?</h3>
                        <p className="text-[#6B7C6B]">Pilih preferensi Anda di sebelah kiri dan biarkan Amora memilihkan kencan sempurna.</p>
                    </div>
                )}
            </div>
        </div>
    );
}
