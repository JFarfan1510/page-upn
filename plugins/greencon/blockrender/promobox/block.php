<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class PromoBox{

	protected $name = 'promobox';

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
		register_block_type('gutencon/'.$this->name, array(
			'attributes'      => $this->attributes,
			'editor_script' => 'gutencon_common_js',
			'editor_style' => 'gutencon_common_css',
			'render_callback' => array( $this, 'render_block' ),
		));
	}

	protected $attributes = array(
		'title'               => array(
			'type'    => 'string',
			'default' => 'Sample title',
		),
		'content'             => array(
			'type'    => 'string',
			'default' => 'Sample content',
		),
		'backgroundColor'     => array(
			'type'    => 'string',
			'default' => '#f8f8f8',
		),
		'backgroundGradient'     => array(
			'type'    => 'string',
			'default' => '',
		),
		'textColor'           => array(
			'type'    => 'string',
			'default' => '#333',
		),
		'btnColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'btntColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'btnGradient'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'showBorder'          => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'borderSize'          => array(
			'type'    => 'number',
			'default' => 1,
		),
		'borderColor'         => array(
			'type'    => 'string',
			'default' => '#dddddd',
		),
		'showHighlightBorder' => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'highlightColor'      => array(
			'type'    => 'string',
			'default' => '#fb7203',
		),
		'highlightPosition'   => array(
			'type'    => 'string',
			'default' => 'Left',
		),
		'showButton'          => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'buttonText'          => array(
			'type'    => 'string',
			'default' => 'Purchase Now',
		),
		'buttonLink'          => array(
			'type'    => 'string',
			'default' => '',
		),
		'buttonRel' => array( 'type' => 'boolean', 'default' => false ),
		'buttonTarget' => array( 'type' => 'boolean', 'default' => false ),
	);

	public function render_block($settings = array()){
		$attributes = array(
			'background'  => $settings['backgroundColor'],
			'gradient'  => $settings['backgroundGradient'],
			'title'       => $settings['title'],
			'description' => $settings['content'],
			'text_color'  => $settings['textColor'],
			'btnColor'    => $settings['btnColor'],
			'btntColor'    => $settings['btntColor'],
			'btnGradient'    => $settings['btnGradient'],
		);

		if ( $settings['showBorder'] ) {
			$attributes['border_size']  = (int)$settings['borderSize'] . 'px';
			$attributes['border_color'] = esc_attr($settings['borderColor']);
		}

		if ( $settings['showHighlightBorder'] ) {
			$attributes['highligh_color']     = esc_attr($settings['highlightColor']);
			$attributes['highlight_position'] = strtolower( esc_attr($settings['highlightPosition']) );
		}

		if ( $settings['showButton'] ) {
			$attributes['button_link'] = esc_url($settings['buttonLink']);
			$attributes['button_text'] = esc_attr($settings['buttonText']);
		}

		extract($attributes);	
		if($button_link){
			$button_link 		   = apply_filters('gutencon_url_filter', $button_link );
			$button_link 		   = apply_filters('rh_post_offer_url_filter', $button_link );
		}

		$btnColor = ($btnColor) ? 'background-color:' . esc_attr($btnColor) . ';' : '';
		$btntColor = ($btntColor) ? 'color:' . esc_attr($btntColor) . ';' : '';
		$btnGradient = ($btnGradient) ? 'background-image:' . esc_attr($btnGradient) . ';' : '';
		$btnstyles = ($btnColor || $btntColor || $btnGradient) ? 'style="'.$btntColor.$btntColor.$btnGradient.'"' : '';

		$out = '<div class="gc_promobox" style="background-color:'.$background.' !important;background-image:'.esc_attr($gradient).'';
		if(!empty($border_size) && !empty($border_color)):
			$out .= ' border-width:'.esc_attr($border_size).';border-color:'.esc_attr($border_color).'!important; border-style:solid;';
		endif;
		if($text_color):
			$out .= ' color:'.esc_attr($text_color).';';
		endif;
		if($highligh_color && $highlight_position):
			$out .= ' border-'.esc_attr($highlight_position).'-width:3px !important;border-'.esc_attr($highlight_position).'-color:'.esc_attr($highligh_color).'!important;border-'.esc_attr($highlight_position).'-style:solid';
		endif;
		$out .= '">';
			$out .= '<div class="gc_promo_cont">';
				if($title):
					$out .= '<div class="title_promobox">'.wp_kses_post($title).'</div>';
				endif;
				if($description):
					$out.= '<div class="text_promobox">'.wp_kses_post($description).'</div>';
				endif;
			$out .= '</div>';
			if($button_link):
				$btnrel = (!empty($settings['buttonRel'])) ? 'nofollow sponsored' : '';
				$btntarget = (!empty($settings['buttonTarget'])) ? '_blank' : '';
				$out .= '<div class="gc_promo_right"><a href="'.esc_url($button_link).'" class="btn_offer_block re_track_btn gc_track_btn" rel="'.$btnrel.'"
				target="'.$btntarget.'" '.$btnstyles.'><span>'.esc_attr($button_text).'</span></a></div>';
			endif;
		$out .= '</div>';
		return $out;

	}

}

PromoBox::instance();
