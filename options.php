<?php /*================================================================================
| options.php
|
| Created by: 	Carlos Ramos
| Twitter: 		@OMGCarlos https://twitter.com/#!/omgcarlos
| Portfolio: 	http://press12.com
| @since  		1.0.0
| @package  	WordPress
|
| Sets up the options page
================================================================================*/ 

	/*================================================================================
	| Settings Class
	|
	| @since	1.0.0
	================================================================================*/
	class P12EditorRepositioner_Options {
		/*================================================================================
		| Register the settings page
		|
		| @since	1.0.0
		================================================================================*/
		function register(){
			add_options_page( 'Editor Repositioner Settings', 'Editor Repositioner', 'manage_options', 'editor-repositioner', array('P12EditorRepositioner_Options', 'display') );
		}



		/*================================================================================
		| Display the settings page
		|
		| @since	1.0.0
		================================================================================*/
		function display(){
			if ( !current_user_can( 'manage_options' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}

			/*================================================================================
			| Save the form
			================================================================================*/
			if(isset($_POST['updated']) && $_POST['updated'] === 'true'){
				$label = $_POST['globalName'];
				update_option('p12-editor-repositioner-label', $label);
			}

			/*================================================================================
			| Show update message
			|
			| @since	1.0.1
			================================================================================*/
			if( isset($_POST['updated']) && $_POST['updated'] == true ){
				?>
					<div id="message" class="updated">
				        <p>
					        <?php echo __('Settings updated. Editor Metabox will now be called: ') . '<b>' . $_POST['globalName'] . '</b>'; ?>
				        </p>
				    </div>
    			<?php
			}

			/*================================================================================
			| Create the form
			================================================================================*/
			?>
				<div class="wrap">
					<div id="icon-options-general" class="icon32"><br></div>
					<h2>Editor Repositioner by <a href="http://press12.com">Press12</a></h2>
					<br>

					<form name="editor-repositioner-settings" method="post">
						<?php wp_nonce_field('eN>Un5i;nLxsB.Hb', 'p12'); ?>
						<input type="hidden" name="updated" value="true">
						
						<table class="form-table">
							<tbody>
								<tr valign="top">
									<th scope="row"><label for="globalName"><?php _e('Global Title:'); ?></label></th>
									<td>
										<input type="text" name="globalName" class="regular-text" value="<?php echo esc_textarea(get_option('p12-editor-repositioner-label')); ?>">
										<p class="description"><?php _e('The title to use for the metabox, leave empty for default "Content"'); ?></p>
									</td>
								</tr>
							</tbody>
						</table>
						
						<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"></p>
					</form>
				</div>
			<?php
		}
	}
?>