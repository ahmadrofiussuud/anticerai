import { test, expect } from '@playwright/test';
import { loginUser } from './utils/auth-helper';

test.describe('UI Parity Checks', () => {
    test.beforeEach(async ({ page }) => {
        await loginUser(page);
    });

    test('Home Page should have Hero Carousel', async ({ page }) => {
        await page.goto('/home');
        // Check for Hero Carousel container
        await expect(page.locator('h1', { hasText: 'Kurasi Kenangan' }).first()).toBeVisible({ timeout: 10000 });
        // Check for specific text from one of the slides
        await expect(page.getByText('Nostalgia Engine membantu Anda')).toBeVisible();
    });

    test('Bridge Page should have Immersive Layout', async ({ page }) => {
        await page.goto('/home/bridge');
        // Check for Hero Header present in the immersive layout
        await expect(page.locator('h1', { hasText: 'Invisible Bridge' })).toBeVisible();
        await expect(page.getByText('Private Encrypted Chat')).toBeVisible();
        // Check if ChatInterface is present
        await expect(page.getByText('Amora Bridge')).toBeVisible();
    });

    test('Date Roulette Page should have Hero Section', async ({ page }) => {
        await page.goto('/home/date-roulette');
        // Check for Hero Title
        await expect(page.locator('h1', { hasText: 'Ciptakan' })).toBeVisible();
        await expect(page.getByText('Tak Terlupakan')).toBeVisible();
        // Check for "Mulai Rencanakan" button
        await expect(page.getByText('Mulai Rencanakan')).toBeVisible();
    });

    test('Growth Space Page should have Hero Section', async ({ page }) => {
        await page.goto('/home/growth-space');
        // Check for Hero Title
        await expect(page.locator('h1', { hasText: 'Tumbuh Bersama' })).toBeVisible();
        await expect(page.getByText('Satu Langkah Tiap Waktu')).toBeVisible();
        // Check for "Mulai Belajar" button
        await expect(page.getByRole('button', { name: 'Mulai Belajar' })).toBeVisible();
    });
});
