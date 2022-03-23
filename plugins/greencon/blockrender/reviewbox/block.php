<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Reviewbox{

	protected $name = 'reviewbox';

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
		'title'       => array(
			'type'    => 'string',
			'default' => 'Awesome'
		),
		'description' => array(
			'type'    => 'string',
			'default' => 'Place here Description for your reviewbox',
		),
		'score'       => array(
			'type'    => 'number',
			'default' => 0,
		),
		'scoreset'       => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'enablecriterias'       => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'enableproscons'       => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'scoreManual' => array(
			'type'    => 'number',
			'default' => 0,
		),
		'mainColor'   => array(
			'type'    => 'string',
			'default' => '#E43917',
		),
		'criterias'   => array(
			'type'    => 'array',
			'default' => array(),
		),
		'prosTitle'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'positives'   => array(
			'type'    => 'array',
			'default' => array(),
		),
		'consTitle'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'negatives'   => array(
			'type'    => 'array',
			'default' => array(),
		),
		'uniqueClass' => array(
			'type'    => 'string',
			'default' => ''
		),
		'scorelabel'   => array(
			'type'    => 'string',
			'default' => 'Expert Score',
		),
		'bgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'textColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
	);

	public function render_block($settings = array()){
		extract($settings);

		$contstyle = ($bgColor || $textColor) ? ' style="color:'.esc_attr($textColor).';background-color:'.esc_attr($bgColor).'"' : '';
		$scorecolor = ($mainColor) ? ' style="background-color:'.esc_attr($mainColor).';"' : '';
		$out ='';
		$out .='<div class="gc-review-box"'.$contstyle.'>';
			$out .= '<div class="gc-review-box__wrapper">';
				$out .= '<div class="review-top">';
					$out .= '<div class="overall-score"'.$scorecolor.'>';
						$out .= '<span class="overall">'.($scoreset ? esc_attr($scoreManual) : esc_attr($score)).'</span>';
						$out .= '<span class="overall-text">'.esc_attr($scorelabel).'</span>';
					$out .='</div>';
					$out .= '<div class="review-text">';
						$out .= '<span class="review-header">'.esc_attr($title).'</span>';
						$out .= '<div>'.wp_kses_post($description).'</div>';
					$out .='</div>';
				$out .='</div>';
				if($enablecriterias){
					$out .= '<div class="review-criteria">';
					foreach ( $criterias as $criteria ) {
						$title = $criteria['title'];
						$value = $criteria['value'];
						$percent = (float)$value * 10;
						$out .= '<div class="rate-bar clearfix">';
							$out .= '<div class="rate-bar-title"><span>'.esc_attr($title).'</span></div>';
							$out .= '<div class="rate-bar-bar" style="background-color:'.esc_attr($mainColor).';width: '.$percent.'%"></div>';
							$out .= '<div class="rate-bar-percent">'.esc_attr($value).'</div>';
						$out .='</div>';
					}
					$out .='</div>';
				}
				if($enableproscons){
					$out .='<div class="gc-cons-pros">';
						$out .='<div class="gc-cons-pros__col">';
							$out .='<div class="gc-cons-pros__title gc-cons-pros__title--pros" style="color:'.esc_attr($prosColor).'">'.wp_kses_post($prosTitle).'</div>';
							$out .='<ul class="gc-cons-pros__list gc-cons-pros__list--pros">';
							foreach ( $positives as $positive ) {
								$out .= '<li class="gc-cons-pros__item gc-pros__item">';
									$out .= '<svg xmlns="https://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 512 512" style="fill:#58c649"><ellipse cx="256" cy="256" rx="256" ry="255.832"/><polygon points="235.472,392.08 114.432,297.784 148.848,253.616 223.176,311.52 345.848,134.504 
									391.88,166.392" style="fill:white"/></svg> '.wp_kses_post($positive['title']).'';
								$out .='</li>';
							}	
							$out .= '</ul>';
						$out .='</div>';
						$out .='<div class="gc-cons-pros__col">';
							$out .='<div class="gc-cons-pros__title gc-cons-pros__title--cons" style="color:'.esc_attr($consColor).'">'.wp_kses_post($consTitle).'</div>';
							$out .='<ul class="gc-cons-pros__list gc-cons-pros__list--cons">';
							foreach ( $negatives as $negative ) {
								$out .= '<li class="gc-cons-pros__item gc-cons__item">';
									$out .= '<svg height="20px" viewBox="0 0 365.71733 365" width="20px" xmlns="http://www.w3.org/2000/svg"><g fill="#f44336"><path d="m356.339844 296.347656-286.613282-286.613281c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503906-12.5 32.769532 0 45.25l286.613281 286.613282c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082032c12.523438-12.480468 12.523438-32.75.019532-45.25zm0 0"/><path d="m295.988281 9.734375-286.613281 286.613281c-12.5 12.5-12.5 32.769532 0 45.25l15.082031 15.082032c12.503907 12.5 32.769531 12.5 45.25 0l286.632813-286.59375c12.503906-12.5 12.503906-32.765626 0-45.246094l-15.082032-15.082032c-12.5-12.523437-32.765624-12.523437-45.269531-.023437zm0 0"/></g></svg> '.wp_kses_post($negative['title']).'';
								$out .='</li>';
							}	
							$out .= '</ul>';
						$out .='</div>';
					$out .='</div>';
				}
			$out .='</div>';
		$out .='</div>';
		return $out;
	}
}

Reviewbox::instance();