import Link from "next/link";
import { Button } from "@/components/ui/button";

export default function LandingPage() {
  return (
    <div className="min-h-screen bg-[#FDFBF7] flex flex-col items-center justify-center text-center p-4">
      <div className="max-w-3xl space-y-8">
        <h1 className="text-5xl lg:text-7xl font-serif font-bold text-[#2A3C2A] mb-6 leading-tight">
          Welcome to <span className="text-[#C67C5C]">Amora</span>
        </h1>
        <p className="text-xl text-[#6B7C6B]">
          Creating forever new beginnings.
        </p>
        <div className="flex justify-center gap-4">
          <Button asChild size="lg" className="bg-[#2C3E2C] hover:bg-[#1E291E] text-white rounded-full px-8 py-6 h-auto text-lg">
            <Link href="/login">Log in</Link>
          </Button>
          <Button asChild variant="outline" size="lg" className="border-[#2C3E2C] text-[#2C3E2C] hover:bg-[#FDFBF7] rounded-full px-8 py-6 h-auto text-lg">
            <Link href="/register">Register</Link>
          </Button>
        </div>
      </div>
    </div>
  );
}
