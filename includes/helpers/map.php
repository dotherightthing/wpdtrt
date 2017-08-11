<?php
/**
 * Map Embed
 *
 * Uses ACF Google Map field to set marker and viewport.
 * Uses Leaflet to embed interactive map.
 *
 * @package DTRT Framework - Theme
 * @subpackage DTRT Framework - Theme Functions
 * @since 0.1.0
 * @version 0.1.0
 *
 * @see http://leafletjs.com/examples/quick-start/
 * @see https://stackoverflow.com/a/23663848/6850747
 * @todo create a plugin, to populate wpdtrt_acf_google_map_api and mapbox_api_token
 */

if ( ! function_exists('wpdtrt_acf_google_map_api') ) {

	add_filter('acf/fields/google_map/api', 'wpdtrt_acf_google_map_api');

	function wpdtrt_acf_google_map_api( $api ){

		$api['key'] = 'AIzaSyAGMTUqI6dPWoP4u9JeqCh7gmNUzKqBArU'; // Hands Of Light

		return $api;

	}
}

/**
 * Load CSS
 *
 * wp_enqueue_scripts + enqueue_style can't be used here
 * as SRI integrity metadata isn't currently supported by WP
 * Subresource Integrity Hashes "defines a mechanism by which user agents may verify
 *  that a fetched resource has been delivered without unexpected manipulation."
 * @see https://www.w3.org/TR/SRI/
 * @see https://core.trac.wordpress.org/ticket/22249
 */

if ( ! function_exists('wpdtrt_map_css') ) {

	//add_action( 'wp_enqueue_scripts', 'wpdtrt_leaflet_css' );
	add_action( 'wp_head', 'wpdtrt_map_css' );

	function wpdtrt_map_css() {

		$acf_map = get_field('wpdtrt_acf_page_map');

		if ( ! $acf_map ) {
			return;
		}

		// "Include Leaflet CSS file in the head section of your document:"
		$style = '';
		$style .= '<link';
		$style .= ' rel="stylesheet"';
		$style .= ' href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"';
		$style .= ' integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="';
		$style .= ' crossorigin=""';
		//$style .= ' ver=""';
		$style .= ' />';

		echo $style;
	}

}

/**
 * Load JS
 *
 * wp_enqueue_scripts + wp_enqueue_script can't be used here
 * as SRI integrity metadata isn't currently supported by WP
 * Subresource Integrity Hashes "defines a mechanism by which user agents may verify
 *  that a fetched resource has been delivered without unexpected manipulation."
 * @see https://www.w3.org/TR/SRI/
 * @see https://core.trac.wordpress.org/ticket/22249
 * @see https://www.advancedcustomfields.com/resources/google-map/
 */

if ( ! function_exists('wpdtrt_map_js') ) {

	//add_action( 'wp_enqueue_scripts', 'wpdtrt_leaflet_css' );
	add_action( 'wp_footer', 'wpdtrt_map_js' );

	function wpdtrt_map_js() {

		/**
		 * ACF's Google Map field type supports geocoding
		 * so entering an address there will generate
		 * latitide and longitude
		 * @see https://stackoverflow.com/questions/27186167/set-view-for-an-array-of-addressesno-coordinates-using-leaflet-js
		 * @see https://www.advancedcustomfields.com/resources/google-map/
		 */
		$acf_map = get_field('wpdtrt_acf_page_map');

		if ( ! $acf_map ) {
			return;
		}

		// https://www.mapbox.com/studio/account/tokens/
		$mapbox_api_token = 'pk.eyJ1IjoiZG90aGVyaWdodHRoaW5nbnoiLCJhIjoiY2o2NmhuMXN5MGI5ZDJ4cWF2MTJkcWhlcSJ9.D8h1TOJEY25i8B8ruDmvjg';

		//wpdtrt_log( $acf_map );
		$coordinates = $acf_map['lat'] . ', ' . $acf_map['lng'];
		$address = $acf_map['address'];

		// "Include Leaflet JavaScript file after Leaflet’s CSS"
		$script = '';
		$script .= '<script';
		$script .= ' src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"';
		$script .= ' integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="';
		$script .= ' crossorigin=""';
		$script .= '>';
		$script .= '</script>';

		$script .= '<script>';
		$script .= 'var mymap = L.map("wpdtrt-map-1", { zoomControl: false }).setView([' . $coordinates . '], 16);';

		$script .= 'L.tileLayer("https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}", {';
		$script .= 'attribution: "Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>",';
		//$script .= 'maxZoom: 18,';
		$script .= 'id: "mapbox.streets",';
		$script .= 'accessToken: "' . $mapbox_api_token . '"';
		$script .= '}).addTo(mymap);';

		$script .= 'var marker = L.marker([' . $coordinates . ']).addTo(mymap);';

		// http://leafletjs.com/examples/choropleth/
		$script .= 'var legend = L.control({ position: "topleft" });';
		$script .= 'legend.onAdd = function (map) {';
		// tagname:div, classname:info legend
    	$script .= 'var div = L.DomUtil.create("div", "wpdtrt-map-legend");';
    	$script .= 'div.innerHTML = "' . $address . '";';
    	$script .= 'return div;';
    	$script .= '};';
    	$script .= 'legend.addTo(mymap);';

		// https://www.mapbox.com/mapbox.js/example/v1.0.0/change-zoom-control-location/
		$script .= 'new L.Control.Zoom({ position: "bottomleft" }).addTo(mymap);';

		$script .= '</script>';

		echo $script;
	}

}

/**
 * Map Shortcode
 *
 * @since 0.1.0
 * @version 0.1.0
 */

if ( ! function_exists('wpdtrt_map_shortcode') ) {

  function wpdtrt_map_shortcode( $user_atts ) {

		$acf_map = get_field('wpdtrt_acf_page_map');

		if ( ! $acf_map ) {
			return;
		}

		$atts = shortcode_atts( array(
	        'id' => '1',
	        'link-text' => 'View Larger Map'
	    ), $user_atts );

		$coordinates = $acf_map['lat'] . ', ' . $acf_map['lng'];

		$html = '';
		$html .= '<div class="wpdtrt-map">';
		$html .= '<div id="wpdtrt-map-' . $atts['id'] . '" class="wpdtrt-map-embed"></div>';

		if ( $atts['link-text'] !== '' ) {
			$html .= '<p class="wpdtrt-map-link">';
			$html .= '<a href="//maps.google.com/maps/place/' . $coordinates . '">' . $atts['link-text'] . '</a>';
			$html .= '</p>';
		}

	$html .= '</div>';

    return $html;
  }

  add_shortcode( 'wpdtrt-map', 'wpdtrt_map_shortcode' );
}

?>