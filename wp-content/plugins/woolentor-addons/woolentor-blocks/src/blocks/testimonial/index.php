<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uniqClass 	 = 'woolentorblock-'.$settings['blockUniqId'];
$areaClasses = [ $uniqClass, 'woolentor-testimonial-area' ];

!empty( $settings['className'] ) ? $areaClasses[] = esc_attr( $settings['className'] ) : '';
!empty( $settings['align'] ) ? $areaClasses[] = 'align'.$settings['align'] : '';

!empty( $settings['columns']['desktop'] ) ? $areaClasses[] = 'woolentor-grid-columns-'.$settings['columns']['desktop'] : 'woolentor-grid-columns-4';
!empty( $settings['columns']['laptop'] ) ? $areaClasses[] = 'woolentor-grid-columns-laptop-'.$settings['columns']['laptop'] : 'woolentor-grid-columns-laptop-3';
!empty( $settings['columns']['tablet'] ) ? $areaClasses[] = 'woolentor-grid-columns-tablet-'.$settings['columns']['tablet'] : 'woolentor-grid-columns-tablet-2';
!empty( $settings['columns']['mobile'] ) ? $areaClasses[] = 'woolentor-grid-columns-mobile-'.$settings['columns']['mobile'] : 'woolentor-grid-columns-mobile-1';

!empty( $settings['testimonialStyle'] ) ? $areaClasses[] = 'wlb-testimonial-style-'.$settings['testimonialStyle'] : 'wlb-testimonial-style-1';

$image_size = $settings['imageSize'] ? $settings['imageSize'] : 'full';

// Generate testimonial
$testimonial_list = [];
if( $settings['testimonialType'] === 'custom' ){
    foreach ( $settings['testimonialList'] as $review ){
        $testimonial_list[] = [
            'image' => $review['image']['id'] ? wp_get_attachment_image( $review['image']['id'], $image_size ) : '',
            'name' 	=> $review['name'],
            'designation' => $review['designation'],
            'ratting' 	  => $review['rating'],
            'message' 	  => $review['message'],
		];
    }
}


$rowClass = [ 'woolentor-grid' ];
if( $settings['noGutter'] ){
    $rowClass[] = 'woolentor-no-gutters';
}

echo '<div class="'.implode(' ', $areaClasses ).'">';
	echo '<div class="'.implode(' ', $rowClass ).'">';
		foreach ( $testimonial_list as $testimonial ){
			?>
				<div class="woolentor-grid-item">
					<div class="ht-single-testimonial-wrap">

						<?php if( $settings['testimonialStyle'] === '1' ): ?>
							<?php
								if( !empty( $testimonial['message'] ) ){
									?>
										<div class="ht-client-content ht-client-content-border">
											<p><?php echo esc_html__( $testimonial['message'],'woolentor' ); ?></p>
											<div class="ht-client-rating"><?php woolentorBlocks_ratting( $testimonial['ratting'] );?></div>
										</div>
									<?php
								}
							?>
							<div class="ht-client-info">
								<?php
									if( !empty( $testimonial['image'] ) ){
										echo $testimonial['image'];
									}

									if( !empty( $testimonial['name'] ) ){
										echo '<h4>'.$testimonial['name'].'</h4>';
									}

									if( !empty( $testimonial['designation'] ) ){
										echo '<span>'.$testimonial['designation'].'</span>';
									}
								?>
							</div>

						<?php elseif( $settings['testimonialStyle'] === '2' ): ?>
							<div class="ht-client-info-wrap-2">
								<?php
									if( !empty( $testimonial['image'] ) ){
										echo sprintf( '<div class="ht-client-img-2">%1$s</div>', $testimonial['image'] );
									}
								?>
								<div class="ht-client-info-3">
									<?php
										if( !empty( $testimonial['name'] ) || !empty( $testimonial['designation'] ) ){
											echo sprintf('<h4>%1$s<span>%2$s</span></h4>', $testimonial['name'], $testimonial['designation'] );
										}
										if( !empty( $testimonial['ratting'] ) ){
											echo '<div class="ht-client-rating">';
												woolentorBlocks_ratting( $testimonial['ratting'] );
											echo '</div>';
										}
									?>
								</div>
							</div>
							<?php
								if( !empty( $testimonial['message'] ) ){
									echo  sprintf( '<div class="ht-client-content"><p class="ht-width-dec">%1$s</p></div>', $testimonial['message'] );
								}
							?>

						<?php elseif( $settings['testimonialStyle'] === '3' ): ?>
							<div class="ht-client-info-wrap ht-client-info-border">
								<?php 
									if( !empty( $testimonial['image'] ) ){
										echo sprintf( '<div class="ht-client-img">%1$s</div>', $testimonial['image'] );
									}
								?>
								<div class="ht-client-info-2">
									<?php
										if( !empty( $testimonial['name'] ) ){
											echo '<h4>'.$testimonial['name'].'</h4>';
										}

										if( !empty( $testimonial['designation'] ) ){
											echo '<span>'.$testimonial['designation'].'</span>';
										}

										if( !empty( $testimonial['ratting'] ) ){
											echo '<div class="ht-client-rating">';
												woolentorBlocks_ratting( $testimonial['ratting'] );
											echo '</div>';
										}
									?>
								</div>
							</div>
							<?php
								if( !empty( $testimonial['message'] ) ){
									echo  sprintf( '<div class="ht-client-content"><p>%1$s</p></div>', $testimonial['message'] );
								}
							?>

						<?php else: ?>
							<div class="ht-client-info-wrap-2">
								<?php 
									if( !empty( $testimonial['image'] ) ){
										echo sprintf( '<div class="ht-client-img-2">%1$s</div>', $testimonial['image'] );
									}
								?>
								<div class="ht-client-info-3">
									<?php
										if( !empty( $testimonial['name'] ) || !empty( $testimonial['designation'] ) ){
											echo sprintf('<h4>%1$s<span>%2$s</span></h4>', $testimonial['name'], $testimonial['designation'] );
										}

										if( !empty( $testimonial['ratting'] ) ){
											echo '<div class="ht-client-rating">';
												woolentorBlocks_ratting( $testimonial['ratting'] );
											echo '</div>';
										}
									?>
								</div>
							</div>
							<?php
								if( !empty( $testimonial['message'] ) ){
									echo sprintf( '<div class="ht-client-content"><p>%1$s</p></div>', $testimonial['message'] );
								}
							?>

						<?php endif; ?>

					</div>
				</div>
			<?php
		}
	echo '</div>';
echo '</div>';