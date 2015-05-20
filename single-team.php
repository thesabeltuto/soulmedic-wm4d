<?php get_header();?>
<?php #Page Top Code Section
	$dttheme_options = get_option(IAMD_THEME_SETTINGS);
	$dttheme_integration = $dttheme_options['integration'];
	if(isset($dttheme_integration['enable-single-post-top-code']))	echo stripslashes($dttheme_integration['single-post-top-code']);?>        

       	<?php if( have_posts() ): ?>
       	<?php 	while ( have_posts() ) : the_post(); ?>
        <div class="procedure">
			<?php // 		get_template_part( 'framework/loops/content', 'page' ); ?>
            
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
                
                    <?php /*if( has_post_thumbnail() ): ?>
                    		<!-- .entry-thumb -->
                    		<div class="entry-thumb">
                            	<a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php the_post_thumbnail();?></a>
                            </div><!-- .entry-thumb -->
                    <?php endif;*/ ?>
                    
<?php /*?>                    <div class="entry-thumb">
                            <?php if( $format === "image" || empty($format) ):?>
                                    <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>">
                                    <?php if( has_post_thumbnail() ):
                                            the_post_thumbnail("full");
                                          else:?>
                                            <img src="http://placehold.it/1060x636&text=Image" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />
                                    <?php endif;?>
                                    </a>
                            <?php elseif( $format === "gallery" &&  array_key_exists("items", $tpl_default_settings) ):
                                    echo "<ul class='entry-gallery-post-slider'>";
                                    foreach ( $tpl_default_settings['items'] as $item ) { echo "<li><img src='{$item}' /></li>";	}
                                    echo "</ul>";
                                  elseif( $format === "video" ):
                                    if( array_key_exists('oembed-url', $tpl_default_settings) || array_key_exists('self-hosted-url', $tpl_default_settings) ):
                                        echo "<div class='dt-video-wrap'>";
                                            if( array_key_exists("oembed-url", $tpl_default_settings) )
                                                echo wp_oembed_get($tpl_default_settings['oembed-url']);
                                            elseif( array_key_exists("self-hosted-url", $tpl_default_settings) )
                                                echo apply_filters( 'the_content', $tpl_default_settings['self-hosted-url'] );
                                        echo "</div>";
                                    endif;
                                  elseif( $format === "audio" ):
                                    if( array_key_exists('oembed-url', $tpl_default_settings) || array_key_exists('self-hosted-url', $tpl_default_settings) ):
                                        if( array_key_exists("oembed-url", $tpl_default_settings) )
                                            echo wp_oembed_get($tpl_default_settings['oembed-url']);
                                        elseif( array_key_exists("self-hosted-url", $tpl_default_settings) )
                                            echo apply_filters( 'the_content', $tpl_default_settings['self-hosted-url'] );
                                    endif;	
                                 else:?>
                                        <a href="<?php the_permalink();?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>"><?php
                                            if( has_post_thumbnail() ):
                                                the_post_thumbnail("full");
                                            else:?>
                                                <img src="http://placehold.it/1060x636&text=Image" alt="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" title="<?php printf(esc_attr__('%s'),the_title_attribute('echo=0'));?>" />		<?php endif;?></a>                  
                                <?php endif; ?>
                    </div>                    
<?php */?>                    <div class="entry-details">
                    
					  <?php if(is_sticky()): ?>
                        	<div class="featured-post"> <span class="fa fa-trophy"> </span> <?php _e('Featured','dt_themes');?></div>
                  	  <?php endif;?>
                      
                      	<div class="entry-title">
                      		<h4><a href="<?php the_permalink();?>" title="<?php printf( esc_attr__('%s'), the_title_attribute('echo=0'));?>"><?php the_title();?></a></h4>
                      	</div>
                        
                        <div class="entry-metadata">
                        
							<?php
							$first =  '<span class="fa fa-folder-open"> </span><a href="'.site_url().'/team/">Meet the Team</a>';
							$categories = the_terms($post->ID, 'team-category', '<span class="fa fa-folder-open"> </span>', ', ', '');
							if ($categories == '') {
								$categories = $first;
							}
							?>
                            
                            <?php the_tags("<p class='{$hide_tag_meta}'><span class='fa fa-tags'> </span> ",', ','</p>');?>
                            
                            <p class="<?php echo $hide_category_meta;?> categories"><?php echo $categories;  ?></p>
                            
                        </div><!-- .entry-metadata-->
                        
                        <div class="entry-body"><?php
						
							the_content();

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