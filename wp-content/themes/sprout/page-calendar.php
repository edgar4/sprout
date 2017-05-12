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
                <div class="buttons"><a id="add-event" data-toggle="modal" href="#modal-add-event"
                                        class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Add new
                        event</a>
                    <div class="modal modal-container" id="modal-add-event">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Add a new event</h3>
                        </div>

                        <div class="modal-body">
                            <form action="" method="post">

                                <p>Enter event Title:</p>
                                <p>
                                    <input  type="" id="title" required/>
                                </p>

                                <p>Enter event Start Date & Time</p>
                                <p>
                                    <input  type="datetime-local" id="startdate" required/>
                                </p>
                                <p>Enter event End Date & Time:</p>
                                <p>
                                    <input  type="datetime-local" id="enddate" required/>
                                </p>
                                <p>Enter event description:</p>
                                <p>
                                    <textarea id="desc" required></textarea>
                                    <input type="hidden" id="school" value="<?php echo get_user_meta(wp_get_current_user()->ID, 'school', true)?>">
                                    <input type="hidden" id="teacher" value="<?php echo get_current_user_id()?>">
                                </p>


                        </div>
                        <div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Cancel</a>

                            <button
                                type="submit"
                                class="btn btn-primary" id="saveEvent">Add
                                event
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="widget-content nopadding updates collapse in" id="collapseG3">
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



<?php get_footer();
