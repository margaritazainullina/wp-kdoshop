<?php

/**
 * Class for handling the footers
 *
 * @package ShogunFollowers
 */
 
class NF_Settings {
	
	/**
	 * Settings array
	 * @var array
	*/
	private $_settings;
	
	/**
	 * Settings options table
	 * @var string
	*/
	private static $_table = 'settings';
	
	/**
	 * Settings Fields
	 * @var array
	*/	
	private static $_fields = array(
		'home_page' => array(
			'title' => 'Display on Home Page',
			'type' => 'checkbox',
			'value' => 1
		),
		'front_page' => array(
			'title' => 'Display on Front Page',
			'type' => 'checkbox',
			'value' => 1
		),
		'specific_pages' => array(
			'title' => "Display on Certain Pages Only",
			'type' => 'pages',
			'value' => 0
		),
		'archive_pages' => array(
			'title' => "Display on Archived Pages",
			'type' => 'checkbox',
			'value' => 1
		),
		'append_excerpts' => array(
			'title' => "Append to Excerpts",
			'type' => 'checkbox',
			'value' => 1
		),
		'priority' => array(
			'title' => "Priority",
			'type' => 'number',
			'value' => 10
		)
	);

	/**
	 * Class constructor
	 * @return void
	*/
	public function __construct() {
		$this->set_settings();
	}
	
	/**
	 * Update a footer
	 * @return void
	*/	
	private static function update($settings){
		NF_Options::update_option(self::$_table, $settings);
	}
		
	/**
	 * Get the settings
	 * @return void
	*/	
	public static function get_all(){
		return NF_Options::get_option(self::$_table);
	}
	
	/**
	 * Get the settings
	 * @return void
	*/	
	public static function get($field){
		$settings = self::get_all();
		$result = null;
		if (isset(self::$_fields[$field]) ) {
			if (self::$_fields[$field]['type'] == 'checkbox') {
				$result = isset($settings[$field]) ? $settings[$field] : 0;
			} else {
				$result = isset($settings[$field]) ? $settings[$field] : null;
			}
		}
		return $result;
	}
	
	/**
	 * Get the settings fields
	 * @return void
	*/	
	public static function get_fields(){
		self::$_fields['front_page']['title'] = self::$_fields['front_page']['title'] . '<br>(' . get_the_title(get_option('page_on_front')) . ')';
		return self::$_fields;
	}
	
	/**
	 * Set the settings fields
	 * @return void
	*/	
	private function set_settings() {
		$this->_settings = self::get_all();
	}
	
	/**
	 * Initialize the settings.
	 * @return void
	*/	
	public static function init_settings(){
		$settings_to_update = array();
		$settings = self::get_all();
		$fields = self::$_fields;
		$fields['pages'] = array();
		foreach ($fields as $key => $field) {
			if (isset($settings[$key])) {
				$settings_to_update[$key] = $settings[$key]; 
			} else {
				$settings_to_update[$key] = $field['value'];
			}
		}
		self::update($settings_to_update);
		
	}	
	
}