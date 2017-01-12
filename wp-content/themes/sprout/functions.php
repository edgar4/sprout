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

function ga_reports_enqueue()
{
    wp_enqueue_style('datatable-css', '//cdn.datatables.net/1.10.3/css/jquery.dataTables.css');
    wp_enqueue_script('datatable-jquery', '//code.jquery.com/jquery-1.11.1.min.js');
    wp_enqueue_script('datatable-js', '//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js');
    wp_enqueue_script('student-js',get_template_directory_uri(). '/js/student.js',false,'1.0.1');

}

add_action('admin_enqueue_scripts', 'ga_reports_enqueue');


add_action('admin_menu', 'ga_report_menu');
function ga_report_menu()
{
    add_menu_page('GA Reports', 'GA Reports', 'administrator', 'ga-reports', 'ga_reports_page', 'dashicons-admin-generic');
}

function ga_reports_page()
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
          jQuery('.button_quote').click(function(){

              alert('clikced');

          });
      });
  </script>
        <h1 class="wp-heading-inline">Student</h1>
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
                <?php echo  get_students()?>

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
    $results = $wpdb->get_results("SELECT * FROM " . $table_name , OBJECT);
    foreach ($results as $result) {

        $url = site_url() . "/wp-admin/admin.php?page=student_details&id=" . $result->id;
        $url_delete = site_url() . "/wp-admin/admin.php?page=student_details&id=" . $result->id;
        $html .= "<tr>
					<td><a href='" . $url . "'>" . $result->image . "</a></td>
					<td>" . $result->name . "</td>
					<td>" . $result->class .  "</td>
					 <td>" . $result->school. "</td>
					<td><a href='" . $url . "'> Edit</a></td>
					<td><a href='" . $url_delete . "'> X </a></td>
                  

				</tr>";


    }

    echo $html;

    exit;

}
