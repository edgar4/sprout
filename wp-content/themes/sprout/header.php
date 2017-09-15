<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.7.0/chosen.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css"/>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.js"></script>
    <script
        src="http://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
    <script>

        $(document).ready(function () {
            $('.chosen').chosen();
            $('.datetimepicker-calendar').datetimepicker();

            $('#form-events').hide();
            $('#add-event').click(function () {
                $('#form-events').toggle();
            })

        })
    </script>

    <style>
        .datepicker {
            z-index: 1151 !important;
        }
    </style>
</head>
<body>
<style>

</style>

<!--Header-part-->
<div id="header">
    <h1><a href="">Sprout</a></h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown"
                                                      data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span
                    class="text"><?php echo wp_get_current_user()->user_login ?></span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo site_url() . '/dashboard/edit-profile' ?>"><i class="icon-user"></i> My
                        Profile</a></li>
                <li class="divider"></li>
                <li class="divider"></li>
                <li><a href="<?php echo wp_logout_url($redirect); ?>"><i class="icon-key"></i> Log Out</a></li>
            </ul>
        </li>

    </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
    <input type="text" placeholder="Search here..."/>
    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar">
    <!--    <a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>-->
    <ul>
        <li class="active"><a href="<?php echo site_url() . '/dashboard'; ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a>
        </li>
        <li><a href="<?php echo site_url() . '/dashboard/student-activity/'; ?>"><i class="icon icon-signal"></i>
                <span>Students</span></a></li>
        <li><a href="<?php echo site_url() . '/dashboard/calendar'; ?>"><i class="icon icon-inbox"></i>
                <span>Calendar</span></a>
        </li>

        <?php $user = wp_get_current_user() ?>
        <?php if ($user->roles[0] == 'parent') : ?>
            <li><a href="<?php echo site_url() . '/dashboard/subscription'; ?>"><i class="icon icon-th"></i> <span>Subscriptions</span></a>
            </li>


        <?php elseif ($user->roles[0] == 'teacher') : ?>
            <li><a href="<?php echo site_url() . '/dashboard/new-student'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Add Student</span></a>
            </li>
            <li><a href="<?php echo site_url() . '/dashboard/student-list'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Student List</span></a>
            </li>

        <?php elseif ($user->roles[0] == 'school_admin') : ?>
            <li><a href="<?php echo site_url() . '/dashboard/new-class'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Add school Classes </span></a>
            </li>
            <li><a href="<?php echo site_url() . '/dashboard/new-user'; ?>"><i class="icon icon-fullscreen"></i> <span> Add Teacher/ Parent</span></a>
            </li>

            <li><a href="<?php echo site_url() . '/dashboard/new-student'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Add Student</span></a>
            </li>
            <li><a href="<?php echo site_url() . '/dashboard/student-list'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Student List</span></a>
            </li>


        <?php elseif ($user->roles[0] == 'administrator') : ?>

            <li><a href="<?php echo site_url() . '/dashboard/new-user'; ?>"><i class="icon icon-fullscreen"></i> <span> Add User</span></a>
            </li>
            <li><a href="<?php echo site_url() . '/dashboard/new-school'; ?>"><i class="icon icon-fullscreen"></i>
                    <span> Add school</span></a>
            </li>

        <?php endif ?>

        <li><a href="<?php echo site_url() . '/dashboard/feedback'; ?>"><i class="icon icon-fullscreen"></i> <span> Feedback</span></a>
        </li>
        <li><a href="<?php echo wp_logout_url(); ?>"><i class="icon icon-tint"></i> <span>Log out</span></a></li>
    </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <?php
        if (have_posts()):while (have_posts()) : the_post(); ?>
            <div id="breadcrumb"><a href="" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home/ <?php echo the_title() ?></a></div>
        <?php endwhile; endif ?>
    </div>
    <!--End-breadcrumbs-->