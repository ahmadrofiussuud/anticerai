export const EmailService = {
    /**
     * Send an email.
     * Currently mocks sending by logging to console (Parity with Laravel 'log' driver).
     */
    async send({ to, subject, html, text }) {
        console.log("-----------------------------------------");
        console.log(`[EmailService] Sending email to: ${to}`);
        console.log(`[EmailService] Subject: ${subject}`);
        console.log(`[EmailService] Content:`);
        console.log(text || html);
        console.log("-----------------------------------------");

        // In future, implement Nodemailer or Resend here:
        // if (process.env.MAIL_HOST) { ... }
        return true;
    }
};
