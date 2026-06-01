import "dotenv/config";
import { GoogleGenerativeAI } from "@google/generative-ai";

const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);

export const AmoraService = {
    /**
     * Mode: INTERPRETER
     * Analyzes a situation/complaint and provides risk level + NVC suggestion.
     */
    async interpret(userText) {
        try {
            const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
            const prompt = `
        Role: Amora, a relationship mediator and NVC (Non-Violent Communication) expert.
        Task: Analyze the following user complaint/situation.
        
        Input: "${userText}"
        
        Output Format (JSON strictly):
        {
          "risk_level": "Low" | "Medium" | "High",
          "analysis": "Empathic interpretation of the underlying feelings and needs.",
          "suggestion": "A specific, actionable NVC-based suggestion or rephrasing."
        }
        
        Keep the analysis concise (under 20 words) and the suggestion practical.
      `;

            const result = await model.generateContent(prompt);
            const response = await result.response;
            let text = response.text();

            // Cleanup json code blocks if present
            text = text.replace(/```json/g, "").replace(/```/g, "").trim();

            return JSON.parse(text);
        } catch (error) {
            console.error("Amora Interpret Error:", error);
            return {
                risk_level: "Medium",
                analysis: "Unable to analyze completely due to connection issues, but I hear you.",
                suggestion: "Try expressing your feelings using 'I feel...' statements."
            };
        }
    },

    /**
     * Mode: SPARK
     * Generates a small, romantic/thoughtful idea.
     */
    async spark() {
        try {
            const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
            const prompt = `
        Role: Amora, a creative romance guide.
        Task: Generate a "Daily Spark" - a small, easy-to-do gesture to surprise a partner.
        
        Output Format (JSON strictly):
        {
          "icon": "coffee" | "gift" | "hug" | "chat" | "date",
          "spark_title": "Short catchy title (2-4 words)",
          "spark_text": "One sentence description of the action."
        }
      `;

            const result = await model.generateContent(prompt);
            const response = await result.response;
            let text = response.text();

            text = text.replace(/```json/g, "").replace(/```/g, "").trim();

            return JSON.parse(text);
        } catch (error) {
            console.error("Amora Spark Error:", error);
            return {
                icon: "heart",
                spark_title: "Quick Hug",
                spark_text: "Give your partner a 20-second hug right now."
            };
        }
    },

    /**
     * Mode: BRIDGE (Psychologist)
     * chatWithPsychologist
     */
    async chatWithPsychologist(userMessage, history = []) {
        console.log("AmoraService: Starting chat with message:", userMessage);
        try {
            const apiKey = process.env.GEMINI_API_KEY;
            console.log("AmoraService: API Key check:", apiKey ? "Present (Starts with " + apiKey.substring(0, 4) + ")" : "Missing");

            const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

            // Convert history to Gemini format if needed, but for now we essentially send context
            // A simple approach is to append the history to the prompt or use chat session.
            // For true ephemeral chat, we can just start a chat with history.

            const chatHistory = history.map(msg => ({
                role: msg.type === 'user' ? 'user' : 'model',
                parts: [{ text: msg.content }]
            })).filter(msg => msg.parts && msg.parts[0] && msg.parts[0].text); // robust filter

            const chat = model.startChat({
                history: [
                    {
                        role: "user",
                        parts: [{
                            text: `
                            You are "The Bridge", an AI relationship counselor and NVC (Non-Violent Communication) expert for the app "Amora".
                            Your goal is to help couples bridge their communication gaps.
                            
                            Guidelines:
                            1. Listen with empathy.
                            2. Identify feelings and needs underlying the user's message.
                            3. Use NVC structure: "When I see... I feel... because I need... Would you be willing to..."
                            4. Be gentle, neutral, and solution-oriented.
                            5. Keep responses concise (under 3-4 sentences likely).
                            6. If the user asks for "NVC Guide", explain the 4 components: Observation, Feeling, Need, Request.
                        ` }]
                    },
                    {
                        role: "model",
                        parts: [{ text: "Understood. I am Amora's Invisible Bridge, ready to help facilitate healthy communication with empathy and NVC principles." }]
                    },
                    ...chatHistory
                ]
            });

            const result = await chat.sendMessage(userMessage);
            const response = await result.response;
            return { reply: response.text() };

        } catch (error) {
            console.error("Amora Chat Error Details:", {
                message: error.message,
                stack: error.stack,
                name: error.name
            });
            return { reply: "I am having trouble connecting to the emotional spectrum right now. Please try again." };
        }
    },

    /**
     * Mode: DATE PLANNER
     * generateDateIdea
     */
    async generateDateIdea({ mood, budget, location, atmosphere }) {
        try {
            const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
            const prompt = `
                Role: Amora, a creative date planner.
                Task: Generate a unique date night idea based on these preferences:
                - Mood: ${mood}
                - Budget: ${budget}
                - Location: ${location}
                - Atmosphere: ${atmosphere}

                Output Format (JSON strictly):
                {
                    "title": "Date Title",
                    "description": "Engaging description of the date activity.",
                    "category": "${location}",
                    "budget": "${budget}",
                    "icon": "Emoji",
                    "tips": "One separate tip to make it special."
                }
            `;

            const result = await model.generateContent(prompt);
            const response = await result.response;
            let text = response.text();
            text = text.replace(/```json/g, "").replace(/```/g, "").trim();
            return JSON.parse(text);

        } catch (error) {
            console.error("Amora Date Error:", error);
            return null; // Signal to use fallback
        }
    }
};
