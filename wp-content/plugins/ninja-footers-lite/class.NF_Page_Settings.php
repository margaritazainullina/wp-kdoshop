<?php
class NF_Page_Settings {

	/**
	 * Footers array
	 * @var array
	*/
	private $_footers = array();

	/**
	 * Options name
	 * @var string
	*/	
	private $_table ='ninja-footers-settings';
	
	
    /**
	 * Class constructor
	 * @params array $options
	 * @return void
	*/
	public function __construct($footers) {
		$this->_footers = $footers;
		$this->init();
	}
	
	/**
	 * Initiates init functions.
	 * @return void
	*/
	private function init() {
		$this->addActions();
	}
	
	/**
	 * Initiates the actions.
	 * @return void
	*/
	private function addActions() {
		add_action('admin_menu', array( $this, 'add_menu') );
		add_action('admin_post_nf_save', array($this, 'on_save_changes'));
	}

	/**
	 * Add the plugin menu
	 * @return void
	*/
	public function add_menu() {
		$this->pagehook = add_submenu_page( 'edit.php', 'Ninja Footers', 'Ninja Footers', 'manage_options', 'ninja-footers-settings', array( $this, 'create_page') ); 
		add_action( "load-{$this->pagehook}",  array( $this, 'page_init' ) );
		add_action( 'admin_init', array( $this, 'page_settings' ) );		
	}
	
	/**
	 * Initialize page settings
	 * @return void
	*/
	public function page_init() {
		Ninja_Footers_Lite::register_plugin_scripts();
		$this->set_fields('ninja-footers-settings', 'setting_section_id');
	}
	
	/**
	 * Create the page
	 * @return void
	*/
    public function create_page() {
	?>
        <div id="nf-general" class="wrap">
            <?php  $this->page_content(); ?>
        </div>
        <?php
	}
	
	/**
	 * Create the page content
	 * @return void
	*/
	private function page_content() { ?>
	<h2><?php echo Ninja_Footers_Lite::$name; ?></h2>        
            <form method="post" action="admin-post.php">
			<input type="hidden" name="action" value="nf_save" />
            <?php
				wp_nonce_field('nf-general');
				$this->section_editor();
				
			?>
            </form>
			<p id="nf-settings-title">View Settings</p>
			<div id="nf-settings">
				<form method="post" action="options.php">
				<?php
					$this->section_settings();
				?>
				</form>
			</div>
<?php
	}
	
	/**
	 * Create the editor section
	 * @return void
	*/
	private function section_editor() { ?>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<?php $this->set_editor(); ?>
			</div>
		</div>
<?php
	}

	/**
	 * Create the editor
	 * @return void
	*/	
	private function set_editor() {		
		$this->left_column();
		$this->right_column();
	}
	
	/**
	 * Create the left column
	 * @return void
	*/
	private function left_column() {
		$footers = array();
		?> <div id="post-body-content"> <?php
		$settings = array(
			'textarea_name' => 'nf-editor',
			'media_buttons' => true,
			'textarea_rows' => 8
		);
		
		$footers = $this->_footers->get();
		wp_editor( $footers->content, 'nf-editor', $settings );
		?> </div> <?php
	}
	
	/**
	 * Create the right column
	 * @return void
	*/
	private function right_column() {
		?> 
		<!-- #post-body-content -->
		<div id="postbox-container-1" class="postbox-container">
		<?php
			$this->nf_meta_box_categories();
			submit_button();
		?>
		</div>
		<?php
	}
	
	
	/**
	 * Create the settings section
	 * @return void
	*/
	private function section_settings() { ?>
			<div id="post-body">
				<?php $this->set_settings(); ?>
			</div>
<?php
	}
	
	/**
	 * Create the settings
	 * @return void
	*/	
	private function set_settings() {
		?> <div id="post-body-content" class="nf-settings-content">
				<div class="nf-settings-inside">
		<?php
				settings_fields( 'ninja_footers_option_group' );   
				do_settings_sections( 'ninja-footers-settings' );
				$this->update_button(); 
		?>		</div> 
			</div> <?php
	}
	
