<?php
add_action('wp_ajax_nopriv_custom_registration_function', 'custom_registration_function');
add_action('wp_ajax_custom_registration_function', 'custom_registration_function');
function custom_registration_function()
{
    $request = (object)$_REQUEST;
    global $username, $password, $email, $school, $first_name, $last_name, $nickname, $bio, $roles;
    if (isset($request->username)) {
        registration_validation(
            $request->username,
            $request->password,
            $request->email,
            'http://sprout-ke.co.ke',
            $request->fname,
            $request->lname,
            $request->nickname,
            $request->bio,
            $request->roles
        );

// sanitize user form input

        $username = sanitize_user($_POST['username']);
        $password = esc_attr($_POST['password']);
        $email = sanitize_email($_POST['email']);
        $school = sanitize_text_field($_POST['school']);
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        $nickname = sanitize_text_field($_POST['nickname']);
        $bio = esc_textarea($_POST['bio']);
        $roles = sanitize_text_field($_POST['roles']);

// call @function complete_registration to create the user
// only when no WP_error is found

        complete_registration(
            $username,
            $password,
            $email,
            $school,
            $first_name,
            $last_name,
            $nickname,
            $bio,
            $roles
        );

        exit;
    }

    registration_form(
        $username,
        $password,
        $email,
        $school,
        $first_name,
        $last_name,
        $nickname,
        $bio,
        $roles
    );
}

function school_options()
{

    global $wpdb;
    $results = $wpdb->get_results('SELECT * FROM schools ', OBJECT);
    $options = '';
    foreach ($results as $school) {
        $options .= '<option value="' . $school->id . '"> ' . $school->school_name . '</option>';

    }
    return $options;

}

function show_roles()
{
    global $wp_roles;

    $html = '<select name="roles" class="form-control">';
    foreach ($wp_roles->roles as $key => $value) {
        if ($key == 'parent' || $key == 'school_admin' || $key == 'teacher') {
            $html .= '<option value="' . $key . '">' . $value['name'] . '</option>';
        }

    }

    $html .= '</select>';

    return $html;
}

function registration_form($username, $password, $email, $school, $first_name, $last_name, $nickname, $bio, $roles)
{
    echo '
<style>
    div {
        margin-bottom:2px;
    }

    input{
        margin-bottom:4px;
    }
</style>
';

    echo '
<form action="" method="post" id="teacher-form">
    <div class="controls">
        <label for="username">Username <strong>*</strong></label>
        <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '" class="form-control">
    </div class="controls">

    <div class="controls">
        <label for="password">Password <strong>*</strong></label>
        <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '" class="form-control">
    </div>

    <div class="controls">
        <label for="email">Email <strong>*</strong></label>
        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '" class="form-control">
    </div>

    <div class="controls">

    </div class="controls">

    <div class="controls">
        <label for="firstname">First Name</label>
        <input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '" class="form-control">
    </div>

    <div class="controls">
        <label for="school">Last Name</label>
        <input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '" class="form-control">
    </div>

    <div class="controls">
        <label for="firstname">Choose Roles </label>
        ' . show_roles() . '
    </div>
    <div class="controls">
        <label for="nickname">Nickname</label>
        <input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '" class="form-control">
    </div>

    <div>
        <label for="bio">About / Bio</label>
        <textarea name="bio" class="form-control">' . (isset($_POST['bio']) ? $bio : null) . '</textarea>
    </div>
    <input type="submit" name="submit" id="fucking-submit" value="Register"/>
</form>
';
}

function registration_validation($username, $password, $email, $school, $first_name, $last_name, $nickname, $bio, $roles)
{
    global $reg_errors;
    $reg_errors = new WP_Error;

    if (empty($username) || empty($password) || empty($email)) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if (strlen($username) < 4) {
        $reg_errors->add('username_length', 'Username too short. At least 4 characters is required');
    }

    if (username_exists($username))
        $reg_errors->add('user_name', 'Sorry, that username already exists!');

    if (!validate_username($username)) {
        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
    }

    if (strlen($password) < 5) {
        $reg_errors->add('password', 'Password length must be greater than 5');
    }

    if (!is_email($email)) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if (email_exists($email)) {
        $reg_errors->add('email', 'Email Already in use');
    }

    if (!empty($school)) {
        if (!filter_var($school, FILTER_VALIDATE_URL)) {
            $reg_errors->add('school', 'school is not a valid URL');
        }
    }

    if (is_wp_error($reg_errors)) {

        foreach ($reg_errors->get_error_messages() as $error) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration()
{

    global $reg_errors, $username, $password, $email, $school, $first_name, $last_name, $nickname, $bio, $roles;
    if (count($reg_errors->get_error_messages()) < 1) {
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,
            'user_url' => $school,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'nickname' => $nickname,
            'description' => $bio,
            'role' => $roles
        );
        $user_id = wp_insert_user($userdata);
        update_user_meta($user_id, 'school', get_user_meta(wp_get_current_user()->ID, 'school', true));

        $to = $email;
        $subject = "Sprout Registration";
        $message = '<p> Welcome to Sprout</p>';
        $message .= '<p>Your username ' . $username . '</p>';
        $message .= '<p>Your Login ' . $password . '</p>';

        wp_mail($to, $subject, $message);
        echo json_encode(array('msg' => 'success'));
    }
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode()
{
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}

add_action('user_register', 'myplugin_user_register');
function set_roles($user_id)
{
    if (wp_get_current_user()->roles[0] == 'school_admin') {
        $roles = 'teacher';
    } else {
        $roles = 'school_admin';
    }
    $user_id = wp_update_user(array('ID' => $user_id, 'role' => $roles));
}
