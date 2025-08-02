document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    const formMessage = document.getElementById('formMessage');

    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const submitButton = e.target.querySelector('button[type="submit"]');
        
        // Disable submit button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = 'Sending...';
        
        try {
            const response = await fetch('https://your-render-app.onrender.com/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: formData.get('name'),
                    email: formData.get('email'),
                    subject: formData.get('subject'),
                    message: formData.get('message')
                })
            });

            const data = await response.json();
            
            formMessage.classList.remove('hidden');
            if (response.ok) {
                formMessage.className = 'success-message';
                formMessage.textContent = 'Message sent successfully!';
                e.target.reset();
            } else {
                throw new Error(data.message || 'Something went wrong');
            }
        } catch (error) {
            formMessage.classList.remove('hidden');
            formMessage.className = 'error-message';
            formMessage.textContent = error.message;
        } finally {
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.innerHTML = 'Send Message';
        }
    });
});