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

            <?php if (wp_get_current_user()->roles[0] == 'administrator') :

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $request = (object)$_REQUEST;
                    add_school($request);
                }

                ?>

                <form action="<?php echo site_url().'/new-school'?>" method="post">
                    <div class="form-group">
                        <label for="email">School name</label>
                        <input type="text" name="school_name" class="form-control" id="school_name">
                    </div>
                    <button type="submit" class="btn btn-default"> Add School</button>
                </form>

            <?php endif ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.school_options').append('<?php echo school_options()?>');

        console.log('<?php echo school_options()?>')
    })
</script>

<?php get_footer(); ?>


