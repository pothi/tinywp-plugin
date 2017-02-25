#!/bin/bash

# make sure you check the diff of the following
# https://future.tinywp.in/wp-content/plugins/contact-form-7/includes/css/styles.css
# diff ../../../../plugins/contact-form-7/includes/css/styles.css contact-form-7.css
# in case of differences - then...
cp ../../../../plugins/contact-form-7/includes/css/styles.css contact-form-7.css


# https://future.tinywp.in/wp-content/plugins/prismatic/lib/highlight/css/solarized-light.css
# diff ../../../../plugins/prismatic/lib/highlight/css/solarized-light.css highlight.css
# in case of differences - then...
cp ../../../../plugins/prismatic/lib/highlight/css/solarized-light.css highlight.css

cp ../../../../themes/twentyseventeen-child/style.css style-child.css

### Finally
cleancss -o main.min.css style-child.css contact-form-7.css highlight.css
