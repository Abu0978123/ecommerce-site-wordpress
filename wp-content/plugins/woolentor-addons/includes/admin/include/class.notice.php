<?php  
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woolentor_Admin_Notice{

	/**
	 * [$instance]
	 * @var null
	 */
	private static $instance = null;

	/**
	 * [instance]
	 * @return [Woolentor_Admin_Notice]
	 */
    public static function instance(){
        if( is_null( self::$instance ) ){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * [__construct]
     */
    public function __construct(){
        add_action(	'admin_footer', [ $this, 'enqueue_scripts' ], 999 );
		add_action( 'wp_ajax_woolentor_notices', [ $this, 'ajax_dismiss' ] );
    }

    /**
	 * Ajax Action for Notice dismiss
	 *
	 * @return void
	 */
	public function ajax_dismiss() {

        $nonce = !empty( $_POST['notice_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['notice_nonce'] ) ) : '';

		if( !wp_verify_nonce( $nonce, 'woolentor_notice_nonce') ) {
            $error_message = [
                'message'  => __('Are you cheating?','woolentor')
            ];
            wp_send_json_error( $error_message );
		}

		$notice_id   = ( isset( $_POST['noticeid'] ) ) ? sanitize_key( $_POST['noticeid'] ) : '';
		$expire_time = ( isset( $_POST['expiretime'] ) ) ? sanitize_text_field( wp_unslash( $_POST['expiretime'] ) ) : '';
		$close_by    = ( isset( $_POST['closeby'] ) ) ? sanitize_key( $_POST['closeby'] ) : '';

		if ( ! empty( $notice_id ) ) {

			if ( 'user' === $close_by ) {
				update_user_meta( get_current_user_id(), $notice_id, true );
			} else {
				set_transient( $notice_id, true, $expire_time );
			}

			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Script
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		$styles = ".woolentor-admin-notice.promo-banner {
			position: relative;
			padding-top: 20px !important;
			padding-right: 40px;
		}
		.woolentor-admin-notice.notice img{
			width: 100%;
		}";

        $scripts = "jQuery(document).ready( function($) {
			$( '.woolentor-admin-notice.is-dismissible' ).on( 'click', '.notice-dismiss', function(e) {
				let noticeWrap = $( this ).parents( '.woolentor-admin-notice' ),
					noticeId = noticeWrap.attr( 'id' ) || '',
					expireTime = noticeWrap.attr( 'expire-time' ) || '',
					closeBy = noticeWrap.attr( 'close-by' ) || '',
					noticeNonce = '".esc_html( wp_create_nonce( 'woolentor_notice_nonce' ) )."';
		
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action 	: 'woolentor_notices',
						noticeid: noticeId,
						closeby : closeBy,
						expiretime : expireTime,
						notice_nonce: noticeNonce
					},
					success: function( response ) {
						noticeWrap.css('display','none');
					},
					complete: function( response ){
						noticeWrap.css('display','none');
					}
				});
		
			});
		});";
		
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<style>%s</style>', $styles );
		printf( '<script>%s</script>', $scripts );
	}

	/**
	 * Add Notices
	 *
	 * @param [type] $notice
	 * @return void
	 */
	public static function add_notice( $notice_data ) {

		$defaults = [
			'id'            => '',
			'type'          => 'info',
			'dismissible'   => false,
			'close_by' 		=> 'user',
			'expire_time'	=> WEEK_IN_SECONDS,
			'is_show'		=> true,
			'data'          => '',
			'message'       => '',
			'button'		=> [],
			'banner'		=> [],
			'dismissible_btn'=> ''
		];
		$notice = wp_parse_args( $notice_data, $defaults );

		$classes = [ 'woolentor-admin-notice' ];

		if ( isset( $notice['type'] ) ) {
			$classes[] = 'notice-' . $notice['type'];
			if( $notice['type'] !== 'custom'){
				$classes[] = 'notice';
			}else{
				$notice['dismissible_btn'] = '<button type="button" class="notice-dismiss"><span class="screen-reader-text">'.esc_html__('Dismiss this notice.','woolentor').'</span></button>';
			}
		}

		if( !empty( $notice['banner'] ) ){
			$classes[] = 'promo-banner';
		}

		// If notice is dismissible then add "is-dismissible" class.
		if ( true === $notice['dismissible'] ) {
			$classes[] 		= 'is-dismissible';
			$notice['data'] = ' expire-time=' . esc_attr( $notice['expire_time'] ) . ' ';
		}

		
		$notice['id'] = 'woolentor-admin-notice-id-' . $notice['id'];
		$notice['classes'] = implode( ' ', $classes );
		$notice['data'] .= ' close-by=' . esc_attr( $notice['close_by'] ) . ' ';

		// Check close by
		if ( 'user' === $notice['close_by'] ) {
			$expired = get_user_meta( get_current_user_id(), $notice['id'], true );
		} elseif ( 'transient' === $notice['close_by'] ) {
			$expired = get_transient( $notice['id'] );
		}

		// Check Notice visible condition.
		if ( isset( $notice['is_show'] ) ) {
			if ( true === $notice['is_show'] ) {
				if ( false === $expired || empty( $expired ) ) {
					self::html( $notice );
				}
			}
		}



	}

	/**
	 * Gerenare Notice HTML
	 *
	 * @param array $notice_arg
	 * @return void
	 */
	public static function html( $notice_arg = [] ){
		?>
			<div id="<?php echo esc_attr( $notice_arg['id'] ); ?>" class="<?php echo esc_attr( $notice_arg['classes'] ); ?>" <?php self::render_attribute($notice_arg['data']); ?>>
				<?php
					// Notice Image
					if( !empty( $notice_arg['banner'] ) ){
						printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $notice_arg['banner']['url'] ), $notice_arg['banner']['image'] );
					}

					// Notice Message
					printf('<p>%1$s</p>', __( $notice_arg['message'] ) );

					// If notice type custom and dismissible true
					if ( true === $notice_arg['dismissible'] ) {
						printf('%1$s', __( $notice_arg['dismissible_btn'] ) );
					}

					// Notice Action Button
					if( !empty( $notice_arg['button'] ) ){
						printf('<p><a href="%1$s" class="button-primary">%2$s</a></p>', esc_url( $notice_arg['button']['url'] ), esc_html( $notice_arg['button']['text'] ) );
					}
				?>
			</div>
		<?php
	}

	/**
	 * Data Attribute Render
	 *
	 * @param [type] $data
	 * @return void
	 */
	public static function render_attribute( $data ){
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $data;
	}

}

Woolentor_Admin_Notice::instance();