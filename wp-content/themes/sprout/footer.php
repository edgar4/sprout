<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
	<div id="footer" class="span12"> <?php echo date('Y')?> &copy;  Sproute.  <a href="http://tinker.co.ke">Tinker Digital</a> </div>
</div>

<!--end-Footer-part-->
<?php wp_footer(); ?>
<script>
	var ajax_url = '<?php echo admin_url('admin-ajax.php')?>';
</script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/excanvas.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.ui.custom.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.flot.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.flot.resize.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.peity.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/fullcalendar.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.dashboard.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.gritter.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.interface.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.chat.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.validate.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.form_validation.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.wizard.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.uniform.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/select2.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.popover.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/matrix.tables.js"></script>

<script src="<?php echo get_stylesheet_directory_uri() .'/assets/';?>js/sprout.js"></script>

<script type="text/javascript">
	// This function is called from the pop-up menus to transfer to
	// a different page. Ignore if the value returned is a null string:
	function goPage (newURL) {

		// if url is empty, skip the menu dividers and reset the menu selection to default
		if (newURL != "") {

			// if url is "-", it is this page -- reset the menu:
			if (newURL == "-" ) {
				resetMenu();
			}
			// else, send page to designated URL
			else {
				document.location.href = newURL;
			}
		}
	}

	// resets the menu selection upon entry to this page:
	function resetMenu() {
		document.gomenu.selector.selectedIndex = 2;
	}


</script>
</body>
</html>


