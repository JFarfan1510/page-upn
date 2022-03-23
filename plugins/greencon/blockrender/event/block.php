<?php


namespace Gutencon\Blocks;
defined('ABSPATH') OR exit;


class EventBox{

	protected $name = 'event';

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
		'title'               => array(
			'type'    => 'string',
			'default' => 'Sample title',
		),
		'content'             => array(
			'type'    => 'string',
			'default' => 'Sample content',
		),
		'startdate'             => array(
			'type'    => 'string',
			'default' => '',
		),
		'enddate'             => array(
			'type'    => 'string',
			'default' => '',
		),
		'backgroundColor'     => array(
			'type'    => 'string',
			'default' => '#fff',
		),
		'textColor'           => array(
			'type'    => 'string',
			'default' => '#333',
		),
		'iconColor'           => array(
			'type'    => 'string',
			'default' => '',
		),
		'offerBg'     => array(
			'type'    => 'string',
			'default' => '#fa7204',
		),
		'offerColor'           => array(
			'type'    => 'string',
			'default' => '#fff',
		),
		'showBorder'          => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'schemaenable'          => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'borderSize'          => array(
			'type'    => 'number',
			'default' => 1,
		),
		'borderColor'         => array(
			'type'    => 'string',
			'default' => '#dddddd',
		),
		'showHighlightBorder' => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'highlightColor'      => array(
			'type'    => 'string',
			'default' => '#fb7203',
		),
		'highlightPosition'   => array(
			'type'    => 'string',
			'default' => 'Left',
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
		'location'        => array(
			'type'    => 'object',
			'default' => array(
				'name'     => '',
				'locality'    => '',
				'postal' => '',
				'street'  => '',
				'region' => '',
				'country' => '',
				'stream' => '',
				'maplabel' => '',
				'streamlabel' => '',
			),
		),
		'offer'        => array(
			'type'    => 'object',
			'default' => array(
				'url'     => '',
				'price'    => '',
				'currency' => 'USD',
				'priceschema' => ''
			),
		),
		'schemafields'        => array(
			'type'    => 'object',
			'default' => array(
				'name'     => '',
				'url'    => '',
			),
		),
	);

