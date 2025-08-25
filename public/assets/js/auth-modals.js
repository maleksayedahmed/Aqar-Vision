document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-email-form');
    const signupForm = document.getElementById('signup-form');

    // --- START: NEW HELPER FUNCTIONS FOR BUTTON STATE ---
    const showSpinner = (form) => {
        const button = form.querySelector('button[type="submit"]');
        if (button) {
            button.disabled = true; // Disable the button
            button.querySelector('.spinner').classList.remove('hidden'); // Show spinner
            button.querySelector('.button-text').classList.add('hidden'); // Hide text
        }
    };

    const hideSpinner = (form) => {
        const button = form.querySelector('button[type="submit"]');
        if (button) {
            button.disabled = false; // Enable the button
            button.querySelector('.spinner').classList.add('hidden'); // Hide spinner
            button.querySelector('.button-text').classList.remove('hidden'); // Show text
        }
    };
    // --- END: NEW HELPER FUNCTIONS ---


    const handleFormSubmit = async (form, event) => {
        event.preventDefault();
        clearErrors(form);
        showSpinner(form); // <-- SHOW SPINNER ON SUBMIT

        const formData = new FormData(form);
        const action = form.action;
        const method = form.method;

        try {
            const response = await fetch(action, {
                method: method,
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422 && data.errors) {
                    displayErrors(form, data.errors);
                } else {
                    alert(data.message || 'An unexpected error occurred.');
                }
                hideSpinner(form); // <-- HIDE SPINNER ON ERROR
                return;
            }

            if (data.redirect) {
                window.location.href = data.redirect;
                // No need to hide spinner here, the page will redirect
            }

        } catch (error) {
            console.error('Submission error:', error);
            alert('A network error occurred. Please try again.');
            hideSpinner(form); // <-- HIDE SPINNER ON NETWORK ERROR
        }
    };

    const displayErrors = (form, errors) => {
        for (const field in errors) {
            const errorElement = form.querySelector(`.error-message[data-field="${field}"]`);
            if (errorElement) {
                errorElement.textContent = errors[field][0];
            }
        }
        if (errors.email && !form.querySelector(`.error-message[data-field="email"]`)) {
             const emailErrorElement = loginForm.querySelector(`.error-message[data-field="email"]`);
             if(emailErrorElement) emailErrorElement.textContent = errors.email[0];
        }
    };

    const clearErrors = (form) => {
        form.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
        });
    };

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => handleFormSubmit(loginForm, e));
    }
    if (signupForm) {
        signupForm.addEventListener('submit', (e) => handleFormSubmit(signupForm, e));
    }
});