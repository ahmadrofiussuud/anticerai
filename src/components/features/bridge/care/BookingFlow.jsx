"use client";

import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { Calendar as CalendarIcon, Clock, CheckCircle2, ChevronRight, ChevronLeft, ShieldAlert } from "lucide-react";
import { careService } from "@/lib/services/careService";

export default function BookingFlow({ onComplete }) {
    const [step, setStep] = useState(1);
    const [bookingData, setBookingData] = useState({
        goal: "",
        date: "",
        time: ""
    });
    const [isSubmitting, setIsSubmitting] = useState(false);

    const goals = [
        "Komunikasi buntu",
        "Rencana pra-nikah",
        "Konflik berulang",
        "Butuh pihak netral"
    ];

    const timeSlots = ["09:00", "11:00", "14:00", "16:00", "19:00"];

    const handleBooking = async () => {
        setIsSubmitting(true);
        try {
            // Mocking date object construction
            const scheduledAt = new Date();
            scheduledAt.setDate(scheduledAt.getDate() + 2); // default to 2 days from now for mock

            await careService.createBooking({
                userId: 1,
                goal: bookingData.goal,
                scheduledAt
            });
            setStep(4);
            if (onComplete) onComplete();
        } catch (error) {
            console.error("Booking error:", error);
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <div className="bg-white rounded-[2.5rem] p-8 lg:p-12 border border-black/5 shadow-2xl relative overflow-hidden">
            {/* Step Indicator */}
            <div className="flex items-center gap-4 mb-12">
                {[1, 2, 3].map((s) => (
                    <div key={s} className="flex items-center gap-2">
                        <div className={`w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs transition-all ${step >= s ? 'bg-[#2A3C2A] text-white' : 'bg-black/5 text-[#A0A0A0]'
                            }`}>
                            {s}
                        </div>
                        {s < 3 && <div className={`w-12 h-0.5 rounded-full ${step > s ? 'bg-[#2A3C2A]' : 'bg-black/5'}`}></div>}
                    </div>
                ))}
            </div>

            <AnimatePresence mode="wait">
                {step === 1 && (
                    <motion.div
                        key="step1"
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        exit={{ opacity: 0, x: -20 }}
                        className="flex flex-col gap-6"
                    >
                        <div>
                            <h3 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-2">Apa tujuan sesi Anda?</h3>
                            <p className="text-sm text-[#6B7C6B] font-medium">Pilih satu yang paling mendesak saat ini.</p>
                        </div>
                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {goals.map((goal) => (
                                <button
                                    key={goal}
                                    onClick={() => setBookingData({ ...bookingData, goal })}
                                    className={`p-6 rounded-2xl border text-left transition-all ${bookingData.goal === goal
                                            ? 'border-[#2A3C2A] bg-[#2A3C2A]/5 text-[#2A3C2A]'
                                            : 'border-black/5 bg-[#FDFBF7] text-[#6B7C6B] hover:border-[#2A3C2A]/20'
                                        }`}
                                >
                                    <span className="text-sm font-bold">{goal}</span>
                                </button>
                            ))}
                        </div>
                        <button
                            disabled={!bookingData.goal}
                            onClick={() => setStep(2)}
                            className="mt-8 bg-[#2A3C2A] text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 disabled:opacity-50"
                        >
                            Lanjut ke Jadwal
                            <ChevronRight className="w-4 h-4" />
                        </button>
                    </motion.div>
                )}

                {step === 2 && (
                    <motion.div
                        key="step2"
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        exit={{ opacity: 0, x: -20 }}
                        className="flex flex-col gap-8"
                    >
                        <div>
                            <h3 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-2">Pilih Waktu</h3>
                            <p className="text-sm text-[#6B7C6B] font-medium">Mediator siap membantu di jam-jam berikut.</p>
                        </div>

                        <div className="space-y-6">
                            <div className="flex flex-wrap gap-3">
                                {timeSlots.map((slot) => (
                                    <button
                                        key={slot}
                                        onClick={() => setBookingData({ ...bookingData, time: slot })}
                                        className={`px-6 py-3 rounded-xl border font-bold text-xs transition-all ${bookingData.time === slot
                                                ? 'border-[#2A3C2A] bg-[#2A3C2A] text-white'
                                                : 'border-black/5 bg-[#FDFBF7] text-[#6B7C6B] hover:border-[#2A3C2A]/20'
                                            }`}
                                    >
                                        {slot}
                                    </button>
                                ))}
                            </div>
                        </div>

                        <div className="flex items-center gap-4 mt-8">
                            <button onClick={() => setStep(1)} className="flex-1 py-4 border border-black/10 rounded-xl font-bold text-sm text-[#2A3C2A]">
                                Kembali
                            </button>
                            <button
                                disabled={!bookingData.time}
                                onClick={() => setStep(3)}
                                className="flex-[2] bg-[#2A3C2A] text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 disabled:opacity-50"
                            >
                                Ringkasan Booking
                                <ChevronRight className="w-4 h-4" />
                            </button>
                        </div>
                    </motion.div>
                )}

                {step === 3 && (
                    <motion.div
                        key="step3"
                        initial={{ opacity: 0, x: 20 }}
                        animate={{ opacity: 1, x: 0 }}
                        exit={{ opacity: 0, x: -20 }}
                        className="flex flex-col gap-8"
                    >
                        <div>
                            <h3 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-2">Konfirmasi Sesi</h3>
                            <p className="text-sm text-[#6B7C6B] font-medium">Periksa kembali detail sebelum membayar.</p>
                        </div>

                        <div className="bg-[#FDFBF7] rounded-3xl p-8 border border-black/5 space-y-6">
                            <div className="flex justify-between items-start border-b border-black/5 pb-4">
                                <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-wider">Layanan</span>
                                <span className="text-sm font-bold text-[#2A3C2A]">Bridge Care Mediation</span>
                            </div>
                            <div className="flex justify-between items-start border-b border-black/5 pb-4">
                                <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-wider">Tujuan</span>
                                <span className="text-sm font-bold text-[#2A3C2A]">{bookingData.goal}</span>
                            </div>
                            <div className="flex justify-between items-start border-b border-black/5 pb-4">
                                <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-wider">Jadwal</span>
                                <span className="text-sm font-bold text-[#2A3C2A]">Besok, {bookingData.time}</span>
                            </div>
                            <div className="flex justify-between items-center pt-2">
                                <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-wider">Total</span>
                                <span className="text-2xl font-serif font-bold text-[#C67C5C]">Rp150.000</span>
                            </div>
                        </div>

                        <div className="flex items-start gap-3 bg-[#C67C5C]/5 p-4 rounded-xl border border-[#C67C5C]/20">
                            <ShieldAlert className="w-5 h-5 text-[#C67C5C] shrink-0" />
                            <p className="text-[10px] text-[#C67C5C] font-bold leading-relaxed">
                                Pembatalan kurang dari 24 jam sebelum sesi akan dikenakan biaya 50%. Pastikan Anda dan pasangan siap di jam yang ditentukan.
                            </p>
                        </div>

                        <div className="flex items-center gap-4">
                            <button onClick={() => setStep(2)} className="flex-1 py-4 border border-black/10 rounded-xl font-bold text-sm text-[#2A3C2A]">
                                Ubah
                            </button>
                            <button
                                onClick={handleBooking}
                                disabled={isSubmitting}
                                className="flex-[2] bg-[#2A3C2A] text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-[#2A3C2A]/20"
                            >
                                {isSubmitting ? "Memproses..." : "Konfirmasi & Bayar"}
                                {!isSubmitting && <ChevronRight className="w-4 h-4" />}
                            </button>
                        </div>
                    </motion.div>
                )}

                {step === 4 && (
                    <motion.div
                        key="step4"
                        initial={{ opacity: 0, scale: 0.95 }}
                        animate={{ opacity: 1, scale: 1 }}
                        className="text-center py-12"
                    >
                        <div className="w-20 h-20 bg-[#2A3C2A] rounded-full flex items-center justify-center text-white mx-auto mb-8 shadow-xl">
                            <CheckCircle2 className="w-10 h-10" />
                        </div>
                        <h3 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-4">Booking Berhasil!</h3>
                        <p className="text-[#6B7C6B] font-medium max-w-sm mx-auto mb-10 leading-relaxed">
                            Detail sesi telah dikirim ke dashboard Anda. Kami akan mengirim pengingat 24 jam sebelum sesi dimulai.
                        </p>
                        <button
                            onClick={onComplete}
                            className="bg-[#FDFBF7] border border-black/5 px-8 py-4 rounded-xl font-bold text-sm text-[#2A3C2A] hover:bg-white transition-all"
                        >
                            Tutup
                        </button>
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    );
}
