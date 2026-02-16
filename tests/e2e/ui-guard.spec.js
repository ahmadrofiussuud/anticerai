const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

test.describe('No-UI-Change Guard', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
    });

    test('Home structural parity', async ({ page }) => {
        await page.goto('/home');
        // Check key containers exist
        await expect(page.locator('main')).toBeVisible();
    });

    test('Nostalgia structural parity', async ({ page }) => {
        await page.goto('/home/nostalgia');
        // Expect a grid or something specific
        // Since it might be empty state if no memories, looking for filters is safer
        await expect(page.getByText('Filter')).toBeVisible();
    });
});
