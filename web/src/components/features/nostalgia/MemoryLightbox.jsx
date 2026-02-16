import { format } from "date-fns";
import { id } from "date-fns/locale";

export default function MemoryLightbox({ memory, onClose, onNext, onPrev, currentIndex, totalMemories }) {
    if (!memory) return null;

    return (
        <div className="fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4">
            {/* Close Button */}
            <button
                onClick={onClose}
                className="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm z-50"
            >
                <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            {/* Previous Button */}
            <button
                onClick={onPrev}
                className="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm z-50 disabled:opacity-30 disabled:cursor-not-allowed"
                disabled={currentIndex === 0}
            >
                <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            {/* Next Button */}
            <button
                onClick={onNext}
                className="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors backdrop-blur-sm z-50 disabled:opacity-30 disabled:cursor-not-allowed"
                disabled={currentIndex === totalMemories - 1}
            >
                <svg className="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            {/* Content */}
            <div className="max-w-6xl w-full">
                <div className="grid md:grid-cols-2 gap-8 items-center">
                    {/* Photo */}
                    <div className="rounded-2xl overflow-hidden shadow-2xl bg-black max-h-[80vh] flex items-center justify-center">
                        <img
                            src={memory.image_path || "/images/placeholder-memory.jpg"}
                            alt={memory.title}
                            className="max-w-full max-h-full object-contain"
                        />
                    </div>

                    {/* Details */}
                    <div className="text-white">
                        <div className="mb-4">
                            <p className="text-sm text-white/60 mb-2">
                                {format(new Date(memory.memory_date), "dd MMMM yyyy", { locale: id })}
                            </p>
                            <h2 className="text-4xl font-serif font-bold mb-4">{memory.title}</h2>
                            <p className="text-lg text-white/90 leading-relaxed mb-6">
                                {memory.description}
                            </p>
                        </div>

                        <div className="flex gap-2 mb-6 flex-wrap">
                            {memory.tagsJSON && memory.tagsJSON.map((tag, idx) => (
                                <span key={idx} className="bg-white/20 backdrop-blur-sm text-white text-sm px-4 py-2 rounded-full font-bold">
                                    {tag}
                                </span>
                            ))}
                        </div>

                        <div className="text-sm text-white/60">
                            Kenangan {currentIndex + 1} dari {totalMemories}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
