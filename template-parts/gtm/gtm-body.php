<?php
/**
 * Include this partial immediately after the opening <body> tag.
 * The <head> portion is loaded in js.php
 *
 * @package WPDTRT
 * @subpackage WPDTRT Templates
 * @since 0.1.0
 * @version 0.1.0
 * @see http://kb.dotherightthing.dan/seo/google-tag-manager-gtm/
 */

?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php the_field( 'wpdtrt_acf_gtm_container_id', 'option' ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
