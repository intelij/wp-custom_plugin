<?php
/*
Plugin Name: Participants
Description: Allows registered users to submit images.
Version: 1.0
Plugin URI: www.thinkjam.com
Author: Khululekani Mkhonza
Author URI: www.thinkjam.com

*/


class KSM_Participants {
	public function __construct() {
		$this->register_post_type();
		$this->metaboxes();
	}
	
		public function register_post_type() {
			$args = array(
				'labels' => array(
						'name' => 'Participants',
						'singular_name' => 'Participant',
						'add_new' => 'Add New Participant',
						'add_new_item' => 'Add New Participant',
						'edit_item'	=> 'Edit Participants',
						'view_item' => 'View Participants',
						'search_items' => 'Search Participants',
						'not_found' => 'No Participants Found',
						'not_found_in_trash' => 'No Participants Found in Trash'	
				),
				'query_var' => 'participants',
				'rewrite' => array(
					'slug' => 'participants/',
				),
				'public' => true,
				'menu_position' => 5,
				'menu_icon' => admin_url() . 'images/media-button-other.gif',
				'supports' => array(
					'title',
					'thumbnail',
					'excerpt',
					// 'custom-fields'
				),
				
				
				
				
			);
			
		register_post_type('ksm_participants', $args);
		
		}
		
		public function metaboxes() 
		{
			add_action('add_meta_boxes', function () {
				//css id, title, cb function, page, priority,
				add_meta_box('ksm_participants_url', 'Participant URL', 'participant_url', 'ksm_participants');
			});
			
			
			function participant_url($post) { 
				$length = get_post_meta($post->ID, 'ksm_participants_url', true);
				?>
				<p>
					<label for="ksm_participants_url">Participant URL</label>
					<input type="text" class="widefat" name="ksm_participants_url" id="ksm_participants_url" value="<? echo esc_attr($length);?>" />
				</p>
				<?php
				
			}
			
			add_action('save_post', function($id){
				if ( isset($_POST['ksm_participants_url']) ) {
					update_post_meta($id, 'ksm_participants_url', strip_tags($_POST['ksm_participants_url']));										
				}
			});
			
		}
	
	
	 
}

add_action('init', function() {
	new KSM_Participants();
	include dirname(__FILE__) . '/participants_shortcode.php';
});