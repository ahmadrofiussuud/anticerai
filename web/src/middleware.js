import { auth } from "@/auth"

export default auth((req) => {
    // Configured in auth.js authorized callback
})

export const config = {
    // https://nextjs.org/docs/app/building-your-application/routing/middleware#matcher
    matcher: ['/((?!api|_next/static|_next/image|.*\\.png$).*)'],
};
