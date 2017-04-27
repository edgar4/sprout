<?php
ini_set("date.timezone", "Africa/Nairobi");
require_once 'inc/template-functions.php';


// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}


add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
add_action('wp_ajax_ajax_login', 'ajax_login');

function ajax_login()
{ //get the POST data and sign user on

    if (is_user_logged_in()):
        $user = get_userdata(get_current_user_id());
        echo json_encode(array('loggedin' => true,
            'message' => __('Login successful, redirecting...'),
            'userdata' => array(
                'name ' => $user->display_name,
                'id' => get_current_user_id(),
                'role' => implode(', ', $user->roles),
                'avatar' => get_avatar_url(get_current_user_id(), 64),
                'email' => $user->user_email,
            )));

        exit;
    else:
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
                    'name' => $user->display_name,
                    'id' => get_current_user_id(),
                    'role' => implode(',', $user->roles),
                    'avatar' => get_avatar_url(get_current_user_id(), 64),
                    'email' => $user->user_email,
                )));
        }
        exit();
    endif;


}

function ga_reports_enqueue($hook)
{
    if ('toplevel_page_sproute-students' === $hook) {
        wp_enqueue_style('datatable-css', '//cdn.datatables.net/1.10.3/css/jquery.dataTables.css');
        wp_enqueue_script('datatable-jquery', '//code.jquery.com/jquery-1.11.1.min.js');
        wp_enqueue_script('datatable-js', '//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js');
        wp_enqueue_script('student-js', get_template_directory_uri() . '/js/student.js', false, '1.0.1');
    }


}

add_action('admin_enqueue_scripts', 'ga_reports_enqueue');
add_action('admin_menu', 'ga_report_menu');
function ga_report_menu()
{
    add_menu_page('Students', 'Students', 'administrator', 'sproute-students', 'sproute_student_page', 'dashicons-admin-generic');
    add_submenu_page('sproute-students', 'Add Student', 'Add Student', 'administrator', 'add-student', 'new_student');
}

function sproute_student_page()
{ ?>

    <div class="wrap">
        <script>
            jQuery(document).ready(function () {
                console.log('table');
                jQuery('#report-datatable').dataTable({
                    "order": [[1, "desc"], [0, "desc"]],
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    "filter": false,
                    "columnDefs": [{"targets": [0, 1, 2, 3, 4, 5], "orderable": false}]
                });
                var table = jQuery('#report-datatable').DataTable();
                var column = table.column("6");
                column.visible(column.visible());
                jQuery('.button_quote').click(function () {

                    alert('clikced');

                });
            });
        </script>
        <h1 class="wp-heading-inline">Srudents</h1>
        <a href="" class="page-title-action"> Add Student</a>
        <div class="report-results">
            <table id="report-datatable" class="display table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Profile</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>School</th>
                    <th>edit</th>
                    <th>delete</th>

                </tr>
                </thead>

                <tbody id="report-results">
                <?php echo get_students() ?>

                </tbody>
            </table>
        </div>
    </div>


<?php }

function get_students()
{
    global $wpdb;
    $table_name = 'students';

    $html = '';
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " INNER JOIN schools  ON students.school = schools.id ", OBJECT);

    echo $wpdb->last_error;
    foreach ($results as $result) {

        $url = site_url() . "/wp-admin/admin.php?page=student_details&id=" . $result->id;
        $url_delete = site_url() . "/wp-admin/admin.php?page=student_details&id=" . $result->id;
        $img = '<img src="' . $result->image . '" width="50" height="50"/>';
        $html .= "<tr>
					<td><a href='" . $url . "'>" . $img . "</a></td>
					<td>" . $result->name . "</td>
					<td>" . $result->class . "</td>
					 <td>" . $result->school_name . "</td>
					<td><a href='" . $url . "'> Edit</a></td>
					<td><a href='" . $url_delete . "'> X </a></td>
                  

				</tr>";


    }

    echo $html;

    exit;


}

function new_student()
{
    ?>
    <div class="wrap">
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
            <p>
                <input name="name" id="name" value="" tabindex="1" type="text" required>
                <label for="author">
                    <small>Name (required)</small>
                </label>
            </p>

            <p>
                <input name="class" id="class" value="" tabindex="1" type="text" required>
                <label for="author">
                    <small>Class (required)</small>
                </label>
            </p>
            <p>
                <select name="school" required>
                    <option>choose School</option>
                    <?php global $wpdb;
                    $results = $wpdb->get_results("SELECT * FROM schools ", OBJECT);
                    foreach ($results as $result) {
                        echo '<option value="' . $result->id . '">' . $result->school_name . '</option>';
                    }

                    ?>
                </select>
                <label for="author">
                    <small>School (required)</small>
                </label>
            </p>

            <p>
                <input name="file" id="class" value="" tabindex="1" type="file" required>
                <label for="author">
                    <small>profile (required)</small>
                </label>
            </p>

            <p>
                <input name="submit" id="submit" tabindex="5" value="Submit" type="submit"
                       class="button button-primary button-large">
                <input type="hidden" name="action" value="do_upload"">
            </p>

        </form>
    </div>


<?php }

