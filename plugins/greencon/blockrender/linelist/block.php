<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class LineList{

	protected $name = 'linelist';

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
			'editor_style' => 'gutencon_common_css'
		));
	}

	protected $attributes = array(
		'bgColor'   => array(
			'type'    => 'string',
			'default' => '#409cd1',
		),
		'borderColor'   => array(
			'type'    => 'string',
			'default' => '#eeeeee',
		),
		'icon'   => array(
			'type'    => 'string',
			'default' => 'check',
		),
		'items' => array(
			'type'    => 'array',
			'default' => array(
				array(
					'content' => 'Box Content',
				),
				array(
					'content' => 'Box Content',
				),
			),
		),
	);
}

LineList::instance();