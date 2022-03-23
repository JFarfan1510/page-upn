<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class VersusLine{

	protected $name = 'versus';

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
		'heading'      => array(
			'type'    => 'string',
			'default' => 'Versus Title',
		),
		'subheading'   => array(
			'type'    => 'string',
			'default' => 'Versus subline',
		),
		'type'         => array(
			'type'    => 'string',
			'default' => 'two',
		),
		'bg'           => array(
			'type'    => 'string',
			'default' => '',
		),
		'color'        => array(
			'type'    => 'string',
			'default' => '',
		),
		'firstColumn'  => array(
			'type'    => 'object',
			'default' => array(
				'type'    => 'text',
				'isGrey'  => false,
				'content' => 'Value 1',
				'image'   => '',
				'imageId' => '',
			),
		),
		'secondColumn' => array(
			'type'    => 'object',
			'default' => array(
				'type'    => 'text',
				'isGrey'  => false,
				'content' => 'Value 2',
				'image'   => '',
				'imageId' => '',
			),
		),
		'thirdColumn'  => array(
			'type'    => 'object',
			'default' => array(
				'type'    => 'text',
				'isGrey'  => false,
				'content' => 'Value 3',
				'image'   => '',
				'imageId' => '',
			),
		),
	);

	public function render_block($settings = array()){
		$attrs = array(
			'heading'          => $settings['heading'],
			'subheading'       => $settings['subheading'],
			'type'             => $settings['type'],
			'bg'               => $settings['bg'],
			'color'            => $settings['color'],
			'firstcolumntype'  => $settings['firstColumn']['type'],
			'secondcolumntype' => $settings['secondColumn']['type'],
			'thirdcolumntype'  => $settings['thirdColumn']['type'],
			'firstcolumngrey'  => $settings['firstColumn']['isGrey'],
			'secondcolumngrey' => $settings['secondColumn']['isGrey'],
			'thirdcolumngrey'  => $settings['thirdColumn']['isGrey'],
			'firstcolumncont'  => $settings['firstColumn']['content'],
			'secondcolumncont' => $settings['secondColumn']['content'],
			'thirdcolumncont'  => $settings['thirdColumn']['content'],
			'firstcolumnimg'   => $settings['firstColumn']['imageId'],
			'secondcolumnimg'  => $settings['secondColumn']['imageId'],
			'thirdcolumnimg'   => $settings['thirdColumn']['imageId'],
		);
		extract($attrs);
		$fclass = $sclass = $tclass = array();
		$fclass[] = 'vs-1-col';
		$sclass[] = 'vs-2-col';
		$tclass[] = 'vs-3-col';
		$rand_id = mt_rand().'vers';
		$output = '<div class="gc-versus-item" id="gc-vs-'.$rand_id .'">';

			if($bg || $color){
				$colorstyle = empty($color) ? '' : '#gc-vs-'.$rand_id.', #gc-vs-'.$rand_id.' .vs-conttext{color:'.esc_attr($color).'}';
				$bgstyle = empty($bg) ? '' : '#gc-vs-'.$rand_id.'{background-color:'.esc_attr($bg).'; margin-bottom:10px}';				
				$output .= '<style scope>'.$colorstyle.$bgstyle.'</style>';	
			}

			$output .= '<div class="title-versus"><span class="vs-heading">'.wp_kses_post($heading).'</span><span class="vs-subheading">'.wp_kses_post($subheading).'</span></div>';
			$output .= '<div class="gc-versus-cont">';

				if($firstcolumntype == 'tick'){
					$fclass[] = 'vs-tick';
				}
				elseif($firstcolumntype == 'times'){
					$fclass[] = 'vs-times';
				}	
				elseif($firstcolumntype == 'image'){
					$fclass[] = 'vs-img-col';
				}					
				else{
					$fclass[] = 'vs-conttext';						
				}				
				if($firstcolumngrey){
					$fclass[] = 'vs-greyscale';
				}						
				$output .= '<div class="'.implode(' ', $fclass).'">';
					if($firstcolumntype == 'tick'){
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 512 512" style="fill:#58c649"><ellipse cx="256" cy="256" rx="256" ry="255.832"/><polygon points="235.472,392.08 114.432,297.784 148.848,253.616 223.176,311.52 345.848,134.504 
							391.88,166.392 " style="fill: white"/></svg>';
					}
					elseif($firstcolumntype == 'times'){
						$output .= '<svg height="20px" viewBox="0 0 365.71733 365" width="20px" xmlns="https://www.w3.org/2000/svg"><g><path d="m356.339844 296.347656-286.613282-286.613281c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503906-12.5 32.769532 0 45.25l286.613281 286.613282c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082032c12.523438-12.480468 12.523438-32.75.019532-45.25zm0 0"/><path d="m295.988281 9.734375-286.613281 286.613281c-12.5 12.5-12.5 32.769532 0 45.25l15.082031 15.082032c12.503907 12.5 32.769531 12.5 45.25 0l286.632813-286.59375c12.503906-12.5 12.503906-32.765626 0-45.246094l-15.082032-15.082032c-12.5-12.523437-32.765624-12.523437-45.269531-.023437zm0 0"/></g></svg>';
					}		
					elseif($firstcolumntype == 'image'){					
						$output .=  wp_get_attachment_image($firstcolumnimg, 'thumbnail', false, array('class'=>'vs-image'));
					}	
					else{
						$firstcolumncont = wp_kses_post( $firstcolumncont);
						$output .=  do_shortcode($firstcolumncont);
					}																	
				$output .= '</div>';
				$output .= '<div class="vs-circle-col"><div class="vs-circle">VS</div></div>';

				if($secondcolumntype == 'tick'){
					$sclass[] = 'vs-tick';
				}
				elseif($secondcolumntype == 'times'){
					$sclass[] = 'vs-times';
				}	
				elseif($secondcolumntype == 'image'){
					$sclass[] = 'vs-img-col';
				}					
				else{
					$sclass[] = 'vs-conttext';						
				}				
				if($secondcolumngrey){
					$sclass[] = 'vs-greyscale';
				}						
				$output .= '<div class="'.implode(' ', $sclass).'">';
					if($secondcolumntype == 'tick'){
						$output .= '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 512 512" style="fill:#58c649"><ellipse cx="256" cy="256" rx="256" ry="255.832"/><polygon points="235.472,392.08 114.432,297.784 148.848,253.616 223.176,311.52 345.848,134.504 
							391.88,166.392 " style="fill: white"/></svg>';
					}
					elseif($secondcolumntype == 'times'){
						$output .= '<svg height="20px" viewBox="0 0 365.71733 365" width="20px" xmlns="https://www.w3.org/2000/svg"><g><path d="m356.339844 296.347656-286.613282-286.613281c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503906-12.5 32.769532 0 45.25l286.613281 286.613282c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082032c12.523438-12.480468 12.523438-32.75.019532-45.25zm0 0"/><path d="m295.988281 9.734375-286.613281 286.613281c-12.5 12.5-12.5 32.769532 0 45.25l15.082031 15.082032c12.503907 12.5 32.769531 12.5 45.25 0l286.632813-286.59375c12.503906-12.5 12.503906-32.765626 0-45.246094l-15.082032-15.082032c-12.5-12.523437-32.765624-12.523437-45.269531-.023437zm0 0"/></g></svg>';
					}	
					elseif($secondcolumntype == 'image'){					
						$output .=  wp_get_attachment_image($secondcolumnimg, 'thumbnail', false, array('class'=>'vs-image'));
					}
					else{
						$secondcolumncont = wp_kses_post( $secondcolumncont);
						$output .=  do_shortcode($secondcolumncont);
					}																		
				$output .= '</div>';	

				if($type=='three'){
					$output .= '<div class="vs-circle-col"><div class="vs-circle">VS</div></div>';
					if($thirdcolumntype == 'tick'){
						$tclass[] = 'vs-tick';
					}
					elseif($thirdcolumntype == 'times'){
						$tclass[] = 'vs-times';
					}
					elseif($thirdcolumntype == 'image'){
						$tclass[] = 'vs-img-col';
					}					
					else{
						$tclass[] = 'vs-conttext';						
					}	
					if($thirdcolumngrey){
						$tclass[] = 'vs-greyscale';
					}						
					$output .= '<div class="'.implode(' ', $tclass).'">';
						if($thirdcolumntype == 'tick'){
							$output .= '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 512 512" style="fill:#58c649"><ellipse cx="256" cy="256" rx="256" ry="255.832"/><polygon points="235.472,392.08 114.432,297.784 148.848,253.616 223.176,311.52 345.848,134.504 
							391.88,166.392 " style="fill: white"/></svg>';
						}
						elseif($thirdcolumntype == 'times'){
							$output .= '<svg height="20px" viewBox="0 0 365.71733 365" width="20px" xmlns="https://www.w3.org/2000/svg"><g><path d="m356.339844 296.347656-286.613282-286.613281c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503906-12.5 32.769532 0 45.25l286.613281 286.613282c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082032c12.523438-12.480468 12.523438-32.75.019532-45.25zm0 0"/><path d="m295.988281 9.734375-286.613281 286.613281c-12.5 12.5-12.5 32.769532 0 45.25l15.082031 15.082032c12.503907 12.5 32.769531 12.5 45.25 0l286.632813-286.59375c12.503906-12.5 12.503906-32.765626 0-45.246094l-15.082032-15.082032c-12.5-12.523437-32.765624-12.523437-45.269531-.023437zm0 0"/></g></svg>';
						}		
						elseif($thirdcolumntype == 'image'){
							$output .=  wp_get_attachment_image($thirdcolumnimg, 'thumbnail', false, array('class'=>'vs-image'));
						}
						else{
							$thirdcolumncont = wp_kses_post( $thirdcolumncont);
							$output .=  do_shortcode($thirdcolumncont);
						}																			
					$output .= '</div>';					
				}


			$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
}

VersusLine::instance();
