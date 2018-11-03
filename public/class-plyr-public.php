<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plyr
 * @subpackage Plyr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plyr
 * @subpackage Plyr/public
 * @author     Your Name <email@example.com>
 */
class Plyr_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plyr    The ID of this plugin.
	 */
	private $plyr;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plyr       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plyr, $version ) {

		$this->plyr = $plyr;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plyr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plyr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plyr, 'https://cdn.plyr.io/3.4.5/plyr.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plyr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plyr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plyr, 'https://cdn.plyr.io/3.4.5/plyr.js', array(), $this->version, false );

		wp_enqueue_script( $this->plyr . '-public', plugin_dir_url( __FILE__ ) . 'js/plyr-public.js', array( $this->plyr ), $this->version, false );

	}

	public function embed_oembed_html( $html, $url, $attr, $post_ID ) {

		$args = array();
		include_once ABSPATH . WPINC . '/class-oembed.php';

		$wp_oembed = new WP_oEmbed();

		$provider = $wp_oembed->get_provider( $url );

		if ( !$provider || false === $data = $wp_oembed->fetch( $provider, $url, $args ) )
			return false;

		if ( 'video' !== $data->type )
			return $html;

		if ( !in_array( $data->provider_name, array( 'Vimeo', 'YouTube' ) ) )
			return $html;

		if ( $data->provider_name == 'YouTube' ) {
			$splode = array_reverse( explode('/', $data->thumbnail_url) );

			$video_id = $splode[1];
		} else {
			$video_id = $data->video_id;
		}

		return '<div class="js-plyr" data-plyr-provider="'.strtolower($data->provider_name).'" data-plyr-embed-id="'.$video_id.'"></div>';
	}

}
