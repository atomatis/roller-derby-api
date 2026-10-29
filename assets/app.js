/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

import './stimulus_bootstrap.js'
import './styles/app.css';

document.addEventListener("turbo:load", function() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('scroll_to')) {
        const element = document.getElementById(params.get('scroll_to'));
        if (element) element.scrollIntoView();
    }
});
