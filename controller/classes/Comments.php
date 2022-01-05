<?php

new SERMA_POST_COMMENTS();

/**
 * Ser Madre Comments Controller
 *
 * SerMadre Blog Comments Handler
 *
 * @version 1.0
 */

class SERMA_POST_COMMENTS
{

    public static $nonce;
    public static $nonce_field;

    public function __construct()
    {
        add_action('wp_ajax_serma_post_comments_create', 'SERMA_POST_COMMENTS::create');
        add_action('wp_ajax_serma_post_comments_delete', 'SERMA_POST_COMMENTS::delete');
        add_action('wp_ajax_nopriv_serma_post_comments_create', 'SERMA_POST_COMMENTS::create');
    }

    public static function create() : Mixed
    {
        $post_data = [];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $val = stripslashes($value);
                $post_data[$key] = $val;
            }
        }

        $data = empty($_POST) ? json_decode(file_get_contents("php://input"), true) : $post_data;

        if (!wp_verify_nonce($data['_wpnonce'], 'serma_form_comment')) {
            wp_send_json_error(['message' => 'Esta acción está prohíbida, intenta de nuevo', 'status' => 'error']);
        }

        $current_user = SERMA_POST_COMMENTS_USER::get_current_user();
        $full_name = !empty($current_user['id']) ? "{$current_user['first_name']} {$current_user['last_name']}" : '';

        $post_arguments = [
            'comment_approved' => is_user_logged_in() && current_user_can('administrator') ? 1 : 0,
            'comment_author' => is_user_logged_in() ? (strlen($full_name) >= 3 ? $full_name : $current_user['user_login']) : $data['serma_comment_full_name'],
            'comment_author_email' => is_user_logged_in() ? $current_user['email'] : $data['serma_comment_email'],
            'comment_content' => $data['serma_comment'],
            'comment_post_ID' => $data['serma_post_id'],
            'comment_meta' => [
                'serma_avatar' => $data['serma_avatar'],
            ],
        ];
        $result = wp_insert_comment($post_arguments);
        $message = ['message' => 'Se ha enviado el comentario correctamente', 'status' => 'success'];

        if (!$result) {
            $message = ['message' => 'Hubo un error, intenta de nuevo.', 'status' => 'error'];
        }

        $result ? wp_send_json_success($message) : wp_send_json_error($message);
    }

    public static function delete() : Mixed
    {
        $post_data = [];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $val = stripslashes($value);
                $post_data[$key] = $val;
            }
        }

        $data = empty($_POST) ? json_decode(file_get_contents("php://input"), true) : $post_data;

        if (!current_user_can('manage_options')) {
            return wp_send_json_error([
                'message' => 'No estás autorizado para ejecutar esta acción',
                'status' => 'error',
            ]);
        } else if (empty($data['comment_id'])) {
            return wp_send_json_error([
                'message' => 'Debes especificar el ID del comentario para ejecutar esta acción',
                'status' => 'error',
            ]);
        }

        $result = wp_delete_comment($data['comment_id'], true);

        $message = ['message' => 'Se ha eliminado el comentario correctamente', 'status' => 'success'];

        if (!$result) {
            $message = ['message' => 'Hubo un error, intenta de nuevo.', 'status' => 'error'];
        }

        $result ? wp_send_json_success($message) : wp_send_json_error($message);

    }

}
