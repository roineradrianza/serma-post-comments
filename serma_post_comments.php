<?php
/**
 * Plugin Name:       Ser Madre Custom Post Comments
 * Description:       Comentarios personalizados para los artículos de Ser Madre
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            Ser Madre
 * Author URI:        https://sermadre.com/
 * Developer:         Roiner Adrianza
 * License:           GPL v2 or later
 */

//Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('SERMA_POST_COMMENTS_FILE', __FILE__);
define('SERMA_POST_COMMENTS', dirname(SERMA_POST_COMMENTS_FILE));
define('SERMA_POST_COMMENTS_URL', plugin_dir_url(SERMA_POST_COMMENTS_FILE));
define('SERMA_POST_COMMENTS_VERSION', '1.0.0');

require_once SERMA_POST_COMMENTS . '/controller/main.php';

require_once SERMA_POST_COMMENTS . '/shortcodes/shortcodes.php';