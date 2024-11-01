<?php
/**
 * Plugin Name:       Testimonial Carousel Block
 * Plugin URI:        https://github.com/ariful93/testimonial-carousel-block
 * Description:       Testimonials Carousel Block allows you to add a testimonials carousel block to your WordPress content via the block editor.
 * Author:            WPFound
 * Author URI         https://github.com/ariful93
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.2
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       testimonial-carousel-block
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets, so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPFound_Testimonial_Carousel_Gutenberg_Block class.
 *
 * @class WPFound_Testimonial_Carousel_Gutenberg_Block The class that holds the entire WPFound_Testimonial_Carousel_Gutenberg_Block plugin.
 */
class WPFound_Testimonial_Carousel_Gutenberg_Block {

    /**
     * Singleton pattern
     *
     * @var bool $instance
     */
    private static $instance = false;

    /**
     * Initializes the WPFound_Testimonial_Carousel_Gutenberg_Block class.
     *
     * Checks for an existing WPFound_Testimonial_Carousel_Gutenberg_Block instance
     * and if it can't find one, then creates it.
     *
     * @since 1.0.0
     *
     * @return self
     */
    public static function init() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor for the WPFound_Testimonial_Carousel_Gutenberg_Block class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @return void
     */
    public function __construct() {
        $this->includes(); // includes
    }

    /**
     * Load all includes file
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function includes() {
        add_action( 'init', array( $this, 'testimonial_carousel_block_register_init' ) );
    }

    /**
     * Register gutenberg blocks.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function testimonial_carousel_sub_block_register( $name, $options = array() ) {
        register_block_type( __DIR__ . '/build/' . $name, $options );
    }

    /**
     * Initialize blocks registration.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function testimonial_carousel_block_register_init() {
        $this->testimonial_carousel_sub_block_register( 'testimonial-carousel' );
    }
}

/**
 * Init the team member for gutenberg plugin.
 *
 * @return WPFound_Testimonial_Carousel_Gutenberg_Block the plugin object
 */
function wpfound_testimonial_carousel_gutenberg_block() {
    return WPFound_Testimonial_Carousel_Gutenberg_Block::init();
}

wpfound_testimonial_carousel_gutenberg_block();