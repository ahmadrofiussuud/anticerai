import { format } from "date-fns";
import { id } from "date-fns/locale";

export default function MemoryGrid({ memories, onSelectMemory }) {
    if (memories.length === 0) return null;

    return (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {memories.map((memory) => (
                <div
                    key={memory.id}
                    onClick={() => onSelectMemory(memory)}
                    className="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] cursor-pointer border border-[#E5E0D0] flex flex-col h-full"
                >
                    {/* Memory Photo */}
                    <div className="relative h-64 overflow-hidden bg-[#F2EFE5]">
                        <img
                            src={memory.image_path || "/images/placeholder-memory.jpg"}
                            alt={memory.title}
                            className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            onError={(e) => {
                                e.target.style.display = "none";
                                e.target.nextElementSibling.style.display = "flex";
                            }}
                        />

                        {/* Fallback */}
                        <div className="absolute inset-0 hidden items-center justify-center bg-[#F7F5F0] -z-10 group-hover:scale-110 transition-transform duration-700">
                            <svg className="w-16 h-16 text-[#D4CEBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>

                        <div className="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>

                        {/* Date Badge */}
                        <div className="absolute top-5 left-5 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold text-[#2A3C2A] shadow-md z-10 transition-transform group-hover:-translate-y-1">
                            {format(new Date(memory.memory_date), "d MMM yyyy", { locale: id })}
                        </div>

                        {/* Tags */}
                        <div className="absolute bottom-5 left-5 right-5 flex flex-wrap gap-2 z-10">
                            {memory.tagsJSON && memory.tagsJSON.slice(0, 3).map((tag, idx) => (
                                <span key={idx} className="bg-[#4A6741]/90 backdrop-blur-md text-white text-[10px] px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                    {tag}
                                </span>
                            ))}
                            {memory.tagsJSON && memory.tagsJSON.length > 3 && (
                                <span className="bg-black/30 backdrop-blur-md text-white text-[10px] px-2 py-1 rounded-full shadow-sm">
                                    +{memory.tagsJSON.length - 3}
                                </span>
                            )}
                        </div>
                    </div>

                    {/* Memory Info */}
                    <div className="p-6 flex-grow flex flex-col">
                        <h3 className="text-xl font-serif font-bold text-[#2A3C2A] mb-3 leading-tight group-hover:text-[#C67C5C] transition-colors">
                            {memory.title}
                        </h3>
                        <p className="text-[#6B7C6B] text-sm leading-relaxed line-clamp-3">
                            {memory.description}
                        </p>
                    </div>
                </div>
            ))}
        </div>
    );
}
