export const authConfig = {
    pages: {
        signIn: '/login',
        newUser: '/register',
    },
    callbacks: {
        authorized({ auth, request: { nextUrl } }) {
            const isLoggedIn = !!auth?.user;
            const isOnHome = nextUrl.pathname.startsWith('/home');
            const isOnAuth = nextUrl.pathname.startsWith('/login') || nextUrl.pathname.startsWith('/register');

            if (isOnHome) {
                if (isLoggedIn) return true;
                return false; // Redirect unauthenticated users to login page
            } else if (isOnAuth && isLoggedIn) {
                return Response.redirect(new URL('/home', nextUrl));
            }
            return true;
        },
    },
    providers: [], // Providers (and bcrypt) are configured in auth.js
}
