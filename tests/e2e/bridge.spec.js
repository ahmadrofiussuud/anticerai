const { test, expect } = require('@playwright/test');
const { loginUser } = require('./utils');

test.describe('Invisible Bridge Parity', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
        await page.goto('/home/bridge');
    });

    test('chat interface should render', async ({ page }) => {
        await expect(page.getByText('Amora Bridge')).toBeVisible();
        await expect(page.getByPlaceholder('Tulis apa yang kamu rasakan...')).toBeVisible();
    });

    test('sending message should show bubble', async ({ page }) => {
        const input = page.getByPlaceholder('Tulis apa yang kamu rasakan...');
        await input.fill('Tes Playwright');
        await page.locator('button[type="submit"]').click();

        await expect(page.getByText('Tes Playwright')).toBeVisible();
        await expect(page.getByText('Sedang berpikir...')).toBeVisible({ timeout: 10000 });
    });
});
