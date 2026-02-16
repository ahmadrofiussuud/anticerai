"use client";

import { useState, useEffect } from "react";
import NostalgiaHero from "@/components/features/nostalgia/NostalgiaHero";
import MemoryFilters from "@/components/features/nostalgia/MemoryFilters";
import MemoryGrid from "@/components/features/nostalgia/MemoryGrid";
import MemoryTimeline from "@/components/features/nostalgia/MemoryTimeline";
import UploadMemoryModal from "@/components/features/nostalgia/UploadMemoryModal";
import MemoryLightbox from "@/components/features/nostalgia/MemoryLightbox";
import { Loader2 } from "lucide-react";

export default function NostalgiaPage() {
    // State
    const [memories, setMemories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [searchQuery, setSearchQuery] = useState("");
    const [filterTag, setFilterTag] = useState("");
    const [sortBy, setSortBy] = useState("date_desc");
    const [viewMode, setViewMode] = useState("grid"); // grid | timeline
    const [showFilters, setShowFilters] = useState(false);

    // Modals
    const [showUploadForm, setShowUploadForm] = useState(false);
    const [selectedMemory, setSelectedMemory] = useState(null);

    // Fetch Memories
    const fetchMemories = async () => {
        setLoading(true);
        try {
            const params = new URLSearchParams({
                search: searchQuery,
                tag: filterTag,
                sort: sortBy,
                limit: 100 // Get enough for demo
            });

            const res = await fetch(`/api/memories?${params.toString()}`);
            const data = await res.json();

            // Process tags (JSON string to array if needed)
            // Assuming API returns tags field which might be string or plain text
            const processedMemories = data.data.map(m => ({
                ...m,
                tagsJSON: m.tags ? m.tags.split(',').map(t => t.trim()) : []
            }));

            setMemories(processedMemories);
        } catch (error) {
            console.error("Failed to fetch memories", error);
        } finally {
            setLoading(false);
        }
    };

    // Derived Data
    const allTags = Array.from(new Set(memories.flatMap(m => m.tagsJSON)));

    // Effects
    useEffect(() => {
        // Debounce search
        const timeoutId = setTimeout(() => {
            fetchMemories();
        }, 300);
        return () => clearTimeout(timeoutId);
    }, [searchQuery, filterTag, sortBy]);

    // Handlers
    const handleSaveMemory = () => {
        fetchMemories(); // Refresh list
    };

    const handleSelectMemory = (memory) => {
        setSelectedMemory(memory);
    };

    const handleNextMemory = () => {
        if (!selectedMemory) return;
        const currentIndex = memories.findIndex(m => m.id === selectedMemory.id);
        if (currentIndex < memories.length - 1) {
            setSelectedMemory(memories[currentIndex + 1]);
        }
    };

    const handlePrevMemory = () => {
        if (!selectedMemory) return;
        const currentIndex = memories.findIndex(m => m.id === selectedMemory.id);
        if (currentIndex > 0) {
            setSelectedMemory(memories[currentIndex - 1]);
        }
    };

    return (
        <div className="min-h-screen bg-[#FDFBF7]">
            <NostalgiaHero
                memoryCount={memories.length}
                tagsCount={allTags.length}
            />

            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 pb-20">
                <MemoryFilters
                    searchQuery={searchQuery}
                    setSearchQuery={setSearchQuery}
                    filterTag={filterTag}
                    setFilterTag={setFilterTag}
                    sortBy={sortBy}
                    setSortBy={setSortBy}
                    viewMode={viewMode}
                    setViewMode={setViewMode}
                    toggleUploadForm={() => setShowUploadForm(true)}
                    showFilters={showFilters}
                    setShowFilters={setShowFilters}
                    tags={allTags}
                />

                {loading ? (
                    <div className="flex justify-center py-20">
                        <Loader2 className="w-10 h-10 animate-spin text-[#C67C5C]" />
                    </div>
                ) : memories.length > 0 ? (
                    <>
                        {viewMode === 'grid' ? (
                            <MemoryGrid memories={memories} onSelectMemory={handleSelectMemory} />
                        ) : (
                            <MemoryTimeline memories={memories} onSelectMemory={handleSelectMemory} />
                        )}
                    </>
                ) : (
                    <div className="text-center py-20">
                        <svg className="w-24 h-24 mx-auto text-[#D4CEBC] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-3">Tidak Ada Kenangan Ditemukan</h3>
                        <p className="text-[#6B7C6B] mb-6">Coba sesuaikan filter Anda atau tambahkan kenangan baru</p>
                        <button
                            onClick={() => { setSearchQuery(""); setFilterTag(""); }}
                            className="text-[#C67C5C] font-bold hover:text-[#D89A7A] transition-colors"
                        >
                            Hapus Filter
                        </button>
                    </div>
                )}
            </div>

            <UploadMemoryModal
                isOpen={showUploadForm}
                onClose={() => setShowUploadForm(false)}
                onSave={handleSaveMemory}
            />

            <MemoryLightbox
                memory={selectedMemory}
                onClose={() => setSelectedMemory(null)}
                onNext={handleNextMemory}
                onPrev={handlePrevMemory}
                currentIndex={memories.findIndex(m => m.id === selectedMemory?.id)}
                totalMemories={memories.length}
            />
        </div>
    );
}
