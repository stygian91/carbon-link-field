<?php

namespace Carbon_Field_Link_Field;

use Carbon_Fields\Field\Field;
use Carbon_Fields\Value_Set\Value_Set;

class Link_Field extends Field {

	public function __construct( $type, $name, $label ) {
		$this->set_value_set( new Value_Set(
			Value_Set::TYPE_MULTIPLE_PROPERTIES,
			array( 'label' => '', 'link' => '', 'target' => false, )
		) );
		parent::__construct( $type, $name, $label );
	}

	/**
	 * Prepare the field type for use
	 * Called once per field type when activated
	 */
	public static function field_type_activated() {
		$dir = \Carbon_Field_Link_Field\DIR . '/languages/';
		$locale = get_locale();
		$path = $dir . $locale . '.mo';
		load_textdomain( 'crblf', $path );
	}

	/**
	 * Enqueue scripts and styles in admin
	 * Called once per field type
	 */
	public static function admin_enqueue_scripts() {
		$root_uri = \Carbon_Fields\Carbon_Fields::directory_to_url( \Carbon_Field_Link_Field\DIR );

		# Enqueue JS
		wp_enqueue_script( 'carbon-field-link', $root_uri . '/assets/js/bundle.js', array( 'carbon-fields-boot' ) );
		wp_localize_script( 'carbon-field-link', 'CrbLinkFieldi18n', Language::get_strings() );

		# Enqueue CSS
		wp_enqueue_style( 'carbon-field-link', $root_uri . '/assets/css/field.css' );
	}

	/**
	 * Load the field value from an input array based on it's name
	 *
	 * @param array $input Array of field names and values.
	 */
	public function set_value_from_input( $input ) {
		if ( ! isset( $input[ $this->get_name() ] ) ) {
			$this->set_value( null );
			return $this;
		}

		$value = $input[ $this->get_name() ];
		if( isset( $value['target'] ) && $value['target'] === 'checked' ) {
			$target = true;
		} else {
			$target = false;
		}

		$value_set = array(
			'link' => isset( $value['link'] ) ? $value['link'] : '',
			'label' => isset( $value['label'] ) ? $value['label'] : '',
			'target' => $target,
		);

		$value_set[ Value_Set::VALUE_PROPERTY ] = $value_set['link'];

		$this->set_value( $value );
		return $this;
	}

	public function get_formatted_value() {
		$value = parent::get_formatted_value();

		if ( isset( $value['target'] ) && $value['target'] === 'checked' ) {
			$value['target'] = true;
		} else {
			$value['target'] = false;
		}

		unset( $value['value'] );

		return $value;
	}
}
