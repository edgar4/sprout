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
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Enter activity note</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                            <div class="control-group">
                                <label class="control-label">Activity Subject</label>
                                <div class="controls">
                                    <input type="text" name="activity_title" id="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Activity Note</label>
                                <div class="controls">
                                <textarea name="activity_note" cols="150"> </textarea>

                                    <input type="hidden" name="action" value="save_activity">
                                    <input type="hidden" name="activity" value="<?php echo request_object()->activity?>" >
                                    <input type="hidden" name="student_id" value="<?php echo request_object()->student_id?>">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value=" Save Activity Note" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>


<?php get_footer();
