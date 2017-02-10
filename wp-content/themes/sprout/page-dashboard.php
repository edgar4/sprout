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

    <!--Action boxes-->
    <div class="container-fluid">



        <div class="row-fluid offset1">
            <div class="span12">
                <div class="widget-box2 text-center">

                    <div class="span3">
                        <a href="<?php echo site_url().'/student-activity?activity=1'?>"> <img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-checkin.png' ?>" class="img-responsive"/>
                        <h5> Check in</h5>
                        </a>
                    </div>
                    <div class="span3">
                        <a href="<?php echo site_url().'/student-activity?activity=2'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-learning.png' ?>" class="img-responsive"/>
                        <h5> Learning</h5>
                        </a>
                    </div>
                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=3'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-food.png' ?>" class="img-responsive"/>
                        <h5> Food</h5></a>
                    </div>

                </div>


            </div>

        </div>


        <div class="row-fluid offset1">
            <div class="span12">
                <div class="widget-box2 text-center">
                    &nbsp;<br/> &nbsp;
            &nbsp;<br/> &nbsp;
                    <div class="span3">
                        <a href="<?php echo site_url().'/student-activity?activity=4'?>"> <img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-note.png' ?>" class="img-responsive"/>
                        <h5> Note</h5></a>
                    </div>
                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=5'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-honours.png' ?>" class="img-responsive"/>

                        <h5> Honours</h5></a>
                    </div>
                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=6'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-potty.png' ?>" class="img-responsive"/>
                        <h5> Porty</h5></a>
                    </div>
                </div>


            </div>

        </div>


        <div class="row-fluid offset1">
            <div class="span12">
                <div class="widget-box2 text-center">


                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=7'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-clinic.png' ?>" class="img-responsive"/>
                        <h5> Clinic</h5></a>
                    </div>
                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=8'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-sleep.png' ?>" class="img-responsive"/>
                        <h5>Sleep</h5>
                    </div>
                    <div class="span3"><a href="<?php echo site_url().'/student-activity?activity=9'?>"><img
                            src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon-sports.png' ?>" class="img-responsive"/>
                        <h5> Sports</h5></a>
                    </div>
                </div>


            </div>

        </div>
    </div>

<?php get_footer();
