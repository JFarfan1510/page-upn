<?php

namespace GutenCon;

use WP_REST_Request;
use WP_REST_Server;

defined( 'ABSPATH' ) OR exit;

class REST {
	private $rest_namespace = 'gcrestapi/v2';


	private static $instance = null;

	/** @return Assets */
	public static function instance() {
		if ( is_null( static::$instance ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct() {
		add_action( 'rest_api_init', array( $this, 'action_rest_api_init_trait' ) );
	}

	public function action_rest_api_init_trait() {
		//		if(!((is_user_logged_in() && is_admin()))) {
		//			return;
		//		}

		register_rest_route( $this->rest_namespace . '/posts',
			'/get',
			array(
				array(
					'methods'  => WP_REST_Server::CREATABLE,
					'permission_callback' => function ( WP_REST_Request $request ) {
						return current_user_can( 'editor' ) || current_user_can( 'administrator' );
					},
					'callback' => array( $this, 'rest_get_posts' ),
				)
			)
		);

		register_rest_route(
			$this->rest_namespace,
			"/product/(?P<id>\d+)",
			array(
				'methods'  => WP_REST_Server::READABLE,
				'permission_callback' => function ( WP_REST_Request $request ) {
					return current_user_can( 'editor' ) || current_user_can( 'administrator' );
				},
				'callback' => array( $this, 'rest_product_handler' ),
			)
		);
	}

	public function rest_get_posts( WP_REST_Request $request ) {
		$params    = array_merge(
			array(
				's'         => '',
				'include'   => '',
				'exclude'   => '',
				'page'      => 1,
				'post_type' => 'post',
			), $request->get_params()
		);
		$isSelect2 = ( $request->get_param( 'typeQuery' ) === 'select2' );

		$args = array(
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			'post_type'      => $params['post_type'],
			'paged'          => $params['page'],
		);

		if ( ! empty( $params['s'] ) ) {
			$args['s'] = $params['s'];
		}
		if ( ! empty( $params['include'] ) ) {
			$args['post__in'] = is_array( $params['include'] ) ? $params['include'] : array( $params['include'] );
		}
		if ( ! empty( $params['exclude'] ) ) {
			$args['post__not_in'] = is_array( $params['exclude'] ) ? $params['exclude'] : array( $params['exclude'] );
		}

		$response_array = array();
		$keys           = $isSelect2 ?
			[ 'label' => 'text', 'value' => 'id' ] :
			[ 'label' => 'label', 'value' => 'value' ];

		$posts = new \WP_Query( $args );
		if ( $posts->post_count > 0 ) {
			/* @var \WP_Post $gallery */
			foreach ( $posts->posts as $_post ) {
				$response_array[] = array(
					$keys['label'] => ! empty( $_post->post_title ) ? $_post->post_title : esc_html__( 'No Title', 'gutencon' ),
					$keys['value'] => $_post->ID,
				);
			}
		}
		wp_reset_postdata();

		$return = array(
			'results'    => $response_array,
			'pagination' => array(
				'more' => $posts->max_num_pages >= ++ $params['page'],
			)
		);

		return rest_ensure_response( $return );
	}

	public function rest_product_handler( WP_REST_Request $request ) {
		$id   = $request->get_params()['id'];
		$data = array();

		if ( empty( $id ) ) {
			return new \WP_Error( 'empty_data', 'Pass empty data', array( 'status' => 404 ) );
		}

		$product              = wc_get_product( $id );
		$thumbID 			  = $product->get_image_id();
		$copy                 = $product->get_short_description();
		$product_on_sale      = $product->is_on_sale();
		$regular_price        = (float) $product->get_regular_price();
		$sale_price           = (float) $product->get_sale_price();
		$attributes           = $product->get_attributes();
		$gallery_ids          = $product->get_gallery_image_ids();
		$price_label          = '';
		$gallery_images       = array();
		$product_name         = $product->get_title();
		$add_to_cart_text     = $product->add_to_cart_text();
		$product_type         = $product->get_type();
		
		if ( empty( $thumbID ) ) {
			$thumbnail_url = plugin_dir_url( __FILE__ ) . 'assets/icons/noimage-placeholder.png';
		}else{
			$thumbnail_url = wp_get_attachment_image_url($thumbID);
		}
		
		if ( ! empty( $copy ) ) {
			$copy = wp_trim_words($copy, 15);
		}

		if ( $product_on_sale && $regular_price && $sale_price > 0 && $product_type !== 'variable' ) {
			$sale_proc   = 0 - ( 100 - ( $sale_price / $regular_price ) * 100 );
			$sale_proc   = round( $sale_proc );
			$price_label = $sale_proc . '%';
		}

		if ( ! empty( $attributes ) ) {
			ob_start();
			wc_display_product_attributes( $product );
			$attributes = ob_get_contents();
			ob_end_clean();
		}

		if ( ! empty( $gallery_ids ) ) {
			foreach ( $gallery_ids as $key => $value ) {
				$gallery_images[] = wp_get_attachment_url( $value );
			}
		}

		$data['thumbnail'] = array(
			'url' => $thumbnail_url,
			'id'  => $thumbID
		);
		$data['title']             = $product_name;
		$data['copy']              = $copy;
		$data['priceLabel']        = $price_label;
		$data['addToCartText']     = $add_to_cart_text;
		$data['productAttributes'] = $attributes;
		$data['galleryImages']     = $gallery_images;
		$data['userscore']		   = $product->get_average_rating();
		$data['priceHtml']         = $product->get_price_html();
		$data['id']                = $id;

		return json_encode( $data );
	}

}
\GutenCon\REST::instance();