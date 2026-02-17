"use client";

import { motion } from "framer-motion";
import { Calendar, Clock, Video, ChevronRight, FileText, CheckCircle2, Sparkles } from "lucide-react";
import { format } from "date-fns";
import { id } from "date-fns/locale";

export function UpcomingSessionCard({ session, onReschedule }) {
    if (!session) return (
        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-8 shadow-sm flex flex-col items-center justify-center text-center min-h-[280px]">
            <div className="w-12 h-12 bg-black/5 rounded-2xl flex items-center justify-center mb-4">
                <Calendar className="w-6 h-6 text-[#A0A0A0]" />
            </div>
            <p className="text-sm font-bold text-[#2A3C2A]">Belum ada sesi terjadwal</p>
            <p className="text-[11px] text-[#6B7C6B] mt-1">Book sesi pertama Anda untuk mulai mediasi.</p>
        </div>
    );

    return (
        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-6 shadow-sm hover:translate-y-[-2px] transition-all group">
            <div className="flex flex-col md:flex-row justify-between gap-6">
                <div className="space-y-4 flex-grow">
                    <div className="flex items-center gap-2">
                        <span className="px-2.5 py-1 bg-[#2A3C2A] text-white text-[10px] font-bold rounded-full uppercase tracking-wider">Mendatang</span>
                        <span className="text-[11px] font-bold text-[#6B7C6B] uppercase tracking-widest">Premium Mediation</span>
                    </div>

                    <div>
                        <h3 className="text-2xl font-serif font-bold text-[#2A3C2A]">
                            {format(new Date(session.scheduledAt), 'EEEE, dd MMMM', { locale: id })}
                        </h3>
                        <div className="flex items-center gap-4 mt-2">
                            <div className="flex items-center gap-1.5 text-[12px] font-medium text-[#6B7C6B]">
                                <Clock className="w-3.5 h-3.5" />
                                {format(new Date(session.scheduledAt), 'HH:mm')} WIB
                            </div>
                            <div className="w-1 h-1 bg-black/10 rounded-full"></div>
                            <div className="flex items-center gap-1.5 text-[12px] font-medium text-[#6B7C6B]">
                                <Video className="w-3.5 h-3.5" />
                                Google Meet
                            </div>
                        </div>
                    </div>

                    <div className="grid grid-cols-2 gap-4 pt-4 border-t border-black/5">
                        <div className="space-y-1">
                            <p className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-wider">Durasi</p>
                            <p className="text-sm font-bold text-[#2A3C2A]">60 Menit</p>
                        </div>
                        <div className="space-y-1">
                            <p className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-wider">Investasi</p>
                            <p className="text-sm font-bold text-[#2A3C2A]">Rp150.000</p>
                        </div>
                    </div>
                </div>

                <div className="flex flex-col gap-3 justify-end min-w-[160px]">
                    <a
                        href={session.meetLink}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="w-full h-11 bg-[#C67C5C] text-white rounded-full font-bold text-xs flex items-center justify-center gap-2 shadow-sm hover:shadow-md transition-all active:scale-[0.98]"
                    >
                        Join Session
                        <ChevronRight className="w-4 h-4" />
                    </a>
                    <button
                        onClick={onReschedule}
                        className="w-full h-11 bg-black/5 text-[#2A3C2A] rounded-full font-bold text-xs hover:bg-black/10 transition-all"
                    >
                        Reschedule
                    </button>
                </div>
            </div>
        </div>
    );
}

export function SessionSummaryCard({ summary, isPreview, isList }) {
    if (!summary && isPreview) return (
        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-6 shadow-sm flex flex-col items-center justify-center text-center h-full min-h-[200px]">
            <p className="text-[11px] font-bold text-[#A0A0A0] uppercase tracking-widest mb-2">Summary Preview</p>
            <p className="text-xs text-[#6B7C6B] font-medium">Belum ada ringkasan sesi.</p>
            <button className="mt-4 text-[11px] font-bold text-[#C67C5C] hover:underline">Book your first session</button>
        </div>
    );

    if (isList) return (
        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-5 shadow-sm hover:translate-y-[-2px] hover:bg-white transition-all group flex items-center justify-between cursor-pointer">
            <div className="flex items-center gap-5">
                <div className="w-12 h-12 bg-black/5 rounded-2xl flex flex-col items-center justify-center shrink-0">
                    <span className="text-[8px] font-bold text-[#6B7C6B] uppercase leading-none mb-0.5">{format(new Date(summary.createdAt), 'MMM', { locale: id })}</span>
                    <span className="text-lg font-serif font-bold text-[#2A3C2A] leading-none">{format(new Date(summary.createdAt), 'dd')}</span>
                </div>
                <div className="space-y-1">
                    <h4 className="text-sm font-bold text-[#2A3C2A] group-hover:text-[#C67C5C] transition-colors">
                        Mediasi {format(new Date(summary.createdAt), 'yyyy')}
                    </h4>
                    <div className="flex items-center gap-3">
                        {summary.agreements.slice(0, 2).map((agm, i) => (
                            <span key={i} className="text-[10px] text-[#6B7C6B] font-medium flex items-center gap-1">
                                <span className="w-1 h-1 bg-black/10 rounded-full"></span>
                                {agm}
                            </span>
                        ))}
                    </div>
                </div>
            </div>
            <div className="flex items-center gap-4">
                <span className="px-2 py-0.5 bg-black/5 rounded-full text-[9px] font-bold text-[#A0A0A0] uppercase tracking-wider">Completed</span>
                <ChevronRight className="w-4 h-4 text-black/10 group-hover:text-[#2A3C2A] transition-colors" />
            </div>
        </div>
    );

    return (
        <div className="bg-white/60 backdrop-blur rounded-3xl border border-black/5 p-6 shadow-sm h-full flex flex-col">
            <div className="flex items-center justify-between mb-6">
                <h3 className="text-sm font-bold text-[#2A3C2A]">Ringkasan Terakhir</h3>
                <span className="px-2 py-0.5 bg-[#C67C5C]/10 text-[#C67C5C] text-[10px] font-bold rounded-full">New Insight</span>
            </div>

            <div className="flex-grow space-y-4">
                <p className="text-xs text-[#2A3C2A] font-medium italic leading-relaxed opacity-80 border-l-2 border-[#C67C5C]/30 pl-3">
                    "{summary.summaryText.length > 120 ? summary.summaryText.substring(0, 120) + '...' : summary.summaryText}"
                </p>
                <div className="space-y-2">
                    <p className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-wider">Key Takeaways</p>
                    <div className="flex flex-col gap-2">
                        {summary.agreements.slice(0, 3).map((agm, i) => (
                            <div key={i} className="flex items-center gap-2 text-[11px] font-medium text-[#6B7C6B]">
                                <div className="w-1 h-1 bg-[#C67C5C] rounded-full"></div>
                                {agm}
                            </div>
                        ))}
                    </div>
                </div>
            </div>

            <button className="mt-6 w-full h-10 bg-black/5 hover:bg-black/10 text-[#2A3C2A] rounded-full font-bold text-[10px] uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                <Sparkles className="w-3 h-3" />
                Save to Playbook
            </button>
        </div>
    );
}
