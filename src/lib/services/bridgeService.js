import { GoogleGenerativeAI } from "@google/generative-ai";

const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);

export const BridgeService = {
    async sendMessage(message, context = "") {
        const model = genAI.getGenerativeModel({ model: "gemini-pro" });

        const systemPrompt = `
      You are an ephemeral AI assistant named "The Bridge" for a couples' app called Amora.
      Your goal is to help couples communicate better using Non-Violent Communication (NVC) principles.
      Be empathetic, neutral, and solution-oriented.
      Keep responses concise and helpful.
      Context: ${context}
    `;

        const chat = model.startChat({
            history: [
                {
                    role: "user",
                    parts: [{ text: systemPrompt }],
                },
                {
                    role: "model",
                    parts: [{ text: "Understood. I am ready to help you communicate better with your partner." }],
                },
            ],
        });

        const result = await chat.sendMessage(message);
        const response = await result.response;
        return response.text();
    }
};
