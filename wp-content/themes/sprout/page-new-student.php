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
    <div class="wrap" style="padding-left: 5em;">
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
            <p>
                <input name="name" id="name" value="" tabindex="1" type="text" class="form-control" required>
                <label for="author">
                    <small>Name (required)</small>
                </label>
            </p>
            <?php $school = $wpdb->get_results("SELECT * FROM schools WHERE id = " . get_user_meta(wp_get_current_user()->ID, 'school', true) . " ", OBJECT); ?>
            <p>
<!--                <input name="class" id="class" value="" tabindex="1" type="text" class="form-control" required>-->

                <select name="class" id="class" class="form-control" required>
                    <option>choose Class</option>
                    <?php global $wpdb;
                    $results = $wpdb->get_results("SELECT * FROM school_classes WHERE school_id = " . $school[0]->id . " ", OBJECT);
                    foreach ($results as $result) {
                        echo '<option value="' . $result->class . '">' . $result->class . '</option>';
                    }

                    ?>
                </select>

                <label for="author">
                    <small>Class (required)</small>
                </label>
            </p>

            <p>
                <select name="parent" class="form-control" required>
                    <option>choose student parent</option>
                    <?php
                    $user_query = new WP_User_Query(array(
                        'role' => 'parent',
                        'meta_key' => 'school',
                        'meta_value' => get_user_meta(wp_get_current_user()->ID, 'school', true)
                    ));
                    $results = $user_query->results;
                    foreach ($results as $result) {
                        echo '<option value="' . $result->ID . '">' . $result->display_name . '</option>';
                    }

                    ?>
                </select>
            </p>
            <p>
                <select name="school" class="form-control" required>
                    <option>choose School</option>
                    <?php global $wpdb;

                    foreach ($school as $result) {
                        echo '<option value="' . $result->id . '">' . $result->school_name . '</option>';
                    }

                    ?>
                </select>
                <label for="author">
                    <small>School (required)</small>
                </label>
            </p>

            <p>
                <input name="file" id="class" value="" tabindex="1" type="file" class="form-control" required>
                <label for="author">
                    <small>profile (required)</small>
                </label>
            </p>

            <p>
                <input name="submit" id="submit" tabindex="5" value="Submit" type="submit"
                       class="button button-primary button-large">
                <input type="hidden" name="action" value="do_upload">
            </p>

        </form>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('.school_options').append('<?php echo school_options()?>');
        $('.parent-teacher-school').append('<?php echo get_user_meta($user->ID, 'school', true)?>');

    })
</script>

<?php get_footer(); ?>


