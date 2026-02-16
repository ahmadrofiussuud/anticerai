import { test, expect } from '@playwright/test';

const BASE_URL = 'http://localhost:3000'; // Adjust if running on a different port

test.describe('Hero Parity Lock', () => {

    test('Home Page Hero Parity', async ({ page }) => {
        await page.goto(`${BASE_URL}/home`);

        // Check for Hero Slider Container
        const heroSlider = page.locator('.relative.min-h-\\[600px\\]');
        await expect(heroSlider).toBeVisible();

        // Check for specific text from Slide 1 or 2 (since it auto-plays, we check closely)
        // We'll check for the existence of the slider content wrapper
        await expect(page.locator('text=Kurasi Kenangan')).toBeVisible({ timeout: 10000 });

        // Check for Floating Action Button
        await expect(page.locator('button:has-text("Update Energi")')).toBeAttached();
    });

    test('Date Roulette Hero Parity', async ({ page }) => {
        await page.goto(`${BASE_URL}/home/date-roulette`);

        // Title
        await expect(page.locator('text=Ciptakan')).toBeVisible();
        await expect(page.locator('text=Tak Terlupakan')).toBeVisible();

        // Buttons
        await expect(page.locator('a:has-text("Mulai Rencanakan")')).toBeVisible();
        await expect(page.locator('a:has-text("Lihat Ide")')).toBeVisible();
    });

    test('Growth Space Hero Parity', async ({ page }) => {
        await page.goto(`${BASE_URL}/home/growth-space`);

        // Heading
        await expect(page.locator('h1:has-text("Tumbuh Bersama")')).toBeVisible();

        // Button
        const startButton = page.locator('button:has-text("Mulai Belajar")');
        await expect(startButton).toBeVisible();

        // Stats
        await expect(page.locator('text=50+')).toBeVisible();
    });

    test('Bridge Page Parity', async ({ page }) => {
        await page.goto(`${BASE_URL}/home/bridge`);

        // Title
        await expect(page.locator('h1:has-text("Invisible Bridge")')).toBeVisible();

        // Subtitle
        await expect(page.locator('text=Private Encrypted Chat')).toBeVisible();

        // Input Placeholder
        await expect(page.locator('input[placeholder="Type a message..."]')).toBeVisible();

        // NVC Button
        await expect(page.locator('button:has-text("Read The NVC Communication Guide")')).toBeVisible();
    });

});
