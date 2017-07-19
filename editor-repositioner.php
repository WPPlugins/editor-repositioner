<?php
/*
Plugin Name: Editor Repositioner
Plugin URI: http://press12.com/plugins/editor-repositioner
Description: Places the backend post editor inside a metabox, allowing you to collapse and reposition it!
Version: 1.0.2
Author: Press12.com
Author URI: https://press12.com
License: GPL2
*/
?>
<?php /*================================================================================
| editor-repositioner.php
|
| Created by: 	Carlos Ramos
| Twitter: 		@OMGCarlos https://twitter.com/#!/omgcarlos
| Portfolio: 	http://press12.com
| @since 		1.0.0
| @package 		WordPress	
================================================================================*/
	include plugin_dir_path(__FILE__) . 'options.php';	//The options page

	/*================================================================================
	| Main Class
	|
	| @since	1.0.0
	================================================================================*/
	class P12EditorRepositioner {
		/*================================================================================
		| p12_editor_metabox
		|
		| @since	1.0.0
		|
		| Remove the editor from all post-types, and recreate it inside a metabox
		================================================================================*/
		function metabox(){
			/*================================================================================
			| Unset the default editor in each post type, then create a metabox for it
			================================================================================*/
			global $_wp_post_type_features;
			foreach(get_post_types() as $key => $postType){
				global $post;

				/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
				| Only attempt to remove editor if we are in the correct post type, is not
				| blacklisted, AND is in supported by the post type
				- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
				if( $post->post_type === $postType && isset($_wp_post_type_features[$postType]['editor']) && $_wp_post_type_features[$postType]['editor']){
					unset($_wp_post_type_features[$postType]['editor']);
					add_meta_box(
						'p12-metabox-editor-'.$key,	//Make sure each one is unique incase another plugin adds extra editors!
						get_option('p12-editor-repositioner-label'),	//Use the defined label
						array( 'P12EditorRepositioner', 'readd_editor'),
						$postType, 'normal', 'high'
					);
				}
			}
		}

		/*================================================================================
		| Re-add the editor
		|
		| @since 	1.0.0
		================================================================================*/
		function readd_editor($post){
			wp_nonce_field('b4gsSG2iC3AqAleE', 'p12-metabox-editor');
			wp_editor($post->post_content, 'thecontent');
		}

		/*================================================================================
		| Save the post content
		|
		| @since	1.0.0
		| 
		| @param 	INTEGER 	$postID 	$postID === $post->ID
		================================================================================*/
		function save($data){
			global $post;

			/*================================================================================
			| Authenticate
			================================================================================*/
			if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $data;
			if( !isset($_POST['p12-metabox-editor']) || !wp_verify_nonce( $_POST['p12-metabox-editor'], 'b4gsSG2iC3AqAleE')) return $data;
			if( $post->post_type == 'revision') return $data;

			$data['post_content'] = $_POST['thecontent'];
			return $data;
		}



		/*############################################################################################################################################################*/



		/*================================================================================
		| Activation
		|
		| @since	1.0.0
		================================================================================*/
		function activate() { 
			/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			| Create the metabox label option with the default value
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			update_option( 'p12-editor-repositioner-label', __('Content') );

			/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			| Create a temporary option variable to display message, then delete it
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			update_option( 'p12-editor-repositioner-activated', true);
		}

		/*================================================================================
		| Admin Notices
		|
		| @since	1.0.0
		================================================================================*/
		function admin_notices(){
			/*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			| Activated
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
			if( get_option( 'p12-editor-repositioner-activated' ) ) {
				echo '<div class="updated"><p>'.__('Thank you for installing the <b>Editor Repositioner</b> plugin by <a href="http://press12.com">Press12.com</a>!').'</p></div>';
				delete_option( 'p12-editor-repositioner-activated' );
			}
		}


		/*================================================================================
		| Deactivation: Remove all options
		|
		| @since	1.0.0
		================================================================================*/
		function deactivate() { 
			delete_option('p12-editor-repositioner-deactivated');
			delete_option('p12-editor-repositioner-activated');
			delete_option('p12-editor-repositioner-label');
		}


		/*================================================================================
		| Settings Link
		|
		| @since	1.0.0
		================================================================================*/
		function settings($links){
			$settings = '<a href="' . get_bloginfo('url') . '/wp-admin/options-general.php?page=editor-repositioner.php">Settings</a>';
			array_unshift($links, $settings);
			return $links;
		}
	}

	/*================================================================================
	| Actions, Filters, and Hooks
	================================================================================*/
	add_action( 'add_meta_boxes', array( 'P12EditorRepositioner', 'metabox'), 5 );
	add_action( 'admin_notices', array( 'P12EditorRepositioner', 'admin_notices' ) );
	add_action( 'wp_insert_post_data', array( 'P12EditorRepositioner', 'save' ), '10', 2 );
	add_action( 'admin_menu', array( 'P12EditorRepositioner_Options', 'register') );

	$plugin = plugin_basename(__FILE__);
	add_filter( "plugin_action_links_$plugin", array('P12EditorRepositioner', 'settings') );

	register_activation_hook( __FILE__, array( 'P12EditorRepositioner', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'P12EditorRepositioner', 'deactivate' ) );	
?>