"use client";

import { motion } from "framer-motion";
import { Calendar, Clock, Video, ChevronRight, FileText, CheckCircle2 } from "lucide-react";
import { format } from "date-fns";
import { id } from "date-fns/locale";

export function UpcomingSessionCard({ session, onReschedule }) {
    if (!session) return (
        <div className="bg-[#FDFBF7] rounded-3xl p-8 border border-dashed border-black/10 flex flex-col items-center justify-center text-center">
            <Calendar className="w-10 h-10 text-[#A0A0A0] mb-4 opacity-40" />
            <p className="text-sm font-bold text-[#A0A0A0] mb-2">Belum ada sesi terjadwal</p>
            <p className="text-[11px] text-[#A0A0A0] max-w-[200px]">Book sesi mediasi pertama Anda untuk memulai.</p>
        </div>
    );

    return (
        <div className="bg-[#2A3C2A] rounded-[2rem] p-8 text-white shadow-xl relative overflow-hidden group">
            <div className="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>

            <div className="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <div className="flex items-center justify-between mb-8">
                        <span className="px-3 py-1 bg-white/10 rounded-full text-[9px] font-bold uppercase tracking-widest border border-white/10">
                            Upcoming Session
                        </span>
                        <div className={`px-2 py-0.5 rounded text-[8px] font-bold uppercase tracking-widest ${session.status === 'confirmed' ? 'bg-[#C67C5C] text-white' : 'bg-white/20 text-white'
                            }`}>
                            {session.status}
                        </div>
                    </div>

                    <h3 className="text-2xl font-serif font-bold mb-2">{format(new Date(session.scheduledAt), 'EEEE, dd MMM', { locale: id })}</h3>
                    <div className="flex items-center gap-4 text-white/70 text-sm font-medium">
                        <div className="flex items-center gap-1.5">
                            <Clock className="w-4 h-4" />
                            {format(new Date(session.scheduledAt), 'HH:mm')}
                        </div>
                        <div className="flex items-center gap-1.5">
                            <Video className="w-4 h-4" />
                            Google Meet
                        </div>
                    </div>
                </div>

                <div className="mt-12 flex flex-col gap-3">
                    <a
                        href={session.meetLink}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="w-full bg-white text-[#2A3C2A] py-4 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-[#FDFBF7] transition-all"
                    >
                        Join Session
                    </a>
                    <button
                        onClick={onReschedule}
                        className="text-xs font-bold text-white/60 hover:text-white transition-colors text-center"
                    >
                        Reschedule
                    </button>
                </div>
            </div>
        </div>
    );
}

export function SessionSummaryCard({ summary }) {
    return (
        <div className="bg-white rounded-3xl p-6 border border-black/5 shadow-sm hover:shadow-md transition-all group">
            <div className="flex items-start justify-between mb-6">
                <div className="flex items-center gap-3">
                    <div className="w-10 h-10 bg-[#FDFBF7] rounded-xl flex items-center justify-center text-[#2A3C2A]">
                        <FileText className="w-5 h-5" />
                    </div>
                    <div>
                        <div className="text-[10px] font-bold text-[#A0A0A0] uppercase tracking-widest">Ringkasan Sesi</div>
                        <div className="text-sm font-bold text-[#2A3C2A]">{format(new Date(summary.createdAt), 'dd MMMM yyyy', { locale: id })}</div>
                    </div>
                </div>
                <button className="p-2 hover:bg-black/5 rounded-lg transition-colors text-[#A0A0A0] hover:text-[#2A3C2A]">
                    <ChevronRight className="w-5 h-5" />
                </button>
            </div>

            <p className="text-xs text-[#6B7C6B] font-medium leading-relaxed mb-6 line-clamp-2 italic">
                "{summary.summaryText}"
            </p>

            <div className="space-y-4 pt-4 border-t border-black/5">
                <div>
                    <div className="text-[9px] font-bold text-[#A0A0A0] uppercase tracking-widest mb-2">Kesepakatan</div>
                    <div className="flex flex-wrap gap-2">
                        {summary.agreements.map((agm, i) => (
                            <span key={i} className="bg-[#2A3C2A]/5 text-[#2A3C2A] text-[10px] font-bold px-2 py-1 rounded-md">
                                {agm}
                            </span>
                        ))}
                    </div>
                </div>
                <div>
                    <div className="text-[9px] font-bold text-[#A0A0A0] uppercase tracking-widest mb-2">Next Actions</div>
                    <div className="space-y-2">
                        {summary.nextActions.map((action) => (
                            <div key={action.id} className="flex items-center gap-2">
                                <CheckCircle2 className={`w-3 h-3 ${action.completed ? 'text-[#2A3C2A]' : 'text-black/10'}`} />
                                <span className={`text-[10px] font-medium ${action.completed ? 'text-[#2A3C2A] line-through' : 'text-[#6B7C6B]'}`}>
                                    {action.task}
                                </span>
                            </div>
                        ))}
                    </div>
                </div>
            </div>

            <button className="w-full mt-6 py-3 bg-[#FDFBF7] text-[#C67C5C] text-[10px] font-bold uppercase tracking-widest rounded-xl border border-black/5 hover:bg-[#C67C5C] hover:text-white transition-all">
                Save to Partnership Playbook
            </button>
        </div>
    );
}
