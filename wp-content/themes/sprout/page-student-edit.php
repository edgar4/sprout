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
        <?php $id = $_GET['id']; ?>
        <form action="<?php echo site_url() . '/student-edit?id=' . $id; ?>" method="post"
              enctype="multipart/form-data">
            <p>

            </p>
            <p>
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>" tabindex="1" type="text"
                       class="form-control" required>
                <input name="name" id="name" value="<?php echo list_student_edit($id)->name ?>" tabindex="1" type="text"
                       class="form-control" required>
                <label for="author">
                    <small>Name (required)</small>
                </label>
            </p>

            <p>
                <input name="class" id="class" value="<?php echo list_student_edit($id)->class ?>" tabindex="1"
                       type="text" class="form-control" required>
                <label for="author">
                    <small>Class (required)</small>
                </label>
            </p>

            <select name="parent" class="form-control" required>
                <option value="<?php echo list_student_edit($id)->parent ?>"> as previously set</option>
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
            <br/>
            <p>
                <input name="submit" id="submit" tabindex="5" value="Edit_Student" type="submit"
                       class="button button-primary button-large">
                <input type="hidden" name="action" value="edit_student">
            </p>

        </form>
    </div>

</div>


<script>
    $(document).ready(function () {
        $("#submit").click(function (e) {
            e.preventDefault();
            var form = $('form').serialize();
            console.log(form)
            $.post("<?php echo site_url() . '/wp-admin/admin-ajax.php?action=edit_student'; ?>", form, function (data, status) {
                var obj = jQuery.parseJSON(data)
                console.log(obj)

                location.replace("student-list")

            });
        });
    });

</script>
<?php get_footer(); ?>


