import './bootstrap';
import jQuery from 'jquery';
import { popper } from '@popperjs/core';
window.$ = jQuery;
window.Popper = popper;
import 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
