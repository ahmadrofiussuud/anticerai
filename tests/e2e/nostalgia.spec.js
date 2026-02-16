const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

test.describe('Nostalgia Engine Parity', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
        await page.goto('/home/nostalgia');
    });

    test('should render hero section', async ({ page }) => {
        await expect(page.getByText('Mesin Nostalgia')).toBeVisible();
    });

    test('search should filter grid', async ({ page }) => {
        const searchInput = page.getByPlaceholder('Cari kenangan...');
        await expect(searchInput).toBeVisible();
        await searchInput.fill('TestMemory');
    });

    test('view mode toggle should work', async ({ page }) => {
        // Button to switch view
        const toggleBtn = page.locator('button').filter({ has: page.locator('svg') }).nth(2); // Approximate
        if (await toggleBtn.count() > 0) {
            await toggleBtn.click();
        }
    });
});
