import Link from "next/link";
import { Twitter, Facebook, Instagram } from "lucide-react";

export default function Footer() {
    return (
        <footer className="relative z-10 bg-white border-t border-[#E5E0D0] pt-16 pb-8 text-[#4A3427]">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">
                    {/* Brand Column */}
                    <div className="space-y-6">
                        <Link href="/" className="flex items-center gap-2 group">
                            <div className="w-10 h-10 bg-gradient-to-br from-[#C67C5C] to-[#D89A7A] rounded-xl flex items-center justify-center text-white font-serif font-bold text-xl shadow-lg group-hover:shadow-xl transition-all transform group-hover:rotate-3">
                                A
                            </div>
                            <span className="text-2xl font-serif font-bold">Amora</span>
                        </Link>
                        <p className="text-[#8A7A70] text-lg leading-relaxed max-w-xs">
                            Creating forever new beginnings. We help couples deepen their connection through shared experiences and meaningful growth.
                        </p>
                        <div className="flex items-center gap-4">
                            <a href="#" className="w-10 h-10 rounded-full bg-[#FDFBF7] flex items-center justify-center text-[#C67C5C] hover:bg-[#C67C5C] hover:text-white transition-all shadow-sm">
                                <Twitter className="w-5 h-5" />
                            </a>
                            <a href="#" className="w-10 h-10 rounded-full bg-[#FDFBF7] flex items-center justify-center text-[#C67C5C] hover:bg-[#C67C5C] hover:text-white transition-all shadow-sm">
                                <Instagram className="w-5 h-5" />
                            </a>
                        </div>
                    </div>

                    {/* Links Column 1 */}
                    <div>
                        <h3 className="font-serif font-bold text-lg mb-6">Product</h3>
                        <ul className="space-y-4">
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Features</Link></li>
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Pricing</Link></li>
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Testimonials</Link></li>
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">FAQ</Link></li>
                        </ul>
                    </div>

                    {/* Links Column 2 */}
                    <div>
                        <h3 className="font-serif font-bold text-lg mb-6">Resources</h3>
                        <ul className="space-y-4">
                            <li><Link href="/dashboard/growth-space" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Growth Space</Link></li>
                            <li><Link href="/dashboard/nostalgia" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Nostalgia Engine</Link></li>
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Blog</Link></li>
                            <li><Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Community</Link></li>
                        </ul>
                    </div>

                    {/* Newsletter Column */}
                    <div>
                        <h3 className="font-serif font-bold text-lg mb-6">Stay Connected</h3>
                        <p className="text-[#8A7A70] mb-4 text-sm">Join our newsletter for weekly relationship tips.</p>
                        <form className="space-y-3">
                            <input type="email" placeholder="Enter your email"
                                className="w-full px-4 py-3 rounded-xl bg-[#FDFBF7] border border-[#E5E0D0] focus:border-[#C67C5C] focus:ring focus:ring-[#C67C5C]/20 outline-none transition-all placeholder-[#B0A69D] text-[#4A3427]" />
                            <button type="button" className="w-full bg-[#4A3427] text-white font-bold py-3 rounded-xl hover:bg-[#3A2820] transition-colors shadow-md">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>

                {/* Bottom Bar */}
                <div className="pt-8 border-t border-[#E5E0D0] flex flex-col md:flex-row justify-between items-center gap-4">
                    <p className="text-[#B0A69D] text-sm">© {new Date().getFullYear()} Amora. All rights reserved.</p>
                    <div className="flex items-center gap-6 text-sm">
                        <Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Privacy Policy</Link>
                        <Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Terms of Service</Link>
                        <Link href="#" className="text-[#8A7A70] hover:text-[#C67C5C] transition-colors">Cookie Policy</Link>
                    </div>
                </div>
            </div>
        </footer>
    );
}
