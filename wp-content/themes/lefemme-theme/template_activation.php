<?php /* Template Name: Activation Template */ ?>
<?php get_header(); ?>
<div class="inner-page">
	<div class="maincontent">
	    <div class="section group">
            <div class="col span_4_of_12"></div>
	        <div class="col span_4_of_12">
                <?php include (TEMPLATEPATH . '/frameworks/authentication_fuctions/activation.php'); ?>
	        </div>
            <div class="col span_4_of_12"></div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>