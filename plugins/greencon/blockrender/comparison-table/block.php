<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class ComparisonTable{

	protected $name = 'comparison-table';

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
        'enableBadges' => array('type'    => 'boolean','default' => false ),
		'enableImage' => array('type'    => 'boolean','default' => true ),
		'enableTitle' => array('type' => 'boolean','default' => true ),
		'enableSubtitle' => array('type' => 'boolean','default' => true ),
		'enableStars' => array('type' => 'boolean', 'default' => true ),
		'enableNumbers' => array( 'type' => 'boolean', 'default' => false ),
		'enableList' => array( 'type' => 'boolean', 'default' => false ),
		'enableListTitle' => array( 'type' => 'boolean', 'default' => true ),
		'enableButton' => array( 'type' => 'boolean', 'default' => true ),
		'enableBottom' => array( 'type' => 'boolean', 'default' => true ),
		'enablePros' => array( 'type' => 'boolean', 'default' => true ),
		'enableCons' => array( 'type' => 'boolean', 'default' => true ),
		'enableSpec' => array( 'type' => 'boolean', 'default' => false ),
		'enableCallout' => array( 'type' => 'boolean', 'default' => false ),
		'titleTag' => array( 'type' => 'string', 'default' => 'div' ),
		'titleFont' => array( 'type' => 'number', 'default' => 18 ),
		'contentFont' => array( 'type' => 'number', 'default' => 14 ),
		'bottomTitle' => array( 'type' => 'string', 'default' => 'Bottom Line' ),
		'prosTitle' => array( 'type' => 'string', 'default' => 'Pros' ),
		'consTitle' => array( 'type' => 'string', 'default' => 'Cons' ),
		'specTitle' => array( 'type' => 'string', 'default' => 'Spec' ),
		'responsiveView' => array( 'type' => 'string', 'default' => 'stacked' ),
		'bgfirst' => array( 'type' => 'string', 'default' => '' ),
		'colorfirst' => array( 'type' => 'string', 'default' => '' ),
		'bgcontent' => array( 'type' => 'string', 'default' => '#ffffff' ),
		'colorcontent' => array( 'type' => 'string', 'default' => '#333333' ),
		'disablefirst' => array('type'    => 'boolean','default' => false ),
	);

	public function render_block( $settings = array(), $inner_block='' ) {
		$alignclass = (!empty($settings['align'])) ? ' align'.esc_attr($settings['align']).' ' : '';
		$uniqueid = 'gc-compare-table'.mt_rand();
		ob_start();
		?>
			<style scoped>
				body #<?php echo esc_attr($uniqueid);?> .comparison-wrapper .comparison-item{<?php echo (!empty($settings['bgcontent'])) ? 'background:'.esc_attr($settings['bgcontent']).';' : '';?><?php echo (!empty($settings['colorcontent'])) ? 'color:'.esc_attr($settings['colorcontent']).';' : '';?>}
				body #<?php echo esc_attr($uniqueid);?> .comparison-control-prev svg path, body #<?php echo esc_attr($uniqueid);?> .comparison-control-next svg path{<?php echo (!empty($settings['colorcontent'])) ? 'fill:'.esc_attr($settings['colorcontent']).';' : '';?>}
				body #<?php echo esc_attr($uniqueid);?> .comparison-wrapper .comparison-item .item-list-links a{<?php echo (!empty($settings['colorcontent'])) ? 'color:'.esc_attr($settings['colorcontent']).';' : '';?>}				
				body #<?php echo esc_attr($uniqueid);?>.stacked .comparison-item .item-row-description .item-row-title, body #<?php echo esc_attr($uniqueid);?>.slide .comparison-item .item-row-description .item-row-title{
					<?php echo (!empty($settings['bgfirst'])) ? 'background:'.esc_attr($settings['bgfirst']).';' : '';?><?php echo (!empty($settings['colorfirst'])) ? 'color:'.esc_attr($settings['colorfirst']).';' : '';?>
				}
				body #<?php echo esc_attr($uniqueid);?> .comparison-wrapper{
					<?php echo (!empty($settings['contentFont'])) ? 'font-size:'.esc_attr($settings['contentFont']).'px;' : '';?>
				}
			</style>
			<div id="<?php echo esc_attr($uniqueid);?>" class="<?php echo esc_attr($alignclass);?>comparison-table <?php echo $settings['responsiveView'] ==='slide' ? 'swiper swiper-container' : ''; ?> <?php echo esc_attr($settings['responsiveView']); ?> <?php echo $settings['enableBadges'] ? 'has-badges' : ''; ?> <?php echo $settings['disablefirst'] ? 'noheadertable' : ''; ?>" data-table-type="<?php echo esc_attr($settings['responsiveView']); ?>">
				<div class="comparison-item comparison-header" style="<?php if(!empty($settings['bgfirst'])):?>background: <?php echo esc_attr($settings['bgfirst']); ?>;<?php endif;?><?php if(!empty($settings['colorfirst'])):?>color: <?php echo esc_attr($settings['colorfirst']); ?>;<?php endif;?>">
					<div class="item-header" data-match-height="itemHeader"></div>
					<?php if($settings['enableBottom']): ?>
						<div class="item-row-description item-row-bottomline" data-match-height="itemBottomline">
							<?php echo esc_attr($settings['bottomTitle']); ?>
						</div>
					<?php endif; ?>
					<?php if($settings['enablePros']): ?>
						<div class="item-row-description item-row-pros" data-match-height="itemPros">
							<?php echo esc_attr($settings['prosTitle']); ?>
						</div>
					<?php endif; ?>
					<?php if($settings['enableCons']): ?>
						<div class="item-row-description item-row-cons" data-match-height="itemCons">
							<?php echo esc_attr($settings['consTitle']); ?>
						</div>
					<?php endif; ?>
					<?php if($settings['enableSpec']): ?>
						<div class="item-row-description item-row-spec" data-match-height="itemSpec">
							<?php echo esc_attr($settings['specTitle']); ?>
						</div>
					<?php endif; ?>
					<?php if($settings['enableCallout']): ?>
						<div class="item-row-description item-row-callout" data-match-height="itemCallout">&nbsp;</div>
					<?php endif; ?>
				</div>
				<div class="comparison-wrapper <?php echo $settings['responsiveView'] ==='slide' ? 'swiper-wrapper' : ''; ?>">
					<?php echo ''.$inner_block; //Only gutencon/comparison-item is allowed for this block and its sanitized in own render function, using any sanitisation here breaks inner block content ?>
				</div>
				<button type="button" class="comparison-control-prev">
					<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492">
						<path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
							C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
							c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
							l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
					</svg>
				</button>
				<button type="button" class="comparison-control-next">
					<svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492.004 492.004">
						<path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
							c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
							c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
							c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
					</svg>
				</button>
			</div>
		<?php 
		$output = ob_get_clean();
		return $output;
	}
}

ComparisonTable::instance();
