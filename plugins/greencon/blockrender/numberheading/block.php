<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class NumberHeading{

	protected $name = 'numberheading';

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
			'render_callback' => array( $this, 'render_block' ),
			'editor_script' => 'gutencon_common_js',
			'editor_style' => 'gutencon_common_css'
		));
	}

	protected $attributes = array(
		'includeImage'          => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'circlestyle'          => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'mobilecenter' => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'position'        => array(
			'type'    => 'string',
			'default' => '',
		),
		'title' => array(
			'type'    => 'string',
			'default' => '',
		),
		'subtitle' => array(
			'type'    => 'string',
			'default' => '',
		),
		'titleTag' => array(
			'type'    => 'string',
			'default' => 'h2',
		),
		'titleColor' => array(
			'type'    => 'string',
			'default' => '',
		),
		'subtitleColor' => array(
			'type'    => 'string',
			'default' => '',
		),
		'numberColor' => array(
			'type'    => 'string',
			'default' => '',
		),
		'blockid' => array(
			'type'    => 'string',
			'default' => '',
		),		
		'thumbnail'        => array(
			'type'    => 'object',
			'default' => array(
				'id'     => '',
				'url'    => '',
				'width'  => '',
				'height' => '',
				'alt' => ''
			),
		),
	);

	public function render_block($settings = array()){
		extract($settings);
		$imageid  = !empty($thumbnail['id']) ? $thumbnail['id'] : '';
		$image_url = !empty($thumbnail['url']) ? $thumbnail['url'] : '';
		$image_alt = !empty($thumbnail['alt']) ? $thumbnail['alt'] : '';
		$circleclass = ($circlestyle) ? 'gc-numhead__circle' : 'gc-numhead__position';
		$centerclass = ($mobilecenter) ? ' gc-numhead__mcenter' : '';
		$out = '';
		$out .='<div class="gc-numhead'.$centerclass.'" id="'.$blockid.'">';
			$out .='<div class="'.$circleclass.'" style="color:'.esc_attr($numberColor).'; border-color:'.esc_attr($numberColor).'"><span>'.(int)$position.'</span></div>';
			$out .='<div>';
				$out .= '<'.esc_attr($titleTag).' class="gc-numhead__title" style="color:'.esc_attr($titleColor).'">'.esc_attr($title);
				$out .= '</'.esc_attr($titleTag).'>';
				$out .= '<div class="gc-numhead__sub" style="color:'.esc_attr($subtitleColor).'">'.esc_attr($subtitle);
				$out .= '</div>';
			$out .= '</div>';
			if($includeImage){
				$out .= '<div class="gc-numhead__logo"><div class="gc-numhead__logo-cont">';
					if(!empty($imageid)){
						$out .= wp_get_attachment_image($imageid, 'full', false);
					}
					else if(!empty($image_url)){
						$out .= '<img src="'.esc_url($image_url).'" class="attachment-full size-full" alt="'.esc_attr($image_alt).'" loading="lazy">';
					}
				$out .= '</div></div>';					
			}
		$out .= '</div>';
		return $out;
	}
}

NumberHeading::instance();