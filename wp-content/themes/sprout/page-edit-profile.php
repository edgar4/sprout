<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php $request = request_object();
if ($request->activity == 1) :
    prefix_admin_save_activity(true);
else:?>

    <?php $action = empty($_REQUEST['action']) ? '' : $_REQUEST['action'];
    if ($action) {
        prefix_admin_save_activity(false, $_REQUEST);
    } ?>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Profile</h5>
                    </div>
                    <div class="widget-content">
                        <style>
                            .wppb-form-field label, #wppb-login-wrap .login-username label, #wppb-login-wrap .login-password label {
                                width: 15%;
                                float: left;
                                min-height: 1px;
                        </style>
                        <?php echo do_shortcode('[wppb-edit-profile]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>


<?php get_footer();
