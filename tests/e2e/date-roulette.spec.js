const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

test.describe('Date Roulette Parity', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
        await page.goto('/home/date-roulette');
    });

    test('should render preferences', async ({ page }) => {
        await expect(page.getByText('Preferensi')).toBeVisible();
        await expect(page.getByText('Mood')).toBeVisible();
    });

    test('spin should show result', async ({ page }) => {
        const spinBtn = page.getByText('Putar Roulette');
        await spinBtn.click();

        await expect(page.getByText('Sedang Mencari...')).toBeVisible();
        // Wait for result
        await expect(page.getByText('Coba Lagi', { exact: false })).toBeVisible({ timeout: 15000 });
    });
});
