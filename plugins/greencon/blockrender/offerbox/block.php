<?php

namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;

class OfferBox{

	protected $name = 'offerbox';

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
		'name' => array(
			'type'    => 'string',
			'default' => '',
		),
		'titleTag' => array(
			'type'    => 'string',
			'default' => 'h3',
		),
		'description' => array(
			'type'    => 'string',
			'default' => '',
		),
		'disclaimer'  => array(
			'type'    => 'string',
			'default' => '',
		),
		'old_price'        => array(
			'type'    => 'string',
			'default' => '',
		),
		'sale_price'       => array(
			'type'    => 'string',
			'default' => '',
		),
		'coupon_code'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'expiration_date'  => array(
			'type'    => 'string',
			'default' => '',
		),
		'offer_is_expired' => array(
			'type' => 'boolean',
			'default' => false,
		),
		'shadow' => array(
			'type' => 'boolean',
			'default' => false,
		),
		'schemaenable' => array(
			'type' => 'boolean',
			'default' => false,
		),
		'button'  => array(
			'type'    => 'object',
			'default' => array(
				'text'     => 'Buy this item',
				'url'      => '',
				'newTab'   => true,
				'noFollow' => true,
			),
		),
		'schemafields'  => array(
			'type'    => 'object',
			'default' => array(
				'mpn'     => '12345',
				'sku'     => '999GC',
				'count'      => 5,
				'currency'   => 'USD',
				'price'   => '',
				'brand' => 'Brand'
			),
		),
		'thumbnail'        => array(
			'type'    => 'object',
			'default' => array(
				'id'     => '',
				'url'    => '',
				'width'  => '',
				'height' => ''
			),
		),
		'discount_tag'     => array(
			'type'    => 'number',
			'default' => 0
		),
		'rating'           => array(
			'type'    => 'number',
			'default' => 0,
		),
		'borderColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'bgColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'btnColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'btntColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'textColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'titleColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'priceColor'      => array(
			'type'    => 'string',
			'default' => '',
		)
	);

	public function render_block($settings = array()){
		extract($settings);
		
		$urllink = apply_filters('gutencon_url_filter', $button['url']);
		$urllink = apply_filters('rh_post_offer_url_filter', $urllink);
		$buttontxt = $button['text'];
		$coupon_style = $expired = ''; 
		if(!empty($expiration_date)){
			$timestamp1 = strtotime($expiration_date) + 86399;
			$seconds = $timestamp1 - (int)current_time('timestamp',0);
			$days = floor($seconds / 86400);
			$seconds %= 86400;
			if ($days > 0) {
				$coupon_text = $days.' '.esc_html__('days left', 'gutencon');
				$coupon_style = '';
				$expired = 'no';
			}
			elseif ($days == 0){
				$coupon_text = esc_html__('Last day', 'gutencon');
				$coupon_style = '';
				$expired = 'no';
			}
			else {
				$coupon_text = esc_html__('Expired', 'gutencon');
				$coupon_style = ' expired_coupon';
				$expired = '1';
			}
		}
		ob_start(); 
		?>
		<div class="c-offer-box" style="<?php echo ($borderColor) ? 'border:3px solid '.esc_attr($borderColor).';' : '';?><?php echo ($textColor) ? 'color:'.esc_attr($textColor).';' : '';?><?php echo ($bgColor) ? 'background:'.esc_attr($bgColor).';' : '';?><?php echo ($shadow) ? 'box-shadow:0 10px 10px #00000007;' : '';?>"<?php echo ($schemaenable) ? ' itemtype="http://schema.org/Product" itemscope' : '';?>>
			<?php if($schemaenable):?>
				<meta itemprop="mpn" content="<?php echo esc_attr($schemafields['mpn']);?>" />
				<meta itemprop="sku" content="<?php echo esc_attr($schemafields['sku']);?>" />
				<link itemprop="image" href="<?php echo esc_url($thumbnail['url']);?>" />
			<?php endif;?>
			<div class="c-offer-box__wrapper" style="<?php echo ($borderColor || $bgColor) ? 'padding:25px 10px 0 10px;' : '';?>">
				
				<div class="c-offer-box__column c-offer-box__column--image">
					<div class='c-offer-box__image'>
						<?php if(!empty($thumbnail['id'])):?>
							<?php echo wp_get_attachment_image($thumbnail['id'], 'full', false) ?>
						<?php elseif(!empty($thumbnail['url'])):?>
							<img src="<?php echo esc_url($thumbnail['url']);?>" class="attachment-full size-full" alt="" loading="lazy"<?php echo (!empty($thumbnail['width']) && !empty($thumbnail['height'])) ? ' height="'.esc_attr($thumbnail['height']).'" width="'.esc_attr($thumbnail['width']).'"' : '';?>>
						<?php endif;?>
						<?php if($discount_tag > 0):?>
							<span class='c-offer-box__discount'>-<?php echo esc_attr($discount_tag);?>%</span>
						<?php endif;?>
					</div>
				</div>
				<div class="c-offer-box__column">
					<<?php echo esc_attr($titleTag);?> class="c-offer-box__title">
					<a class="gc_track_btn re_track_btn" href="<?php echo esc_url($urllink) ;?>"<?php echo (!empty($button['newTab'])) ? ' target="_blank"' : '' ;?><?php echo (!empty($button['noFollow'])) ? ' rel="nofollow sponsored"' : '';?> style="<?php echo ($titleColor) ? 'color:'.esc_attr($titleColor).';' : '';?>">
						<span <?php echo ($schemaenable) ? 'itemprop="name"' : '';?>><?php echo esc_attr($name); ?></span> 
					</a>
					</<?php echo esc_attr($titleTag);?>>
					<?php  if ((int)$rating > 0): ?>					
						<div class="c-offer-box__rating" <?php echo ($schemaenable) ? ' itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope' : '';?>>
							<?php if($schemaenable):?>
								<meta itemprop="reviewCount" content="<?php echo (int)$schemafields['count'];?>" />
								<meta itemprop="ratingValue" content="<?php echo (float)$rating;?>" />
							<?php endif;?>
							<?php
							echo str_repeat("<span class='orangecolor'>&#x2605;</span>", (int)$rating);
							echo str_repeat("<span>☆</span>", 5 - (int)$rating);
							?>
						</div>   
					<?php endif; ?> 
					<div class="c-offer-box__price">
						<span style="<?php echo ($priceColor) ? 'color:'.esc_attr($priceColor).';' : '';?>"><?php echo esc_attr($sale_price);?></span>
						<span class="retail-old"><strike><?php echo esc_attr($old_price);?></strike></span>
					</div> 
					<div class="c-offer-box__disclaimer">
						<span><?php echo esc_attr($disclaimer);?></span>
					</div>
					<div class="priced_block" <?php echo ($schemaenable) ? ' itemprop="offers" itemtype="http://schema.org/Offer" itemscope' : '';?>>
						<?php if($schemaenable):?>
							<meta itemprop="availability" content="https://schema.org/InStock" />
        					<meta itemprop="priceCurrency" content="<?php echo esc_attr($schemafields['currency']);?>" />
        					<meta itemprop="itemCondition" content="https://schema.org/NewCondition" />
                            <?php if(!empty($schemafields['price'])):?>
                                <?php $schemaprice = $schemafields['price'];?>
                            <?php else:?>
                                <?php $schemaprice = (float)$offer_price;?>
                            <?php endif;?>
        					<meta itemprop="price" content="<?php echo esc_attr($schemaprice); ?>" />
							<?php if($expiration_date):?>
								<meta itemprop="priceValidUntil" content="<?php echo esc_attr($expiration_date);?>" />
							<?php endif;?>
						<?php endif;?>
						<div>
							<a style="<?php echo ($btnColor) ? 'background-color:'.esc_attr($btnColor).';' : '';?><?php echo ($btntColor) ? 'color:'.esc_attr($btntColor).';' : '';?>" class="gc_track_btn re_track_btn btn_offer_block"  href="<?php echo esc_url($urllink) ;?>"<?php echo (!empty($button['newTab'])) ? ' target="_blank"' : '';?><?php echo (!empty($button['noFollow'])) ? ' rel="nofollow sponsored"' : '';?><?php echo ($schemaenable) ? ' itemprop="url"' : '';?>>
								<?php echo esc_attr($buttontxt);?>
							</a>
						</div>
						<?php if ($coupon_code):?>
						<div class="gc_offer_coupon <?php echo esc_attr($coupon_style);?>">
							<input class="coupon_text" readonly value="<?php echo esc_attr($coupon_code);?>" />
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 480"> <g> <g> <rect x="144" y="264" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="296" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="232" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="200" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="168" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="328" width="16" height="16"/> </g> </g> <g> <g> <path d="M472,200c4.418,0,8-3.582,8-8v-80c0-4.418-3.582-8-8-8H8c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8 c22.091,0,40,17.909,40,40s-17.909,40-40,40c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8h464c4.418,0,8-3.582,8-8v-80 c0-4.418-3.582-8-8-8c-22.091,0-40-17.909-40-40S449.909,200,472,200z M416.524,247.956c3.532,24.61,22.867,43.944,47.476,47.476 V360H16v-64.568c30.614-4.394,51.87-32.773,47.476-63.388C59.944,207.435,40.61,188.1,16,184.568V120h448v64.568 C433.386,188.962,412.13,217.341,416.524,247.956z"/> </g> </g> <g> <g> <path d="M240,160c-17.673,0-32,14.327-32,32s14.327,32,32,32c17.673,0,32-14.327,32-32S257.673,160,240,160z M240,208 c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S248.837,208,240,208z"/> </g> </g> <g> <g> <path d="M336,256c-17.673,0-32,14.327-32,32c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32C368,270.327,353.673,256,336,256z M336,304c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S344.837,304,336,304z"/> </g> </g> <g> <g> <rect x="197.494" y="231.982" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -85.3385 273.9377)" width="181.017" height="16"/> </g> </g> </svg>
						</div>
						<?php endif;?>
						<?php if(isset($coupon_text)):?><div class="time_offer"><?php echo esc_attr($coupon_text) ;?></div><?php endif;?>
					</div>
					<div class="c-offer-box__desc">
						<span <?php echo ($schemaenable) ? 'itemprop="description"' : '';?>><?php echo wp_kses_post($description);?></span>
					</div>
					<?php if($schemaenable):?>
						<div itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
							<meta itemprop="name" content="<?php echo esc_attr($schemafields['brand']);?>" />
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;	

	}
}

OfferBox::instance();