<?php

/**
 * Ser Madre Users Controller
 *
 * SerMadre Users Handler
 *
 * @version 1.0
 */

class SERMA_POST_COMMENTS_USER
{

    public static function init()
    {
    }

    public static function get_current_user($id = '')
    {
        $user = array(
            'id' => 0
        );

        $current_user = (!empty($id)) ? get_userdata($id) : wp_get_current_user();

        $avatar_url = '';

        if (!empty($current_user->ID) and 0 != $current_user->ID) {
            $user_meta = get_userdata($current_user->ID);
            $user = array(
                'id' => $current_user->ID,
                'user_login' => $current_user->user_login,
                'email' => $current_user->data->user_email,
                'first_name' => get_user_meta( $current_user->ID, 'first_name', true ),
                'last_name' => get_user_meta( $current_user->ID, 'last_name', true ),
                'agreement_form' => json_decode(get_user_meta( $current_user->ID, 'agreement_form', true )),
                'roles' => $user_meta->roles,
            );
        }

        return $user;
    }
}