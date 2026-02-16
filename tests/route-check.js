// tests/route-check.js
const http = require('http');

const routes = [
    '/',
    '/login',
    '/register',
    '/dashboard', // Should redirect to login if unauth, or 200 if auth (mocking might be needed for simple check)
    // We check purely for availability (not 404)
];

const checkRoute = (path) => {
    return new Promise((resolve) => {
        const req = http.get(`http://localhost:3000${path}`, (res) => {
            console.log(`[${res.statusCode}] ${path}`);
            resolve(res.statusCode);
        });
        req.on('error', (e) => {
            console.error(`[ERROR] ${path}: ${e.message}`);
            resolve(500);
        });
    });
};

const run = async () => {
    console.log('Checking Route Availability...');
    for (const route of routes) {
        await checkRoute(route);
    }
    console.log('Done.');
};

run();
