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
            <div class="error"></div>
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
                    
                    <?php echo get_student_list() ?>

                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#fucking-submit').click(function (e) {
            e.preventDefault();
            console.log('fucking stoped')
            var form = $('#teacher-form').serialize()
            $.post("<?php echo site_url() . '/wp-admin/admin-ajax.php?action=custom_registration_function'; ?>", form, function (data, status) {
                console.log(data)
                if (data.msg == 'success') {
                    $('.error').text('Teacher has been added')
                    $('#teacher-form').resetForm();
                }
                if (data.msg != 'success') {
                    $('.error').html(data).css('color','red')
                }

            });
        })

        $('.school_options').append('<?php echo school_options()?>');
        $('.parent-teacher-school').append('<?php echo get_user_meta($user->ID, 'school', true)?>');

    })
</script>

<?php get_footer(); ?>