add_action('admin_post_do_upload', 'prefix_admin_do_upload');
add_action('admin_post_nopriv_do_upload', 'prefix_admin_do_upload');

function prefix_admin_do_upload()
{

    $request = (object)$_REQUEST;
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    if ($movefile && !isset($movefile['error'])) {
        save_upload_details($movefile, $request);
    } else {
        $message['error'] = $movefile['error'];
        var_dump($movefile['error']);
        //wp_redirect(wp_get_referer());
        echo 'error';
        exit;
    }


}

function save_upload_details($file, $request)
{
    global $wpdb;
    $fileDetails = (object)$file;
    $wpdb->show_errors();
    $table_name = 'students';
    $insert = $wpdb->insert(
        $table_name,
        array(
            'name' => $request->name,
            'school' => $request->school,
            'class' => $request->class,
            'image' => $fileDetails->url,

        ),
        array(
            '%s',
            '%d',
            '%s',
            '%s',


        )
    );
    if ($insert) {
        $message['success'] = 'Uploaded, thanks';
        //set_upload_error($message);
        //wp_redirect(wp_get_referer());
        echo 'uploaded';
        exit;
    }


}

add_action('wp_ajax_nopriv_ajax_get_students', 'ajax_get_students');
add_action('wp_ajax_ajax_get_students', 'ajax_get_students');
function ajax_get_students()
{
    global $wpdb;
    $table_name = 'students';

    $html = '';
    $results = $wpdb->get_results("SELECT students.id, students.name, students.class,students.image,schools.id AS school_id, schools.school_name , schools.school_admin  FROM 
" . $table_name . " INNER JOIN schools  ON students.school = schools.id ", OBJECT);

    echo json_encode(array('students' => $results));

    exit;


}

add_action('wp_ajax_nopriv_ajax_get_student_activity', 'ajax_get_student_activity');
add_action('wp_ajax_ajax_get_student_activity', 'ajax_get_student_activity');
function ajax_get_student_activity($isAjax = true)
{
    global $wpdb;
    $table_name = 'student_activities';
    $request = (object)$_REQUEST;
    $isAjax = $request->isAjax;
    if (isset($request->activityId) && !empty($request->activityId)) {
        $results = $wpdb->get_results("SELECT students.name ,students.class ,activities.activity_icon,schools.school_name,
                                     student_activities.activity_time, student_activities.activity_title,student_activities.activity_note,wp_users.display_name
FROM " . $table_name
            . " INNER JOIN students  ON student_activities.student_id = students.id "
            . "  INNER JOIN activities  ON student_activities.activity_id = activities.id "
            . "  INNER JOIN schools  ON students.school = schools.id "
            . "  INNER JOIN wp_users  ON student_activities.teacher_d=  wp_users.ID "
            . "WHERE students.id = " . $request->student_id . ' AND activities.id = ' . $request->activityId
            , OBJECT);

        if ($isAjax) {
            echo json_encode(array('student_activity' => $results));
            exit;
        }

        return $results;

    }
    $results = $wpdb->get_results("SELECT * FROM " . $table_name
        . "  INNER JOIN students  ON student_activities.student_id = students.id "
        . "  INNER JOIN activities  ON student_activities.activity_id = activities.id "
        . "  WHERE students.id = " . $request->student_id
        . "   ORDER BY student_activities.activity_time DESC", OBJECT);


    if ($isAjax) {
        echo json_encode(array('student_activity' => $results));
        exit;
    }

    return $results;


}


add_action('wp_ajax_nopriv_ajax_get_parent_child', 'ajax_get_parent_child');
add_action('wp_ajax_ajax_get_parent_child', 'ajax_get_parent_child');
function ajax_get_parent_child()
{
    global $wpdb;
    $table_name = 'students';
    $request = (object)$_REQUEST;

    $results = $wpdb->get_results("SELECT students.* FROM " . $table_name . "  WHERE students.parent = " . $request->parent_id, OBJECT);

    echo json_encode(array('student' => $results));

    exit;


}

add_action('wp_ajax_nopriv_ajax_get_student_profile', 'ajax_get_student_profile');
add_action('wp_ajax_ajax_get_student_profile', 'ajax_get_student_profile');
function ajax_get_student_profile($isAjax = true)
{

    global $wpdb;
    $table_name = 'students';
    $request = (object)$_REQUEST;
    $isAjax = $request->isAjax;
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE id = " . $request->student_id
        , OBJECT);

    if ($isAjax) {
        echo json_encode(array('student_profile' => $results));

        exit;
    }

    return $results;


}

