"use client";
import { useState, useEffect } from "react";
import { Loader2, Activity } from "lucide-react";
import { Button } from "@/components/ui/button";

export default function DailyLog() {
    const [loading, setLoading] = useState(true);
    const [todayLog, setTodayLog] = useState(null);

    useEffect(() => {
        fetch("/api/daily-log")
            .then(res => res.json())
            .then(data => {
                setTodayLog(data);
                setLoading(false);
            })
            .catch(err => {
                console.error(err);
                setLoading(false);
            });
    }, []);

    if (loading) return <div className="p-6 bg-white rounded-2xl border border-[#E5E0D0] h-64 flex items-center justify-center"><Loader2 className="animate-spin text-[#6B7C6B]" /></div>;

    return (

        <div className="bg-white p-8 rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E5E0D0] transition-all duration-300 hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] hover:-translate-y-1">
            <div className="flex items-center justify-between mb-6">
                <h3 className="text-xl font-serif font-bold text-[#2A3C2A]">Daily Log</h3>
                <div className="w-10 h-10 rounded-full bg-[#FDFBF7] flex items-center justify-center border border-[#E5E0D0]">
                    <Activity className="w-5 h-5 text-[#C67C5C]" />
                </div>
            </div>

            {todayLog ? (
                <div className="space-y-6">
                    <div className="bg-[#FDFBF7] p-4 rounded-2xl border border-[#E5E0D0]">
                        <span className="text-xs font-bold text-[#6B7C6B] uppercase tracking-widest block mb-2">Strain Level</span>
                        <div className="flex items-center gap-3">
                            <div className="flex-1 h-3 bg-[#E5E0D0] rounded-full overflow-hidden">
                                <div className="h-full bg-[#C67C5C] rounded-full transition-all duration-1000" style={{ width: `${(todayLog.strain_level / 10) * 100}%` }}></div>
                            </div>
                            <span className="text-lg font-bold text-[#2A3C2A] min-w-[3rem] text-right">{todayLog.strain_level}<span className="text-[#B0A69D] text-sm">/10</span></span>
                        </div>
                    </div>
                    {todayLog.note && (
                        <div className="relative pl-4 border-l-2 border-[#E5E0D0]">
                            <p className="text-sm text-[#6B7C6B] italic leading-relaxed">"{todayLog.note}"</p>
                        </div>
                    )}
                </div>
            ) : (
                <div className="text-center py-6">
                    <div className="w-16 h-16 bg-[#FDFBF7] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#E5E0D0]">
                        <span className="text-2xl grayscale">📝</span>
                    </div>
                    <p className="text-sm font-medium text-[#6B7C6B] mb-6">Belum ada catatan hari ini.</p>
                    <Button variant="default" className="w-full rounded-xl bg-[#2A3C2A] hover:bg-[#1a261a] text-white font-bold tracking-wide shadow-lg shadow-[#2A3C2A]/20">
                        Log Activity
                    </Button>
                </div>
            )}
        </div>
    );

}
