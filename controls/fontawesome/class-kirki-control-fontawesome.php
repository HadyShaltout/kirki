<?php
/**
 * Customizer Control: kirki-fontawesome.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Select control.
 */
class Kirki_Control_FontAwesome extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kirki-fontawesome';

	/**
	 * Used to automatically generate all CSS output.
	 *
	 * @access public
	 * @var array
	 */
	public $output = array();

	/**
	 * Data type
	 *
	 * @access public
	 * @var string
	 */
	public $option_type = 'theme_mod';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script( 'select2', trailingslashit( Kirki::$url ) . 'assets/vendor/select2/js/select2.full.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'select2', trailingslashit( Kirki::$url ) . 'assets/vendor/select2/css/select2.min.css', null );
		wp_enqueue_script( 'kirki-fontawesome', trailingslashit( Kirki::$url ) . 'controls/fontawesome/fontawesome.js', array( 'jquery', 'customize-base', 'select2', 'jquery-ui-sortable' ), false, true );
		wp_localize_script( 'kirki-fontawesome', 'fontAwesomeJSON', file_get_contents( Kirki::$path . '/controls/fontawesome/fontawesome.json' ) );
		wp_enqueue_style( 'kirki-fontawesome-css', trailingslashit( Kirki::$url ) . 'controls/fontawesome/fontawesome.css', null );
		wp_enqueue_style( 'kirki-fontawesome-font-css', trailingslashit( Kirki::$url ) . 'controls/fontawesome/font-awesome.css', null );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['output']  = $this->output;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;

		if ( 'user_meta' === $this->option_type ) {
			// @codingStandardsIgnoreLine
			$this->json['value'] = get_user_meta( get_current_user_id(), $this->id, true );
		}

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
	}


	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<select {{{ data.inputAttrs }}} {{{ data.link }}}></select>
		</label>
		<?php
	}


	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overridden without having to rewrite the wrapper in `$this::render()`.
	 *
	 * Supports basic input types `text`, `checkbox`, `textarea`, `radio`, `select` and `dropdown-pages`.
	 * Additional input types such as `email`, `url`, `number`, `hidden` and `date` are supported implicitly.
	 *
	 * Control content can alternately be rendered in JS. See WP_Customize_Control::print_template().
	 *
	 * @since 3.0.0
	 */
	protected function render_content() {}
}
