<?php
/**
 * Internationalisation (I18n)
 *
 * WP functions to make strings translatable in your application.
 *
 * WordPress uses the gettext libraries and tools for this purpose.
 * Translations should not be considered trusted strings.
 * 'text-domain' can also be added automatically, see `gulp-wp-pot`
 * To add a comment for translators, prefix the comment with 'translators: '
 *
 * @see https://codex.wordpress.org/I18n_for_WordPress_Developers
 * @see http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 * @todo https://www.npmjs.com/package/gulp-wp-pot
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * JS
 * Use wp_localize_script() to add translated strings or other server-side data to a previously enqueued script.
 */

/**
 * String
 * @example
 * 	__('string', 'text-domain')
 */

/**
 * String - Context dependent
 * @example
 * 	_x( 'string', 'noun', 'text-domain' )
 * 	_x( 'string', 'verb', 'text-domain' );
 */

/**
 * String
 * Echoed to the browser
 * @example
 * 	_e('string', 'text-domain')
 */

/**
 * String - Context dependent
 * Echoed to the browser
 * @example
 * 	_ex('string', 'verb', 'text-domain')
 */

/**
 * String - Context dependent + number dependent
 * A hybrid of _n() and _x().
 * @see https://codex.wordpress.org/Function_Reference/_nx
 * @example
 * 	_nx('string_singular', 'string_plural', $variable_count, 'verb', 'text-domain')
 */

/**
 * String - Escaped
 * @example
 * 	esc_html__('string', 'text-domain')
 */

/**
 * String - Escaped + Context dependent
 * @example
 * 	esc_attr_x('string', 'noun', 'text-domain')
 * 	esc_html_x('string', 'verb', 'text-domain')
 */

/**
 * String - Escaped
 * Echoed to the browser
 * @example
 * 	esc_html_e('string', 'text-domain')
 *
 * @example
 * 	<a href="http://wordpress.org/" ><?php esc_html_e( 'string', 'text-domain' ); ?></a>
 */

/**
 * String - format
 * Evaluate single variable
 * @example
 * 	printf(
 * 		esc_html__( 'string1 %d string2.', 'text-domain' ),
 * 		$variable
 * 	);
 */

/**
 * String - format
 * Evaluate multiple variables
 * @example
 * 	printf(
 * 		esc_html__('string1 %1$s string2 %2$s string3.', 'text-domain' ),
 * 		$variable1,
 * 		$variable2
 * 	);
 */

/**
 * String - format - number dependent
 * Evaluate single variable
 * @example
 * 	printf(
 * 		esc_html(
 * 			_n( 'string1 %d string2_singular.', 'string1 %d string2_plural.', $count_variable, 'my-text-domain'  )
 * 		)
 * 	)
 */

/**
 * String - format - mixed with HTML
 * Echoed to the browser safely
 * @see https://codex.wordpress.org/Function_Reference/wp_kses
 * @example
 * 	<p>
 * 	<?php
 * 		$url = 'http://example.com';
 * 		$link = sprintf(
 * 			wp_kses(
 * 				// $string (required)
 * 				__( 'string1 <a href="%s">website</a> string2.', 'text-domain' ),
 * 				// $allowed_html (required)
 * 				array(
 * 					'a' => array(
 * 						'href' => array()
 * 					)
 * 				)
 * 				// $allowed_protocols (optional)
 * 			),
 * 			esc_url( $url )
 * 		);
 * 		echo $link;
 * 	?>
 * 	</p>
 */

/**
 * Using gettext filter to change UI strings in a 3rd party plugin
 * This can also be achieved by adding these to
 * PLUGIN_DOMAIN-en_GB.mo and PLUGIN_DOMAIN-en_GB.po files,
 * (this may require moving these files - see https://www.speakinginbytes.com/2013/10/gettext-filter-wordpress/)
 * in conjunction with setting the default locale.
 *
 * @param $translated_text string
 * @param $text string
 * @param $text_domain string
 *
 * @uses https://www.speakinginbytes.com/2013/10/gettext-filter-wordpress/
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/gettext_with_context
 */

add_filter( 'gettext', 'wpdtrt__text_substitutions', 20, 3 );

function wpdtrt__text_substitutions( $translated_text, $text, $text_domain ) {
	switch ( $translated_text ) {
		case 'Related Products' :
			$translated_text = __( 'Check out these related products', 'PLUGIN_DOMAIN' );
			break;
	}
	return $translated_text;
}

/**
 * Set the default locale
 *
 * @param $default_locale string The locale you wish to use
 * @uses https://stackoverflow.com/questions/27346747/wordpress-4-wplang-deprecated-how-to-change-language-programmatically
 */

add_filter( 'locale', 'wpdtrt__set_locale' );

function wpdtrt__set_locale( $default_locale ) {
    if ( isset( $_SESSION['WPLANG'] ) ) {
    	return $_SESSION['WPLANG'];
    }

    return $default_locale;
};

?>