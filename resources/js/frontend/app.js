/**
 * Frontend scripts
 */

// Dark mode toggle
document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
});

// Mobile menu
const menuToggle = document.querySelector('[data-menu-toggle]');
const mobileMenu = document.getElementById('mobile-menu');

if (menuToggle && mobileMenu) {
    const setMenu = (open) => {
        mobileMenu.classList.toggle('hidden', !open);
        menuToggle.setAttribute('aria-expanded', String(open));
        menuToggle.querySelector('[data-menu-icon="open"]')?.classList.toggle('hidden', open);
        menuToggle.querySelector('[data-menu-icon="close"]')?.classList.toggle('hidden', !open);
    };

    menuToggle.addEventListener('click', () => setMenu(mobileMenu.classList.contains('hidden')));

    // Close after following an in-page link
    mobileMenu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));

    // Close when resizing to desktop
    window.matchMedia('(min-width: 768px)').addEventListener('change', (e) => e.matches && setMenu(false));
}

// Show / hide password inputs
document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    const input = button.parentElement.querySelector('input');

    button.addEventListener('click', () => {
        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        button.setAttribute('aria-pressed', String(show));
        button.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        button.querySelector('[data-icon="show"]')?.classList.toggle('hidden', show);
        button.querySelector('[data-icon="hide"]')?.classList.toggle('hidden', !show);
    });
});

// Copy-to-clipboard buttons
document.querySelectorAll('[data-copy]').forEach((button) => {
    button.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(button.dataset.copy);
            const original = button.textContent;
            button.textContent = 'Copied!';
            setTimeout(() => (button.textContent = original), 1500);
        } catch {
            // Clipboard unavailable (e.g. insecure context) — fail silently
        }
    });
});
