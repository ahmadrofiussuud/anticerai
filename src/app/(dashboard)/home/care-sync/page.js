"use client";

import { useSession } from "next-auth/react";
import { useState, useEffect } from "react";
import { supabase } from "@/lib/supabase";
import { Loader2, Plus, Calendar, AlertCircle, Heart, ArrowLeft } from "lucide-react";
import Link from "next/link";

export default function CareSyncPage() {
    const { data: session, status } = useSession();
    const [partner, setPartner] = useState(null);
    const [mySchedules, setMySchedules] = useState([]);
    const [partnerSchedules, setPartnerSchedules] = useState([]);
    const [aiSuggestion, setAiSuggestion] = useState("");
    const [isAiLoading, setIsAiLoading] = useState(false);
    const [isLoading, setIsLoading] = useState(true);

    // Form inputs
    const [activityName, setActivityName] = useState("");
    const [busyLevel, setBusyLevel] = useState("Medium");
    const [notes, setNotes] = useState("");
    const [isSubmitting, setIsSubmitting] = useState(false);

    useEffect(() => {
        if (status === "authenticated" && session?.user) {
            loadInitialData();
        }
    }, [status, session]);

    const loadInitialData = async () => {
        setIsLoading(true);
        try {
            const currentUserId = String(session.user.id);
            const coupleId = String(session.user.couple_id);

            if (!coupleId) {
                setIsLoading(false);
                return;
            }

            // 1. Fetch couple info and find the partner user
            const { data: couple, error: coupleError } = await supabase
                .from("couples")
                .select()
                .eq("id", parseInt(coupleId))
                .single();

            if (couple) {
                const partnerId = String(couple.husband_id) === currentUserId ? String(couple.wife_id) : String(couple.husband_id);
                
                // Fetch partner's profile name
                const { data: partnerUser } = await supabase
                    .from("users")
                    .select()
                    .eq("id", parseInt(partnerId))
                    .single();

                if (partnerUser) {
                    setPartner(partnerUser);
                    // Fetch partner's schedules and AI suggestion
                    await fetchPartnerSchedules(coupleId, partnerId, partnerUser.name);
                }
            }

            // 2. Fetch my schedules for today
            const todayStart = new Date();
            todayStart.setHours(0, 0, 0, 0);

            const { data: mine } = await supabase
                .from("partner_schedules")
                .select()
                .eq("user_id", currentUserId)
                .gte("created_at", todayStart.toISOString())
                .order("created_at", { ascending: true });

            setMySchedules(mine || []);

        } catch (e) {
            console.error("Error loading care-sync data:", e);
        } finally {
            setIsLoading(false);
        }
    };

    const fetchPartnerSchedules = async (coupleId, partnerId, partnerName) => {
        setIsAiLoading(true);
        try {
            const res = await fetch("/api/care-sync/analyze", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    coupleId,
                    partnerId,
                    partnerName
                })
            });

            const data = await res.json();
            if (data.schedules) {
                setPartnerSchedules(data.schedules);
            }
            if (data.suggestion) {
                setAiSuggestion(data.suggestion);
            }
        } catch (error) {
            console.error("Error fetching partner schedules:", error);
        } finally {
            setIsAiLoading(false);
        }
    };

    const handleAddSchedule = async (e) => {
        e.preventDefault();
        if (!activityName.trim() || isSubmitting) return;

        setIsSubmitting(true);
        try {
            const newSchedule = {
                user_id: String(session.user.id),
                couple_id: String(session.user.couple_id),
                activity_name: activityName,
                busy_level: busyLevel,
                notes: notes,
                created_at: new Date().toISOString()
            };

            const { data, error } = await supabase
                .from("partner_schedules")
                .insert(newSchedule)
                .select()
                .single();

            if (error) throw error;

            setMySchedules((prev) => [...prev, data]);
            setActivityName("");
            setNotes("");

            // Trigger AI suggestion recalculation if partner details are ready
            if (partner) {
                const coupleId = String(session.user.couple_id);
                const partnerId = String(partner.id);
                // Just refreshing in background
                fetchPartnerSchedules(coupleId, partnerId, partner.name);
            }

        } catch (err) {
            console.error("Failed to add schedule:", err);
            alert("Gagal menambahkan jadwal harian. Silakan coba lagi.");
        } finally {
            setIsSubmitting(false);
        }
    };

    if (status === "loading" || isLoading) {
        return (
            <div className="flex h-screen items-center justify-center bg-[#FDFBF7]">
                <Loader2 className="h-8 w-8 animate-spin text-[#2A3C2A]" />
            </div>
        );
    }

    if (!session?.user?.couple_id) {
        return (
            <div className="min-h-screen bg-[#FDFBF7] flex flex-col items-center justify-center p-6 text-center">
                <div className="max-w-md bg-white p-8 rounded-[2rem] shadow-xl border border-black/5">
                    <Heart className="w-16 h-16 text-[#C67C5C] mx-auto mb-6" />
                    <h2 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-4">Fitur Khusus Pasangan</h2>
                    <p className="text-[#6B7C6B] mb-6">
                        Anda perlu terhubung dengan pasangan terlebih dahulu melalui menu Profil / Dashboard sebelum bisa menyinkronkan jadwal harian Anda.
                    </p>
                    <Link href="/home" className="inline-block bg-[#2A3C2A] hover:bg-[#1E2B1E] text-white px-6 py-3 rounded-full font-bold transition-all">
                        Kembali ke Home
                    </Link>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#FDFBF7] pb-20 pt-6 relative z-10">
            {/* Background gradients */}
            <div className="fixed inset-0 z-0 pointer-events-none">
                <div className="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-[#C67C5C]/15 blur-[120px]"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-[#4A6741]/15 blur-[120px]"></div>
            </div>

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                {/* Header */}
                <div className="flex items-center gap-4 mb-8">
                    <Link href="/home" className="w-10 h-10 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow-sm border border-black/5 text-[#2A3C2A] transition-all">
                        <ArrowLeft className="w-5 h-5" />
                    </Link>
                    <div>
                        <h1 className="text-3xl font-serif font-bold text-[#2A3C2A]">Care Sync</h1>
                        <p className="text-sm text-[#6B7C6B]">Sinkronisasi Jadwal & Saran Perhatian Pintar AI</p>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    {/* Left: Input My Schedule */}
                    <div className="lg:col-span-5 space-y-6">
                        <div className="bg-white rounded-[2rem] p-8 shadow-xl border border-black/5">
                            <h3 className="text-xl font-serif font-bold text-[#2A3C2A] mb-6 flex items-center gap-2">
                                <Calendar className="w-5 h-5 text-[#C67C5C]" />
                                Jadwal Harian Saya
                            </h3>

                            <form onSubmit={handleAddSchedule} className="space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-[#2A3C2A] uppercase tracking-wider mb-2">Aktivitas / Jadwal</label>
                                    <input
                                        type="text"
                                        value={activityName}
                                        onChange={(e) => setActivityName(e.target.value)}
                                        placeholder="Contoh: Meeting di kantor, Gym, Perjalanan luar kota"
                                        required
                                        className="w-full bg-[#FDFBF7] border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#C67C5C] text-sm text-[#2A3C2A]"
                                    />
                                </div>

                                <div className="grid grid-cols-3 gap-2">
                                    {["Low", "Medium", "High"].map((level) => (
                                        <button
                                            key={level}
                                            type="button"
                                            onClick={() => setBusyLevel(level)}
                                            className={`py-3 rounded-xl text-xs font-bold transition-all border ${
                                                busyLevel === level
                                                    ? level === "High"
                                                        ? "bg-red-500 text-white border-red-500 shadow-md"
                                                        : level === "Medium"
                                                        ? "bg-[#C67C5C] text-white border-[#C67C5C] shadow-md"
                                                        : "bg-green-600 text-white border-green-600 shadow-md"
                                                    : "bg-white text-[#6B7C6B] border-black/5 hover:bg-gray-50"
                                            }`}
                                        >
                                            {level === "High" ? "🔴 High" : level === "Medium" ? "🟡 Medium" : "🟢 Low"}
                                        </button>
                                    ))}
                                </div>

                                <div>
                                    <label className="block text-xs font-bold text-[#2A3C2A] uppercase tracking-wider mb-2">Catatan Tambahan (Opsional)</label>
                                    <textarea
                                        value={notes}
                                        onChange={(e) => setNotes(e.target.value)}
                                        placeholder="Contoh: Sangat macet di jalan, Sedang sakit kepala"
                                        rows={3}
                                        className="w-full bg-[#FDFBF7] border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#C67C5C] text-sm text-[#2A3C2A]"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    disabled={isSubmitting || !activityName.trim()}
                                    className="w-full bg-[#2A3C2A] hover:bg-[#1E2B1E] disabled:bg-gray-300 text-white py-3.5 rounded-xl font-bold text-sm shadow-lg transition-all flex items-center justify-center gap-2"
                                >
                                    {isSubmitting ? (
                                        <Loader2 className="w-5 h-5 animate-spin" />
                                    ) : (
                                        <>
                                            <Plus className="w-5 h-5" />
                                            Kirim Jadwal ke Pasangan
                                        </>
                                    )}
                                </button>
                            </form>
                        </div>

                        {/* Display my schedules for today */}
                        <div className="bg-white rounded-[2rem] p-8 shadow-xl border border-black/5">
                            <h4 className="text-sm font-bold text-[#2A3C2A] uppercase tracking-wider mb-4">Jadwal Saya Hari Ini</h4>
                            {mySchedules.length === 0 ? (
                                <p className="text-sm text-[#6B7C6B] italic">Belum ada jadwal yang dimasukkan hari ini.</p>
                            ) : (
                                <div className="space-y-3">
                                    {mySchedules.map((schedule) => (
                                        <div key={schedule.id} className="flex justify-between items-start p-4 rounded-xl border border-black/5 bg-[#FDFBF7]">
                                            <div>
                                                <h5 className="font-bold text-sm text-[#2A3C2A]">{schedule.activity_name}</h5>
                                                {schedule.notes && <p className="text-xs text-[#6B7C6B] mt-1">{schedule.notes}</p>}
                                            </div>
                                            <span className={`text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full ${
                                                schedule.busy_level === "High"
                                                    ? "bg-red-100 text-red-700"
                                                    : schedule.busy_level === "Medium"
                                                    ? "bg-amber-100 text-amber-700"
                                                    : "bg-green-100 text-green-700"
                                            }`}>
                                                {schedule.busy_level}
                                            </span>
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Right: Partner Schedule & AI Suggestion */}
                    <div className="lg:col-span-7 space-y-6">
                        
                        {/* AI Support suggestion */}
                        <div className="bg-[#2A3C2A] text-white rounded-[2.5rem] p-8 sm:p-10 shadow-2xl relative overflow-hidden">
                            <div className="absolute top-0 right-0 w-36 h-36 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                            
                            <div className="relative z-10 flex flex-col sm:flex-row gap-6 items-start">
                                <div className="w-14 h-14 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-2xl flex items-center justify-center shadow-lg shrink-0">
                                    <Heart className="w-7 h-7 text-white animate-pulse" />
                                </div>
                                <div className="space-y-3">
                                    <div className="text-xs font-bold text-[#B5C4B5] uppercase tracking-widest">Amora AI Care Recommendation</div>
                                    <h3 className="text-2xl font-serif font-bold leading-tight">
                                        Bagaimana Cara Menyambut {partner ? partner.name : "Pasangan"} Hari Ini?
                                    </h3>
                                    
                                    {isAiLoading ? (
                                        <div className="flex items-center gap-2 text-white/60 py-4">
                                            <Loader2 className="w-5 h-5 animate-spin" />
                                            <span>Menganalisis jadwal pasangan Anda...</span>
                                        </div>
                                    ) : (
                                        <p className="text-white/80 leading-relaxed font-medium text-lg pt-2 italic">
                                            "{aiSuggestion}"
                                        </p>
                                    )}
                                </div>
                            </div>
                        </div>

                        {/* Partner Schedule display */}
                        <div className="bg-white rounded-[2rem] p-8 shadow-xl border border-black/5">
                            <h3 className="text-lg font-serif font-bold text-[#2A3C2A] mb-6 flex items-center justify-between">
                                <span>Jadwal Harian {partner ? partner.name : "Pasangan"}</span>
                                <button 
                                    onClick={() => partner && fetchPartnerSchedules(session.user.couple_id, partner.id, partner.name)}
                                    className="text-xs text-[#C67C5C] hover:text-[#B56B4B] font-bold uppercase tracking-wider"
                                >
                                    Segarkan 🔄
                                </button>
                            </h3>

                            {partnerSchedules.length === 0 ? (
                                <div className="text-center py-10 border-2 border-dashed border-[#E5E0D0] rounded-2xl">
                                    <AlertCircle className="w-10 h-10 text-gray-300 mx-auto mb-3" />
                                    <p className="text-sm text-[#6B7C6B]">
                                        {partner ? partner.name : "Pasangan Anda"} belum mengisi jadwal harian mereka hari ini.
                                    </p>
                                </div>
                            ) : (
                                <div className="space-y-4">
                                    {partnerSchedules.map((schedule) => (
                                        <div key={schedule.id} className="flex justify-between items-center p-5 rounded-2xl border border-black/5 bg-[#FDFBF7]">
                                            <div className="space-y-1">
                                                <h4 className="font-bold text-[#2A3C2A]">{schedule.activity_name}</h4>
                                                {schedule.notes && <p className="text-sm text-[#6B7C6B]">{schedule.notes}</p>}
                                                <p className="text-[10px] text-gray-400">
                                                    Dikirim pada {new Date(schedule.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}
                                                </p>
                                            </div>
                                            <div className="text-right shrink-0">
                                                <span className={`text-[10px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full ${
                                                    schedule.busy_level === "High"
                                                        ? "bg-red-100 text-red-700 font-extrabold"
                                                        : schedule.busy_level === "Medium"
                                                        ? "bg-amber-100 text-amber-700 font-extrabold"
                                                        : "bg-green-100 text-green-700 font-extrabold"
                                                }`}>
                                                    {schedule.busy_level === "High" ? "🔴 HIGH" : schedule.busy_level === "Medium" ? "🟡 MEDIUM" : "🟢 LOW"}
                                                </span>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}
