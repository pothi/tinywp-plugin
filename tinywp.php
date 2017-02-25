<?php
/*
 * Plugin Name: Tiny WordPress Optimizer
 * Version: 1.0.2
 * Author: Pothi Kalimuthu
 * Author URI: https://www.tinywp.in
 * Plugin URI: https://www.github.com/pothi
 * Description: Tiny optimizer for tinywp.in
 */

/*
 * Changelog
 * 1.0.2
 * - date: 2017-Feb-25
 * - we no longer needs parent themes CSS as it is overridden by child theme's
 * 1.0.1
 *  - disabled hightlight-prismatic-core javascript that is already included in main.min.js
 *  - included the inline script belongs to highlight-prismatic
 */

defined( 'ABSPATH' ) or exit( 'No script kiddies, please!' );

add_action('wp_head','tinywp_head');
add_action( 'wp_footer', 'tinywp_dequeue_footer_scripts' );
// make sure the following has highest possible priority
add_action( 'wp_enqueue_scripts', 'tinywp_dequeue_header_scripts', 30 );

// let's load helper (script) functions and critical css in the head
function tinywp_head() {
    // critical css
    $ccss = "<style>" . file_get_contents(plugin_dir_path( __FILE__ ) . '/assets/css/ccss.min.css') . "</style>";

    $mtime = filemtime(plugin_dir_path( __FILE__ ) . '/assets/css/main.min.css');
    $maincss_url = plugin_dir_url( __FILE__ ) . "assets/css/main.min.$mtime.css";
    $maincss = "<link rel='preload' href='$maincss_url' as='style' onload=\"this.rel='stylesheet'\" />
                <noscript><link rel='stylesheet' id='main-style-css'  href='$maincss_url' type='text/css' media='all' /></noscript>";

    $fontcss_url = "https://fonts.googleapis.com/css?family=Libre+Franklin%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C800%2C800i&#038;subset=latin%2Clatin-ext";
    $fontcss = "<link rel='preload' href='$fontcss_url' as='style' onload=\"this.rel='stylesheet'\" />
                    <noscript><link rel='stylesheet' id='twentyseventeen-fonts-css'  href='https://fonts.googleapis.com/css?family=Libre+Franklin%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C800%2C800i&#038;subset=latin%2Clatin-ext' type='text/css' media='all' /></noscript>";

    // load helper scripts
    // loadCSS, csspreloadpolyfill, font
    // $cjs = file_get_contents(plugin_dir_path( __FILE__ ) . '/assets/js/fontfaceobserver-2.0.8/fontfaceobserver.standalone.js');
    $cjs = file_get_contents(plugin_dir_path( __FILE__ ) . '/assets/js/helper.js');

    // todo: collect the fonts in an array
    // and iterate through the array
    // to check if each is loaded by the browser
        // var tinyfontB = new FontFaceObserver("octicons");
        // Promise.all([tinyfontA.load(null, 15000), tinyfontB.load(null, 15000)]).then(function () {
        // the following works too
        // document.documentElement.classList.add("webfonts-loaded");
    $cjs .= '
        var tinyfontA = new FontFaceObserver("Libre Franklin");
        
        Promise.all([tinyfontA.load(null, 15000)]).then(function () {
            document.documentElement.className += " webfonts-loaded";
        }, function () {
            console.info("Web font could not be loaded in time. Falling back to system fonts.");
        });
    '; // end of cjs

    if( ! is_user_logged_in() ) {
        echo $ccss;
        echo $maincss;
        echo $fontcss;
        echo "<script>document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );</script>";
        echo "<script async type='text/javascript'>$cjs</script>";

    }
}

function tinywp_dequeue_footer_scripts() {
    $tinywp_handles = [
        'twentyseventeen-skip-link-focus-fix'
        , 'twentyseventeen-navigation'
        , 'twentyseventeen-global'
        , 'jquery-scrollto'
        , 'wp-embed'
    ];

    if( ! is_user_logged_in() ) {
        $mtime = filemtime(plugin_dir_path( __FILE__ ) . '/assets/js/main.min.js');
        $alljs_url = plugin_dir_url( __FILE__ ) . "assets/js/main.min.$mtime.js";
        $alljs = "<script async type='text/javascript' src='$alljs_url'></script>";
        // $alljs .= "<script>jQuery('input[type=url]').blur(function (){ var input = jQuery(this); var val = input.val(); if (val && !val.match(/^http([s]?):\/\/.*/)) { input.val('http://' + val); } });</script>";
        echo $alljs;

        foreach( $tinywp_handles as $handle )
            wp_dequeue_script( $handle );
    }
}

function tinywp_dequeue_header_scripts() {
    $tinywp_handles = [
        'jquery-migrate'
        , 'jquery-core',
        'prismatic-highlight'
    ];

    if( ! is_user_logged_in() ) {
        // dequeue parent styles and fonts
        // https://wordimpress.com/removing-styles-scripts-from-your-wordpress-parent-theme/
        wp_dequeue_style('twentyseventeen-style');
        wp_deregister_style('twentyseventeen-style');

        wp_dequeue_style('twentyseventeen-fonts');
        wp_deregister_style('twentyseventeen-fonts');

        wp_deregister_style('contact-form-7');
        wp_deregister_style('prismatic-highlight');

        foreach( $tinywp_handles as $handle ) {
            wp_dequeue_script( $handle );
            wp_deregister_script( $handle );
        }
    }
}
