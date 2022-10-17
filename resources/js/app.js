import PerfectScrollbar from 'perfect-scrollbar';
window.PerfectScrollbar = PerfectScrollbar;
import Swal from 'sweetalert2';
window.Swal = Swal;

require('./bootstrap');
require('./custom');


import NProgress from 'nprogress'

NProgress.configure({ showSpinner: false });

document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('message.sent', (message, component) => {
        NProgress.start();
    })

    Livewire.hook('message.processed', (message, component) => {
        NProgress.done();
    })
});
