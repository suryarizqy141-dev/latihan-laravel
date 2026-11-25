import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-toggle-password]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.togglePassword);

            if (!input) return;

            const reveal = input.type === 'password';
            input.type = reveal ? 'text' : 'password';
            button.setAttribute('aria-pressed', String(reveal));
            button.querySelector('[data-eye]')?.classList.toggle('hidden', reveal);
            button.querySelector('[data-eye-off]')?.classList.toggle('hidden', !reveal);
        });
    });
});
