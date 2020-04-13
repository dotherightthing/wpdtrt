/*
 * UI manipulation for WPDTRT parent theme
 */

/* eslint-env browser */
/* globals jQuery */

/**
 * @namespace wpdtrtUi
 */

const wpdtrtUi = {

    /**
     * Make :focus state render on touch
     *
     * @see http://stackoverflow.com/a/28771425
     */
    touch_focus: () => {
        document.addEventListener('touchstart', () => {}, false);
    }
};

jQuery(document).ready(() => {
    wpdtrtUi.touch_focus();
});
