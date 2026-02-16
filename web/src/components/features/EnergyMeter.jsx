"use client";
import { useState, useEffect } from "react";
import { Loader2, Battery, BatteryCharging, BatteryWarning, BatteryFull } from "lucide-react";
import { Button } from "@/components/ui/button";

export default function EnergyMeter() {
    const [loading, setLoading] = useState(true);
    const [logs, setLogs] = useState({ user: null, partner: null });

    useEffect(() => {
        fetch("/api/energy-log")
            .then(res => res.json())
            .then(data => {
                setLogs(data);
                setLoading(false);
            })
            .catch(err => {
                console.error(err);
                setLoading(false);
            });
    }, []);

    const getIcon = (level) => {
        if (level >= 80) return <BatteryFull className="w-8 h-8 text-green-500" />;
        if (level >= 40) return <BatteryCharging className="w-8 h-8 text-yellow-500" />;
        return <BatteryWarning className="w-8 h-8 text-red-500" />;
    };

    if (loading) return <div className="p-6 bg-white rounded-2xl border border-[#E5E0D0] h-64 flex items-center justify-center"><Loader2 className="animate-spin text-[#6B7C6B]" /></div>;

    return (

        <div className="bg-white p-8 rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#E5E0D0] transition-all duration-300 hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] hover:-translate-y-1">
            <h3 className="text-xl font-serif font-bold text-[#2A3C2A] mb-6">Energy Levels</h3>
            <div className="flex items-center justify-around">
                <div className="text-center group">
                    <div className="mb-3 flex justify-center transform transition-transform group-hover:scale-110 duration-300">{getIcon(logs.user?.level || 0)}</div>
                    <div className="text-3xl font-bold text-[#2A3C2A] mb-1">{logs.user?.level || "N/A"}%</div>
                    <div className="text-xs font-bold text-[#6B7C6B] uppercase tracking-widest">You</div>
                </div>
                <div className="h-16 w-px bg-[#E5E0D0]"></div>
                <div className="text-center group">
                    <div className="mb-3 flex justify-center transform transition-transform group-hover:scale-110 duration-300">{getIcon(logs.partner?.level || 0)}</div>
                    <div className="text-3xl font-bold text-[#2A3C2A] mb-1">{logs.partner?.level || "N/A"}%</div>
                    <div className="text-xs font-bold text-[#6B7C6B] uppercase tracking-widest">Partner</div>
                </div>
            </div>

            <div className="mt-8 pt-6 border-t border-[#E5E0D0] text-center">
                <Button variant="outline" className="w-full rounded-xl border-[#E5E0D0] text-[#6B7C6B] hover:text-[#2A3C2A] hover:border-[#2A3C2A] font-bold tracking-wide">
                    Update Status
                </Button>
            </div>
        </div>
    );

}
