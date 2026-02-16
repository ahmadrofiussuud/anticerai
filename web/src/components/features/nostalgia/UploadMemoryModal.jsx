import { useState } from "react";
import { Loader2 } from "lucide-react";

export default function UploadMemoryModal({ isOpen, onClose, onSave }) {
    const [title, setTitle] = useState("");
    const [date, setDate] = useState("");
    const [description, setDescription] = useState("");
    const [tags, setTags] = useState("");
    const [photo, setPhoto] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState("");

    if (!isOpen) return null;

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setError("");

        try {
            const formData = new FormData();
            formData.append("title", title);
            formData.append("memory_date", date);
            formData.append("description", description);
            formData.append("tags", tags); // Will handle parsing on backend or just send string
            if (photo) {
                formData.append("image", photo);
            }

            const res = await fetch("/api/memories", {
                method: "POST",
                body: formData,
            });

            if (!res.ok) {
                const data = await res.json();
                throw new Error(data.error || "Failed to create memory");
            }

            onSave();
            onClose();
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-8 relative max-h-[90vh] overflow-y-auto">
                <button
                    onClick={onClose}
                    className="absolute top-4 right-4 w-10 h-10 bg-[#E5E0D0] hover:bg-[#D4CEBC] rounded-full flex items-center justify-center transition-colors"
                >
                    <svg className="w-6 h-6 text-[#2A3C2A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h2 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-6">Tambah Kenangan Baru</h2>

                <form onSubmit={handleSubmit} className="space-y-4">
                    {error && (
                        <div className="bg-red-50 text-red-500 p-3 rounded-lg text-sm">
                            {error}
                        </div>
                    )}

                    <div>
                        <label className="block text-sm font-bold text-[#2A3C2A] mb-2">Judul Kenangan</label>
                        <input
                            type="text"
                            value={title}
                            onChange={(e) => setTitle(e.target.value)}
                            className="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                            placeholder="Contoh: Kencan Pertama di Kafe"
                            required
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-bold text-[#2A3C2A] mb-2">Tanggal</label>
                        <input
                            type="date"
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            className="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                            required
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-bold text-[#2A3C2A] mb-2">Deskripsi</label>
                        <textarea
                            value={description}
                            onChange={(e) => setDescription(e.target.value)}
                            rows="3"
                            className="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                            placeholder="Ceritakan kisahnya..."
                        ></textarea>
                    </div>

                    <div>
                        <label className="block text-sm font-bold text-[#2A3C2A] mb-2">Tag</label>
                        <input
                            type="text"
                            value={tags}
                            onChange={(e) => setTags(e.target.value)}
                            className="w-full px-4 py-3 rounded-xl border border-[#E5E0D0] focus:ring-2 focus:ring-[#4A6741] focus:border-transparent"
                            placeholder="Contoh: kencan, jalan-jalan (pisahkan dengan koma)"
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-bold text-[#2A3C2A] mb-2">Unggah Foto</label>
                        <div className="border-2 border-dashed border-[#E5E0D0] rounded-xl p-8 text-center hover:border-[#4A6741] transition-colors cursor-pointer relative">
                            <input
                                type="file"
                                onChange={(e) => setPhoto(e.target.files[0])}
                                className="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                accept="image/*"
                            />
                            <svg className="w-12 h-12 mx-auto text-[#6B7C6B] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p className="text-[#6B7C6B] text-sm">
                                {photo ? photo.name : "Klik untuk unggah atau seret dan lepas"}
                            </p>
                        </div>
                    </div>

                    <div className="flex gap-3 pt-4">
                        <button
                            type="submit"
                            disabled={loading}
                            className="flex-1 bg-gradient-to-r from-[#4A6741] to-[#5C7C53] text-white font-bold py-3 rounded-xl hover:opacity-90 transition-opacity flex items-center justify-center gap-2"
                        >
                            {loading && <Loader2 className="w-4 h-4 animate-spin" />}
                            Simpan Kenangan
                        </button>
                        <button
                            type="button"
                            onClick={onClose}
                            className="px-6 bg-[#E5E0D0] text-[#2A3C2A] font-bold py-3 rounded-xl hover:bg-[#D4CEBC] transition-colors"
                        >
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
