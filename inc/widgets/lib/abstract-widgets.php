<?php

/**
 * abstract class Unique_Addons_Widget_Loader
 */
if( !class_exists( 'Unique_Addons_Widget_Loader' ) ) {
abstract class Unique_Addons_Widget_Loader extends WP_Widget {

	protected $formFields;
	protected $widgetOptions;
	/**
	 * @var bool Used to prevent duplicated calls.
	 */
	public $saved = false;
	/**
		* @return saved status.
		*/
	public function checkIsSaved( $instance ) {
		if( !empty($instance) ) {
		return true;
		}
		return false;
	}



	/**
	 * Force Extending class to define this method
	 */
	abstract protected function getFormFields();

	/**
		* Sanitize widget form values as they are saved.
		*
		* @see WP_Widget::update()
		*
		* @param array $new_instance Values just sent to be saved.
		* @param array $old_instance Previously saved values from database.
		*
		* @return array Updated safe values to be saved.
		*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		//Update Form Fields
		foreach( $this->formFields as $eachFormField ) {
		$field_name	= $eachFormField['id'];
		$instance[ $field_name ] = ( ! empty( $new_instance[ $field_name ] ) ) ? strip_tags( $new_instance[ $field_name ] ) : '';
		}
		return $instance;
	}

	/**
		* Common method
		* Back-end widget form.
		*
		* @see WP_Widget::form()
		*
		* @param array $instance Previously saved values from database.
		*/
	public function form( $instance ) {
		if( count( $this->formFields ) && is_array( $this->formFields ) ) {
		//saved status to check it is in inital state or saved
		$this->saved = $this->checkIsSaved($instance);

		//Collect Field Values
		foreach( $this->formFields as $eachFormField ) {
			$field_name	= $eachFormField['id'];
			${$field_name} = !empty( $instance[ $field_name ] ) ? esc_attr( $instance[ $field_name ] ) : '';
		}

		//Generate HTML Form
		foreach( $this->formFields as $eachFormField ) {
			switch( $eachFormField['type'] ) {
			case 'text':
				$default_value = ( isset( $eachFormField['default'] ) && !( $this->saved ) ) ? $eachFormField['default'] : ${$eachFormField['id']};
			?>
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?></label>
				<input class="widefat <?php if( isset( $eachFormField['class'] ) ) echo esc_attr( $eachFormField['class'] ); ?>" id="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $eachFormField['id'] ) ); ?>" type="text" value="<?php echo esc_attr( $default_value ); ?>" <?php if( isset( $eachFormField['width'] ) && $eachFormField['width'] == 'auto' ) echo 'style="width: auto;"'; ?>>
				<?php if( isset( $eachFormField['desc'] ) ): ?>
					<span><em><?php esc_html( $eachFormField['desc'] ); ?></em></span>
				<?php endif; ?>
				</p>
			<?php
			break;

			case 'textarea':
			?>
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?></label>
				<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $eachFormField['id'] ) ); ?>"><?php echo wp_kses_post( ${$eachFormField['id']} ); ?></textarea>
				<?php if( isset( $eachFormField['desc'] ) ): ?>
					<span><em><?php esc_html( $eachFormField['desc'] ); ?></em></span>
				<?php endif; ?>
				</p>
			<?php
			break;

			case 'dropdown':
			?>
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $eachFormField['id'] ) ); ?>" <?php if( isset( $eachFormField['width'] ) && $eachFormField['width'] == 'auto' ) echo 'style="width: auto;"'; ?>>
					<?php
					$iter = 0;
					foreach(  $eachFormField['options'] as $option_key => $option_value  ) {
						$selected_option = '';
						if( !( $this->saved ) && $iter == 0 ) {
						$selected_option = 'selected';
						} else if ( $this->saved && $option_key == ${$eachFormField['id']} ) {
						$selected_option = 'selected';
						}
					?>
					<option <?php echo esc_attr( $selected_option ); ?> value="<?php echo esc_attr( $option_key ); ?>"><?php echo esc_html( $option_value ); ?></option>
					<?php
						$iter++;
					}
					?>
				</select>
				<?php if( isset( $eachFormField['desc'] ) ): ?>
					<span><em><?php esc_html( $eachFormField['desc'] ); ?></em></span>
				<?php endif; ?>
				</p>
			<?php
			break;

			case 'checkbox':
			?>
				<p>
				<?php
					$checked_checkbox = '';

					if( isset( $eachFormField['default'] ) && $eachFormField['default'] == 'checked' && !( $this->saved ) )  {
					$checked_checkbox = 'checked';
					} else if( isset( ${$eachFormField['id']} ) &&  ${$eachFormField['id']} != '' )  {
					$checked_checkbox = 'checked';
					}
				?>
				<input <?php echo esc_attr( $checked_checkbox ); ?> class="form-check" id="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $eachFormField['id'] ) ); ?>" type="checkbox" value="<?php echo esc_attr( $eachFormField['value'] ); ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?></label>
				<?php if( isset( $eachFormField['desc'] ) ): ?>
					<span><em><?php esc_html( $eachFormField['desc'] ); ?></em></span>
				<?php endif; ?>
				</p>
			<?php
			break;

			case 'media_upload':
			?>
				<p>
				<div class="tm-widget-image-field">
					<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $eachFormField['id'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$eachFormField['id']} ); ?>" />

					</label>
					<br>
					<br>
					<a class="button tm-widget-image-upload" data-target="#<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" data-preview=".tm-widget-preview-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="Insert Image" data-button="Insert" data-class="media-frame tm-widget-custom-uploader" title="Add Media"><?php echo esc_html__( 'Add Media', 'siddik-layout-widgets-elementor' ); ?></a>

					<a class="button tm-widget-delete-image" data-target="#<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>" data-preview=".tm-widget-preview-image"><?php echo esc_html__( 'Delete', 'siddik-layout-widgets-elementor' ); ?></a>

				</div>
				</p>
			<?php
			break;

			case 'icon_list':
			?>
				<p>
				<label for="<?php echo esc_attr( $this->get_field_id( $eachFormField['id'] ) ); ?>"><?php echo esc_html( $eachFormField['title'] ); ?></label> <br>
				<span class="icon-list" data-target="<?php echo esc_attr( $this->get_field_id( $eachFormField['target'] ) ); ?>">
					<?php
					foreach(  $eachFormField['options'] as $option_key => $option_value  ) {
					?>
					<a class="js-selectable-icon" href="#" data-key="<?php echo esc_attr( $option_key ); ?>">
						<i class="<?php echo esc_attr( $option_key . ' ' . $eachFormField['class'] ); ?>"></i>
					</a>
					<?php
					}
					?>
					</span>
				<?php if( isset( $eachFormField['desc'] ) ): ?>
					<span><em><?php esc_html( $eachFormField['desc'] ); ?></em></span>
				<?php endif; ?>
				</p>
			<?php
			break;

			case 'line':
			?>
				<p>
				<hr>
				</p>
			<?php
			break;

			case 'description':
			?>
				<p>
				<?php echo esc_html( $eachFormField['title'] ); ?>
				</p>
			<?php
			break;

			default:
			?>
				<p>
				<?php esc_html_e( 'Error! Undefined field Type.', 'siddik-layout-widgets-elementor' ); ?>
				</p>
			<?php
			break;
			}
		}
		} else { ?>
			<p><?php esc_html_e( 'No options found for this widget!', 'siddik-layout-widgets-elementor' ); ?></p>
		<?php }
	}
}
}