document.addEventListener('DOMContentLoaded', function () {
    const upgradeModal = document.getElementById('upgrade-account-modal');
    const openModalBtn = document.getElementById('open-upgrade-modal');
    const closeModalBtn = document.getElementById('close-upgrade-modal');
    const upgradeForm = document.getElementById('upgrade-request-form');

    // --- Selectors for the new Success Alert ---
    const successAlert = document.getElementById('success-alert-modal');
    const successAlertTitle = document.getElementById('success-alert-title');
    const successAlertMessage = document.getElementById('success-alert-message');
    const closeSuccessAlertBtn = document.getElementById('close-success-alert');

    if (!upgradeModal || !openModalBtn || !closeModalBtn || !upgradeForm || !successAlert) {
        return; 
    }

    const showUpgradeModal = () => upgradeModal.classList.remove('hidden');
    const hideUpgradeModal = () => upgradeModal.classList.add('hidden');

    // --- Functions to control the Success Alert ---
    const showSuccessAlert = (message) => {
        successAlertTitle.textContent = 'تم الإرسال بنجاح';
        successAlertMessage.textContent = message;
        successAlert.classList.remove('hidden');
        // Trigger the animation
        setTimeout(() => {
            successAlert.querySelector('.transform').classList.remove('scale-95', 'opacity-0');
        }, 10);
    };
    const hideSuccessAlert = () => {
        successAlert.querySelector('.transform').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            successAlert.classList.add('hidden');
        }, 300); // Match the transition duration
    };

    // Event listeners
    openModalBtn.addEventListener('click', showUpgradeModal);
    closeModalBtn.addEventListener('click', hideUpgradeModal);
    closeSuccessAlertBtn.addEventListener('click', hideSuccessAlert);

    upgradeModal.addEventListener('click', (event) => {
        if (event.target === upgradeModal) hideUpgradeModal();
    });
     successAlert.addEventListener('click', (event) => {
        if (event.target === successAlert) hideSuccessAlert();
    });


    // AJAX form submission
    upgradeForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        const button = upgradeForm.querySelector('button[type="submit"]');
        const spinner = button.querySelector('.spinner');
        const buttonText = button.querySelector('.button-text');
        const errorDiv = document.getElementById('upgrade-form-error');

        button.disabled = true;
        spinner.classList.remove('hidden');
        buttonText.classList.add('hidden');
        errorDiv.classList.add('hidden');
        
        const formData = new FormData(upgradeForm);
        // We only allow upgrading to agent now, so we can hardcode it or ensure radio is set
        formData.set('requested_role', 'agent'); 

        try {
            const response = await fetch(upgradeForm.action, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': formData.get('_token') }
            });

            const data = await response.json();

            if (!response.ok) {
                errorDiv.textContent = data.message || 'An unknown error occurred.';
                errorDiv.classList.remove('hidden');
            } else {
                hideUpgradeModal();
                showSuccessAlert(data.message);
            }

        } catch (error) {
            errorDiv.textContent = 'A network error occurred. Please try again.';
            errorDiv.classList.remove('hidden');
        } finally {
            button.disabled = false;
            spinner.classList.add('hidden');
            buttonText.classList.remove('hidden');
        }
    });
});