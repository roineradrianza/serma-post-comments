<?php

if (!defined('ABSPATH')) exit; //Exit if accessed directly

add_action('wp_head', 'serma_post_comments_vars');

function serma_post_comments_vars()
{

    $nonces = array(
        ''
    );

    $nonces_list = array();

    foreach ($nonces as $nonce_name) {
        $nonces_list[$nonce_name] = wp_create_nonce($nonce_name);
    }

    ?>
    <script>
        let serma_post_comments_nonces = <?php echo json_encode($nonces_list); ?>;
        let serma_post_comments_avatars_url = '<?php echo SERMA_POST_COMMENTS_URL . 'assets/images/avatars/' ?>'
    </script>
    <?php
}
