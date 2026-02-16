import Header from "@/components/layout/Header";
import Footer from "@/components/layout/Footer";

export default function DashboardLayout({ children }) {
    return (
        <div className="min-h-screen relative overflow-x-hidden bg-[#FAFAFA]">
            {/* Subtle Warm Noise/Gradient Overlay */}
            <div
                className="fixed inset-0 z-[-1] opacity-60 pointer-events-none"
                style={{ background: 'radial-gradient(circle at 0% 0%, #fff1f2 0%, transparent 50%), radial-gradient(circle at 100% 100%, #fffbeb 0%, transparent 50%)' }}
            ></div>

            <Header />
            <main className="min-h-[calc(100vh-64px)]">
                {children}
            </main>
            <Footer />
        </div>
    );
}
