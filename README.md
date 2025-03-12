# TravelTales

A travel blog website with a functional contact form powered by Express and Nodemailer.

## Features

- Responsive design using Tailwind CSS
- Dynamic blog posts and travel stories
- Contact form with email notifications
- About page with team information
- Privacy policy page

## Setup Instructions

### Prerequisites

- Node.js (v14 or higher)
- npm (Node Package Manager)
- Gmail account for sending emails

### Local Development

1. Clone the repository:
```bash
git clone <repository-url>
cd traveltales
```

2. Install dependencies:
```bash
npm install
```

3. Create a `.env` file in the root directory with the following variables:
```
EMAIL_USER=your-gmail@gmail.com
EMAIL_PASS=your-app-specific-password
PORT=3000
```

Note: For EMAIL_PASS, you'll need to generate an App Password from your Google Account settings:
1. Go to Google Account Security settings
2. Enable 2-Step Verification if not already enabled
3. Generate an App Password for "Mail"

4. Start the development server:
```bash
npm run dev
```

### Deployment to Render

1. Create a new Web Service on Render
2. Connect your GitHub repository
3. Configure the following:
   - Build Command: `npm install`
   - Start Command: `npm start`
4. Add the environment variables (EMAIL_USER, EMAIL_PASS, PORT) in Render's dashboard
5. Deploy the service

6. Update the contact form endpoint in `contact.html` with your Render URL:
```javascript
fetch('https://your-render-app.onrender.com/api/contact', {
  // ... rest of the code
})
```

## File Structure

```
traveltales/
├── public/
│   ├── index.html
│   ├── about.html
│   ├── blogs.html
│   ├── contact.html
│   ├── privacy.html
│   └── profile.html
├── server.js
├── package.json
├── .env
└── README.md
```

## Contributing

1. Fork the repository
2. Create a new branch
3. Make your changes
4. Submit a pull request

## License

MIT License - feel free to use this project for your own purposes. 