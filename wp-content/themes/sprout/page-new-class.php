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
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
            <p style="margin-top: 20px;"></p>
            <p>
                <select name="school" class="form-control" required>
                    <option>choose School</option>
                    <?php global $wpdb;
                    $results = $wpdb->get_results("SELECT * FROM schools WHERE id = " . get_user_meta(wp_get_current_user()->ID, 'school', true) . " ", OBJECT);
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
                <input type="hidden" name="action" value="add_class">
                <input name="class" id="class" value="" tabindex="1" type="text" class="form-control" required>
                <label for="author">
                    <small>Class (required)</small>
                </label>
            </p>


            <p>
                <input name="submit" id="submit" tabindex="5" value="Submit" type="submit"
                       class="button button-primary button-large">

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


