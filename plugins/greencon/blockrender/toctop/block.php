<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class TocTop{

	protected $name = 'toctop';

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
		'bgColor'   => array(
			'type'    => 'string',
			'default' => '#ffffff',
		),
		'textColor'   => array(
			'type'    => 'string',
			'default' => '#333333',
		),
		'evenbgColor'   => array(
			'type'    => 'string',
			'default' => '#eeeeee',
		),
		'numberbgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'numbertxColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'titleTag'   => array(
			'type'    => 'string',
			'default' => 'h2',
		),
		'boxshadow'   => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'seoschema'   => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'items' => array(
			'type'    => 'array',
			'default' => [],
		),
	);

	public function render_block($settings = array()){
		extract($settings);

		$schemarender = ($seoschema) ? ' itemtype="http://schema.org/ItemList" itemscope' : '';
		$schemalist = ($seoschema) ? ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"' : '';
		$schemaurl = ($seoschema) ? ' itemprop="url"' : '';

		$bgstyle = ($bgColor) ? 'background-color:'.esc_attr($bgColor).';' : '';
		$shadowstyle = ($boxshadow) ? 'box-shadow:0 10px 10px #00000007;' : '';

		$out ='';
		global $post;
		$headings = [];

		$blocks = parse_blocks($post->post_content);
		 
		if (count($blocks) == 1 && $blocks[0]['blockName'] == null) {  // Non-Gutenberg posts
		} else {
			foreach ($blocks as $block) {
				$level = str_replace("h", "", $titleTag);
				if ($block['blockName'] == 'gutencon/numberheading') { 
					$id = $block['attrs']['blockid'];         
					$headings[$id] = wp_strip_all_tags($block['attrs']['title']);
				}

			}
		}


		$out .='<div class="gc-autolist" style="'.$bgstyle.$shadowstyle.'" '.$schemarender.'>';
			$index = 0;
			foreach ( $headings as $id=>$item ) {
				$index ++;
				$itemstyle = ($index%2==0) ? 'background-color:'.esc_attr($evenbgColor).';' : '';
				$out .='<div class="gc-autolist-item" style="'.$itemstyle.'"'.$schemalist.'>';
					if($seoschema){
						$out .='<meta itemprop="name" content="'. esc_html($item) .'" />';
					}
					$out .='<a class="gc-autolistitem" data-id="'.$id.'" href="'.get_the_permalink().'#'.$id.'"'.$schemaurl.'>';
						$out .='<span class="gc-autolist-number" itemprop="position" style="background-color:'.esc_attr($numberbgColor).'; color: '.esc_attr($numbertxColor).';">'.esc_attr($index).'</span>';
						$out .='<span class="gc-autolist-title" style="color: '.esc_attr($textColor).'">'.esc_html($item).'</span>';
					$out .='</a>';
				$out .='</div>';
			}

		$out .='</div>';
		return $out;
	}

}



TocTop::instance();