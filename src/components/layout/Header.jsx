"use client";

import Link from "next/link";
import Image from "next/image";
import { usePathname } from "next/navigation";
import { useState } from "react";
import { Menu, X, ChevronDown, User, LogOut } from "lucide-react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Button } from "@/components/ui/button";
import { signOut, useSession } from "next-auth/react";
import { cn } from "@/lib/utils";
import { logout } from "@/lib/actions/auth";

export default function Header() {
    const pathname = usePathname();
    const [isOpen, setIsOpen] = useState(false);
    const { data: session } = useSession();

    // Fallback for user if session is loading or not present (though middleware mimics protection)
    const user = session?.user || { name: "Guest", email: "" };

    const navLinks = [
        { href: "/home", label: "Home", active: pathname === "/home" || pathname === "/dashboard" },
        { href: "/home/nostalgia", label: "Nostalgia", active: pathname.includes("nostalgia") },
        { href: "/home/bridge", label: "Bridge", active: pathname.includes("bridge") },
        { href: "/home/date-roulette", label: "Date Roulette", active: pathname.includes("date-roulette") },
        { href: "/home/growth-space", label: "Growth Space", active: pathname.includes("growth-space") },
    ];

    return (
        <nav className="bg-[#2C3E2C] border-b border-[#3A4A3A] shadow-sm relative z-50">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="flex justify-between items-center h-16">
                    {/* Logo */}
                    <div className="flex-shrink-0">
                        <Link href="/dashboard" className="flex items-center gap-2">
                            <div className="w-12 h-12 flex items-center justify-center">
                                <Image
                                    src="/images/logo_transparent.png"
                                    alt="Amora Logo"
                                    width={48}
                                    height={48}
                                    className="w-full h-full object-contain"
                                />
                            </div>
                            <span className="text-xl font-serif font-bold text-[#FDFBF7]">Amora</span>
                        </Link>
                    </div>

                    {/* Desktop Nav */}
                    <div className="hidden sm:flex absolute left-1/2 transform -translate-x-1/2 space-x-1">
                        {navLinks.map((link) => (
                            <Link
                                key={link.href}
                                href={link.href}
                                className={cn(
                                    "px-4 py-2 text-sm font-medium rounded-lg transition-colors",
                                    link.active
                                        ? "text-[#FDFBF7] bg-[#3A4A3A]"
                                        : "text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50"
                                )}
                            >
                                {link.label}
                            </Link>
                        ))}
                    </div>

                    {/* User Settings Dropdown */}
                    <div className="hidden sm:flex sm:items-center">
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Button variant="ghost" className="inline-flex items-center px-4 py-2 border border-[#3A4A3A] text-sm leading-4 font-medium rounded-lg text-[#FDFBF7] bg-[#3A4A3A]/50 hover:bg-[#3A4A3A] hover:text-[#FDFBF7] focus:outline-none transition ease-in-out duration-150 gap-2">
                                    <User className="w-4 h-4" />
                                    <span>{user.name}</span>
                                    <ChevronDown className="w-4 h-4 opacity-50" />
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end" className="w-48">
                                <DropdownMenuLabel>My Account</DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem asChild>
                                    <Link href="/dashboard/profile">Profile</Link>
                                </DropdownMenuItem>
                                <DropdownMenuItem onClick={() => logout()}>
                                    Log Out
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>

                    {/* Mobile Menu Button */}
                    <div className="-me-2 flex items-center sm:hidden">
                        <Button
                            variant="ghost"
                            size="icon"
                            onClick={() => setIsOpen(!isOpen)}
                            className="text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]"
                        >
                            {isOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
                        </Button>
                    </div>
                </div>
            </div>

            {/* Mobile Menu */}
            {isOpen && (
                <div className="sm:hidden bg-[#2C3E2C] border-t border-[#3A4A3A]">
                    <div className="pt-2 pb-3 space-y-1">
                        {navLinks.map((link) => (
                            <Link
                                key={link.href}
                                href={link.href}
                                className={cn(
                                    "block px-4 py-2 text-base font-medium transition-colors",
                                    link.active
                                        ? "text-[#FDFBF7] bg-[#3A4A3A]"
                                        : "text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50"
                                )}
                                onClick={() => setIsOpen(false)}
                            >
                                {link.label}
                            </Link>
                        ))}
                    </div>
                    <div className="pt-4 pb-4 border-t border-[#3A4A3A]">
                        <div className="px-4">
                            <div className="font-medium text-base text-[#FDFBF7]">{user.name}</div>
                            <div className="font-medium text-sm text-[#B5C4B5]">{user.email}</div>
                        </div>
                        <div className="mt-3 space-y-1">
                            <Link
                                href="/dashboard/profile"
                                className="block px-4 py-2 text-base font-medium text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50 transition-colors"
                                onClick={() => setIsOpen(false)}
                            >
                                Profile
                            </Link>
                            <button
                                onClick={() => logout()}
                                className="w-full text-left block px-4 py-2 text-base font-medium text-[#B5C4B5] hover:text-[#FDFBF7] hover:bg-[#3A4A3A]/50 transition-colors"
                            >
                                Log Out
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </nav>
    );
}
