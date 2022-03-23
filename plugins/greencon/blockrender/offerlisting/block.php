<?php

namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;

class OfferListing{

	protected $name = 'offerlisting';

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
		'btnColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'btntColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'priceColor'      => array(
			'type'    => 'string',
			'default' => '',
		),
		'offers' => array(
			'type'    => 'array',
			'default' => array(
				array(
					'score'          => 10,
					'enableBadge'    => true,
					'enableScore'    => true,
					'enableread'    => true,
					'thumbnail'      => array(
						'url'    => '',
						'width'  => '',
						'height' => '',
						'alt'    => '',
					),
					'title'          => 'Post name',
					'copy'           => 'Content',
					'customBadge'    => array(
						'text'            => 'Best Values',
						'textColor'       => '#fff',
						'backgroundColor' => '#77B21D'
					),
					'currentPrice'   => '',
					'oldPrice'       => '',
					'button'         => array(
						'text' => 'Buy Now',
						'url'  => ''
					),
					'couponCode'         => '',
					'expirationDate' => '',
					'offerExpired'   => false,
					'read' => array(
						'readMore'       => 'Read full review',
						'readMoreUrl'    => '#',
					),
					'disclaimer'     => ''
				)
			),
		),
	);

	public function render_block($settings = array()){
		extract($settings);

		$html   = '';
		if ( empty( $offers ) || count( $offers ) === 0 ) {
			return;
		}
		$html .= '<div class="c-offer-listing">';

		$btnstyles = ($btnColor || $btntColor) ? 'style="background-color:' . esc_attr($btnColor) . '; color:' . esc_attr($btntColor) . ';"' : '';
		$titlestyles = ($titleColor) ? 'style="color:' . esc_attr($titleColor) . ';"' : '';
		$pricestyles = ($priceColor) ? 'style="color:' . esc_attr($priceColor) . ';"' : '';

		foreach ( $offers as $offer ) {
			$score             = !empty($offer['score']) ? esc_attr($offer['score']) : '';
			$offer_url         = !empty($offer['button']['url']) ? $offer['button']['url'] : '';
			$offer_url 		   = apply_filters('gutencon_url_filter', $offer_url );
			$offer_url 		   = apply_filters('rh_post_offer_url_filter', $offer_url );
			$imageid             = !empty($offer['thumbnail']['id']) ? $offer['thumbnail']['id'] : '';
			$image_url         = !empty($offer['thumbnail']['url']) ? $offer['thumbnail']['url'] : '';
			$image_alt         = !empty($offer['thumbnail']['alt']) ? $offer['thumbnail']['alt'] : '';
			$image_width         = !empty($offer['thumbnail']['width']) ? $offer['thumbnail']['width'] : '';
			$image_height         = !empty($offer['thumbnail']['height']) ? $offer['thumbnail']['height'] : '';
			$title             = !empty($offer['title']) ? $offer['title'] : '';
			$copy              = !empty($offer['copy']) ? $offer['copy'] : '';
			$current_price     = !empty($offer['currentPrice']) ? $offer['currentPrice'] : '';
			$old_price         = !empty($offer['oldPrice']) ? $offer['oldPrice'] : '';
			$button_text       = !empty($offer['button']['text']) ? $offer['button']['text'] : esc_html__( 'Buy Now', 'gutencon' );
			$read_more_text    = !empty($offer['read']['readMore']) ? $offer['read']['readMore'] : esc_html__('Read full review', 'gutencon');
			$read_more_url     = !empty($offer['read']['readMoreUrl']) ? $offer['read']['readMoreUrl'] : '';
			$disclaimer        = !empty($offer['disclaimer']) ? $offer['disclaimer'] : '';
			$enable_badge      = !empty($offer['enableBadge']) ? $offer['enableBadge'] : '';
			$enable_score      = !empty($offer['enableScore']) ? $offer['enableScore'] : '';
			$badge             = !empty($offer['customBadge']) ? $offer['customBadge'] : '';
			$badgebg	       = !empty($badge['backgroundColor']) ? $badge['backgroundColor'] : '';
			$badgetxcolor	   = !empty($badge['textColor']) ? $badge['textColor'] : '';
			$badge_styles      = 'background-color:' . $badgebg . '; color:' . $badgetxcolor . ';';
			$coupon_code      = !empty($offer['couponCode']) ? $offer['couponCode'] : '';
			$offer_coupon_date = !empty($offer['expirationDate']) ? $offer['expirationDate'] : '';
			$coupon_style      = '';
			$expired           = '';

			if ( empty( $image_url ) ) {
				$image_url = GUTENCON_PLUGIN_URL . '/assets/icons/noimage-placeholder.png';
			}

			if ( ! empty( $offer_coupon_date ) ) {
				$timestamp1 = strtotime( $offer_coupon_date ) + 86399;
				$seconds    = $timestamp1 - (int) current_time( 'timestamp', 0 );
				$days       = floor( $seconds / 86400 );
				$seconds    %= 86400;

				if ( $days > 0 ) {
					$coupon_text = $days.' '.esc_html__('days left', 'gutencon');
					$coupon_style = '';
					$expired      = 'no';
				} elseif ( $days == 0 ) {
					$coupon_text = esc_html__('Last day', 'gutencon');
					$coupon_style = '';
					$expired      = 'no';
				} else {
					$coupon_text  = esc_html__( 'Expired', 'gutencon' );
					$coupon_style = ' expired_coupon';
					$expired      = '1';
				}
			}

			$html .= '<div class="c-offer-listing-item">';
				$html .= '<div class="c-offer-listing-item__wrapper'.esc_attr($coupon_style).'">';
					$html .= '<div class="c-offer-listing-image">';
						if ( $enable_score ) {
							$html .= '<div class="c-offer-listing-score">';
								$html .= '<span class="score--' . round( $offer['score'] ) . '">';
									$html .= esc_html( $score );
								$html .= '</span>';
							$html .= '</div>';
						}
						$html .= '<figure>';
						if(!empty($imageid)){
							$html .= wp_get_attachment_image($imageid, 'full', false);
						}
						else if(!empty($image_url)){
							$html .= '<img src="'.esc_url($image_url).'" class="attachment-full size-full" alt="'.esc_attr($image_alt).'" loading="lazy" width="'.esc_attr($image_width).'"  height="'.esc_attr($image_height).'">';
						}
						$html .= '</figure>';
					$html .= '</div>';
					$html .= '<div class="c-offer-listing-content">';
						$html .= '<'.$titleTag . ' class="c-offer-listing__title">';
							$html .= '<a href="' . esc_url( $offer_url ) . '" class="gc_track_btn re_track_btn" target="_blank" rel="nofollow sponsored" '.$titlestyles.'>';
								$html .= '' . esc_html( trim( $title ) ) . '';
							$html .= '</a>';
							if ( $enable_badge ) {
								$html .= '<span class="blockstyle">';
								$html .= '	<span class="re-line-badge re-line-badge--default" style="' . esc_attr( $badge_styles ) . '">';
								$html .= '      <span>' . esc_html( $badge['text'] ) . '</span>';
								$html .= '	</span>';
								$html .= '</span>';
							}
						$html .= '</' . $titleTag . '>';
						$html .= '<div class="c-offer-listing__copy">' .wp_kses_post( $copy ). '</div>';
					$html .= '</div>';
					$html .= '<div class="c-offer-listing-cta">';
						if ( $current_price ) {
							$html .= '<div class="c-offer-listing-price">';
								$html .= '<span class="rh_regular_price" '.$pricestyles.'>' . esc_html( trim( $current_price ) ) . '</span>';
								if ( $old_price && $old_price !== $current_price ) {
									$html .= '<del class="">' . esc_html( trim( $old_price ) ) . '</del>';
								}
							$html .= '	</div>';
						}
						if ( $offer_url ) {
							$html .= '<div class="priced_block priced_block--sm">';
								$html .= '<a href="' . esc_url( $offer_url ) . '" target="_blank" rel="nofollow sponsored" class="btn_offer_block gc_track_btn re_track_btn" '.$btnstyles.'>';
									$html .= esc_attr($button_text);
								$html .= '</a>';
							$html .= '</div>';
						}
						if ($coupon_code){
							$html .= '<div class="gc_offer_coupon '.$coupon_style.'">
								<input class="coupon_text" readonly value="'.esc_attr($coupon_code).'" />
								<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 480"> <g> <g> <rect x="144" y="264" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="296" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="232" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="200" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="168" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="328" width="16" height="16"/> </g> </g> <g> <g> <path d="M472,200c4.418,0,8-3.582,8-8v-80c0-4.418-3.582-8-8-8H8c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8 c22.091,0,40,17.909,40,40s-17.909,40-40,40c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8h464c4.418,0,8-3.582,8-8v-80 c0-4.418-3.582-8-8-8c-22.091,0-40-17.909-40-40S449.909,200,472,200z M416.524,247.956c3.532,24.61,22.867,43.944,47.476,47.476 V360H16v-64.568c30.614-4.394,51.87-32.773,47.476-63.388C59.944,207.435,40.61,188.1,16,184.568V120h448v64.568 C433.386,188.962,412.13,217.341,416.524,247.956z"/> </g> </g> <g> <g> <path d="M240,160c-17.673,0-32,14.327-32,32s14.327,32,32,32c17.673,0,32-14.327,32-32S257.673,160,240,160z M240,208 c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S248.837,208,240,208z"/> </g> </g> <g> <g> <path d="M336,256c-17.673,0-32,14.327-32,32c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32C368,270.327,353.673,256,336,256z M336,304c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S344.837,304,336,304z"/> </g> </g> <g> <g> <rect x="197.494" y="231.982" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -85.3385 273.9377)" width="181.017" height="16"/> </g> </g> </svg>
							</div>';
							$html .= '<div class="time_offer">'.esc_attr($coupon_text).'</div>';
						}
						if ( $read_more_url ) {
							$html .= '<a href="' . esc_url( $read_more_url ) . '" class="c-offer-listing__read-more">';
								$html .= esc_html( trim( $read_more_text ) );
							$html .= '</a>';
						}

					$html .= '</div>';
				$html .= '</div>';
				if ( $disclaimer ) {
					$html .= '<div class="c-offer-listing-disclaimer">';
					$html .= wp_kses( $disclaimer , 'post' );
					$html .= '</div>';
				}
			$html .= ' </div>';
		}
		$html .= '</div>';

		return $html;

	}
}

OfferListing::instance();