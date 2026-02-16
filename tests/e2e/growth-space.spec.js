const { test, expect } = require('@playwright/test');

test.describe('Growth Space Parity', () => {
    test.beforeEach(async ({ page }) => {
        await page.goto('/home/growth-space');
    });

    // P1 Feature - Skipped until implementation
    test.fixme('should open article detail panel', async ({ page }) => {
        // Click an article/video card
        await page.locator('.article-card').first().click(); // Adjust selector

        // Expect Modal/Panel
        await expect(page.locator('.detail-panel')).toBeVisible();
        await expect(page.getByText('Artikel Detail')).toBeVisible();

        // Close
        await page.locator('button.close-panel').click();
        await expect(page.locator('.detail-panel')).not.toBeVisible();
    });

    test('placeholder should be visible', async ({ page }) => {
        // Current state check
        await expect(page.locator('body')).not.toBeEmpty();
    });
});
