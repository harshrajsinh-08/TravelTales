
# TravelTales (Yeh ek travel blog website hai)

A travel blog website hai jisme ek functional contact form hai, jo Express aur Nodemailer se chalta hai.

## Features (Kya-kya milta hai)

- Responsive design Tailwind CSS se bana hai
- Dynamic blog posts aur travel stories milengi
- Contact form hai jo email bhejta hai
- About page par team ki jankari hai
- Privacy policy page bhi hai

## Setup Instructions (Kaise setup karein)

### Prerequisites (Zaroori cheezein)

- Node.js (v14 ya usse upar)
- npm (Node Package Manager)
- Gmail account chahiye emails bhejne ke liye

### Local Development (Apne computer par kaam kaise karein)

1. Repository ko clone karo:
```bash
git clone <repository-url>
cd traveltales
```

2. Dependencies install karo:
```bash
npm install
```

3. Root directory mein `.env` file banao aur neeche wali cheezein daalo:
```
EMAIL_USER=your-gmail@gmail.com
EMAIL_PASS=your-app-specific-password
PORT=3000
```

Note: EMAIL_PASS ke liye, Google Account settings se App Password banana padega:
1. Google Account Security settings par jao
2. 2-Step Verification enable karo (agar nahi kiya hai toh)
3. "Mail" ke liye App Password banao

4. Development server chalu karo:
```bash
npm run dev
```

### Deployment to Render (Render par kaise daalein)

1. Render par naya Web Service banao
2. Apna GitHub repository connect karo
3. Yeh settings daalo:
  - Build Command: `npm install`
  - Start Command: `npm start`
4. Environment variables (EMAIL_USER, EMAIL_PASS, PORT) Render ke dashboard mein daalo
5. Service deploy karo

6. `contact.html` mein contact form ka endpoint apne Render URL se update karo:
```javascript
fetch('https://your-render-app.onrender.com/api/contact', {
  // ... rest of the code
})
```

## File Structure (Files ka arrangement)

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

## Contributing (Yogdaan kaise karein)

1. Repository fork karo
2. Nayi branch banao
3. Apne changes karo
4. Pull request bhejo

## License (License ki jankari)

MIT License hai - aap apne kaam ke liye is project ko use kar sakte ho. 