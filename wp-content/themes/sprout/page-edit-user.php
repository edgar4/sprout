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

<div class="container-fluid">
    <div class="widget-box" style="padding-left: 5em;">
        <div class="widget-content nopadding">
            <?php echo get_user_meta($user->ID,'school') ?>
            <?php $user = wp_get_current_user(); if ($user->roles[0] == 'administrator') {
                echo do_shortcode("[user-meta-registration form=\"School Admin form\"]");
            } else if ($user->roles[0] == 'school_admin') {
              echo do_shortcode("[user-meta-registration form=\"School Teacher / parent Form\"]");
            }

            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.school_options').append('<?php echo school_options()?>');
        $('.parent-teacher-school').append('<?php echo get_user_meta($user->ID,'school',true)?>');

    })
</script>

<?php get_footer(); ?>


