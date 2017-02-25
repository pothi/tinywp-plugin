#!/bin/bash

# combines the following scripts
cat \
    ../../../../../wp-includes/js/jquery/jquery.js \
    ../../../../..//wp-includes/js/jquery/jquery-migrate.min.js \
    > main.js

echo 'var twentyseventeenScreenReaderText = {"quote":"<svg class=\"icon icon-quote-right\" aria-hidden=\"true\" role=\"img\"> <use href=\"#icon-quote-right\" xlink:href=\"#icon-quote-right\"><\/use> <\/svg>","expand":"Expand child menu","collapse":"Collapse child menu","icon":"<svg class=\"icon icon-angle-down\" aria-hidden=\"true\" role=\"img\"> <use href=\"#icon-angle-down\" xlink:href=\"#icon-angle-down\"><\/use> <span class=\"svg-fallback icon-angle-down\"><\/span><\/svg>"};' >> main.js

echo 'var _wpcf7 = {"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};' >> main.js

cat \
    ../../../../../wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js \
    ../../../../../wp-content/plugins/contact-form-7/includes/js/scripts.js \
    ../../../../../wp-content/plugins/prismatic/lib/highlight/js/highlight-core.js \
    ../../../../../wp-content/themes/twentyseventeen/assets/js/skip-link-focus-fix.js \
    ../../../../../wp-content/themes/twentyseventeen/assets/js/navigation.js \
    ../../../../../wp-content/themes/twentyseventeen/assets/js/global.js \
    ../../../../../wp-content/themes/twentyseventeen/assets/js/jquery.scrollTo.js \
    >> main.js

echo 'hljs.initHighlightingOnLoad();' >> main.js
