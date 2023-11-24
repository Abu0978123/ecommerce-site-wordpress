<?php
/**
 * Template part for displaying single posts content.
 *
 *
 * @subpackage bizz-ecommerce
 * @since 1.0 
 */

?>

<?php 
$display_author = get_theme_mod('bizz_ecommerce_enable_author_single_section',true); 
$display_comment = get_theme_mod('bizz_ecommerce_enable_comment_single_section',true); 
$display_date = get_theme_mod('bizz_ecommerce_enable_date_single_section',true); 
$display_tags = get_theme_mod('bizz_ecommerce_enable_tags_single_section',true);
$display_visit = get_theme_mod('bizz_ecommerce_enable_vcount_single_section',true); 
$display_image = get_theme_mod('bizz_ecommerce_enable_fimage_single_section',true); 
?>

<div class="blog-detail">
    <?php if($display_image && has_post_thumbnail()) { 
            the_post_thumbnail(); 
        } ?>

    <?php //if(class_exists( 'WooCommerce')) { ?> 
        <?php if(class_exists( 'WooCommerce') && !is_product()) { ?> 
        <ul class="post-meta text-left">

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

            <?php if($display_date) { ?>
            <li>
                <i class="fa fa-calendar"></i>
                <?php bizz_ecommerce_posted_on(); ?>
            </li>
            <?php } ?>

            <?php if($display_visit) { ?>
            <li>
                <i class="fa fa-eye"></i>
                <?php if(bizz_ecommerce_get_post_view()!=0){ 
                     echo esc_html(bizz_ecommerce_get_post_view()); 
                 } else {
                    ?>0<?php
                 }?>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>  
    <?php //} ?>  

    <h4 class="text-capitalize"><?php the_title(); ?></h4>
   
   <?php the_content(); ?>

    <?php if($display_tags && has_tag()) { ?>
    <div class="post-tags mt-4">
        <span class="text-capitalize mr-2 c-black">
            <i class="fa fa-tags"></i> tags :</span>
            <?php the_tags('', ', ', '<br />'); ?>
    </div>
    <?php } ?>

    <?php 

    if (get_previous_post_link()) { 
        $previous_post_url = get_permalink( get_adjacent_post(false,'',true)->ID );
    }
    if (get_next_post_link()) { 
         $next_post_url = get_permalink( get_adjacent_post(false,'',false)->ID );
    } ?>

    <?php if(class_exists( 'WooCommerce') && !is_product()) { ?> 
     <div class="pagination-blog mt-4 mb-5">
        <a href="<?php echo esc_url($previous_post_url); ?>" class="blog-prev">
            <i class="fa fa-angle-left"></i> Previous Post
        </a>
        <a href="<?php echo esc_url($next_post_url); ?>" class="blog-next">Next Post 
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
    <?php } ?>
</div>