<?php
//if(!is_user_logged_in()){
//
//    wp_redirect(site_url() .'/wp-login.php');
//}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title> Sproute</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>css/matrix-login.css"/>
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>font-awesome/css/font-awesome.css"
          rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body style="background-color: #DDDDDD">
<div id="loginbox">

    <form id="loginform-1" class="form-vertical">

        <div class="control-group normal_text"><h3><img
                    src="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>img/logo.png" alt="Logo"/></h3></div>
        <div class="control-group">
            <span class="text-center error">
            </span>
            <div class="controls">

                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" id="user_login"
                                                                                       placeholder="Username"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" id="user_pass"
                                                                                      placeholder="Password"/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <input type="hidden" value="<?php echo esc_attr(site_url() . '/dashboard'); ?>" name="redirect_to">
            <span class="pull-left"><a href="<?php echo wp_lostpassword_url(); ?>" class="flip-link btn btn-info">Lost
                    password?</a></span>
            <span class="pull-right">
                <button type="submit" href="index.html" class="btn btn-success" id="to-login" value="login">
                    login
                </button></span>
        </div>
    </form>
    <!--    <form id="recoverform" action="#" class="form-vertical">-->
    <!--        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a-->
    <!--            password.</p>-->
    <!---->
    <!--        <div class="controls">-->
    <!--            <div class="main_input_box">-->
    <!--                <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text"-->
    <!--                                                                                      placeholder="E-mail address"/>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="form-actions">-->
    <!--            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to-->
    <!--                    login</a></span>-->
    <!--            <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>-->
    <!--        </div>-->
    <!--    </form>-->
</div>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/'; ?>js/matrix.login.js"></script>
<script>
    $(document).ready(function () {
        $("#to-login").click(function (e) {
            e.preventDefault();
            console.log('prevented');
            var form = $('#loginform-1').serialize()
            $.post("<?php echo site_url() . '/wp-admin/admin-ajax.php?action=ajax_login'; ?>", form, function (data, status) {
                var obj = jQuery.parseJSON(data)
                if (obj.loggedin) {
                    location.replace("dashboard")
                }
                if (obj.loggedin == false) {
                    $('.error').text(data.message)
                }
            });
        });
    });

</script>
</body>

</html>
