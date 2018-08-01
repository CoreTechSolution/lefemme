<?php get_header(); ?>
<div id="content">
	<div class="container">
	    <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="dashedborder matchheight paddingRight><br />
                    <h1>Search Results for : <?php echo get_search_query(); ?></h1>
                    <?php if(have_posts()){ ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>     
                    <div><?php the_excerpt(); ?></div>
                    <?php $category = get_the_category(); ?>
                    <div class="post-footer"><?php the_time('F jS, Y'); ?> | Category: <a href="<?php echo get_category_link($category[0]->cat_ID); ?>"><?php echo $category[0]->cat_name; ?></a> | <?php comments_number( 'no comments', 'one comments', '% comments' ); ?></div>
                    <?php endwhile; ?>
                    <?php } else { ?>
                    <div><p>Sorry, No result found</p></div>
                    <?php } ?>
                    <br />
                </div>
            </div>
	    </div>
	</div>
</div>
<?php get_footer(); ?>