export default function ProfilePage() {
    return (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 className="text-3xl font-serif font-bold text-[#2A3C2A] mb-8">Profile</h1>
            <div className="bg-white p-8 rounded-2xl shadow-sm border border-[#E5E0D0] max-w-2xl">
                <h2 className="text-xl font-bold mb-4">User Settings</h2>
                <div className="space-y-4">
                    <div className="h-10 bg-[#FDFBF7] rounded border border-[#E5E0D0]"></div>
                    <div className="h-10 bg-[#FDFBF7] rounded border border-[#E5E0D0]"></div>
                    <button className="bg-[#2C3E2C] text-white px-6 py-2 rounded-lg">Save Changes</button>
                </div>
            </div>
        </div>
    );
}
