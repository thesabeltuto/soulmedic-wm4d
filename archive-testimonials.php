<?php get_header();?>
<script>
(function($) {	
	$(document).ready(function() {
		var breadcrumb = '<a href="/">Home</a><span class="fa fa-angle-double-right">  </span><h1>Testimonials</h1>';
		$('div.breadcrumb').html(breadcrumb);
	});
})(jQuery);
					
</script>


<?php $page_layout 	= dttheme_option('specialty','archives-layout');
  	  $page_layout 	= !empty($page_layout) ? $page_layout : "with-right-sidebar";
	  
	  $post_layout 	= dttheme_option('specialty','archives-post-layout'); 
	  $post_layout 	= !empty($post_layout) ? $post_layout : "one-column";
	  
	  $show_sidebar = false;
	  $sidebar_class = "";
	  $post_class = "";
	  $columns = NULL;
	  
	#TO SET PAGE LAYOUT
	switch($page_layout):
		case 'with-left-sidebar':
			$page_class = $page_layout;
			$show_sidebar = true;
			$sidebar_class = "with-sidebar left-sidebar";
		break;

		case 'with-right-sidebar':
			$show_sidebar = true;
			$sidebar_class = "with-sidebar right-sidebar";
		break;
	endswitch;
	
	#TO SET POST LAYOUT
	switch($post_layout):
		case 'one-column':
			$post_class = " column dt-sc-one-column ";
		break;
		
		case 'one-half-column';
			$post_class = " column dt-sc-one-half";
			$columns = 2;
		break;
		
		case 'one-third-column':
			$post_class = " column dt-sc-one-third ";
			$columns = 3;
		break;
	endswitch;?>
      <!-- **Primary Section** -->
      <section id="primary" class="testimonials <?php echo $page_layout;?>">

		<?php if(get_option('wm4d_testimonials') != '' || get_option('wm4d_testimonials') != null) { ?>
            <article id="post-testimonials" <?php post_class('blog-entry'); ?>>
                <div class="blog-entry-inner">
                	<div class="entry-details">
                        <div class="entry-title"><h4>Testimonials</h4></div>
                        <div class="entry-body"><?php echo do_shortcode(get_option('wm4d_testimonials')); ?></div>
                    </div>
                </div>
            </article>
		<?php } ?>

<?php	if( have_posts() ):
			$i = 1;
			while( have_posts() ):
				the_post();
				
				$temp_class = "";
				if($i == 1) $temp_class = $post_class." first"; else $temp_class = $post_class;
				if($i == $columns) $i = 1; else $i = $i + 1;?>
                
                <div class="<?php echo $temp_class;?>">
                	<!-- #post-<?php the_ID()?> starts -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                    	<!-- .blog-entry-inner -->
                        <div class="blog-entry-inner">
                                                    
                            <!-- .entry-details -->
                            <div class="entry-details">
                            	<?php if(is_sticky()): ?>
                                		<div class="featured-post"> <span class="fa fa-trophy"> </span> <?php _e('Featured','dt_themes');?></div>
                                <?php endif;?>
                                
                                <!-- .entry-title -->
                                <div class="entry-title">
                                	<h4><?php the_title();?></h4>
<?php /*?>                                	<h4><a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php the_title();?></a></h4>
<?php */?>                                </div><!-- .entry-title -->
                                                                
                                <div class="entry-body"><?php the_content();?></div>
                                
                            
                            </div><!-- .entry-details -->
                            
                        </div><!-- .blog-entry-inner -->
                    </article><!-- #post-<?php the_ID()?> Ends -->
                </div>
<?php		endwhile;
		endif;?>
                   
           <!-- **Pagination** -->
           <div class="pagination">
                <div class="prev-post"><?php previous_posts_link('<span class="fa fa-angle-double-left"></span> Prev');?></div>
                <?php echo dttheme_pagination();?>
                <div class="next-post"><?php next_posts_link('Next <span class="fa fa-angle-double-right"></span>');?></div>
           </div><!-- **Pagination - End** -->
       
      </section><!-- **Primary Section** -->
        
<?php if($show_sidebar): ?>
	  <!-- **Secondary Section ** -->
      <section id="secondary" class="<?php echo $sidebar_class; ?>">
<?php 	get_sidebar();?>      
      </section><!-- **Secondary Section - End** -->
<?php endif; ?>
          
<?php get_footer();?>