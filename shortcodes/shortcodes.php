<?php

new SERMA_POST_COMMENTS_SHORTCODES();

class SERMA_POST_COMMENTS_SHORTCODES
{

    public function __construct()
    {
        add_shortcode('serma_post_comments_form', array($this, 'comment_form'));
    }

    public function comment_form()
    {
        SERMA_POST_COMMENTS::$nonce = wp_create_nonce('serma_form_comment');
        SERMA_POST_COMMENTS::$nonce_field = wp_nonce_field('serma_form_comment');
        add_action('wp_enqueue_scripts', $this->serma_post_comments_enqueue_ss());
        echo SERMA_POST_COMMENTS_TEMPLATE::render_view(['main'], ['comments'], 'layout/comments', 
            ['comments' => get_comments(
                [
                    'post_id' => get_the_ID(),
                    'status' => 'approve',
                ]
            ),
        ]);
    }

    public function serma_post_comments_enqueue_ss()
    {
        $v = (WP_DEBUG) ? time() : SERMA_POST_COMMENTS_VERSION;
        $assets = SERMA_POST_COMMENTS_URL . 'assets';

        wp_enqueue_script('serma-tailwind-css', "https://cdn.tailwindcss.com");
        return true;
    }

}
