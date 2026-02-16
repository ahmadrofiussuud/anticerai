const { test, expect } = require('@playwright/test');

test.describe('Authentication Parity', () => {
    test('should allow user to log in and redirect to home', async ({ page }) => {
        // 1. Navigate to Login Page
        await page.goto('/login');

        // 2. Check title or heading
        await expect(page.locator('h1')).toContainText('Welcome Back');

        // 3. Fill Login Form
        await page.fill('input[name="email"]', 'husband@example.com');
        await page.fill('input[name="password"]', 'password');

        // 4. Click Submit
        await page.click('button:has-text("Log in")');

        // 5. Expect redirect to Home
        await expect(page).toHaveURL(/.*\/home/);
    });

    test('should redirect unauthenticated user to login', async ({ page }) => {
        // Clear cookies to ensure unauthenticated
        await page.context().clearCookies();

        await page.goto('/home');
        await expect(page).toHaveURL(/.*\/login/);
    });
});
