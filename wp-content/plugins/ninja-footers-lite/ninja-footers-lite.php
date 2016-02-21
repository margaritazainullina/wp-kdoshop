<?php
/**
@package NinjaFootersLite

Plugin Name: Ninja Footers
Plugin URI: http://www.samurai9design.com/ninja-footers/
Description: A great tool for appending to your posts.

Version: 0.1.6
Author: Samurai 9 Design
Author URI: http://www.samurai9design.com/
License: GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('NINJA_FOOTERS_LITE_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require_once( NINJA_FOOTERS_LITE_PLUGIN_DIR . 'class.NF_Options.php');
require_once( NINJA_FOOTERS_LITE_PLUGIN_DIR . 'class.NF_Settings.php');
require_once( NINJA_FOOTERS_LITE_PLUGIN_DIR . 'class.NF_Footers.php');
require_once( NINJA_FOOTERS_LITE_PLUGIN_DIR . 'class.NF_Page_Settings.php');

if ( ! class_exists( 'Ninja_Footers_Lite' ) ) {

	final class Ninja_Footers_Lite {

		/**
		 * Plugin name
		 * @var string
		*/
		public static $name = 'Ninja Footers';
		
		/**
		 * Plugin version
		 * @var string
		*/
		public static $version = '0.1.6';
			 
		/**
		 * Get plugin name
		 * @return string
		*/
		public static function get_name() {
			return self::$name;
		}

		/**
		 * Get plugin version
		 * @return string
		*/
		public static function get_version() {
			return self::$version;
		}

		/**
		 * Get plugin basename
		 * @return string
		*/
		public static function get_basename() {
			return plugin_basename( __FILE__ );
		}
		
		/**
		 * Class constructor
		 * @return void
		*/
		public function __construct() {
			add_action('plugins_loaded', array($this, 'update_check') );
			$this->init();
		}
		
		/**
		 * Function that initiates the plugin.
		 * @return void
		*/
		private function init() {
			$this->_footers = new NF_Footers();
			$priority_setting = NF_Settings::get('priority');
			if (isset($priority_setting) ) {
				$priority = $priority_setting > 0 ? $priority_setting : 10;
			} else {
				$priority = 10;
			}
			add_filter('the_content', array($this, 'append_content'), $priority );
			add_filter('the_excerpt', array($this, 'append_excerpt'), $priority );
			$page_settings = new NF_Page_Settings($this->_footers);
		}
		
		/**
		 * Function appends the footer to the content.
		 * @params string $content
		 * @return string
		*/
		public function append_content($content) {
			return $this->append_post($content);
		}
		
		/**
		 * Function appends the footer to the excerpt.
		 * @params string $content
		 * @return string
		*/
		public function append_excerpt($content) {
			$append_excerpts = NF_Settings::get('append_excerpts');
			$result = $content;
			if (isset($append_excerpts) ) {
				$result = $append_excerpts ? $this->append_post($content) : $result;
			}
			return $result;
		}
		
		
		/**
		 * Function appends the footer to the post.
		 * @params string $content
		 * @return string
		*/
		private function append_post($content) {
			$settings = NF_Settings::get_all();
			$add = false;
			$footers = $this->_footers->get();
			if ( isset($settings['home_page']) && is_home() ) {
				$add = $settings['home_page'] == 1 ? true : false;
			} 
			if ( isset($settings['front_page']) && is_front_page() ) {
				$add = $settings['front_page'] == 1 ? true : false;
			}
			
			if ( isset($settings['archive_pages']) && is_archive() ) {
				$add = $settings['archive_pages'] == 1 ? true : false;
			}
			
			if (!is_home() && !is_front_page() && !is_archive()) {
				if ( isset($settings['specific_pages']) ) {
					if ($settings['specific_pages'] ) {
						if ( isset($settings['pages']) ) {
							foreach ($settings['pages'] as $page_id) {
								if ($page_id == get_the_ID()) {
									$add = true;
								}
							}
						}
					} else if ( is_page() ) {
						$add = true;
					}
				}
				if ( isset($footers->categories) ) {
					foreach ($footers->categories as $category) {
						if (has_category( $category) ) {
							$add = true;
						}
					}
				}
				
			}
			return $add ? $content . $this->wrap_footer( $footers->content) : $content;
		}
		
		/**
		 * Function to wrap the footer content in a div.
		 * @params string $footer
		 * @return string
		*/
		private function wrap_footer($footer) {
			return '<div class="nf-post-footer">' .  $footer . '</div>';
		}
		
		
		/**
		 * Function that registers the plugin scripts
		 * @return void
		*/
		public static function register_plugin_scripts() {
			wp_register_script( 'ninja-footers_js', plugins_url( '/js/ninja_footers.js', __FILE__ ), array('jquery') );
			wp_register_style( 'ninja_footers_css', plugins_url( '/css/ninja_footers.css', __FILE__ ), array('buttons') );
			add_action( 'admin_enqueue_scripts', array( 'Ninja_Footers_Lite', 'enqueue_plugin_scripts' ) );
		}
		
		/**
		 * Function that enqueue the plugin scripts
		 * @return void
		*/
		public static function enqueue_plugin_scripts() {
			wp_enqueue_script( 'ninja-footers_js' );
			wp_enqueue_style( 'ninja_footers_css' );
		}
		
		/**
		 * Function that checks if the plugin needs updating.
		 * @return void
		*/
		public function update_check() {
			if ( get_site_option( 'ninja_footers_lite_version' ) != self::$version) {
				$this->plugin_update();
			}
		}
		
		private function plugin_update() {
			NF_Settings::init_settings();
			update_option( "ninja_footers_lite_version", self::$version );
		}
	}

}

new Ninja_Footers_Lite();


?>