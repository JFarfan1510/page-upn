<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Accordion{

	protected $name = 'accordion';

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
		'titleTag'        => array(
			'type'    => 'string',
			'default' => 'h3',
		),
		'titleColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'panelColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'contColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'contBgColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'shadow'  => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'seoschema'  => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'toggleone'  => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'tabs' => array(
			'type'    => 'array',
			'default' => array(
				array(
					'title'   => 'Sample title',
					'content' => 'Sample content',
					'open'    =>  false
				)
			),
		),
	);

	public function render_block($settings = array()){
		extract($settings);
		$schemarender = ($seoschema) ? ' itemscope="" itemtype="https://schema.org/FAQPage"' : '';
		$schemaquestion = ($seoschema) ? ' itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"' : '';
		$schemaname = ($seoschema) ? ' itemprop="name"' : '';
		$schemaanswer = ($seoschema) ? ' itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"' : '';
		$schematext = ($seoschema) ? ' itemprop="text"' : '';
		$toggleclass = ($toggleone) ? ' togglelogic' : '';
		$shadowstyle = ($shadow) ? ' style="box-shadow:0 10px 10px #00000007"' : '';
		$colorstyle = ($titleColor) ? 'color:'.esc_attr($titleColor).';' : '';
		$bgcolorstyle = ($panelColor) ? 'background-color:'.esc_attr($panelColor).';border-color:'.esc_attr($panelColor).';' : '';
		$bglinestyle = ($titleColor) ? 'background-color:'.esc_attr($titleColor).';' : '';
		$contcolorstyle = ($contColor) ? 'color:'.esc_attr($contColor).';' : '';
		$contbgstyle = ($contBgColor) ? 'background-color:'.esc_attr($contBgColor).';border-color:'.esc_attr($contBgColor).';' : '';
		$out ='';



		$out .='<div class="gc-accordion'.esc_attr($toggleclass).'"'.$schemarender.'>';
			foreach ( $tabs as $tab ) {
				$openclass = (!empty($tab['open'])) ? ' gcopen' : ' gcclose';

				$out .='<div class="gc-accordion-item'.esc_attr($openclass).'"'.$shadowstyle.$schemaquestion.'>';
					$out .='<div class="gc-accordion-item__title" style="'.$colorstyle.$bgcolorstyle.'">';
						$out .= '<'.esc_attr($titleTag).' class="gc-accordion-item__heading"'.$schemaname.' style="'.$colorstyle.'">';
							$out .= wp_kses_post($tab['title']);
						$out .='</'.esc_attr($titleTag).'>';
						$out .= '<span class="iconfortoggle"><span class="gciconbefore" style='.$bglinestyle.'></span><span class="gciconafter" style='.$bglinestyle.'></span></span>';
					$out .='</div>';
					$out .= '<div class="gc-accordion-item__content" style="'.$contcolorstyle.$contbgstyle.'"'.$schemaanswer.'>';
						$tabcontent = wp_kses_post($tab['content']);
						$out .= '<div class="gc-accordion-item__text"'.$schematext.'>'. do_shortcode($tabcontent).'</div>';
					$out .='</div>';
				$out .='</div>';
			}

		$out .='</div>';
		return $out;
	}
}

Accordion::instance();