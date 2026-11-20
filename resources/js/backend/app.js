/**
 * Backend admin scripts
 */

// Dark mode toggle
document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
});

// Mobile sidebar drawer
const sidebar = document.getElementById('admin-sidebar');
const backdrop = document.getElementById('sidebar-backdrop');
const sidebarToggle = document.querySelector('[data-sidebar-toggle]');

if (sidebar && backdrop && sidebarToggle) {
    const setSidebar = (open) => {
        sidebar.classList.toggle('-translate-x-full', !open);
        backdrop.classList.toggle('hidden', !open);
        sidebarToggle.setAttribute('aria-expanded', String(open));
    };

    sidebarToggle.addEventListener('click', () => {
        setSidebar(sidebar.classList.contains('-translate-x-full'));
    });

    document.querySelectorAll('[data-sidebar-close]').forEach((el) => {
        el.addEventListener('click', () => setSidebar(false));
    });

    window.matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches) setSidebar(false);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setSidebar(false);
    });
}

// Dropdown menus
document.querySelectorAll('[data-dropdown]').forEach((dropdown) => {
    const toggle = dropdown.querySelector('[data-dropdown-toggle]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');

    if (!toggle || !menu) return;

    const setOpen = (open) => {
        menu.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
    };

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        setOpen(menu.classList.contains('hidden'));
    });

    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) setOpen(false);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setOpen(false);
    });
});

// Cmd/Ctrl + K focuses admin search
const searchInput = document.querySelector('[data-admin-search]');
if (searchInput) {
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }
    });
}
