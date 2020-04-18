<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

class FW_Option_Type_FwMultiInline extends FW_Option_Type {

	public function get_type() {
		return 'fw-multi-inline';
	}

	/**
	 * @internal
	 */
	protected function _enqueue_static( $id, $option, $data ) {
		$uri = get_template_directory_uri() . '/inc/includes/option-types/' . $this->get_type() . '/static';

		wp_enqueue_style(
		'fw-option-' . $this->get_type(), $uri . '/css/styles.css'
		);
	}

	/**
	 * @internal
	 */
	public function _get_backend_width_type() {
		return 'auto';
	}

	/**
	 * @internal
	 */
	protected function _render( $id, $option, $data ) {
		return fw_render_view( EXHIBZ_INC . '/includes/option-types/fw-multi-inline/view.php', array(
			'id'	 => $id,
			'option' => $option,
			'data'	 => $data
		) );
	}

	/**
	 * @internal
	 */
	protected function _get_value_from_input( $option, $input_value ) {


		if ( is_array( $input_value ) ) {

			$value = $input_value;
		} else {

			$value = $option[ 'value' ];
		}
		return $value;
	}

	/**
	 * @internal
	 */
	protected function _get_defaults() {

		return array(
			'value' => array(
				'firstoption' => 'select2'
			),
			'fw_multi_options'	 => array(
				'firstoption' => array(
					'type'		 => 'select',
					'title'		 => esc_html__( 'Title', 'exhibz' ),
					'choices'	 => array(
						'select1'	 => esc_html__( 'select1', 'exhibz' ),
						'select2'	 => esc_html__( 'select2', 'exhibz' ),
						'select3'	 => esc_html__( 'select3', 'exhibz' )
					),
				)
			),
			'groupname'			 => ''
		);
	}

}

FW_Option_Type::register( 'FW_Option_Type_FwMultiInline' );
