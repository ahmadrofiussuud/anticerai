const fetch = require("node-fetch");

async function testKey() {
    const key = "AIzaSyAOckDxNEVi5THGJPtc63oB1jOGxb4RYqE";
    const url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=${key}`;
    
    console.log("Testing Gemini API Key directly...");
    
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                contents: [{
                    parts: [{ text: "Hello, reply with one word." }]
                }]
            })
        });
        
        const data = await response.json();
        console.log("Response Status:", response.status);
        console.log("Response Data:", JSON.stringify(data, null, 2));
    } catch (e) {
        console.error("Test failed with error:", e);
    }
}

testKey();
