<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Howto{

	protected $name = 'howto';

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
		'titleColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'borderColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'numberColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'numberBgColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'seoschema'  => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'blockId'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'title'      => array(
			'type'    => 'string',
			'default' => 'Edit this title',
		),
		'description'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'tabs' => array(
			'type'    => 'array',
			'default' => array(
				array(
					'title'   => '',
					'content' => '',
				)
			),
		),
	);

	public function render_block($settings = array()){

		extract($settings);
		$schemarender = ($seoschema) ? ' itemscope itemtype="https://schema.org/HowTo"' : '';
		$schemaname = ($seoschema) ? ' itemprop="name"' : '';
		$schemadescription= ($seoschema) ? ' itemprop="description"' : '';
		$schemastep = ($seoschema) ? ' itemprop="step" itemscope itemtype="https://schema.org/HowToStep"' : '';
		$schemahow = ($seoschema) ? ' itemprop="itemListElement" itemscope itemtype="https://schema.org/HowToDirection"' : '';
		$schematext = ($seoschema) ? ' itemprop="text"' : '';
		$colorstyle = ($titleColor) ? ' style:{color:'.esc_attr($titleColor).';}' : '';
		$borderstyle = ($borderColor) ? 'border-color:'.esc_attr($borderColor).';' : '';
		$borderbgstyle = ($borderColor) ? 'background-color:'.esc_attr($borderColor).';' : '';
		$blockid = substr($blockId, 0, 6);
		$uniqueid = 'gc-howid'.esc_attr($blockid);

		$numberstyle = ($numberBgColor || $numberColor) ? '<style scoped>#'.$uniqueid.' .gc-howtoitem__heading:before{background-color:'.esc_attr($numberBgColor).';color:'.esc_attr($numberColor).';}</style>' : '';
		$out ='';


		$out .='<div id="'.$uniqueid.'" class="gc-howto" style="'.$borderstyle.'"'.$schemarender.'>';
			$out .= $numberstyle;
			$out .='<div class="gc-howto__title">';
				$out .='<div class="gc-howto__line" style="'.$borderbgstyle.'"></div>';
					$out .= '<div'.$schemaname.$colorstyle.' class="gc-howto__heading">'.wp_kses_post($title).'</div>';
				$out .='<div class="gc-howto__line" style="'.$borderbgstyle.'"></div>';
			$out .='</div>';
			$out .='<div class="gc-howto__description">';
				$out .= '<div'.$schemadescription.'>'.wp_kses_post($description).'</div>';
			$out .='</div>';

			foreach ( $tabs as $index=>$tab ) {
				$number = $index+1;
				$out .='<div id="'.$uniqueid.'step'.$number.'" class="gc-howtoitem__step"'.$schemastep.'>';
					if($seoschema){
						if(!empty($tab['content'])){
							preg_match( '@src="([^"]+)"@' , $tab['content'], $match );
							$src = array_pop($match);
							$out .='<meta itemprop="image" content="'.esc_url($src).'" />';
						}
						$out .='<meta itemprop="url" content="'.get_the_permalink().'#'.$uniqueid.'step'.$number.'" />';
					}
					$out .='<div class="gc-howtoitem__title">';
						$out .= '<div class="gc-howtoitem__heading"'.$schemaname.'>';
							$out .= $tab['title'];
						$out .='</div>';
					$out .='</div>';

					$out .= '<div class="gc-howtoitem__content" '.$schemahow.'>';
						$out .= '<div class="gc-howtoitem__text"'.$schematext.'>'. wp_kses_post($tab['content']).'</div>';
					$out .='</div>';
				$out .='</div>';
			}

		$out .='</div>';
		return $out;
	}
}

Howto::instance();