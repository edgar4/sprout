<?php
function custom_registration_function()
{
    if (isset($_POST['submit'])) {
        registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['email'],
            $_POST['school'],
            $_POST['fname'],
            $_POST['lname'],
            $_POST['nickname'],
            $_POST['bio']
        );

// sanitize user form input
        global $username, $password, $email, $school, $first_name, $last_name, $nickname, $bio;
        $username = sanitize_user($_POST['username']);
        $password = esc_attr($_POST['password']);
        $email = sanitize_email($_POST['email']);
        $school = esc_url($_POST['school']);
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        $nickname = sanitize_text_field($_POST['nickname']);
        $bio = esc_textarea($_POST['bio']);

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
            $bio
        );
    }

    registration_form(
        $username,
        $password,
        $email,
        $school,
        $first_name,
        $last_name,
        $nickname,
        $bio
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

function registration_form($username, $password, $email, $school, $first_name, $last_name, $nickname, $bio)
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
<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
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
        <label for="school">school</label>
        <select type="text" name="school" class="form-control">
        
        ' . school_options() . '
        </select>
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
        <label for="nickname">Nickname</label>
        <input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '" class="form-control">
    </div>

    <div>
        <label for="bio">About / Bio</label>
        <textarea name="bio" class="form-control">' . (isset($_POST['bio']) ? $bio : null) . '</textarea>
    </div>
    <input type="submit" name="submit" value="Register"/>
</form>
';
}

function registration_validation($username, $password, $email, $school, $first_name, $last_name, $nickname, $bio)
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

    global $reg_errors, $username, $password, $email, $school, $first_name, $last_name, $nickname, $bio;
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
        );
        $user = wp_insert_user($userdata);
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
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