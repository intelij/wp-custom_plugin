<?php
	
add_shortcode('ksm_participants', function() {

	$loop = new WP_Query (
		array(
			'post_type' => 'ksm_participants',
			'posts_per_page' => -1,
			'orderby' => 'rand'
		)
	);
	
	
	
	if ($loop->have_posts()) {
		
		$output = '<ul class="ksm_participants">';
		
		while ( $loop->have_posts()) {
			$loop->the_post();
			$meta = get_post_meta(get_the_id());
			// echo "</pre>", var_dump($meta), "</pre>";
			$output .= '
			
					<li>
					<a href="'. $meta['ksm_participants_url'][0] .'"  target="_blank">
					' . get_the_post_thumbnail() . '
					</a>
					</li>
					
					'; 
		}
		
		$output .= '</ul>';
	}
	
	return $output;
	
});


