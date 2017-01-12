<?php


add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
add_action('wp_ajax_post_love_add_love', 'ajax_login');

function ajax_login()
{ //get the POST data and sign user on
    $data = (object )$_REQUEST;

    $info = array();
    $info['user_login'] = $data->username;
    $info['user_password'] = $data->password;
    $info['remember'] = true;
    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => strip_tags($user_signon->get_error_message(), '<strong>')));
    } else {
        wp_set_current_user($user_signon->ID);
        $user = get_userdata(get_current_user_id());
        echo json_encode(array('loggedin' => true,
            'message' => __('Login successful, redirecting...'),
            'userdata' => array(
                'name ' => $user->display_name,
                'id' => get_current_user_id(),
                'role' => implode(', ', $user->roles)


            )));
    }

    exit();
}
