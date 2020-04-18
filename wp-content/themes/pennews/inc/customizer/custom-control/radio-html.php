<?php

/**
 * Radio image customize control.
 *
 * array(
 *  'label'    => '',
 *  'section'  => 'general',
 *  'settings' => 'penci_general_loader_effect',
 *  'type'     => 'radio-html',
 *  'choices' => array(
 *      '1' => '<div class="penci-loading-animation-1"><div class="penci-loading-animation"></div></div>',
 *      '2' => '<div class="penci-loading-animation-2"><div class="penci-loading-animation"></div></div>',
 *      '3' => '<div class="penci-loading-animation-3"><div class="penci-loading-animation"></div></div>',
 *      '4' => '<div class="penci-loading-animation-4"><div class="penci-loading-animation"></div></div>',
 *  ),
 * )
 */
class Penci_Customize_Control_Radio_HTML extends WP_Customize_Control
{
	public $type = 'radio_html';

	/**
	 * Render the control's content.
	 *
	 * @return  void
	 */
	public function render_content() {
		if ( $this->label ) {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
		}

		if ( $this->description ) {
			?>
			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php
		}

		$value = $this->value();

		?>
		<div class="customize-control-content-html" id="<?php echo esc_attr( $this->type ); ?>-<?php echo esc_attr( $this->id ); ?>">
			<?php foreach ( $this->choices as $val => $label ) { ?>
			<div class="penci-radio-html <?php if ( checked( $value, $val, false ) ) echo 'selected'; ?>">
				<?php

					echo wp_kses(
						$label,
						array(
							'a' => array(
								'data-section' => array(),
								'href'         => array(),
								'class'        => array()
							),
							'div' => array(
								'class' => array()
							),
							'span' => array(
								'class' => array()
							),
							'h3' => array(
								'class' => array()
							)
						)
					);
				?>
				<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" title="<?php
					if ( is_array( $label ) && isset( $label['title'] ) )
						echo esc_attr( $label['title'] );
				?>" value="<?php echo esc_attr( $val ); ?>" <?php
					checked( $value, $val );
				?>>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}
