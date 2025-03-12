const express = require('express');
const cors = require('cors');
const nodemailer = require('nodemailer');
require('dotenv').config();

const app = express();

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// Email transporter configuration
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: process.env.EMAIL_USER,
        pass: process.env.EMAIL_PASS
    }
});

// Contact form endpoint
app.post('/api/contact', async (req, res) => {
    try {
        const { name, email, subject, message } = req.body;

        // Email content
        const mailOptions = {
            from: process.env.EMAIL_USER,
            to: process.env.EMAIL_USER, // Send to the same email address
            subject: `New Contact Form Submission: ${subject}`,
            html: `
                <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> ${name}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Subject:</strong> ${subject}</p>
                <p><strong>Message:</strong></p>
                <p>${message}</p>
            `
        };

        // Send email
        await transporter.sendMail(mailOptions);

        res.status(200).json({ message: 'Message sent successfully!' });
    } catch (error) {
        console.error('Error sending message:', error);
        res.status(500).json({ message: 'Error sending message. Please try again.' });
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
}); 