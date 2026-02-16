import fs from 'fs';
import path from 'path';
import { v4 as uuidv4 } from 'uuid';

export const LocalFileService = {
    async upload(file) {
        const bytes = await file.arrayBuffer();
        const buffer = Buffer.from(bytes);

        const filename = `${uuidv4()}-${file.name.replace(/[^a-zA-Z0-9.-]/g, '')}`;
        const uploadDir = path.join(process.cwd(), 'public', 'uploads');

        // Ensure directory exists
        if (!fs.existsSync(uploadDir)) {
            fs.mkdirSync(uploadDir, { recursive: true });
        }

        const filepath = path.join(uploadDir, filename);
        fs.writeFileSync(filepath, buffer);

        return `/uploads/${filename}`;
    },

    async delete(url) {
        if (!url) return;
        const filename = url.split('/uploads/')[1];
        if (!filename) return;

        const filepath = path.join(process.cwd(), 'public', 'uploads', filename);
        if (fs.existsSync(filepath)) {
            fs.unlinkSync(filepath);
        }
    }
};