	public function render_block($settings = array()){
		extract ($settings);

		$schemarender = ($schemaenable) ? ' itemscope itemtype="https://schema.org/Event"' : '';
		$schemaname = ($schemaenable) ? ' itemprop="name"' : '';
		$schemadescription= ($schemaenable) ? ' itemprop="description"' : '';
		$schemaoffer = ($schemaenable) ? ' itemprop="offers" itemscope itemtype="https://schema.org/Offer"' : '';
		$schemastream = ($schemaenable && !empty($location['stream'])) ? ' itemprop="location" itemscope itemtype="https://schema.org/VirtualLocation"' : '';

		if ($showBorder ) {
			$border_size  = (int)$borderSize. 'px';
			$border_color = $borderColor;
		}

		if ( $showHighlightBorder ) {
			$highligh_color     = $highlightColor;
			$highlight_position = strtolower( $highlightPosition );
		}

		$offerstyle = ($offerBg || $offerColor) ? 'style="background-color:' . esc_attr($offerBg) . '; color:' . $offerColor . ';"' : '';
		$eventstyle = ($backgroundColor || $textColor) ? 'background-color:' . esc_attr($backgroundColor) . '; color:' . esc_attr($textColor). ';' : '';
		$colorlink = ($textColor) ? ' style="color:'.esc_attr($textColor).'"' : ''; 

		$startdatedate = $startdatemonth = $startdatefull = $enddatefull = '';
		if($startdate){
		   $startstr = strtotime($startdate);
		   $startdatedate = date_i18n('d', $startstr);
		   $startdatemonth = date_i18n('M', $startstr);
		   $startdatefull = date_i18n( "l d F, Y", $startstr );
		}
		if($enddate){
			$endstr = strtotime($enddate);
		   	$enddatefull = date_i18n( "l d F, Y", $endstr );
		}
		$uniqueid = 'gc-event'.mt_rand();
		$iconstyle = ($iconColor) ? '<style scoped>#'.$uniqueid.' .gc-event_meta svg{fill:'.esc_attr($iconColor).';}</style>' : '';

		$out = '<div id="'.$uniqueid.'" class="gc_eventbox" style="'.$eventstyle;
		if(!empty($border_size) && !empty($border_color)):
			$out .= 'border-width:'.$border_size.';border-color:'.esc_attr($border_color).'; border-style:solid;';
		endif;
		if($highligh_color && $highlight_position):
			$out .= 'border-'.esc_attr($highlight_position).'-width:3px;border-'.esc_attr($highlight_position).'-color:'.esc_attr($highligh_color).' !important;border-'.esc_attr($highlight_position).'-style:solid;';
		endif;
		$out .= '"'.$schemarender.'>';
			$out .=$iconstyle;
			$out .= '<div class="gc-event__image"><div class="gc-product-image"><div class="image gcimglightbox">';
				if(!empty($thumbnail['id'])){
					$out .= wp_get_attachment_image($thumbnail['id'], 'full', false);
				}
				else if(!empty($thumbnail['url'])){
					$out .= '<img src="'.esc_url($thumbnail['url']).'" class="attachment-full size-full" alt="" loading="lazy">';
				}
			$out .='</div></div></div>';
			if($startdate){
				$out .='<div class="gc-event__date">';
					$out .='<span class="gc-event__date_date">';
						$out .= $startdatedate;
					$out .= '</span>';
					$out .= '<span class="gc-event__date_month">';
						$out .= $startdatemonth;
					$out .='</span>';			
				$out .='</div>';
			}
			$out .= '<div class="gc-event_cont">';
				if($title):
					$out .= '<div class="gc-title_event"'.$schemaname.'>'.wp_kses_post($title).'</div>';
				endif;
				if($schemaenable){
					if($startdate){
						$out .= '<meta itemprop="startDate" content="'.$startdate.wp_timezone_string().'">';
					}
					if($enddate){
						$out .= '<meta itemprop="endDate" content="'.$enddate.wp_timezone_string().'">';
					}
					if(!empty($thumbnail['url'])){
						$out .= '<link itemprop="image" href="'.esc_url($thumbnail['url']).'" />';
					}
					if(!empty($schemafields['name'])){
						$out .= '<div itemprop="organizer" itemscope itemtype="https://schema.org/Organization">';
							$out .= '<meta itemprop="name" content="'.esc_attr($schemafields['name']).'">';
							$out .= '<meta itemprop="url" content="'.esc_url($schemafields['url']).'">';
						$out .='</div>';
					}	
					if(!empty($location['name']) && !empty($location['stream'])){
						$out .= '<meta itemprop="eventAttendanceMode" content="https://schema.org/MixedEventAttendanceMode">';
					}else if(!empty($location['name']) && empty($location['stream'])){
						$out .= '<meta itemprop="eventAttendanceMode" content="https://schema.org/OfflineEventAttendanceMode">';
					}
					else if(empty($location['name']) && !empty($location['stream'])){
						$out .= '<meta itemprop="eventAttendanceMode" content="https://schema.org/OnlineEventAttendanceMode">';
					}	
					$out .='<meta itemprop="eventStatus" content="https://schema.org/EventScheduled" />';		
				}
				if(!empty($offer['url'])){
					$button_link 		   = apply_filters('gutencon_url_filter', $offer['url'] );
					$button_link 		   = apply_filters('rh_post_offer_url_filter', $button_link );
					$out .= '<div class="gc-offer"><div class="gc-offer-ticket" '.$offerstyle.$schemaoffer.'>';
					$out .= '<meta itemprop="url" content="'.esc_url($offer['url']).'">';
					if(!empty($offer['priceschema']) && $schemaenable){
						$out .= '<meta itemprop="price" content="'.esc_attr($offer['priceschema']).'">';
						$out .= '<meta itemprop="priceCurrency" content="'.esc_attr($offer['currency']).'">';
						$out .= '<meta itemprop="availability" content="https://schema.org/InStock">';
					}
					$out .= '<a class="re_track_btn" href="'.esc_url($button_link).'" style="text-decoration:none;color:'.esc_attr($offerColor).'"><span>'.esc_attr($offer['price']).'</span></a>';
					$out .= '<svg xmlns="https://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 480"> <g> <g> <rect x="144" y="264" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="296" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="232" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="200" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="168" width="16" height="16"/> </g> </g> <g> <g> <rect x="144" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="136" width="16" height="16"/> </g> </g> <g> <g> <rect x="432" y="328" width="16" height="16"/> </g> </g> <g> <g> <rect x="32" y="328" width="16" height="16"/> </g> </g> <g> <g> <path d="M472,200c4.418,0,8-3.582,8-8v-80c0-4.418-3.582-8-8-8H8c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8 c22.091,0,40,17.909,40,40s-17.909,40-40,40c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8h464c4.418,0,8-3.582,8-8v-80 c0-4.418-3.582-8-8-8c-22.091,0-40-17.909-40-40S449.909,200,472,200z M416.524,247.956c3.532,24.61,22.867,43.944,47.476,47.476 V360H16v-64.568c30.614-4.394,51.87-32.773,47.476-63.388C59.944,207.435,40.61,188.1,16,184.568V120h448v64.568 C433.386,188.962,412.13,217.341,416.524,247.956z"/> </g> </g> <g> <g> <path d="M240,160c-17.673,0-32,14.327-32,32s14.327,32,32,32c17.673,0,32-14.327,32-32S257.673,160,240,160z M240,208 c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S248.837,208,240,208z"/> </g> </g> <g> <g> <path d="M336,256c-17.673,0-32,14.327-32,32c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32C368,270.327,353.673,256,336,256z M336,304c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S344.837,304,336,304z"/> </g> </g> <g> <g> <rect x="197.494" y="231.982" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -85.3385 273.9377)" width="181.017" height="16"/> </g> </g> </svg>';
					$out .= '</div></div>';
				}
				$out .= '<div class="gc-event_meta">';
					$out .= '<div class="gc-date_event_full">';
						$out .='<svg  height="14" viewBox="0 0 443.294 443.294" width="14" xmlns="https://www.w3.org/2000/svg"><path d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z"/><path d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z"/></svg>';
						$out .= $startdatefull;
						if($enddatefull){
							$out .=' - '.$enddatefull;
						}
					$out .= '</div>';	
					if(!empty($location['name'])){
						$out .='<div class="gc-location">';
							$out .=' <svg xmlns="https://www.w3.org/2000/svg"  x="0px" y="0px" viewBox="0 0 512 512"><g><g><path d="M256,0C156.748,0,76,80.748,76,180c0,33.534,9.289,66.26,26.869,94.652l142.885,230.257c2.737,4.411,7.559,7.091,12.745,7.091c0.04,0,0.079,0,0.119,0c5.231-0.041,10.063-2.804,12.75-7.292L410.611,272.22C427.221,244.428,436,212.539,436,180C436,80.748,355.252,0,256,0z M384.866,256.818L258.272,468.186l-129.905-209.34C113.734,235.214,105.8,207.95,105.8,180c0-82.71,67.49-150.2,150.2-150.2S406.1,97.29,406.1,180C406.1,207.121,398.689,233.688,384.866,256.818z"/></g></g><g><g><path d="M256,90c-49.626,0-90,40.374-90,90c0,49.309,39.717,90,90,90c50.903,0,90-41.233,90-90C346,130.374,305.626,90,256,90z M256,240.2c-33.257,0-60.2-27.033-60.2-60.2c0-33.084,27.116-60.2,60.2-60.2s60.1,27.116,60.1,60.2C316.1,212.683,289.784,240.2,256,240.2z"/></g>
							</g></svg>';
							$querystring= $location['name'].', '.$location['street'].', '.$location['locality'].', '.$location['postal'].', '.$location['region'].', '.$location['country'];
							if($schemaenable){
								$out .='<span itemprop="location" itemscope itemtype="https://schema.org/Place"><span itemprop="name">'.esc_attr($location['name']).'</span>';
									$out .='<span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="streetAddress">'.esc_attr($location['street']).'</span>, <span itemprop="addressLocality">'.esc_attr($location['locality']).'</span>, <span itemprop="postalCode">'.esc_attr($location['postal']).'</span>, <span itemprop="addressRegion">'.esc_attr($location['region']).'</span>, <span itemprop="addressCountry">'.esc_attr($location['country']).'</span>';
								
								$out .='</span>';
							}else{
								$out .= esc_attr($querystring);
							}
							$querystring = urlencode($querystring);
							if(!empty($location['maplabel'])){
								$out .='<a class="gc-location-maplink" href="https://www.google.com/maps/search/?api=1&query='.$querystring.'">('.esc_attr($location['maplabel']).')</a>';
							}			
						$out .='</div>';
					}
					if(!empty($location['stream'])){
						$out.= '<div'.$schemastream.'>
						<svg  height="512" viewBox="0 0 512 512" width="512" xmlns="https://www.w3.org/2000/svg"><g><path d="m338.95 243.28-120-75c-4.625-2.89-10.453-3.043-15.222-.4-4.77 2.643-7.729 7.667-7.729 13.12v150c0 5.453 2.959 10.476 7.729 13.12 2.266 1.256 4.77 1.88 7.271 1.88 2.763 0 5.522-.763 7.95-2.28l120-75c4.386-2.741 7.05-7.548 7.05-12.72s-2.663-9.979-7.049-12.72zm-112.95 60.656v-95.873l76.698 47.937z"/><path d="m437 61h-362c-41.355 0-75 33.645-75 75v240c0 41.355 33.645 75 75 75h362c41.355 0 75-33.645 75-75v-240c0-41.355-33.645-75-75-75zm45 315c0 24.813-20.187 45-45 45h-362c-24.813 0-45-20.187-45-45v-240c0-24.813 20.187-45 45-45h362c24.813 0 45 20.187 45 45z"/></g></svg>';
							$out .= '<a class="gc-location-streamlink" href="'.esc_url($location['stream']).'"'.$colorlink.' target="_blank">'.esc_attr($location['streamlabel']).'</a>';
							if($schemaenable){
								$out .='<meta itemprop="url" content="'.esc_url($location['stream']).'" />';
							}
						$out.= '</div>';
					}			
				$out .= '</div>';
				if($content):
					$out.= '<div class="gc-text_event"'.$schemadescription.'>'.wp_kses_post($content).'</div>';
				endif;
			$out .= '</div>';
		$out .= '</div>';
		return $out;

	}

}

EventBox::instance();
