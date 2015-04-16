<?php get_header();?>
<?php #Page Top Code Section
	$dttheme_options = get_option(IAMD_THEME_SETTINGS);
	$dttheme_integration = $dttheme_options['integration'];
	if(isset($dttheme_integration['enable-single-post-top-code']))	echo stripslashes($dttheme_integration['single-post-top-code']);?>        

       	<?php if( have_posts() ): ?>
       	<?php 	while ( have_posts() ) : the_post(); ?>
        <div class="before-and-after">
			<?php //		get_template_part( 'framework/loops/content', 'page' ); ?>
            
			<?php $tpl_default_settings = get_post_meta($post->ID,'_dt_post_settings',TRUE);
                  $tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
                  
                  $post_layout = array_key_exists("layout",$tpl_default_settings) ? $tpl_default_settings['layout'] : "with-right-sidebar";
                  $show_sidebar = false;
                  $sidebar_class= "";
                  $format = get_post_format(  $post->ID );
            
                  switch($post_layout):
                    case 'with-left-sidebar':
                        $post_layout 	=	"with-left-sidebar";
                        $show_sidebar 	= 	true;
                        $sidebar_class 	=	"left-sidebar";
                    break;
                    
                    case 'with-right-sidebar':
                        $show_sidebar 	= 	true;
                    break;
                  endswitch;
                  
                $hide_date_meta = isset( $tpl_default_settings['disable-date-info'] ) ? " hidden " : "";
                $hide_comment_meta = isset( $tpl_default_settings['disable-comment-info'] ) ? " hidden " : " comments ";
                
                $hide_author_meta = isset( $tpl_default_settings['disable-author-info'] ) ? " hidden " : "";
                $hide_category_meta = isset( $tpl_default_settings['disable-category-info'] ) ? " hidden " : "";
                $hide_tag_meta = isset( $tpl_default_settings['disable-tag-info'] ) ? " hidden " : "tags";?>
                    <!-- **Primary Section** -->
                    <section id="primary" class="<?php echo $post_layout;?>">
                        <!-- #post-<?php the_ID()?> starts -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                        
                            <div class="blog-entry-inner">
                            
                                <div class="entry-details">
                                
                                  <?php if(is_sticky()): ?>
                                        <div class="featured-post"> <span class="fa fa-trophy"> </span> <?php _e('Featured','dt_themes');?></div>
                                  <?php endif;?>
                                  
                                    <div class="entry-title">
                                        <h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><?php the_title();?></a></h4>
                                    </div>
                                    
                                    <div class="entry-body"><?php
                                    
                                        the_content();
                                        
//                                        echo '<div class="author-bio">';
//                                        echo 	'<h4> Author Info </h4>';
//                                        echo 	'<div class="author-details">';							
//                                        echo 		'<div class="image">';
//                                        echo 			get_avatar( get_the_author_meta('user_email'));	
//                                        echo 		'</div>';
//                                        echo		'<h4>'.get_the_author().'</h4>';
//                                                    the_author_meta('description'); 
//                                        echo 	'</div>';
//                                        echo '</div>';
                                        
                                        wp_link_pages( array(	'before'=>'<div class="page-link">', 'after'=>'</div>', 'link_before'=>'<span>', 'link_after'=>'</span>', 
                                                        'next_or_number'=>'number',	'pagelink' => '%', 'echo' => 1 ) );
                                                        
                                        echo '<div class="social-bookmark">';
                                            show_fblike('post');
                                            show_googleplus('post');
                                            show_twitter('post');
                                            show_stumbleupon('post');
                                            show_linkedin('post');
                                            show_delicious('post');
                                            show_pintrest('post');
                                            show_digg('post');
                                        echo '</div>';
                                        
                                        echo '<div class="social-share">';
                                            dttheme_social_bookmarks('sb-post');
                                        echo '</div>';
                                        
                                        edit_post_link( __( ' Edit ','dt_themes' ) );											
                                                        
                                    ?></div>
                                
                                </div><!--.entry-details -->
                                 
                            </div><!-- .blog-entry-inner -->
                            
                        </article><!-- #post-<?php the_ID()?> Ends -->
                        
                        
            
            <?php /*$dttheme_options = get_option(IAMD_THEME_SETTINGS);
                  $dttheme_general = $dttheme_options['general'];
                  $globally_disable_post_comment =  array_key_exists('global-post-comment',$dttheme_general) ? true : false; 
                  if( (!$globally_disable_post_comment) && (! isset($tpl_default_settings['disable-comment'])) ):?>
                        <!-- **Comment Entries** -->   	
                        <div class="commententries">
                            <?php  comments_template('', true); ?>
                        </div><!-- **Comment Entries - End** -->
            <?php endif;*/?>          
                         
                    </section><!-- **Primary Section** -->
            <?php if($show_sidebar): ?>
                  <!-- **Secondary Section ** -->
                  <section id="secondary" class="<?php echo $sidebar_class; ?>">
            <?php 	get_sidebar();?>      
                  </section><!-- **Secondary Section - End** -->
            <?php endif; ?>            
            
        </div>
        <?php 	endwhile;
           	  endif;?>
<?php #Page Top Code Section
	$dttheme_integration = $dttheme_options['integration'];
	if(isset($dttheme_integration['enable-single-post-bottom-code']))	echo stripslashes($dttheme_integration['single-post-bottom-code']);?>        
<?php get_footer();?>