	/**
	 * Initialize the page settings
	 * @return void
	*/
	public function page_settings() {
		register_setting(
            'ninja_footers_option_group', // Option group
            $this->_table, // Option name
            array( $this, 'process_settings' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'ninja-footers-settings' // Page
        ); 		
	}
	
	/**
	 * Set the fields for the settings
	 * @params string $page
	 * @params string $section
	 * @return void
	*/	
	private function set_fields($page, $section) {
		foreach (NF_Settings::get_fields() as $id => $field) {
			add_settings_field(
				$id, // ID
				$field['title'], // Title 
				array( $this, 'field_callback' ), // Callback
				$page, // Page
				$section,// Section
				array('id'=> $id, 'type'=> $field['type'])
			);   
		}
	}
	
	/**
	 * Sanitize the input for the message.
	 * @params array $input
	 * @return array
	*/
	public function process_settings($input) {
		$results = array();
		foreach ($input as $field=>$value) {
			if (filter_var($field, FILTER_SANITIZE_STRING) == 'pages') {
				foreach ($input[$field] as $page_id) {
					$results[$field][] = filter_var($page_id, FILTER_SANITIZE_NUMBER_INT);
				}
			} else {
				$results[$field] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
			}
		}
		foreach (NF_Settings::get_fields() as $id => $field) {
			if (!isset($input[$id])) {
				if ($field['type'] == 'checkbox') {
					$results[$id] = 0;
				} else {
					$results[$id] = array();
				}
			}
		}
		return $results;
	}
	
	/**
	 * Print out the settings section info
	 * @return void
	*/
    public function print_section_info() {
    }
	
	/**
	 * Field callback to print the input fields box.
	 * @params array $arg
	 * @return void
	*/	
	public function field_callback(array $arg) {
		$classes = isset($arg['classes']) ? 'class="' . $arg['classes'] . '"' : '';
		$id = $arg['id'];
		$settings = NF_Settings::get_all();
		$checked = '';
		if ($arg['type'] == 'text') {
			printf(
				'<input type="text" '. $classes .' id="'. $id . '" name="' . $this->_table . '[' . $arg['id'] . ']" value="%s" />',
				isset( $settings[$id] ) ? esc_attr( $settings[$id]) : ''
			);
		} elseif ($arg['type'] == 'checkbox' ) {
			if ( isset($settings[$id]) ) {
				$checked =  $settings[$id] == 1 ? ' checked': $checked;
			}
			echo '<input type="checkbox" '. $classes .' id="'. $id . '" name="' . $this->_table . '[' . $id . ']" value="1"' . $checked . ' />';
		} elseif ($arg['type'] == 'pages' ) {
			$pages = isset($settings['pages']) ? $settings['pages'] : array();
			if ( isset($settings[$id]) ) {
				$checked =  count($settings[$id]) > 0 ? ' checked': $checked;
			}
			echo '<input type="checkbox" '. $classes .' id="'. $id . '" name="' . $this->_table . '[' . $id . ']" value="1"' . $checked . ' />';
			echo $this->set_pages($pages);
		} elseif ($arg['type'] == 'number' ) {
			printf(
				'<input type="text" '. $classes .' id="'. $id . '" name="' . $this->_table . '[' . $arg['id'] . ']" value="%s" />',
				isset( $settings[$id] ) ? esc_attr( $settings[$id]) : 10
			);
		}
	}
	
	
	/**
	 * Process and sanitize the input.
	 * @return array
	*/
	public function process_data($input) {
		$results = new stdClass;
		$results->content =  wp_kses_post( stripslashes($input['nf-editor']) );
		if (isset($input['post_category'])) {
			foreach ($input['post_category'] as $category) {
				$results->categories[] = filter_var($category, FILTER_SANITIZE_NUMBER_INT);
			}
		}
		return $results;
	}
	
	/**
	 * Meta box categories function
	 * @return void
	*/
	public function nf_meta_box_categories() {
		add_meta_box('nf-categories', _('Categories'), array($this, 'nf_meta_box_categories_callback'), $this->pagehook, 'side', 'core');
		do_meta_boxes($this->pagehook, 'side', '');
	}

	/**
	 * Meta box callback function
	 * @return void
	*/
	public function nf_meta_box_categories_callback() {
		echo '<ul id="categorychecklist" class="categorychecklist">';
		echo $this->set_categories();
		echo '</ul>';
	}
	
	/**
	 * Update button function
	 * @return void
	*/
	
	private function update_button() {
		echo '<button type="submit" id="update_settings" name="update_settings" class="button button-primary">' . _('Update Settings') . '</button>';
	}

	/**
	 * Save the changes when the post data is submitted.
	 * @return void
	*/	
	public function on_save_changes() {
		if ( !current_user_can('manage_options') )
			wp_die( __('Cheatin&#8217; uh?') );			
		check_admin_referer('nf-general');
		$this->_footers->update($this->process_data($_POST));
		wp_redirect($_POST['_wp_http_referer']);		
	}
	
	/**
	 * Set the list of categories
	 * @return string
	*/
	private function set_categories() {
		$result = '';
		$footers= $this->_footers->get();
		foreach (get_categories(array('hide_empty'=>0)) as $category) {
			$checked = '';
			if (isset($footers->categories)) {
				foreach ($footers->categories as $checked_cat) {
					$checked = $checked_cat == $category->term_id ? ' checked': $checked;
				}
			}
			$result .= '<li id="category-' . $category->term_id . '" class="popular-category"><label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="post_category[]" id="in-category-' . $category->term_id . '"' . $checked . '>' . $category->name . '</label></li>';			
		}
		return $result;
	}
	
	/**
	 * Set the list of pages
	 * @return string
	*/
	private function set_pages($pages) {
		$result = '<div id="select_pages">';
		$result .= '<ul id="pagechecklist" class="pagechecklist">';
		$checked_pages = $pages;
		$frontpage_id = get_option('page_on_front');
		foreach (get_pages() as $page) {
			$checked = '';
			if (isset($checked_pages)) {
				foreach ($checked_pages as $checked_page) {
					$checked = $checked_page == $page->ID ? ' checked': $checked;
				}
			}
			if ($page->ID != get_option('page_on_front')) {
				$result .= '<li id="page-' . $page->ID . '" class="popular-page"><label class="selectit"><input value="' . $page->ID . '" type="checkbox" name="' . $this->_table . '[pages][]" id="in-page-' . $page->ID . '"' . $checked . '>' . $page->post_title . '</label></li>';
			}
		}
		$result .= '</ul>';
		$result .= '</div>';
		return $result;
	}
	
	
	
}