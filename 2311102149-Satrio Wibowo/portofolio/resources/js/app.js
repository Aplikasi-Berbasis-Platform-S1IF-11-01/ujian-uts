import './bootstrap';
import Alpine from 'alpinejs'
import './bootstrap';

window.Alpine = Alpine
Alpine.start()
window.openMenu = (id) => document.getElementById(id)?.showModal();
window.closeMenu = (id) => document.getElementById(id)?.close();