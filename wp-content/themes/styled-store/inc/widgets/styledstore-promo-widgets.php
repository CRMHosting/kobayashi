<?php
/**
 *This file is  is used to create promo section on homepage or on any other section of widgets from media gallery
 * @package styledstore
 * @since versioni 1.0
 */

class styledstore_make_promo extends WP_Widget {

	/**
	 * Specifies the widget name, description, class name and instatiates it
	 */
	public function __construct() {
		/**
		 * Specifies the widget name, description, class name and instatiates it
		 */
		parent::__construct( 
			'styledstore_make_promo',
			__( 'ST: Make A Promo  ', 'styled-store' ),
			array(
				'classname'   => 'styledstore_make_promo',
				'description' => __( 'This widgets provides user to select element for the promotion of their business ', 'styled-store' )
			) 
		);
	}

	private function widget_fields() {

	    $fields = array(

	        'image_title' => array(

	            'styledstore_widgets_name' => 'image_title',

	            'styledstore_widgets_title' => __('Title', 'styled-store'),

	            'styledstore_widgets_field_type' => 'text',
	        ),
	        
	        'preview_image' => array(

	            'styledstore_widgets_name' => 'preview_image',

	            'styledstore_widgets_title' => __('Upload Background Image', 'styled-store'),

	            'styledstore_widgets_field_type' => 'upload',
	        ),
	     );  
    return $fields;            
   
    }       

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {

		extract($args);
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$preview_image = isset( $instance['preview_image'] ) ? $instance['preview_image'] : '';
		$main_heading = isset( $instance['main_heading'] ) ? $instance['main_heading'] : '';
		$sub_heading = isset( $instance['sub_heading'] ) ? $instance['sub_heading'] : '';

		echo $args['before_widget'];
			echo '<div class="st_promo_section">';

			if ( $preview_image != '' ) {
	            $img_arr = explode('wp-content',$preview_image);
	            $image = content_url().$img_arr[1];
        	} else {
            	$image = '';    
  	  		}

	  	   	$img_id = attachment_url_to_postid($image);

	        $img = wp_get_attachment_image_src($img_id,'styledstore-pro-promo-image' );


	        $alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);
	        if( ! empty($img_id)){
	            $image_link = $img[0];
	        }  

	        //image link
	        echo '<img src="'.$image_link.'" alt="'.$alt.'" title="'.$alt.'" class="attachment-full size-full" />';
	        echo '<div class="promo-details ">';
				if( ! empty( $title )) { echo '<h3 class="promo-heading">'.__( $title, 'styled-store' ).'</h3>'; }
				if( ! empty( $main_heading )) { echo '<h2 class="promo-main-heading">'.__( $main_heading, 'styled-store' ).'</h2>'; }
				if( ! empty( $sub_heading )) { echo '<h1 class="promo-sub-heading">'.__( $sub_heading, 'styled-store' ).'</h1>'; }
			echo '</div>';	

			echo '</div>';	
		
		echo $args['after_widget']; 
		
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['checked_media_uploader'] = isset( $new_instance['checked_media_uploader'] ) ? (bool) $new_instance['checked_media_uploader'] : false;
		$instance['preview_image'] = isset( $new_instance['preview_image'] ) ? $new_instance['preview_image'] : '';
		$instance['main_heading'] = isset( $new_instance['main_heading'] ) ? $new_instance['main_heading'] : '';
		$instance['sub_heading'] = isset( $new_instance['sub_heading'] ) ? $new_instance['sub_heading'] : '';
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$image_upload = isset($instance['image_upload']) ? $instance['image_upload'] : '';
		$main_heading = isset( $instance['main_heading'] ) ? esc_attr( $instance['main_heading'] ) : '';
		$sub_heading    = isset( $instance['sub_heading'] ) ? esc_attr( $instance['sub_heading'] ) : '';
		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'styled-store' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>


		<?php
		 $widget_fields = $this->widget_fields();
            // Loop through fields

            foreach( $widget_fields as $widget_field ) {

                // Make array elements available as variables 

                extract( $widget_field );

                $styledstore_widgets_field_value = isset( $instance[$styledstore_widgets_name] ) ? esc_attr( $instance[$styledstore_widgets_name] ) : '';

                styledstore_widgets_show_widget_field( $this, $widget_field, $styledstore_widgets_field_value );

            } ?>

            <p><label for="<?php echo $this->get_field_id( 'main_heading' ); ?>"><?php _e( 'Main Heading:', 'styled-store' ); ?></label>
			<textarea class="widefat" rows="5" cols="10" id="<?php echo $this->get_field_id('main_heading'); ?>" name="<?php echo $this->get_field_name('main_heading'); ?>"><?php echo $main_heading; ?></textarea></p>


            <p><label for="<?php echo $this->get_field_id( 'sub_heading' ); ?>"><?php _e( 'Sub Heading:', 'styled-store' ); ?></label>
			<textarea class="widefat" rows="5" cols="10" id="<?php echo $this->get_field_id('sub_heading'); ?>" name="<?php echo $this->get_field_name('sub_heading'); ?>"><?php echo $sub_heading; ?></textarea></p>

        <?php }
}


