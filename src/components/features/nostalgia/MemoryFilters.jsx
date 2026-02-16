export default function MemoryFilters({
    searchQuery, setSearchQuery,
    filterTag, setFilterTag,
    sortBy, setSortBy,
    viewMode, setViewMode,
    toggleUploadForm,
    showFilters, setShowFilters,
    tags
}) {
    return (
        <div className="bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-white/50 p-6 mb-8 transform hover:scale-[1.005] transition-all duration-300">
            <div className="flex flex-col md:flex-row gap-6 items-center justify-between">
                {/* Left: Search & Filter */}
                <div className="flex items-center gap-3 flex-1 w-full">
                    {/* Search */}
                    <div className="relative flex-1 max-w-xl">
                        <input
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            placeholder="Cari kenangan..."
                            className="w-full pl-10 pr-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white/50 focus:bg-white transition-all shadow-sm"
                        />
                        <svg className="w-5 h-5 text-[#6B7C6B] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    {/* Filter Toggle */}
                    <button
                        onClick={() => setShowFilters(!showFilters)}
                        className="px-5 py-3 rounded-xl border-2 border-[#E5E0D0] hover:border-[#C67C5C] hover:text-[#C67C5C] transition-all flex items-center gap-2 bg-white/50 font-bold text-[#6B7C6B] shadow-sm whitespace-nowrap"
                    >
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span>Filter</span>
                    </button>
                </div>

                {/* Right: View Mode & Add Button */}
                <div className="flex items-center gap-3 w-full md:w-auto justify-end">
                    {/* View Mode Toggle */}
                    <div className="bg-[#F2EFE5] rounded-xl p-1 flex gap-1">
                        <button
                            onClick={() => setViewMode("grid")}
                            className={`px-3 py-2 rounded-lg transition-all ${viewMode === "grid"
                                    ? "bg-white shadow text-[#C67C5C]"
                                    : "text-[#6B7C6B] hover:bg-white/50"
                                }`}
                        >
                            <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button
                            onClick={() => setViewMode("timeline")}
                            className={`px-3 py-2 rounded-lg transition-all ${viewMode === "timeline"
                                    ? "bg-white shadow text-[#C67C5C]"
                                    : "text-[#6B7C6B] hover:bg-white/50"
                                }`}
                        >
                            <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fillRule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clipRule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    {/* Add Memory Button */}
                    <button
                        onClick={toggleUploadForm}
                        className="bg-gradient-to-r from-[#C67C5C] to-[#D89A7A] text-white font-bold px-6 py-2.5 rounded-xl hover:shadow-lg hover:from-[#B56B4B] hover:to-[#C67C5C] transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                    >
                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span className="hidden sm:inline">Tambah Memori</span>
                    </button>
                </div>
            </div>

            {/* Filters Panel (Collapsible) */}
            {showFilters && (
                <div className="pt-6 mt-6 border-t border-[#E5E0D0] flex flex-wrap items-center gap-4 animate-fadeIn">
                    {/* Tag Filter */}
                    <div className="flex-1 min-w-[200px]">
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Filter Tag</label>
                        <select
                            value={filterTag}
                            onChange={(e) => setFilterTag(e.target.value)}
                            className="w-full px-4 py-2 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white"
                        >
                            <option value="">Semua Tag</option>
                            {tags.map((tag) => (
                                <option key={tag} value={tag}>
                                    {tag.charAt(0).toUpperCase() + tag.slice(1)}
                                </option>
                            ))}
                        </select>
                    </div>

                    {/* Sort By */}
                    <div className="flex-1 min-w-[200px]">
                        <label className="block text-xs font-bold text-[#6B7C6B] uppercase tracking-wider mb-2">Urutkan</label>
                        <select
                            value={sortBy}
                            onChange={(e) => setSortBy(e.target.value)}
                            className="w-full px-4 py-2 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#C67C5C] focus:border-transparent bg-white"
                        >
                            <option value="date_desc">Terbaru</option>
                            <option value="date_asc">Terlama</option>
                            <option value="title">Judul (A-Z)</option>
                        </select>
                    </div>

                    {/* Clear Filters */}
                    {(searchQuery || filterTag) && (
                        <div className="flex items-end pb-1">
                            <button
                                onClick={() => {
                                    setSearchQuery("");
                                    setFilterTag("");
                                }}
                                className="px-4 py-2 text-sm font-bold text-[#C67C5C] hover:text-[#B56B4B] hover:underline transition-colors"
                            >
                                Hapus Filter
                            </button>
                        </div>
                    )}
                </div>
            )}
        </div>
    );
}
