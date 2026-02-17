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
        <div className="min-h-screen bg-[#FDFBF7] pb-24 selection:bg-[#C67C5C]/10 antialiased">
            <div className="max-w-6xl mx-auto px-6 py-8 space-y-10">

                {/* Compact Header Row */}
                <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div className="space-y-1">
                        <div className="flex items-center gap-2 text-[11px] font-medium text-[#6B7C6B]">
                            <Link href="/home/bridge" className="hover:text-[#2A3C2A] transition-colors">Bridge</Link>
                            <span className="opacity-30">/</span>
                            <span className="text-[#2A3C2A]">Care</span>
                        </div>
                        <h1 className="text-3xl font-serif font-bold text-[#2A3C2A] tracking-tight">Bridge Care</h1>
                        <p className="text-sm text-[#6B7C6B] font-medium">Sesi 60 menit bersama mediator untuk bantu komunikasi lebih jelas.</p>
                    </div>
                    <div className="flex items-center gap-4">
                        <button className="text-sm font-semibold text-[#6B7C6B] hover:text-[#2A3C2A] transition-colors">How it works</button>
                        <button
                            onClick={() => setShowBooking(true)}
                            className="h-11 px-6 bg-[#C67C5C] text-white rounded-full font-bold text-sm shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all active:scale-95 whitespace-nowrap"
                        >
                            Book Session
                        </button>
                    </div>
                </div>

                {/* Slim Safety Banner */}
                <div className="flex items-center justify-between px-4 py-3 bg-white border border-black/5 rounded-2xl shadow-sm">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 bg-[#FDFBF7] rounded-lg border border-black/[0.03] flex items-center justify-center shrink-0">
                            <ShieldAlert className="w-4 h-4 text-[#C67C5C]" />
                        </div>
                        <p className="text-[12px] text-[#2A3C2A] font-medium leading-none">
                            Bukan layanan darurat. Jika butuh bantuan segera, hubungi 112.
                        </p>
                    </div>
                    <button className="text-[11px] font-bold text-[#C67C5C] hover:underline underline-offset-4 tracking-tight">Learn more</button>
                </div>

                {/* Main Bento Grid */}
                <div className="grid grid-cols-1 md:grid-cols-12 gap-6">

                    {/* Row A Left: Upcoming Session (7 cols) */}
                    <div className="md:col-span-7">
                        <UpcomingSessionCard session={upcomingSession} onReschedule={() => setShowBooking(true)} />
                    </div>

                    {/* Row A Right: Session Summary Preview (5 cols) */}
                    <div className="md:col-span-5">
                        <SessionSummaryCard summary={summaries[0]} isPreview={true} />
                    </div>

                    {/* Row B Left: Session History (7 cols) */}
                    <div className="md:col-span-7 space-y-6">
                        <div className="flex items-center gap-2 mb-2">
                            <h3 className="text-sm font-bold text-[#2A3C2A]">Riwayat Sesi</h3>
                            <span className="px-2 py-0.5 bg-black/5 rounded-full text-[10px] font-bold text-[#6B7C6B]">{summaries.length}</span>
                        </div>
                        <div className="space-y-4">
                            {summaries.length > 0 ? (
                                summaries.slice(0, 5).map(s => (
                                    <SessionSummaryCard key={s.id} summary={s} isList={true} />
                                ))
                            ) : (
                                <div className="py-12 text-center bg-white border border-dashed border-black/10 rounded-3xl opacity-50">
                                    <p className="text-xs text-[#A0A0A0] font-bold">Belum ada riwayat sesi mediasi.</p>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Row B Right: Service Details (5 cols) */}
                    <div className="md:col-span-5">
                        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-6 shadow-sm space-y-6 h-full">
                            <h3 className="text-sm font-bold text-[#2A3C2A]">Detail Layanan</h3>
                            <div className="space-y-5">
                                <div className="flex items-start gap-4">
                                    <div className="w-8 h-8 bg-black/5 rounded-xl flex items-center justify-center shrink-0">
                                        <Info className="w-4 h-4 text-[#6B7C6B]" />
                                    </div>
                                    <div className="space-y-1">
                                        <p className="text-[12px] font-bold text-[#2A3C2A]">Privasi Terjamin</p>
                                        <p className="text-[11px] text-[#6B7C6B] leading-relaxed">Seluruh ringkasan sesi bersifat privat dan terenkripsi.</p>
                                    </div>
                                </div>
                                <div className="flex items-start gap-4">
                                    <div className="w-8 h-8 bg-black/5 rounded-xl flex items-center justify-center shrink-0">
                                        <Heart className="w-4 h-4 text-[#6B7C6B]" />
                                    </div>
                                    <div className="space-y-1">
                                        <p className="text-[12px] font-bold text-[#2A3C2A]">Metode NVC</p>
                                        <p className="text-[11px] text-[#6B7C6B] leading-relaxed">Fokus pada fasilitasi komunikasi berempati.</p>
                                    </div>
                                </div>
                                <div className="flex items-start gap-4">
                                    <div className="w-8 h-8 bg-black/5 rounded-xl flex items-center justify-center shrink-0">
                                        <ShieldAlert className="w-4 h-4 text-[#6B7C6B]" />
                                    </div>
                                    <div className="space-y-1">
                                        <p className="text-[12px] font-bold text-[#2A3C2A]">Pengingat Otomatis</p>
                                        <p className="text-[11px] text-[#6B7C6B] leading-relaxed">Notifikasi otomatis untuk setiap sesi yang terjadwal.</p>
                                    </div>
                                </div>
                            </div>

                            <div className="pt-6 border-t border-black/5">
                                <p className="text-[10px] font-bold text-[#6B7C6B] uppercase tracking-wider mb-4">What you'll get</p>
                                <ul className="space-y-3">
                                    {['Ringkasan sesi', 'Kesepakatan bersama', 'Next actions langkah nyata'].map((item, i) => (
                                        <li key={i} className="flex items-center gap-3 text-[11px] font-medium text-[#2A3C2A]">
                                            <div className="w-1.5 h-1.5 bg-[#C67C5C] rounded-full"></div>
                                            {item}
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Pre-marital Health Check (Full Width Balanced Section) */}
                <div className="pt-8 border-t border-black/5">
                    <ReferralSection existingReferrals={referrals} />
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
