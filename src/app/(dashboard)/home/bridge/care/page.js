"use client";

import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { ShieldAlert, Info, ArrowLeft, Loader2, Plus, Heart } from "lucide-react";
import Link from "next/link";

// Components
import { UpcomingSessionCard, SessionSummaryCard } from "@/components/features/bridge/care/SessionHistory";
import BookingFlow from "@/components/features/bridge/care/BookingFlow";
import ReferralSection from "@/components/features/bridge/care/ReferralSection";

// Services
import { careService } from "@/lib/services/careService";

export default function BridgeCarePage() {
    const [bookings, setBookings] = useState([]);
    const [summaries, setSummaries] = useState([]);
    const [referrals, setReferrals] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showBooking, setShowBooking] = useState(false);

    useEffect(() => {
        async function loadData() {
            try {
                const [b, s, r] = await Promise.all([
                    careService.getBookings(1),
                    careService.getSummaries(1),
                    careService.getReferrals(1)
                ]);
                setBookings(b);
                setSummaries(s);
                setReferrals(r);
            } catch (error) {
                console.error("Gagal memuat data Care", error);
            } finally {
                setLoading(false);
            }
        }
        loadData();
    }, []);

    const upcomingSession = bookings.find(b => b.status === 'confirmed' || b.status === 'pending');

    const handleBookingComplete = async () => {
        const b = await careService.getBookings(1);
        setBookings(b);
        setTimeout(() => setShowBooking(false), 2000);
    };

    if (loading) return (
        <div className="min-h-screen flex items-center justify-center bg-[#FDFBF7]">
            <Loader2 className="w-8 h-8 animate-spin text-[#C67C5C]" />
        </div>
    );

    return (
        <div className="min-h-screen bg-[#FDFBF7] pb-20 pt-8 selection:bg-[#C67C5C]/20">
            <div className="max-w-[1200px] mx-auto px-6 sm:px-10">

                {/* Compact Header */}
                <div className="flex flex-col gap-4 mb-12">
                    <Link
                        href="/home/bridge"
                        className="inline-flex items-center gap-2 text-sm font-bold text-[#6B7C6B] hover:text-[#2A3C2A] transition-all group"
                    >
                        <ArrowLeft className="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" />
                        Kembali ke Bridge
                    </Link>
                    <div className="flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div>
                            <h1 className="text-4xl font-serif font-bold text-[#2A3C2A] tracking-tight">Bridge Care</h1>
                            <p className="text-[#6B7C6B] font-medium mt-1">Pendampingan 60 menit untuk bantu komunikasi lebih jelas dan aman.</p>
                        </div>
                        <button
                            onClick={() => setShowBooking(true)}
                            className="bg-[#2A3C2A] text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-[#2A3C2A]/10 hover:bg-[#384F38] transition-all flex items-center gap-2"
                        >
                            <Plus className="w-4 h-4" />
                            Book New Session
                        </button>
                    </div>
                </div>

                {/* Safety Disclaimer */}
                <div className="bg-[#FFF3CD]/30 border border-[#FFE69C] p-4 rounded-2xl mb-12 flex items-start gap-3">
                    <ShieldAlert className="w-5 h-5 text-[#856404] shrink-0" />
                    <p className="text-[11px] text-[#856404] font-medium leading-relaxed">
                        **Bukan layanan darurat.** Jika ada kekerasan atau ancaman keselamatan fisik/mental, mohon segera hubungi layanan darurat setempat atau psikolog klinis terdekat. Bridge Care bersifat fasilitasi komunikasi, bukan penanganan krisis.
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12">

                    {/* Left: Active Care & Stats */}
                    <div className="md:col-span-12 lg:col-span-4 space-y-8">
                        <UpcomingSessionCard session={upcomingSession} />

                        <div className="bg-white rounded-3xl p-8 border border-black/5 shadow-sm">
                            <h3 className="text-lg font-serif font-bold text-[#2A3C2A] mb-6">Informasi Layanan</h3>
                            <div className="space-y-4">
                                <div className="flex items-start gap-4">
                                    <div className="w-8 h-8 bg-[#FDFBF7] rounded-lg flex items-center justify-center text-[#2A3C2A] shrink-0">
                                        <Info className="w-4 h-4" />
                                    </div>
                                    <p className="text-[11px] text-[#6B7C6B] font-medium leading-relaxed">
                                        Seluruh ringkasan sesi bersifat privat antara Anda, pasangan, dan mediator. Data dapat Anda hapus kapan saja.
                                    </p>
                                </div>
                                <div className="flex items-start gap-4">
                                    <div className="w-8 h-8 bg-[#FDFBF7] rounded-lg flex items-center justify-center text-[#C67C5C] shrink-0">
                                        <Heart className="w-4 h-4" />
                                    </div>
                                    <p className="text-[11px] text-[#6B7C6B] font-medium leading-relaxed">
                                        Bridge Care berfokus pada NVC (Non-Violent Communication) untuk membangun jembatan empati.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Right: History & Health Referral */}
                    <div className="md:col-span-12 lg:col-span-8 space-y-12">

                        {/* Session Summaries */}
                        <div>
                            <div className="flex items-center justify-between mb-8">
                                <h3 className="text-2xl font-serif font-bold text-[#2A3C2A]">Riwayat Sesi</h3>
                                <div className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-widest">{summaries.length} Selesai</div>
                            </div>

                            {summaries.length > 0 ? (
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    {summaries.map(s => (
                                        <SessionSummaryCard key={s.id} summary={s} />
                                    ))}
                                </div>
                            ) : (
                                <div className="py-20 text-center bg-white border border-dashed border-black/10 rounded-[2.5rem]">
                                    <p className="text-xs text-[#A0A0A0] font-bold">Belum ada riwayat sesi.</p>
                                </div>
                            )}
                        </div>

                        {/* Referral Section */}
                        <div className="pt-12 border-t border-black/5">
                            <ReferralSection existingReferrals={referrals} />
                        </div>
                    </div>
                </div>
            </div>

            {/* Booking Modal */}
            <AnimatePresence>
                {showBooking && (
                    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            exit={{ opacity: 0 }}
                            onClick={() => setShowBooking(false)}
                            className="absolute inset-0 bg-black/40 backdrop-blur-md"
                        ></motion.div>
                        <motion.div
                            initial={{ opacity: 0, scale: 0.9, y: 20 }}
                            animate={{ opacity: 1, scale: 1, y: 0 }}
                            exit={{ opacity: 0, scale: 0.9, y: 20 }}
                            className="relative z-10 w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                        >
                            <BookingFlow onComplete={handleBookingComplete} />
                        </motion.div>
                    </div>
                )}
            </AnimatePresence>
        </div>
    );
}
