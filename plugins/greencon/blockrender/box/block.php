<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Box{

	protected $name = 'box';

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
		'type'      => array(
			'type'    => 'string',
			'default' => 'green',
		),
		'textalign' => array(
			'type'    => 'string',
			'default' => 'left',
		),
		'radius' => array(
			'type'    => 'number',
			'default' => 0,
		),
		'date'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'takeDate'  => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'shadow'  => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'label'     => array(
			'type'    => 'string',
			'default' => 'Update',
		),
	);

	public function render_block($settings = array(), $content=''){

		$alignclass = (!empty($settings['align'])) ? ' align'.esc_attr($settings['align']).' ' : '';

		$label = ($settings['takeDate'] && $settings['type']=='update') ? '<span class="label-info">'.esc_attr($settings['date']).' '.esc_attr($settings['label']).'</span>' : '';
		if($settings['type']=='info'){
			$iconcode = '<svg x="0px" y="0px" viewBox="0 0 512 512"> <g><g> <path d="M256,0C114.497,0,0,114.507,0,256c0,141.503,114.507,256,256,256c141.503,0,256-114.507,256-256 C512,114.497,397.492,0,256,0z M256,472c-119.393,0-216-96.615-216-216c0-119.393,96.615-216,216-216 c119.393,0,216,96.615,216,216C472,375.393,375.384,472,256,472z"/> </g> </g> <g> <g> <path d="M256,214.33c-11.046,0-20,8.954-20,20v128.793c0,11.046,8.954,20,20,20s20-8.955,20-20.001V234.33 C276,223.284,267.046,214.33,256,214.33z"/> </g> </g> <g> <g> <circle cx="256" cy="162.84" r="27"/> </g> </g> </svg>';
			$iconclass = 'icon_type';
		}
		else if($settings['type'] =='download'){
			$iconcode = '<svg viewBox="0 0 612 612"> <g> <g> <g> <path d="M403.939,295.749l-78.814,78.833V172.125c0-10.557-8.568-19.125-19.125-19.125c-10.557,0-19.125,8.568-19.125,19.125 v202.457l-78.814-78.814c-7.478-7.478-19.584-7.478-27.043,0c-7.478,7.478-7.478,19.584,0,27.042l108.19,108.19 c4.59,4.59,10.863,6.005,16.812,4.953c5.929,1.052,12.221-0.382,16.811-4.953l108.19-108.19c7.478-7.478,7.478-19.583,0-27.042 C423.523,288.29,411.417,288.29,403.939,295.749z M306,0C137.012,0,0,136.992,0,306s137.012,306,306,306s306-137.012,306-306 S475.008,0,306,0z M306,573.75C158.125,573.75,38.25,453.875,38.25,306C38.25,158.125,158.125,38.25,306,38.25 c147.875,0,267.75,119.875,267.75,267.75C573.75,453.875,453.875,573.75,306,573.75z"/> </g> </g> </g> </svg>';
			$iconclass = 'icon_type';
		}
		else if($settings['type']=='notice'){
			$iconcode = '<svg x="0px" y="0px" viewBox="0 0 486.463 486.463" > <g> <g> <path d="M243.225,333.382c-13.6,0-25,11.4-25,25s11.4,25,25,25c13.1,0,25-11.4,24.4-24.4 C268.225,344.682,256.925,333.382,243.225,333.382z"/> <path d="M474.625,421.982c15.7-27.1,15.8-59.4,0.2-86.4l-156.6-271.2c-15.5-27.3-43.5-43.5-74.9-43.5s-59.4,16.3-74.9,43.4 l-156.8,271.5c-15.6,27.3-15.5,59.8,0.3,86.9c15.6,26.8,43.5,42.9,74.7,42.9h312.8 C430.725,465.582,458.825,449.282,474.625,421.982z M440.625,402.382c-8.7,15-24.1,23.9-41.3,23.9h-312.8 c-17,0-32.3-8.7-40.8-23.4c-8.6-14.9-8.7-32.7-0.1-47.7l156.8-271.4c8.5-14.9,23.7-23.7,40.9-23.7c17.1,0,32.4,8.9,40.9,23.8 l156.7,271.4C449.325,369.882,449.225,387.482,440.625,402.382z"/> <path d="M237.025,157.882c-11.9,3.4-19.3,14.2-19.3,27.3c0.6,7.9,1.1,15.9,1.7,23.8c1.7,30.1,3.4,59.6,5.1,89.7 c0.6,10.2,8.5,17.6,18.7,17.6c10.2,0,18.2-7.9,18.7-18.2c0-6.2,0-11.9,0.6-18.2c1.1-19.3,2.3-38.6,3.4-57.9 c0.6-12.5,1.7-25,2.3-37.5c0-4.5-0.6-8.5-2.3-12.5C260.825,160.782,248.925,155.082,237.025,157.882z"/> </g> </g> </svg>';
			$iconclass = 'icon_type';
		}
		else if($settings['type']=='error'){
			$iconcode = '<svg x="0px" y="0px" viewBox="0 0 512 512"> <g> <g> <path d="M256,0C114.508,0,0,114.497,0,256c0,141.493,114.497,256,256,256c141.492,0,256-114.497,256-256 C512,114.507,397.503,0,256,0z M256,472c-119.384,0-216-96.607-216-216c0-119.385,96.607-216,216-216 c119.384,0,216,96.607,216,216C472,375.385,375.393,472,256,472z"/> </g> </g> <g> <g> <path d="M343.586,315.302L284.284,256l59.302-59.302c7.81-7.81,7.811-20.473,0.001-28.284c-7.812-7.811-20.475-7.81-28.284,0 L256,227.716l-59.303-59.302c-7.809-7.811-20.474-7.811-28.284,0c-7.81,7.811-7.81,20.474,0.001,28.284L227.716,256 l-59.302,59.302c-7.811,7.811-7.812,20.474-0.001,28.284c7.813,7.812,20.476,7.809,28.284,0L256,284.284l59.303,59.302 c7.808,7.81,20.473,7.811,28.284,0C351.398,335.775,351.397,323.112,343.586,315.302z"/> </g> </g> </svg>';
			$iconclass = 'icon_type';
		}else{
			$iconcode = $iconclass = '';
		}
		$boxshadow = (!empty($settings['shadow'])) ? 'box-shadow: 0 10px 10px #00000007' : '';

		$out = '<div class="gc-box '.esc_attr($settings['type']).'_type '.$iconclass.$alignclass.'" style="text-align:'.esc_attr($settings['textalign']).';border-radius:'.esc_attr($settings['radius']).'px;'.$boxshadow.'">
			<div class="gc-box-icon">'.$iconcode.'</div>
			'.$label.'
			<div class="gc-box-text">'.$content.'</div>
		</div>';

		return $out;
	}
}

Box::instance();
