import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const destroyModal = document.getElementById('modal-destroy')
destroyModal.addEventListener('show.bs.modal', e => {
    const button = e.relatedTarget;
    destroyModal.querySelector('form').action = button.getAttribute('data-action');
})
