<?php get_header(); ?>
<div id="">
	<div class="container">
	    <div class="row">
	        <div class="col-lg-12">
                <div class="contentSection">
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