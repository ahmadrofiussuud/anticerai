const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

test.describe('Home Page Parity', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
    });

    test('should display daily suggestions', async ({ page }) => {
        // Ensure page is loaded
        await expect(page.locator('h1')).not.toBeEmpty();
        await expect(page.locator('text=Morning Coffee').first()).toBeVisible();
    });

    test('feature links should be present', async ({ page }) => {
        await expect(page.getByText('Mesin Nostalgia')).toBeVisible();
        await expect(page.getByText('Invisible Bridge')).toBeVisible();
    });

    test('FAB should be visible', async ({ page }) => {
        await expect(page.locator('button:has-text("⚡")')).toBeVisible();
    });
});
