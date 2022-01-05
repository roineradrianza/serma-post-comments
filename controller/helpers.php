<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly

function serma_post_comments_register_style($style, $deps = array(), $inline_css = '', $version = SERMA_POST_COMMENTS_VERSION)
{
    $default_path = SERMA_POST_COMMENTS_URL . 'assets/css/';

    wp_enqueue_style('ra-project-filter-' . $style, $default_path . $style . '.css', $deps, $version);

    if (!empty($inline_css)) wp_add_inline_style('ra-project-filter-' . $style, $inline_css);
}

function serma_post_comments_register_script($script, $deps = array(), $footer = false, $inline_scripts = '', $version = SERMA_POST_COMMENTS_VERSION)
{
    $handle = "ra-project-filter-{$script}";
    wp_enqueue_script($handle, SERMA_POST_COMMENTS_URL . 'assets/js/' . $script . '.js', $deps, $version, $footer);
    if (!empty($inline_scripts)) wp_add_inline_script($handle, $inline_scripts);
}