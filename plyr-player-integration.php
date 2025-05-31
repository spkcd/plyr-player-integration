<?php
/**
 * Plugin Name: Plyr Player Integration
 * Description: Integrates Plyr media player for audio and video elements.
 * Version: 1.0.0
 * Author: WordPress User
 * Text Domain: plyr-player-integration
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Plyr scripts and styles.
 */
function plyr_player_integration_enqueue_scripts() {
    // Only load on frontend
    if (is_admin()) {
        return;
    }

    // Enqueue Plyr CSS from JSDelivr CDN
    wp_enqueue_style(
        'plyr-css',
        'https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.css',
        array(),
        '3.7.8'
    );
    
    // Enqueue custom CSS
    wp_enqueue_style(
        'plyr-custom-css',
        plugin_dir_url(__FILE__) . 'css/plyr-custom.css',
        array('plyr-css'),
        '1.0.0'
    );

    // Enqueue Plyr JS from JSDelivr CDN
    wp_enqueue_script(
        'plyr-js',
        'https://cdn.jsdelivr.net/npm/plyr@3.7.8/dist/plyr.min.js',
        array(),
        '3.7.8',
        true
    );

    // Add inline initialization script
    $inline_script = "
        document.addEventListener('DOMContentLoaded', function() {
            const audioElements = document.querySelectorAll('audio.plyr-audio');
            if (audioElements.length > 0) {
                audioElements.forEach(function(audio) {
                    // Remove native controls to avoid duplicate play buttons
                    audio.removeAttribute('controls');
                    
                    // Initialize with custom options to remove overlaid play button
                    new Plyr(audio, {
                        controls: [
                            'play',
                            'progress',
                            'current-time',
                            'mute',
                            'volume'
                        ],
                        displayDuration: true,
                        hideControls: false,
                        toggleInvert: false,
                        // Disable the big play button overlay
                        clickToPlay: false
                    });
                });
            }
        });
    ";
    wp_add_inline_script('plyr-js', $inline_script);
}
add_action('wp_enqueue_scripts', 'plyr_player_integration_enqueue_scripts');

/**
 * Add support for m4a file uploads.
 */
function plyr_player_integration_mime_types($mimes) {
    $mimes['m4a'] = 'audio/mp4';
    return $mimes;
}
add_filter('upload_mimes', 'plyr_player_integration_mime_types');

/**
 * Create required directories on plugin activation.
 */
function plyr_player_integration_activate() {
    // Create css directory if it doesn't exist
    $css_dir = plugin_dir_path(__FILE__) . 'css';
    if (!file_exists($css_dir)) {
        wp_mkdir_p($css_dir);
    }
}
register_activation_hook(__FILE__, 'plyr_player_integration_activate'); 