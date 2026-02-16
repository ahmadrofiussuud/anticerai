import { format } from "date-fns";
import { id } from "date-fns/locale";

export default function MemoryTimeline({ memories, onSelectMemory }) {
    if (memories.length === 0) return null;

    return (
        <div className="max-w-4xl mx-auto">
            {memories.map((memory, index) => (
                <div key={memory.id} className={`relative pl-8 pb-12 ${index === memories.length - 1 ? 'pb-0' : ''}`}>
                    {/* Timeline Line */}
                    {index !== memories.length - 1 && (
                        <div className="absolute left-[15px] top-8 bottom-0 w-0.5 bg-[#E5E0D0]"></div>
                    )}

                    {/* Timeline Dot */}
                    <div className="absolute left-0 top-2 w-8 h-8 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                        <span className="text-white text-xs font-bold">{index + 1}</span>
                    </div>

                    {/* Memory Card */}
                    <div
                        onClick={() => onSelectMemory(memory)}
                        className="bg-white rounded-2xl shadow-lg border border-[#E5E0D0] overflow-hidden hover:shadow-2xl transition-all cursor-pointer"
                    >
                        <div className="md:flex">
                            {/* Photo */}
                            <div className="md:w-1/3 h-48 md:h-auto overflow-hidden bg-[#F2EFE5] relative">
                                <img src={memory.image_path || "/images/placeholder-memory.jpg"}
                                    alt={memory.title}
                                    className="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                                    onError={(e) => {
                                        e.target.style.display = "none";
                                        e.target.nextElementSibling.style.display = "flex";
                                    }}
                                />
                                <div className="absolute inset-0 hidden items-center justify-center bg-[#F7F5F0]">
                                    <svg className="w-12 h-12 text-[#D4CEBC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>

                            {/* Content */}
                            <div className="md:w-2/3 p-6">
                                <div className="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 className="text-2xl font-serif font-bold text-[#2A3C2A] mb-1">{memory.title}</h3>
                                        <p className="text-sm text-[#6B7C6B]">{format(new Date(memory.memory_date), "dd MMMM yyyy", { locale: id })}</p>
                                    </div>
                                </div>
                                <p className="text-[#6B7C6B] leading-relaxed mb-4">{memory.description}</p>
                                <div className="flex gap-2">
                                    {memory.tagsJSON && memory.tagsJSON.map((tag, idx) => (
                                        <span key={idx} className="bg-[#E5E0D0] text-[#2A3C2A] text-xs px-3 py-1 rounded-full font-bold">
                                            {tag}
                                        </span>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
}
