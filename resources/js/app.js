import './bootstrap';
import '../css/app.scss'
import toastr from 'toastr';
window.toastr = toastr
window.toastr.options = {
    "progressBar": true
};
import.meta.glob([
    '../images/**',
    '../fonts/**',
    '../sass/**',
]);
