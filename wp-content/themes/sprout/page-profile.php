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
        <?php $request = request_object();
       $student = ajax_get_student_profile(false);
        foreach ($student as $profile): ?>
            <div class="profile-bg text-center">
                <img class="img-circle" width="150" height="150" alt="User"
                     src="<?php echo $profile->image ?>">
            </div>
        <?php endforeach; ?>


     <?php if(!isset($request->activity_id)) :?>

        <div class="widget-box">
            <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i
                        class="icon-chevron-down"></i></span>
                <h5>Student  Activity List</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">
                <ul class="recent-posts">
                    <?php $request = request_object();
                   $activityActivity = ajax_get_student_activity(false);
                    foreach ( $activityActivity as $activity): ?>
                    <li>
                        <a href="<?php echo site_url() . '/dashboard/profile/?activity_id=' . $activity->id .'&student_id='.$activity->student_id?>">
                            <div class="user-thumb"><img width="40" height="40" alt="User"
                                                         src="<?php echo site_url().'/'.$activity->activity_icon?>"></div>
                            <div class="article-post"><strong><span
                                        class="user-info"> <?php echo $activity->activity_title ?> </span></strong>
                                <p> Class <?php echo $activity->activity_note ?></p>
                        </a>
                        <div class="action pull-right">
                           <?php echo $activity->activity_time?>


                        </div>
            </div>
            <span class="clearfix"></span>

            </li>
            <?php endforeach; ?>

            </ul>
        </div>
    <?php else:?>
         <div class="row-fluid">
             <div class="col-xs-12">
                 <div class="widget-box">
                     <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                         <h5>comment on activity</h5>
                     </div>
                     <div class="widget-content nopadding">
                         <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
                             <div class="control-group col-xs-11 col-xs-offset-1 ">
                                 <label class="control-label">Your Name</label>

                                 <textarea class="col-xs-12 "></textarea>

                             </div>



                             <div class="form-actions text-center">
                                 <input  type="submit" value="Comment" class="btn btn-success col-xs-12">
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
    <?php endif;?>
    </div>


<?php get_footer();
