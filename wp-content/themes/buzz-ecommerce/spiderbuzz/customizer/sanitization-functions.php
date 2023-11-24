<?php
/**
 * Sanitization Functions
 * 
 * @package buzz ecommerce
 */
 
/**
 * Sanitize html fields
*/
function buzz_ecommerce_sanitize_html_files( $input ){
    // Boolean check.
    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'iframe' => array()
    );
     
    return wp_kses($input, $allowed_html); 
    
}

/**
 * Sanitize callback for checkbox
*/
function buzz_ecommerce_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize callback for select
*/
function buzz_ecommerce_sanitize_select( $value ){
    if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = esc_attr( $subvalue );
		}
		return $value;
	}
	return esc_attr( $value );
}

function buzz_ecommerce_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );                                                            
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function buzz_ecommerce_sanitize_number_floatval( $number, $setting ) {
    // Ensure $number is an floatval.
    $number = floatval( $number );                                                          
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}
 
function buzz_ecommerce_sanitize_image( $image, $setting ) {
    /*
     * Array of valid image file types.
     *
     * The array includes image mime types that are included in wp_get_mime_types()
     */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : '' );
}

function buzz_ecommerce_sanitize_multiple_check( $value ) {                        
    $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
    return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();    
}

function buzz_ecommerce_sanitize_sortable( $value = array() ) {
	if ( is_string( $value ) || is_numeric( $value ) ) {
		return array(
			esc_attr( $value ),
		);
	}
	$sanitized_value = array();
	foreach ( $value as $sub_value ) {
		$sanitized_value[] = esc_attr( $sub_value );
	}
	return $sanitized_value;
}


/**
 * repeator field sanitization
*/
function buzz_ecommerce_store_sanitize_repeater($input){        
    $input_decoded = json_decode( $input, true );
    $allowed_html = array(
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'a' => array(
            'href' => array(),
            'class' => array(),
            'id' => array(),
            'target' => array()
        ),
        'button' => array(
            'class' => array(),
            'id' => array()
        )
    ); 

    if(!empty($input_decoded)) {
        foreach ($input_decoded as $boxes => $box ){
            foreach ($box as $key => $value){
            $input_decoded[$boxes][$key] = sanitize_text_field( $value );
            }
        }
        return json_encode($input_decoded);
    }      
    return $input;
}

//Radio Button
function buzz_ecommerce_sanitize_radio( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}