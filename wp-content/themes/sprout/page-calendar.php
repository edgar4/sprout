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
            <div class="widget-title bg_lo" data-toggle="collapse" href="#collapseG3"><span class="icon"> <i
                        class="icon-chevron-down"></i> </span>
                <h5>My Events</h5>
                <div class="buttons">
                    <?php if (current_user_can('teacher') || current_user_can('editor') || current_user_can('administrator')) : ?>
                        <a id="add-event"
                           class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Add new
                            event</a>
                    <?php endif ?>

                </div>
                <div class="widget-content nopadding updates collapse out in">
                    <form action="" id="form-events" method="post" style="padding-top: 50px; display:none">

                        <p>Enter event Title:</p>
                        <p>
                            <input type="" id="title" required/>
                        </p>

                        <p>Enter event Start Date & Time</p>
                        <p>
                            <input type="text" id="startdate" class="datetimepicker-calendar" required/>
                        </p>
                        <p>Enter event End Date & Time:</p>
                        <p>
                            <input type="text" id="enddate" class="datetimepicker-calendar" required/>
                        </p>
                        <p>Enter event description:</p>
                        <p>
                            <textarea id="desc" required></textarea>
                            <input type="hidden" id="school"
                                   value="<?php echo get_user_meta(wp_get_current_user()->ID, 'school', true) ?>">
                            <input type="hidden" id="teacher" value="<?php echo get_current_user_id() ?>">
                        </p>
                        <button
                            type="submit"
                            class="btn btn-primary" id="saveEvent">Add
                            event
                        </button>

                    </form>

                    <?php $request = request_object();
                    $events = get_school_calendar();
                    foreach ($events as $event): ?>
                        <div class="new-update clearfix"><i class="icon-ok-sign"></i>
                            <div class="update-done"><a title="" href="#"><strong><?php echo $event->title ?>
                                    </strong></a>
                                <span><?php echo $event->description ?></span>
                            </div>
                            <div class="update-date"><span
                                    class="update-day"><?php echo date_format(new DateTime($event->date), 'd') ?></span></span><?php echo date_format(new DateTime($event->date), 'M') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>


<?php get_footer();
