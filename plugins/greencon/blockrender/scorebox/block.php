<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class Scorebox{

	protected $name = 'Scorebox';

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
		register_block_type(__DIR__, array(
			'render_callback' => array( $this, 'render_block' ),
			'attributes'      => $this->attributes
		)
		);
	}

	public $attributes = array(
		'title'       => array(
			'type'    => 'string',
		),
		'label' => array(
			'type'    => 'string',
		),
		'labelicon' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'disablepros' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'schemaenable' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'coverenable' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'enableinner' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'innerbottom' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'score'       => array(
			'type'    => 'number',
			'default' => 7
		),
		'boxradius'       => array(
			'type'    => 'number',
			'default' => 0
		),
		'scorebgColor'   => array(
			'type'    => 'string',
			'default' => '#ffffff',
		),
		'scoretextColor'   => array(
			'type'    => 'string',
			'default' => '#111111',
		),
		'labelColor'   => array(
			'type'    => 'string',
			'default' => '#cd0000',
		),
		'scorecircleColor'   => array(
			'type'    => 'string',
			'default' => '#1CC600',
		),
		'prosTitle'   => array(
			'type'    => 'string',
			'default' => 'POSITIVES',
		),
		'buttons'   => array(
			'type'    => 'array',
			'default' => array(
				array(
				'url'=> '',
				'btntitle'=> 'Check lowest prices',
				'newTab' => '',
				'noFollow' => '',
				'textcolor' => '#ffffff',
				'bgcolor' => '#cc0000',
				'bggradient' => '',
				'radius'=> 3
				)
				
			),
		),
		'positives'   => array(
			'type'    => 'array',
			'default' => array(
				array(
				'title'=> 'Positive Item 1',
				),
				array(
					'title'=> 'Positive Item 2',
					)
				
			),
		),
		'consTitle'   => array(
			'type'    => 'string',
			'default' => 'NEGATIVES',
		),
		'negatives'   => array(
			'type'    => 'array',
			'default' => array(
				array(
				'title'=> 'Negative Item 1',
				),
				array(
					'title'=> 'Negative Item 2',
					)
				
			),
		),
		'bgColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'textColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'prosiconColor'   => array(
			'type'    => 'string',
			'default' => '',
		),
		'consiconColor'   => array(
			'type'    => 'string',
			'default' => '',
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
	);

	public function render_block($settings = array(), $inner_content=''){
		extract($settings);
		$scorecalculate = 440 - (440 * $score * 10) / 100;

		$schemarender = ($schemaenable) ? ' itemtype="http://schema.org/Product" itemscope' : '';
		$schemaoffer = ($schemaenable) ? ' itemprop="offers" itemtype="http://schema.org/Offer" itemscope' : '';
		$schemarating = ($schemaenable) ? ' itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope' : '';
		$schemaname = ($schemaenable) ? ' itemprop="name"' : '';
		$schemadescription = ($schemaenable) ? ' itemprop="description"' : '';
		$schemaurl = ($schemaenable) ? ' itemprop="url"' : '';
		$fullclass = ($coverenable) ? ' imagefullcover' : '';

		$out = '<div class="gc-scorebox"'.$schemarender.'>';
			if($schemaenable){
				$out .= '<meta itemprop="mpn" content="'.esc_attr($schemafields['mpn']).'" />';
				$out .= '<meta itemprop="sku" content="'.esc_attr($schemafields['sku']).'" />';
				$out .= '<meta itemprop="image" content="'.esc_url($thumbnail['url']).'" />';
				$out .='<div itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
				<meta itemprop="name" content="'.esc_attr($schemafields['brand']).'" />
				</div>';
			}
			$out .= '<div class="gc-scorebox__left">';
				$out .='<div class="gc-scorebox__wrap" style="background-color: '.esc_attr($bgColor).'; border-radius:'.(int)$boxradius.'px; overflow:hidden">';
					$out .= '<div class="gc-scorebox__image'.$fullclass.'" style="max-height:240px">';
						if(!empty($thumbnail['id'])){
							$out .= wp_get_attachment_image($thumbnail['id'], 'full', false);
						}
						else if(!empty($thumbnail['url'])){
							$out .= '<img src="'.esc_url($thumbnail['url']).'" class="attachment-full size-full" alt="" loading="lazy">';
						}
					$out .='</div>';
					$out .= '<div class="gc-scorebox__cont">';
						$out .= '<div class="gc-scorebox__score" style="background-color: '.esc_attr($scorebgColor).'; color: '.esc_attr($scoretextColor).'"'.$schemarating.'>';
							if($schemaenable){
								$scoreuser = $score/2;
								$out .='<meta itemprop="reviewCount" content="'.(int)$schemafields["count"].'" />';
								$out .='<meta itemprop="ratingValue" content="'.(float)$scoreuser.'" />';
							}
							$out .='<svg viewBox="0 0 154 154" style="transform: rotate(270deg); width: 80px; height: 80px; position: absolute">
								<circle cx="70" cy="70" r="70" style="stroke: #ffffff7d; stroke-dashoffset: '.$scorecalculate.'; stroke-width: 14px; transform: translate(7px, 7px); fill: none">
								</circle>
								<circle cx="70" cy="70" r="70" style="stroke-dasharray: 440px; stroke: '.esc_attr($scorecircleColor).'; stroke-dashoffset: '.(float)$scorecalculate.'; stroke-width: 14px; transform: translate(7px, 7px); fill: none; stroke-linecap: round"></circle>
							</svg>
							<div class="gc-scorebox__number">
							'.(float)$score.'
							</div>';
						$out .='</div>';
						$out .= '<div class="gc-scorebox__label" style="color: '.esc_attr($labelColor).'; fill: '.esc_attr($labelColor).'">';
							if($labelicon){
								$out .= '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512.002 512.002" width="20" height="20"> <g> <g> <path d="M511.267,197.258c-1.764-5.431-6.457-9.389-12.107-10.209l-158.723-23.065L269.452,20.157 c-2.526-5.12-7.741-8.361-13.45-8.361c-5.71,0-10.924,3.241-13.451,8.361l-70.988,143.827l-158.72,23.065 c-5.649,0.82-10.344,4.778-12.108,10.208c-1.765,5.431-0.293,11.392,3.796,15.377l114.848,111.954L92.271,482.671 c-0.966,5.628,1.348,11.314,5.967,14.671c2.613,1.898,5.708,2.864,8.818,2.864c2.388,0,4.784-0.569,6.978-1.723l141.967-74.638 l141.961,74.637c5.055,2.657,11.178,2.215,15.797-1.141c4.619-3.356,6.934-9.044,5.969-14.672l-27.117-158.081l114.861-111.955 C511.56,208.649,513.033,202.688,511.267,197.258z"/> </g> </g> </svg>';
							}
							$out .='<span>'.wp_kses_post($label).'</span>';
						$out .='</div>';
						$out .='<div class="gc-scorebox__title" style="color: '.esc_attr($textColor).'">';
							$out .='<span'.$schemaname.'>'.wp_kses_post($title).'</span>';
						$out .='</div>';
						$out .='<div class="gc-scorebox__buttons"'.$schemaoffer.'>';
						if($schemaenable){
							$out .='<meta itemprop="availability" content="https://schema.org/InStock" />';
							$out .='<meta itemprop="priceCurrency" content="'.esc_attr($schemafields["currency"]).'" />';
							$out .='<meta itemprop="itemCondition" content="https://schema.org/NewCondition" />';
							$out .='<meta itemprop="price" content="'.(float)$schemafields["price"].'" />';
						}

						foreach ($buttons as $index=>$button){
							$bgcolor = (!empty($button['bgcolor'])) ? $button['bgcolor'] : '';
							$bggradient = (!empty($button['bggradient'])) ? $button['bggradient'] : '';
							$radius = (!empty($button['radius'])) ? $button['radius'] : '';
							$textcolor = (!empty($button['textcolor'])) ? $button['textcolor'] : '';
							$urltarget = (!empty($button['newTab'])) ? ' target="_blank"' : '';
							$urlrel = (!empty($button['noFollow'])) ? ' rel="nofollow sponsored"' : '';
							$btntitle = (!empty($button['btntitle'])) ? $button['btntitle'] : '';
							$url = (!empty($button['url'])) ? $button['url'] : '';
							$urllink = apply_filters('gutencon_url_filter', $url);
							$urllink = apply_filters('rh_post_offer_url_filter', $urllink);
							$urlschema = ($index==0 && $schemaenable) ? $schemaurl : '';
							
							$out .='<a class="gc_track_btn re_track_btn gc-scorebox__button" style="background-color: '.esc_attr($bgcolor).'; color: '.esc_attr($textcolor).'; background-image: '.esc_attr($bggradient).'; border-radius: '.(int)$radius.'px" href="'.esc_url($urllink).'"'.$urltarget.$urlrel.$urlschema.'>';
								$out .='<span>'.wp_kses_post($btntitle).'</span>';
							$out .='</a>';
						}
						$out .='</div>';
					$out .='</div>';
				$out .='</div>';
			$out .='</div>';
			$out .='<div class="gc-scorebox__right">';
				if($enableinner && !$innerbottom){
					$out .='<div class="gc-scorebox__inner">';
						$out .='<div'.$schemadescription.'>'.wp_kses_post($inner_content).'</div>';
					$out .='</div>';
				}
				if(!$disablepros){
					$out .='<div class="gc-scorebox__pros">';
						$out .='<div class="gc-scorebox__criterias-title gc-scorebox__criterias-title-pros" style="color:'.esc_attr($prosColor).'">'.wp_kses_post($prosTitle).'</div>';
						$out .='<ul class="gc-scorebox__list gc-scorebox__list-pros">';
							foreach($positives as $positive){
								$prostitle = (!empty($positive['title'])) ? $positive['title'] : '';
								$out .='<li class="gc-scorebox__list-item" style="fill: '.esc_attr($prosiconColor).'">';
									$out .='<svg xmlns="https://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 478.2 478.2"><g><path d="M457.575,325.1c9.8-12.5,14.5-25.9,13.9-39.7c-0.6-15.2-7.4-27.1-13-34.4c6.5-16.2,9-41.7-12.7-61.5 c-15.9-14.5-42.9-21-80.3-19.2c-26.3,1.2-48.3,6.1-49.2,6.3h-0.1c-5,0.9-10.3,2-15.7,3.2c-0.4-6.4,0.7-22.3,12.5-58.1 c14-42.6,13.2-75.2-2.6-97c-16.6-22.9-43.1-24.7-50.9-24.7c-7.5,0-14.4,3.1-19.3,8.8c-11.1,12.9-9.8,36.7-8.4,47.7 c-13.2,35.4-50.2,122.2-81.5,146.3c-0.6,0.4-1.1,0.9-1.6,1.4c-9.2,9.7-15.4,20.2-19.6,29.4c-5.9-3.2-12.6-5-19.8-5h-61 c-23,0-41.6,18.7-41.6,41.6v162.5c0,23,18.7,41.6,41.6,41.6h61c8.9,0,17.2-2.8,24-7.6l23.5,2.8c3.6,0.5,67.6,8.6,133.3,7.3 c11.9,0.9,23.1,1.4,33.5,1.4c17.9,0,33.5-1.4,46.5-4.2c30.6-6.5,51.5-19.5,62.1-38.6c8.1-14.6,8.1-29.1,6.8-38.3 c19.9-18,23.4-37.9,22.7-51.9C461.275,337.1,459.475,330.2,457.575,325.1z M48.275,447.3c-8.1,0-14.6-6.6-14.6-14.6V270.1 c0-8.1,6.6-14.6,14.6-14.6h61c8.1,0,14.6,6.6,14.6,14.6v162.5c0,8.1-6.6,14.6-14.6,14.6h-61V447.3z M431.975,313.4 c-4.2,4.4-5,11.1-1.8,16.3c0,0.1,4.1,7.1,4.6,16.7c0.7,13.1-5.6,24.7-18.8,34.6c-4.7,3.6-6.6,9.8-4.6,15.4c0,0.1,4.3,13.3-2.7,25.8 c-6.7,12-21.6,20.6-44.2,25.4c-18.1,3.9-42.7,4.6-72.9,2.2c-0.4,0-0.9,0-1.4,0c-64.3,1.4-129.3-7-130-7.1h-0.1l-10.1-1.2 c0.6-2.8,0.9-5.8,0.9-8.8V270.1c0-4.3-0.7-8.5-1.9-12.4c1.8-6.7,6.8-21.6,18.6-34.3c44.9-35.6,88.8-155.7,90.7-160.9 c0.8-2.1,1-4.4,0.6-6.7c-1.7-11.2-1.1-24.9,1.3-29c5.3,0.1,19.6,1.6,28.2,13.5c10.2,14.1,9.8,39.3-1.2,72.7 c-16.8,50.9-18.2,77.7-4.9,89.5c6.6,5.9,15.4,6.2,21.8,3.9c6.1-1.4,11.9-2.6,17.4-3.5c0.4-0.1,0.9-0.2,1.3-0.3 c30.7-6.7,85.7-10.8,104.8,6.6c16.2,14.8,4.7,34.4,3.4,36.5c-3.7,5.6-2.6,12.9,2.4,17.4c0.1,0.1,10.6,10,11.1,23.3 C444.875,295.3,440.675,304.4,431.975,313.4z"/></g></svg>';
									$out .='<span>'.wp_kses_post($prostitle).'</span>';
								$out .='</li>';

							}
						$out .='</ul>';
					$out .='</div>';
					$out .='<div class="gc-scorebox__cons">';
						$out .='<div class="gc-scorebox__criterias-title gc-scorebox__criterias-title-cons" style="color:'.esc_attr($consColor).'">'.wp_kses_post($consTitle).'</div>';
						$out .='<ul class="gc-scorebox__list gc-scorebox__list-cons">';
							foreach($negatives as $negative){
								$constitle = (!empty($negative['title'])) ? $negative['title'] : '';
								$out .='<li class="gc-scorebox__list-item" style="fill: '.esc_attr($consiconColor).'">';
									$out .='<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 155.129 155.129"><g><g><path d="M4.454,71.061c-7.858,7.829-5.43,23.653,8.181,23.653l35.813-0.024c-1.36,7.584-3.33,20.156-3.252,21.338c0.752,11.248,7.924,24.93,8.228,25.485c1.307,2.434,7.906,5.734,14.553,4.32c8.586-1.838,9.463-7.315,9.428-8.825c0,0-0.376-14.983-0.406-18.981c4.099-9.022,18.253-32.71,22.555-34.536c1.026,0.621,2.184,0.949,3.395,0.949h45.247c3.843,0,6.934-3.109,6.934-6.934l-0.006-62.533c-0.269-3.371-3.127-6.015-6.516-6.015h-40.634c-3.604,0-6.54,2.93-6.54,6.534v2.076c0,0-1.51,0.107-2.196-0.328c-2.608-1.659-5.842-3.747-10.054-3.747H28.542c-22.674,0-20.234,20.126-18.169,22.871c-3.831,4.171-6.2,11.528-2.966,17.34C4.913,56.34,0.545,63.572,4.454,71.061z M109.357,15.509h39.256v62.407h-39.256C109.357,77.917,109.357,15.509,109.357,15.509z M15.027,71.598l0.37-1.545c-10.448-2.971-4.887-15.007,2.602-15.794l0.37-1.545C8.35,50.165,13.13,37.766,20.976,36.918l0.364-1.539c-8.181-1.343-6.2-15.305,6.194-15.305l61.685-0.024c4.356,0,8.324,4.964,11.534,4.964h2.793v48.033c-3.485,2.166-7.763,4.964-10.15,6.993c-4.499,3.837-22.913,33.593-22.913,37.317c0,3.723,0.412,19.834,0.412,19.834s-3.616,4.648-11.671,1.259c0,0-6.784-12.727-7.476-22.859c0,0,3.049-20.884,4.696-27.442H13.678C3.183,88.144,5.188,73.137,15.027,71.598z"/></g></g></svg>';
									$out .='<span>'.wp_kses_post($constitle).'</span>';
								$out .='</li>';
							}
						$out .='</ul>';
					$out .='</div>';
				}
				if($enableinner && $innerbottom){
					$out .='<div class="gc-scorebox__inner">';
						$out .='<div'.$schemadescription.'>'.wp_kses_post($inner_content).'</div>';
					$out .='</div>';
				}
			$out .='</div>';
		$out .='</div>';
		return $out;
	}
}

Scorebox::instance();