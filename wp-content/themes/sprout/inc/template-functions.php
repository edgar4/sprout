<?php
/**
 *







<script src="js/matrix.tables.js"></script>
 */
function assets()
{

    wp_enqueue_style('s1', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('s2', get_stylesheet_directory_uri() . '/assets/css/bootstrap-responsive.min.css');
    wp_enqueue_style('s3', get_stylesheet_directory_uri() . '/assets/css/fullcalendar.css');
    wp_enqueue_style('s4', get_stylesheet_directory_uri() . '/assets/css/matrix-style.css');
    wp_enqueue_style('s5', get_stylesheet_directory_uri() . '/assets/css/matrix-media.css');
    wp_enqueue_style('s6', get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.css');

    wp_enqueue_style('s7', get_stylesheet_directory_uri() . '/assets/css/matrix-media.css');
    wp_enqueue_style('s8', get_stylesheet_directory_uri() . '/assets/css/jquery.gritter.css');

    
    


}

add_action('wp_enqueue_scripts', 'assets');


function scripts(){

    //    wp_enqueue_script('j1', get_stylesheet_directory_uri() . '/assets/js/excanvas.min.js', array('j1'));
    wp_enqueue_script('j2', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array('j2'));
    wp_enqueue_script('j3', get_stylesheet_directory_uri() . '/assets/js/jquery.ui.custom.js', array('j3'));
    wp_enqueue_script('j4', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('j4'));
//    wp_enqueue_script('j5', get_stylesheet_directory_uri() . '/assets/js/jquery.flot.min.js', array('j5'));
//    wp_enqueue_script('j6', get_stylesheet_directory_uri() . '/assets/js/jquery.flot.resize.min.jss', array('j6'));
//    wp_enqueue_script('j7', get_stylesheet_directory_uri() . '/assets/js/jquery.peity.min.js', array('j7'));
    wp_enqueue_script('j8', get_stylesheet_directory_uri() . '/assets/js/fullcalendar.min.js', array('j8'));
    wp_enqueue_script('j9', get_stylesheet_directory_uri() . '/assets/js/matrix.js', array('j1'));
    wp_enqueue_script('j10', get_stylesheet_directory_uri() . '/assets/js/matrix.dashboard.js', array('j9'));
//    wp_enqueue_script('j11', get_stylesheet_directory_uri() . '/assets/js/jquery.gritter.min.js', array('j10'));
//    wp_enqueue_script('j12', get_stylesheet_directory_uri() . '/assets/js/matrix.interface.js', array('j11'));
//    wp_enqueue_script('j13', get_stylesheet_directory_uri() . '/assets/js/matrix.chat.js', array('j12'));

    wp_enqueue_script('j14', get_stylesheet_directory_uri() . '/assets/js/jquery.validate.js', array('j7'));
    wp_enqueue_script('j15', get_stylesheet_directory_uri() . '/assets/js/matrix.form_validation.js', array('j8'));
    wp_enqueue_script('j16', get_stylesheet_directory_uri() . '/assets/js/jquery.uniform.js', array('j1'));
    wp_enqueue_script('j17', get_stylesheet_directory_uri() . '/assets/js/select2.min.js', array('j9'));
    wp_enqueue_script('j18', get_stylesheet_directory_uri() . '/assets/js/matrix.popover.js', array('j10'));
    wp_enqueue_script('j19', get_stylesheet_directory_uri() . '/assets/js/jquery.dataTables.min.js', array('j11'));
    wp_enqueue_script('j20', get_stylesheet_directory_uri() . '/assets/js/matrix.tables.js', array('j12'));
}

//add_action('wp_footer', 'scripts');


function redirect_users_by_role() {

    $current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];

    if ( 'administrator' !== $role_name ) {
        wp_redirect( site_url().'/dashboard' );
    }

}
add_action( 'admin_init', 'redirect_users_by_role' );