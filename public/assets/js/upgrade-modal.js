document.addEventListener('DOMContentLoaded', function () {
    const upgradeModal = document.getElementById('upgrade-account-modal');
    const openModalBtn = document.getElementById('open-upgrade-modal');
    const closeModalBtn = document.getElementById('close-upgrade-modal');
    const upgradeForm = document.getElementById('upgrade-request-form');
    const falLicenseField = document.getElementById('fal-license-field');

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
            // Reload the page after closing success modal to show updated status
            window.location.reload();
        }, 300); // Match the transition duration
    };

    // Show/hide FAL license field based on selected role
    const toggleFalLicenseField = () => {
        const selectedRole = upgradeForm.querySelector('input[name="requested_role"]:checked');
        if (falLicenseField) {
            if (selectedRole && selectedRole.value === 'agent') {
                falLicenseField.style.display = 'block';
            } else {
                falLicenseField.style.display = 'none';
            }
        }
    };

    // Show/hide agency fields
    const agencyFields = document.getElementById('agency-fields');
    const toggleAgencyFields = () => {
        const selectedRole = upgradeForm.querySelector('input[name="requested_role"]:checked');
        if (agencyFields) {
            if (selectedRole && selectedRole.value === 'agency') {
                agencyFields.classList.remove('hidden');
            } else {
                agencyFields.classList.add('hidden');
            }
        }
    };

    // Event listeners
    openModalBtn.addEventListener('click', () => {
        showUpgradeModal();
        toggleFalLicenseField(); // Show/hide field when modal opens
    toggleAgencyFields();
    });

    closeModalBtn.addEventListener('click', hideUpgradeModal);
    closeSuccessAlertBtn.addEventListener('click', hideSuccessAlert);

    upgradeModal.addEventListener('click', (event) => {
        if (event.target === upgradeModal) hideUpgradeModal();
    });
     successAlert.addEventListener('click', (event) => {
        if (event.target === successAlert) hideSuccessAlert();
    });

    // Listen for role changes
    upgradeForm.addEventListener('change', function(e) {
        if (e.target.name === 'requested_role') {
            toggleFalLicenseField();
            toggleAgencyFields();
        }
    });

    // Initialize field visibility
    toggleFalLicenseField();
    toggleAgencyFields();


    // AJAX form submission
    upgradeForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        const button = upgradeForm.querySelector('button[type="submit"]');
        const spinner = button.querySelector('.spinner');
        const buttonText = button.querySelector('.button-text');
        const errorDiv = document.getElementById('upgrade-form-error');

        // Get selected role
        const selectedRole = upgradeForm.querySelector('input[name="requested_role"]:checked');
        if (!selectedRole) {
            errorDiv.textContent = 'يرجى اختيار نوع الحساب المطلوب.';
            errorDiv.classList.remove('hidden');
            return;
        }

        button.disabled = true;
        spinner.classList.remove('hidden');
        buttonText.classList.add('hidden');
        errorDiv.classList.add('hidden');

        const formData = new FormData(upgradeForm);

        try {
            const response = await fetch(upgradeForm.action, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': formData.get('_token') }
            });

            const data = await response.json();

            if (!response.ok) {
                // If validation errors are returned, show them as a list
                if (data.errors && typeof data.errors === 'object') {
                    const ul = document.createElement('ul');
                    ul.classList.add('list-disc', 'list-inside', 'space-y-1');
                    Object.keys(data.errors).forEach(function(key) {
                        data.errors[key].forEach(function(msg) {
                            const li = document.createElement('li');
                            li.textContent = msg;
                            ul.appendChild(li);
                        });
                    });
                    errorDiv.innerHTML = '';
                    errorDiv.appendChild(ul);
                    errorDiv.classList.remove('hidden');
                } else {
                    errorDiv.textContent = data.message || 'حدث خطأ غير معروف.';
                    errorDiv.classList.remove('hidden');
                }
            } else {
                hideUpgradeModal();
                showSuccessAlert(data.message);
            }

        } catch (error) {
            errorDiv.textContent = 'حدث خطأ في الشبكة. يرجى المحاولة مرة أخرى.';
            errorDiv.classList.remove('hidden');
        } finally {
            button.disabled = false;
            spinner.classList.add('hidden');
            buttonText.classList.remove('hidden');
        }
    });
});
