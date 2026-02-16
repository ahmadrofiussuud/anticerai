const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

const routes = [
    '/home',
    '/home/nostalgia',
    '/home/bridge',
    '/home/date-roulette',
];

test.describe('Route Presence Check', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
    });

    for (const route of routes) {
        test(`should render ${route} without 404`, async ({ page }) => {
            const response = await page.goto(route);
            // 200 OK
            expect(response.status()).toBe(200);

            // Should NOT be redirected to login (if auth failed)
            // But waitForURL in loginUser handles the initial auth.
            // If session persists, it should be fine.
            // However, loginUser logs in every test which is slow but safe.

            await expect(page).toHaveURL(new RegExp(route));

            // Basic guard: body not empty
            const body = await page.locator('body');
            await expect(body).not.toBeEmpty();
        });
    }
});
