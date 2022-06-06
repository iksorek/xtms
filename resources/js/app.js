require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('data', () => ({
    dark: window.localStorage.getItem('dark') ? window.localStorage.getItem('dark') : false,
    toggleTheme() {
        this.dark = !this.dark
        window.localStorage.setItem('dark', this.dark);
        console.log(this.dark);

    },
    isSideMenuOpen: false,
    toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
        this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
        this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
        this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
        this.isProfileMenuOpen = !this.isProfileMenuOpen;
        console.log(this.isProfileMenuOpen);
    },
    closeProfileMenu() {
        this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
        this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
        this.isModalOpen = true
        this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
        this.isModalOpen = false
        this.trapCleanup()
    },

}));

Alpine.start();
