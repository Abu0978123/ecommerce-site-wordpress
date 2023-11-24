<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bizz-ecommerce
 */

?>
<?php 
$display_author = get_theme_mod('bizz_ecommerce_enable_author_blog_section',true);
$display_date = get_theme_mod('bizz_ecommerce_enable_date_blog_section',true); 
$display_comment = get_theme_mod('bizz_ecommerce_enable_comment_blog_section',true); 
$display_visit = get_theme_mod('bizz_ecommerce_enable_vcount_blog_section',true);
$display_image = get_theme_mod('bizz_ecommerce_enable_fimage_blog_section',true); 
?>

<article class="blog-item blog-2" id="post-<?php the_ID(); ?>">
    <?php if($display_image) { ?>
    <div class="post-img">
        <?php
        if(has_post_thumbnail()){ 
         	the_post_thumbnail(); 
         } ?>
        
        <?php if($display_date && has_post_thumbnail()) { ?>
        <div class="date">
            <p>
                <span><?php bizz_ecommerce_posted_on(); ?></span>
            </p>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    
    <?php if($display_author || $display_comment ||$display_visit){ ?>
    <ul class="post-meta">
        
        <?php if($display_author) { ?>
        <li>
            <i class="fa fa-user"></i>
            <?php bizz_ecommerce_posted_by(); ?>
        </li>
        <?php } ?>
        
        <?php if($display_comment) { ?>
        <li>
            <i class="fa fa-comments"></i>
            <?php echo esc_html(get_comments_number());  ?>
        </li>
        <?php } ?>

        <?php if($display_visit) { ?>
        <li>
            <i class="fa fa-eye"></i>
            <?php  if(bizz_ecommerce_get_post_view()!=0){ 
                 echo esc_html(bizz_ecommerce_get_post_view()); 
             } else {
                ?>0<?php
             }?>
        </li>
        <?php } ?>

    </ul>
    <?php } ?>
    <div class="post-content p-4 text-center">
        <h5>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h5>
                   
        <?php the_excerpt(); ?>
   		<a class="text-uppercase read-more" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('bizz_ecommerce_readmore_general_section', 'Read More')); ?></a>
    </div>
</article>