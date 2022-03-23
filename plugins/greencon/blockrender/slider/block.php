<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Slider{

	protected $name = 'Slider';

	final public static function instance(){
		static $instance = null;

		if(is_null($instance)) {
			$instance = new static();
		}

		return $instance;
	}

	protected function __construct(){
		add_action('init', array( $this, 'init_handler' ));
	}

	public function init_handler(){
		register_block_type(__DIR__, array(
			'render_callback' => array( $this, 'render_block' )
		)
		);
	}

	public function render_block( $settings = array(), $inner_content = '' ) {
		$html       = '';
		$slides     = $settings['slides'];
		$random_key = rand( 0, 100 );

		if ( empty( $slides ) ) {
			return;
		}

		$arrowbg = (!empty($settings['background'])) ? 'background-color:'.$settings["background"].';' : '';
		$arrowgrad = (!empty($settings['backgroundGradient'])) ? 'background-image:'.$settings["backgroundGradient"].';' : '';
		$arrowcolor = (!empty($settings['arrowColor'])) ? 'fill:'.$settings["arrowColor"].';' : '';
		$thumbcolor = (!empty($settings['thumbColor'])) ? ' style:"--active-slide:'.$settings["thumbColor"].';"' : '';

		$arrowstyle= ($arrowcolor || $arrowbg || $arrowgrad) ? 'style:'.$arrowbg.$arrowgrad.$arrowcolor : '';

		$html .= '<div class="gc-slider jsgc-hook__slider mb25 width-100p"'.$thumbcolor.'>';
		$html .= ' <div class="gc-slider__wrapper">';
		$html .= '	<div class="gc-slider__inner">';
		foreach ( $slides as $slide ) {
			$url    = $slide['image']['url'];
			$alt    = $slide['image']['alt'];
			$caption = (!empty($slide['image']['caption'])) ? $slide['image']['caption'] : '';
			$width  = $slide['image']['width'];
			$height = $slide['image']['height'];
			if ( empty( $url ) ) {
				$url = plugin_dir_url( __DIR__ ) . '/assets/icons/noimage-placeholder.png';
			}
			$html .= '<div class="gc-slider-item gcimglightbox">';
			$html .= '<span class="gc-slider-caption">'.$caption.'</span>';
			$html .= '  <img src="' . esc_attr( $url ) . '" alt="' . esc_attr( $alt ) . '"';
			$html .= '       width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '"/>';
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '<div class="gc-slider-controls">';
		$html .= '<div class="gc-slider-arrow gc-slider-arrow--prev" '.$arrowstyle.'><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="451.847px" height="451.847px" viewBox="0 0 451.847 451.847"><g><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0 c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744 c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"/></g></svg></div>';
		$html .= '<div class="gc-slider-arrow gc-slider-arrow--next" '.$arrowstyle.'><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="451.846px" height="451.847px" viewBox="0 0 451.846 451.847"><g><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744
		L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284
		c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"/></g></svg></div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '	<div class="gc-slider-thumbs rhscrollthin">';
		$html .= '		<div class="gc-slider-thumbs__row">';
		foreach ( $slides as $key => $slide ) {
			$url    = $slide['image']['url'];
			$alt    = $slide['image']['alt'];
			$width  = $slide['image']['width'];
			$height = $slide['image']['height'];
			if ( empty( $url ) ) {
				$url = plugin_dir_url( __DIR__ ) . '/assets/icons/noimage-placeholder.png';
			}
			$html .= '<div class="gc-slider-thumbs-item" data-slide ="' . $key . '">';
			$html .= '	<img src="' . esc_attr( $url ) . '" alt="' . esc_attr( $alt ) . '"';
			$html .= '       width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" />';
			$html .= '</div>';
		}
		$html .= '		</div>';
		$html .= '	</div>';
		$html .= '</div>';

		return $html;


	}

}

Slider::instance();