<?php
/*-------Buzz Ecommerce Theme Functions----------*/
	/* Contents:
	*1.Buzz Ecommerce Breadcrumb Section
	*2.Function to list post categories in customizer options 
	*3.get Post  Category 	
	*4.get Woocommerce Products Id
	*5.Default woocommerce Default category
	*6.Multiple Category Select Section
	*/


/** 1. Buzz Ecommerce Breadcrumb Section Functions Hear */

	if ( ! function_exists( 'buzz_ecommerce_breadcrumb' ) ) {
		/**
		 * Buzz Ecommerce Breadcrumb Section
		 * 
		 * @since Buzz Ecommerce 1.0.0
		 */

		function buzz_ecommerce_breadcrumb() {
			
			//Enable Breadcrumb Section 
			if( get_theme_mod('buzz_ecommerce_breadcrumb_enable',true ) == true  ){
				global $post;

				$buzz_ecommerce_breadcrumb_separator = wp_kses_post( '<span class="separator">/</span>' );
				echo '<section class="breadcrumb"><div class="container"><div class="row"><div class="col-md-12"><div class="breadcrumb_wrap">';
				if (!is_home()) {
					echo '<div class="breadcrumb-section">';
					
					echo '<i class="fa fa-home" aria-hidden="true"></i><a href="';
					echo esc_url( home_url( '/' ) );
					echo '">';
					echo esc_html__('Home', 'buzz-ecommerce');
					echo '</a>'.$buzz_ecommerce_breadcrumb_separator ;
					if ( is_category() || is_single()) {
						the_category( $buzz_ecommerce_breadcrumb_separator );
						if (is_single()) {
							echo ''.$buzz_ecommerce_breadcrumb_separator;
							the_title();
						}
					} elseif ( is_page() ) {
						if($post->post_parent){
							$title = get_the_title();
							
							echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
						} else {
							echo '<span> '. esc_html(get_the_title()).'</span>';
						}
					}
					elseif (is_tag()) {single_tag_title();}
					elseif (is_day()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'buzz-ecommerce'), get_the_time('F jS, Y')); echo '</span>';}
					elseif (is_month()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'buzz-ecommerce'), get_the_time('F, Y')); echo '</span>';}
					elseif (is_year()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'buzz-ecommerce'), get_the_time('Y')); echo '</span>';}
					elseif (is_author()) {echo "<span>" . esc_html__('Author Archive', 'buzz-ecommerce'); echo '</span>';}
					elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>" . esc_html__('Blog Archives', 'buzz-ecommerce'); echo '</span>';}
					elseif (is_search()) {echo "<span>" . esc_html__('Search Results', 'buzz-ecommerce'); echo '</span>';}
					
					echo '</div>';
				} else {
					echo '<div class="breadcrumbs-section">';
					
					echo '<a href="';
					echo esc_url( home_url( '/' ) );
					echo '">';
					echo esc_html__('Home', 'buzz-ecommerce');
					echo '</a>'.$buzz_ecommerce_breadcrumb_separator;
					
					echo esc_html__('Blog', 'buzz-ecommerce');
					
					
					echo '</div>';
				}

				echo "</div></div></div></div></section>";
			}
		}

	}



/** 2.Function to list post categories in customizer options */
if( ! function_exists( 'buzz_ecommerce_get_products_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function buzz_ecommerce_get_products_categories( ){
		if(!buzz_ecommerce_is_woocommerce_activated()): return; endif;
		
		/* Option list of all categories */
		$taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
		
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}


/** 3.get Post  Category */
if( ! function_exists( 'buzz_ecommerce_get_post_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function buzz_ecommerce_get_post_categories( ){
		
		
		$all_categories = get_categories( );
		
		//default value
		$categories['all'] = 'all';  
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}


/** 4.get Woocommerce Products Id*/
if( ! function_exists( 'buzz_ecommerce_get_woocommerce_products_id' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function buzz_ecommerce_get_woocommerce_products_id( ){
		
		
		//products
		$product_args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);
		$query = new WP_Query( $product_args );
		if($query->have_posts()) { while( $query->have_posts() ) { $query->the_post();
			$categories[ get_the_ID() ] = get_the_title();  
		}}
		
		return $categories;
	}

}

/**
 * 5. Default woocommerce Default category
 */
if( ! function_exists( 'buzz_ecommerce_get_default_products_categories' ) ) {
	
	/**
	 * Defaul category section 
	*/
	function buzz_ecommerce_get_default_products_categories( ){
		if(!buzz_ecommerce_is_woocommerce_activated()): return; endif;
		
		//Default cat
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );


		//Default Select
		$default_product_cat = '';
        foreach( $all_categories as $cat )  { 
            //Select default category Hear
           if( $cat->count >= 4 ){
                $default_product_cat = $cat->term_id; 
            }
        }

        //not category select then
        if( empty($default_product_cat) ){
            foreach( $all_categories as $cat )  { 
                //Select default category Hear
                $default_product_cat = $cat->term_id;
            }
        }


        //Return default cat
        return $default_product_cat;
	}

}

//Default multiple category select
/** 6.Multiple Category Select Section */
if( ! function_exists( 'buzz_ecommerce_get_multiple_product_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function buzz_ecommerce_get_multiple_product_categories( ){
		
		//Default cat
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );


		//Default Select
		$category_count = 0;
        foreach( $all_categories as $cat )  { 
			//Select default category Hear
			
			$default_product_cat = array();
           if( $category_count < 5  ){
                $default_product_cat[$category_count] = $cat->term_id; 
			}
			
			//increment count
			$category_count++;
        }

        //Return default cat
        return $default_product_cat;
	}

}


/**
 * 
 * Buzz Ecommerce header Search options hear
 */

function buzz_ecommerce_header_search() { 
	?>
	<div id="buzz_ecommerce_search" class="search-form">
		<form class="main-form clearfix" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
		<input type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search', 'buzz-ecommerce'); ?>">
			<?php if (class_exists('WooCommerce')) : ?>
			<?php 
				if( isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']) )
					{
					$optsetlect = sanitize_text_field( wp_unslash( $_REQUEST['product_cat'] ) );
				}
				else{
				$optsetlect = 0;  
				}
				$args = array(
							'show_option_all' => esc_html__( 'Categories', 'buzz-ecommerce' ),
							'hierarchical' => 1,
							'class' => 'cat',
							'echo' => 1,
							'value_field' => 'slug',
							'selected' => $optsetlect
						);
					$args['taxonomy'] = 'product_cat';
					$args['name'] = 'product_cat';              
					$args['class'] = 'cate-dropdown hidden-xs';
					wp_dropdown_categories($args);
			?>
			
			<input type="hidden" value="product" name="post_type">
			
			<?php endif; ?>
				
			<button type="submit" title="<?php echo esc_attr('Search', 'buzz-ecommerce'); ?>" class="search-btn-bg"><img src="<?php echo  esc_url( get_template_directory_uri()."/assets/images/arrow.png" ); ?>" alt=""></button>
				
		</form>
	</div>

	<?php
}

/**
 * Default products items
 * 
 */
function buzz_ecommerce_default_products(){
    ?>
    <div class="defaultproducts item">
        <figure>
          	<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/add-products.png'); ?>" alt="">
		</figure>
    </div>
    <?php
}
