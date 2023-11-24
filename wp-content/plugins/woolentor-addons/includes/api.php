<?php
if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class Woolentor_Api{

    /**
     * Define nessesary variables
     */
    const NEWS_FEED_OPTION_KEY = 'woolentor_info_news_feed_data';
	const TRANSIENT_KEY_PREFIX = 'woolentor_info_api_data';

    /**
     * Info API URL
     */
    public static $api_url = 'https://library.shoplentor.com/wp-json/woolentor/v1/info';

    /**
     * Get API data
     */
    private static function get_info_data( $force_update = false ) {
		$cache_key = self::TRANSIENT_KEY_PREFIX;

		$info_data = get_transient( $cache_key );

		if ( $force_update || false === $info_data ) {
			$timeout = ( $force_update ) ? 25 : 8;

			$response = wp_remote_get( self::$api_url, [
				'timeout' => $timeout,
				'body' => [
					'api_version' => WOOLENTOR_VERSION,
					'site_lang' => get_bloginfo( 'language' ),
				],
			] );

			if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
				set_transient( $cache_key, [], 2 * HOUR_IN_SECONDS );
				return false;
			}

			$info_data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $info_data ) || ! is_array( $info_data ) ) {
				set_transient( $cache_key, [], 2 * HOUR_IN_SECONDS );
				return false;
			}

			if ( isset( $info_data['info'] ) ) {
				update_option( self::NEWS_FEED_OPTION_KEY, $info_data['info'], 'no' );
				unset( $info_data['info'] );
			}

			set_transient( $cache_key, $info_data, 2 * (24 * HOUR_IN_SECONDS) );
		}

		return $info_data;
	}

    /**
	 * Get news feed data.
	 * Retrieve the feed info data from remote woolentor server.
	 *
	 * @param bool $force_update Optional. Whether to force the data update.
	 * @return array News Feed data.
	 */
	public static function get_remote_data( $force_update = false ) {
		self::get_info_data( $force_update );
		$feed = get_option( self::NEWS_FEED_OPTION_KEY );
        return empty( $feed ) ? [] : $feed;
	}

}