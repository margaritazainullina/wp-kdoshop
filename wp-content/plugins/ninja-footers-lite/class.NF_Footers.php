<?php

/**
 * Class for handling the footers
 *
 * @package ShogunFollowers
 */
 
class NF_Footers {
	
	/**
	 * Footers array
	 * @var object
	*/
	private $_footers;
	

	/**
	 * Class constructor
	 * @return void
	*/
	public function __construct() {
		$this->set_footers();
	}
	
	/**
	 * Update a footer
	 * @return void
	*/	
	public function update($footer){
		$this->_footers = $footer;
		NF_Options::update_option('footers', $this->_footers);
		$this->set_footers();
	}
	
	
	/**
	 * Get a footer
	 * @return void
	*/	
	public function get(){
		return isset($this->_footers) ? $this->_footers : '';
	}
	
	
	/**
	 * Get all the categories
	 * @return void
	*/	
	public function get_all_categories() {
		$results = array();
		foreach ($this->footers[0] as $category) {
			$results[] = $category;
		}
		return array_unique($results);
	}
	
	private function set_footers() {
		$this->_footers = NF_Options::get_option('footers');
	}
	
}