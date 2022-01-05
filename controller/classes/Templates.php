<?php

/**
 * Ser Madre Template Controller
 *
 * SerMadre Template Handler
 *
 * @version 1.0
 */

class SERMA_POST_COMMENTS_TEMPLATE
{

    public static function load_template($template_name, $serma_post_comments_vars = [])
    {
        ob_start();
        extract($serma_post_comments_vars);
        include self::locate_template($template_name, $serma_post_comments_vars);
        return apply_filters("serma_post_comments_{$template_name}", ob_get_clean(), $serma_post_comments_vars);
    }

    public static function show_template($template_name, $serma_post_comments_vars = [])
    {
        echo self::load_template($template_name, $serma_post_comments_vars);
    }

    public static function locate_template($template_name, $serma_post_comments_vars = [])
    {
        $template_name = '/views/' . $template_name . '.php';
        $template_name = apply_filters('serma_post_comments_template_name', $template_name, $serma_post_comments_vars);
        $template = apply_filters('serma_post_comments_template_file', SERMA_POST_COMMENTS, $template_name) . $template_name;

        return (locate_template($template_name)) ? locate_template($template_name) : $template;

    }
    
    public static function render_view($styles = [], $scripts = [], $template = '', $vars = [])
    {
        foreach ($styles as $style) {
            serma_post_comments_register_style($style);
        }
        foreach ($scripts as $script) {
            serma_post_comments_register_script($script);
        }
        return self::show_template($template, $vars);
    }

}
