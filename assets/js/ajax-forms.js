/**
 * SERENITY PLANNERS - AJAX FORM CONTROLLER & TOAST NOTIFICATIONS
 * Production-ready asynchronous form handler
 */

// Toast notification helper
function showToast(message, type = 'success') {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    toast.innerHTML = `
        <div style="font-size: 1.3rem; color: ${type === 'success' ? '#10B981' : '#EF4444'};">
            <i class="fas ${icon}"></i>
        </div>
        <div style="flex-grow: 1;">
            <div style="font-weight: 700; font-size: 0.95rem; margin-bottom: 0.2rem;">
                ${type === 'success' ? 'Success' : 'Attention Required'}
            </div>
            <div style="font-size: 0.88rem; color: #CBD5E1; line-height: 1.4;">${message}</div>
        </div>
        <button style="background:transparent;border:none;color:#94A3B8;cursor:pointer;font-size:1.1rem;" onclick="this.parentElement.remove();">&times;</button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(20px)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 6000);
}

// Clear validation errors
function clearErrors(form) {
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
}

// Display validation errors
function displayErrors(form, errors) {
    clearErrors(form);
    for (const [field, errorMsg] of Object.entries(errors)) {
        const input = form.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('is-invalid');
            const feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            feedback.style.marginTop = '0.35rem';
            feedback.innerText = errorMsg;
            input.parentElement.appendChild(feedback);
        }
    }
}

// Attach AJAX submit to enquiry & contact forms
document.addEventListener('DOMContentLoaded', () => {
    // 1. Enquiry Form
    const enquiryForm = document.getElementById('enquiryForm');
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearErrors(enquiryForm);

            const submitBtn = enquiryForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting Enquiry...';
            }

            const formData = new FormData(enquiryForm);

            try {
                const response = await fetch('api/enquiry.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showToast(data.message, 'success');
                    enquiryForm.reset();
                    if (data.csrf_token) {
                        const csrfInputs = document.querySelectorAll('input[name="csrf_token"]');
                        csrfInputs.forEach(input => input.value = data.csrf_token);
                    }
                } else {
                    showToast(data.message || 'Please check your inputs and try again.', 'error');
                    if (data.errors) {
                        displayErrors(enquiryForm, data.errors);
                    }
                }
            } catch (err) {
                console.error(err);
                showToast('Unable to connect to server. Please try again.', 'error');
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            }
        });
    }

    // 2. Contact Form
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            clearErrors(contactForm);

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending Message...';
            }

            const formData = new FormData(contactForm);

            try {
                const response = await fetch('api/contact.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showToast(data.message, 'success');
                    contactForm.reset();
                    if (data.csrf_token) {
                        const csrfInputs = document.querySelectorAll('input[name="csrf_token"]');
                        csrfInputs.forEach(input => input.value = data.csrf_token);
                    }
                } else {
                    showToast(data.message || 'Please check your inputs and try again.', 'error');
                    if (data.errors) {
                        displayErrors(contactForm, data.errors);
                    }
                }
            } catch (err) {
                console.error(err);
                showToast('Unable to connect to server. Please try again.', 'error');
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            }
        });
    }
});
