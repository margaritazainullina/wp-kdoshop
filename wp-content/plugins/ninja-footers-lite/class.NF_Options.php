<?php

/**
 * Class for handling the options
 *
 * @package ShogunFollowers
 */
 
class NF_Options {

	/**
	 * Options prefix
	 * @var string
	*/
	private static $prefix = 'ninja-footers-';
	
	/**
	 * Options array
	 * @var array
	*/
	public static $options = array(
		'footers'
	);
	
	/**
	 * Footers array
	 * @var array
	*/
	public $footers;
	

	/**
	 * Class constructor
	 * @return void
	*/
	public function __construct() {
		$this->get_options();
	}
	
	/**
	 * Get all the options.
	 * @return void
	*/
	private function get_options() {
		foreach (self::$options as $option) {
			$this->{$option} = self::get_option( $option );
		}
	}
	
	/**
	 * Get all the options.
	 * @return void
	*/
	public static function get_option($option) {
			return get_option( self::$prefix . $option );
	}

	/**
	 * Reset all the options.
	 * @return void
	*/	
	public function reset() {
		foreach (self::$options as $option) {
			unset( $this->{$option} );
		}
		$this->get_options();
	}
	
	public static function update_option($name, $value) {
		update_option(self::$prefix . $name, $value);
	}
	
	/**
	 * Update the options.
	 * @params array $fields
	 * @return void
	*/	
	public function commit_options($fields = array()) {
		foreach ($fields as $field) {
			self::update_option($field, $this->{$field});
		}
	}

	
	/**
	 * Delete all the options
	 * @return void
	*/	
	public static function delete_all_options() {
		foreach (self::$options as $option) {
			delete_option(self::$prefix . $option['name']);
		}
	}
	
}