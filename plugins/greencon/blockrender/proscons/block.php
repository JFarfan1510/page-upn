<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class ProsCons{

	protected $name = 'proscons';

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
		'prosbgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prostextColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prostitleColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prostitleBgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosIconColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosBorderColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosBorderSize'   => array(
			'type'    => 'number',
			'default' => 0,
		),
		'prosShadow'   => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'consbgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'constextColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'constitleColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'constitleBgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consIconColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consBorderColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consBorderSize'   => array(
			'type'    => 'number',
			'default' => 0,
		),
		'consShadow'   => array(
			'type'    => 'boolean',
			'default' => false,
		),
	);
}

ProsCons::instance();