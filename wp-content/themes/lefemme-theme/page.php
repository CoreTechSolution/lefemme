<?php get_header(); ?>
<?php
if(is_page('my-account') && !is_user_logged_in()) {
	header('Location:'.get_bloginfo('url').'/login');
}
?>
<div id="content">
	<div class="maincontent">
	    <div class="section group">
	        <div class="col span_12_of_12"> 
                <div class="container">
                    <?php while (have_posts()) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?></div>
                    <?php endwhile; ?>  
                </div>                         
	        </div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>