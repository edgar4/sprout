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
        <div class="widget-box">
            <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i
                        class="icon-chevron-down"></i></span>
                <h5>Student List</h5>
            </div>
            <div class="widget-content nopadding collapse in" id="collapseG2">
                <ul class="recent-posts">
                    <?php $request = request_object();
                    $students = B_get_students();
                    foreach ($students as $student): ?>
                        <li>
                            <a href="<?php echo site_url() . '/dashboard/profile/?st=' . $student->id?>"><div class="user-thumb"><img width="40" height="40" alt="User"
                                                         src="<?php echo $student->image ?>"></div>
                            <div class="article-post"><strong><span
                                        class="user-info"> <?php echo $student->name ?> </span></strong>
                                <p> Class <?php echo $student->class ?></p></a>
                                <div class="action pull-right">
                                    <a style="font-size: 3em;"
                                       href="<?php echo site_url() . '/dashboard/add/?activity=' . $request->activity . '&student_id=' . $student->id ?>">

                                        <?php if ($request->activity == 1):
                                            echo '<i class="icon-arrow-right"></i> </a>';
                                        else:
                                            echo '<i class="icon-plus-sign"></i> </a>';
                                        endif;
                                        ?>

                                </div>
                            </div>
                            <span class="clearfix"></span>

                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>

<?php get_footer();