add_action('wp_ajax_nopriv_ajax_add_activity', 'ajax_add_activity');
add_action('wp_ajax_ajax_add_activity', 'ajax_add_activity');
function ajax_add_activity()
{
    global $wpdb;

    $request = (object)$_REQUEST;
    $insert = $wpdb->insert('student_activities', array(
        'student_id' => $request->student_id,
        'activity_id' => $request->activity_id,
        'activity_title' => $request->activity_title,
        'activity_note' => $request->activity_note,
        'teacher_d' => $request->teacher_id,
        'activity_time' => date('Y-m-d h:i:s a'),

    ));

    if ($insert) {
        echo json_encode(array(
            'message' => 'success',
            'student_id' => $request->student_id,
        ));

        exit;
    }


    echo json_encode(array('message' => 'failed'));
    exit;


}

add_action('wp_ajax_nopriv_ajax_add_comment', 'ajax_add_comment');
add_action('wp_ajax_ajax_add_comment', 'ajax_add_comment');
function ajax_add_comment()
{
    global $wpdb;

    $request = (object)$_REQUEST;
    $insert = $wpdb->insert('comments', array(
        'student_id' => $request->student_id,
        'activity_id' => $request->activity_id,
        'comment' => $request->comment,
        'commenter_id' => $request->commenter_id,
        'activity_time' => date('Y-m-d h:i:s a'),

    ));

    if ($insert) {
        echo json_encode(array(
            'message' => 'success',
            'student_id' => $request->student_id,
            'activity_id' => $request->activity_id,
        ));

        exit;
    }


    echo json_encode(array('message' => 'failed'));
    exit;


}

add_action('wp_ajax_nopriv_ajax_get_comment', 'ajax_get_comment');
add_action('wp_ajax_ajax_get_comment', 'ajax_get_comment');

function ajax_get_comment()
{
    global $wpdb;
    $table_name = 'comments';
    $request = (object)$_REQUEST;
    $results = $wpdb->get_results("SELECT wp_users.display_name, wp_users.ID, comments.*
              FROM " . $table_name
        . "  INNER JOIN wp_users  ON comments.commenter_id =  wp_users.ID "
        . "WHERE comments.student_id = " . $request->student_id . ' AND comments.activity_id = ' . $request->activity_id
        . "   ORDER BY comments.activity_time DESC", OBJECT);
    $data = array();
    foreach ($results as $result) {
        $data[] = array('display_name' => $result->display_name,
            'activity_id' => $result->activity_id,
            'student_id' => $result->student_id,
            'avatar' => get_avatar_url($result->ID, 64),
            'comment' => $result->comment,
            'activity_time' => $result->activity_time,
            'commenter_id' => $result->commenter_id
        );


    }
    echo json_encode(array('comments' => $data));
    exit;
}


add_action('wp_ajax_nopriv_ajax_add_event', 'ajax_add_event');
add_action('wp_ajax_ajax_add_event', 'ajax_add_event');
function ajax_add_event()
{
    global $wpdb;

    $request = (object)$_REQUEST;
    $insert = $wpdb->insert('events', array(
        'title' => $request->title,
        'description' => $request->description,
        'date' => $request->startdate,
        'enddate' => $request->enddate,
        'school_id' => $request->school_id,
        'teacher_id' => $request->teacher_id,

    ));

    if ($insert) {
        echo json_encode(array(
            'message' => 'success',
        ));

        exit;
    }


    echo json_encode(array('message' => 'failed'));
    exit;


}

add_action('wp_ajax_nopriv_ajax_get_school_event', 'ajax_get_school_event');
add_action('wp_ajax_ajax_get_school_event', 'ajax_get_school_event');
function ajax_get_school_event()
{
    global $wpdb;
    $table_name = 'events';
    $request = (object)$_REQUEST;
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE school_id = " . $request->school_id
        . "   ORDER BY id  DESC", OBJECT);

    echo json_encode(array('event' => $results));

    exit;


}

add_action('wp_ajax_nopriv_ajax_set_subscription', 'ajax_set_subscription');
add_action('wp_ajax_ajax_set_subscription', 'ajax_set_subscription');
function ajax_set_subscription()
{

    global $wpdb;
    $request = (object)$_REQUEST;
    $isAjax = $request->isAjax;
    if ($isAjax) {

        $insert = $wpdb->insert('subscriptions', array(
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'start_date' => date("Y-m-d H:i:s"),
            'end_date' => date('Y-m-d', strtotime("+90 days")),
            'transaction_code' => $request->transactionCode,
            'quantity' => 1,

        ));
        
         

        if ($insert) {
            echo json_encode(array('message' => 'subscription successfully update you will recieve a confirmation email shortly'));
            wp_mail();
            exit;

        }else{
            echo json_encode(array('message' => 'subscription  not updated'));
            exit;
        }


    }


}

function prefix_send_email_to_admin() {
    $request = (object)$_REQUEST;
    var_dump($request);

}
add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );



