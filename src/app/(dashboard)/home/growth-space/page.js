import GrowthHero from "@/components/features/growth-space/GrowthHero";

export default function GrowthSpacePage() {
    return (
        <div className="min-h-screen bg-[#FDFBF7]">
            <GrowthHero />

            <div id="articles-grid" className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 scroll-mt-24">
                <div className="flex items-center justify-between mb-8">
                    <h2 className="text-3xl font-serif font-bold text-[#2A3C2A]">Artikel Terbaru</h2>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {[1, 2, 3, 4, 5, 6].map((i) => (
                        <div key={i} className="bg-white rounded-2xl shadow-sm border border-[#E5E0D0] overflow-hidden group cursor-pointer hover:shadow-lg transition-all">
                            <div className="h-48 bg-[#FDFBF7] relative overflow-hidden">
                                <div className="absolute inset-0 bg-gradient-to-br from-[#E5E0D0] to-[#FDFBF7] group-hover:scale-110 transition-transform duration-500"></div>
                            </div>
                            <div className="p-6">
                                <h3 className="font-serif font-bold text-xl mb-2 text-[#2A3C2A] group-hover:text-[#C67C5C] transition-colors">Article Title {i}</h3>
                                <p className="text-[#6B7C6B] text-sm line-clamp-2">Short description of the growth material to help you understand better...</p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
