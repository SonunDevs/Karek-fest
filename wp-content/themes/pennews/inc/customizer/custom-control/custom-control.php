<?php
/**
 * Custom controller numbers type and categories type
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	class Penci_Customize_Font_Size_Control extends WP_Customize_Control {
		public $type = 'font_size';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" name="quantity" <?php esc_attr( $this->link() ); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;"> px
			</label>
			<?php
		}
	}

	class Penci_Customize_Number_Control extends WP_Customize_Control {
		public $type = 'number';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input type="number" name="quantity" <?php esc_attr( $this->link() ); ?> value="<?php echo esc_textarea( $this->value() ); ?>" style="width:70px;">
			</label>
			<?php
		}
	}

	class Penci_Customize_CustomCss_Control extends WP_Customize_Control {
		public $type = 'custom_css';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea style="width:100%; height:150px;" <?php esc_attr( $this->link() ); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	class Penci_Customize_Heading_Control extends WP_Customize_Control {
		public $type = 'heading';

		public function render_content() {
			?>
			<label>
				<h2 class="customize-control-title" style="text-transform: uppercase; text-align: center;"><?php echo esc_html( $this->label ); ?></h2>
				<hr style="border-top:1px solid #111;"/>
			</label>
			<?php
		}
	}


	class WP_Customize_Category_Control extends WP_Customize_Control {
		public function render_content() {
			$dropdown = wp_dropdown_categories( array(
				'name'              => '_customize-dropdown-categories-' . $this->id,
				'echo'              => 0,
				'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'pennews' ),
				'option_none_value' => '0',
				'selected'          => $this->value(),
			) );

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>', $this->label, $dropdown );
		}
	}
}
