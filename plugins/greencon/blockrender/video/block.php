<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class VideoBox{

	protected $name = 'video';

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
			'editor_script' => 'gutencon_common_js',
			'editor_style' => 'gutencon_common_css'
		));
	}

}

VideoBox::instance();