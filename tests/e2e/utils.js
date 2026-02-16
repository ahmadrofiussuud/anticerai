const { expect } = require('@playwright/test');

async function loginUser(page) {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'husband@example.com');
    await page.fill('input[name="password"]', 'password');
    // Click button that contains text "Log in" or submit button
    await page.click('button:has-text("Log in")');
    // Wait for redirect to home
    await page.waitForURL('**/home', { timeout: 15000 });
}

module.exports = { loginUser };
