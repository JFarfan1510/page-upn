<?php
/*
Plugin Name: GreenCon
Plugin URI: https://1.envato.market/JZgzN
Description: Marketing and SEO Booster for Gutenberg
Version: 1.0.1
Author: Wpsoul
Author URI: https://wpsoul.com/
Text Domain: gutencon
Domain Path: /lang/
*/

namespace GutenCon;

if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}

define( 'GREENCON_VERSION', '1.0.1' );
define( 'GUTENCON_VERSION', '4.0' );
define( 'GUTENCON_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'GUTENCON_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

final class Init {

    public $disableconditioncss = false;

    private static $instance = null;
    public static function instance(){
        if(is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    //Declare list of our blocks and asset dependencies
    public $gutblockassets = [
        'box' => array(
            'frontcss' => array(
                'boxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/box/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'titlebox' => array(
            'frontcss' => array(
                'titleboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/titlebox/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'promobox' => array(
            'frontcss' => array(
                'promoboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/promobox/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'event' => array(
            'frontcss' => array(
                'eventfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/event/style.css',
                    'dependencies' => array(),
                ),
                'gclightboxfront' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/imagelightbox/imagelightbox.css',
                    'dependencies' => array(),
                ), 
            ),
            'frontjs' => array(
                'gclightboxjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/imagelightbox/imagelightbox.js',
                    'dependencies' => array(),
                )
            ),
            'editorjs' => array(),
        ),
        'offerbox' => array(
            'frontcss' => array(
                'offerboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/offerbox/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'comparison-table' => array(
            'frontcss' => array(
                'comparisonfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/comparison/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(
                'gcequalizer' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/comparison/equalizer.js',
                    'dependencies' => array(),
                ),
            ),
            'editorjs' => array(),
        ),
        'comparison-item' => array(
            'frontcss' => array(),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'offerlisting' => array(
            'frontcss' => array(
                'offerlistingfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/offerlisting/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'linelist' => array(
            'frontcss' => array(
                'linelistfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/linelist/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'toctop' => array(
            'frontcss' => array(
                'toctopfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/toctop/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(
                'gctoctopjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/toctop/scrolltolist.js',
                    'dependencies' => array(),
                ),
            ),
            'editorjs' => array(),
        ),
        'versus' => array(
            'frontcss' => array(
                'versusfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/versus/style.css',
                    'dependencies' => array(),
                )
            ),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'tabs' => array(
            'frontcss' => array(
                'gctabsfront' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/tabs/tabs.css',
                    'dependencies' => array(),
                ),
                'gcaligncss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/extra/align.css',
                    'dependencies' => array(),
                )         
            ),
            'frontjs' => array(
                'gctabsjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/tabs/tabs.js',
                    'dependencies' => array(),
                )
            ),
            'editorjs' => array(
                'gctabsjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/tabs/tabs.js',
                    'dependencies' => array(),
                )
            ),
        ),
        'tab' => array(
            'frontcss' => array(),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'accordion' => array(
            'frontcss' => array(
                'accordionfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/accordion/style.css',
                    'dependencies' => array(),
                ),           
            ),
            'frontjs' => array(
                'gcaccordionjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/accordion/accordion.js',
                    'dependencies' => array(),
                ),
            ),
        ),
        'reviewbox' => array(
            'frontcss' => array(
                'reviewboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/reviewbox/style.css',
                    'dependencies' => array(),
                ),           
            )
        ),
        'scorebox' => array(
            'frontcss' => array(
                'scoreboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/scorebox/style.css',
                    'dependencies' => array(),
                ),           
            )
        ),
        'progressbar' => array(
            'frontcss' => array(),
            'frontjs' => array(),
            'editorjs' => array(),
        ),
        'numberheading' => array(
            'frontcss' => array(
                'numberheadingfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/numberheading/style.css',
                    'dependencies' => array(),
                ),           
            )
        ),
        'proscons' => array(
            'frontcss' => array(
                'prosboxfrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/proscons/style.css',
                    'dependencies' => array(),
                ),           
            )
        ),
        'howto' => array(
            'frontcss' => array(
                'howtofrontcss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/howto/style.css',
                    'dependencies' => array(),
                ),           
            )
        ),
        'video' => array(
            'frontcss' => array(
                'gc-video' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/video/gc-video.css',
                    'dependencies' => array(),
                ),            
            ),
            'frontjs' => array(
                'gc-video' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/video/gc-video.js',
                    'dependencies' => array(),
                ),
            ),
        ),
        'countdown' => array(
            'frontcss' => array(
                'gccountdowncss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/countdown/style.css',
                    'dependencies' => array(),
                ),   
                'gcaligncss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/extra/align.css',
                    'dependencies' => array(),
                ),          
            ),
            'frontjs' => array(
                'gccountdownjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/countdown/index.js',
                    'dependencies' => array(),
                ),
            ),
        ),
        'counter' => array(
            'frontcss' => array( 
                'gccountercss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/counter/style.css',
                    'dependencies' => array(),
                ), 
                'gcaligncss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/extra/align.css',
                    'dependencies' => array(),
                ),          
            ),
            'frontjs' => array(
                'gccounterjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/counter/index.js',
                    'dependencies' => array(),
                ),
            ),
        ),
        'contenttoggler' => array(
            'frontcss' => array( 
                'gccontenttogglercss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/contenttoggler/style.css',
                    'dependencies' => array(),
                ),         
            ),
            'frontjs' => array(
                'gccontenttogglerjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/contenttoggler/index.js',
                    'dependencies' => array(),
                ),
            ),
        ),
        'slider' => array(
            'frontcss' => array( 
                'gcgutslidercss' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/slider/slider.css',
                    'dependencies' => array(),
                ),  
                'gclightboxfront' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/imagelightbox/imagelightbox.css',
                    'dependencies' => array(),
                ),        
            ),
            'frontjs' => array(
                'gcgutsliderjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/slider/index.js',
                    'dependencies' => array(),
                ),
                'gclightboxjs' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/imagelightbox/imagelightbox.js',
                    'dependencies' => array(),
                )
            ),
            'editorjs' => array(
                'gcgutsliderback' => array(
                    'link' => GUTENCON_PLUGIN_URL.'assets/slider/indexbackend.js',
                    'dependencies' => array(),
                )
            ),
        ),
    ];

    private function __construct(){
        //Parser class
        require_once GUTENCON_PLUGIN_DIR .'class-rest.php';
        require_once GUTENCON_PLUGIN_DIR .'admin/class-admin.php';
        require_once GUTENCON_PLUGIN_DIR .'/assets/assetloading.php';



        //Register Gutenberg categories
        add_filter('block_categories_all', array($this,'block_categories_filter'), 10, 2);

        //Register our blocks and classes
        foreach($this->gutblockassets as $gutname=>$gutvalue){
            if (file_exists(GUTENCON_PLUGIN_DIR .'blockrender/'.$gutname.'/block.php')){
                require_once GUTENCON_PLUGIN_DIR .'blockrender/'.$gutname.'/block.php';
            }
        }
        $options = get_option( 'globalgutencon', array() );
        $checkforcssloading = (!empty($options['cssdiscondition'])) ? $options['cssdiscondition'] : false;
        if($checkforcssloading) $this->disableconditioncss = true;
        
        add_action('init', array( $this, 'init' )); // hook init our blocks
        add_action('enqueue_block_assets', array( $this, 'guten_assets' )); //hook add conditional frontend and backend assets
        add_filter('render_block', array( $this, 'guten_render_assets' ), 10, 2); //conditional assets loading
    
    }

    //Declare category of blocks
    function block_categories_filter($categories, $post){
        array_splice($categories, 3, 0, array(
            array(
                'slug'  => 'gutencon-modules',
                'title' => esc_html__('Greencon modules', 'gutencon'),
            )
        ));
        return $categories;
    }

    // init our blocks
	public function init(){
        load_plugin_textdomain( 'gutencon', false, basename( __DIR__ ) . '/lang' ); //translation files

        // automatically load dependencies and version
        $asset_file = include( GUTENCON_PLUGIN_DIR. 'build/index.asset.php');

        //Common main script file for blocks for editor
        wp_register_script(
            'gutencon_common_js',
            GUTENCON_PLUGIN_URL. 'build/index.js',
            $asset_file['dependencies'],
            $asset_file['version']
        );

        wp_localize_script('gutencon_common_js','GCGutenberg', array(
            'disableduplicate' => ('rehub-theme' == get_option( 'template')),
        ));

        //Translation in scripts
        if ( function_exists( 'wp_set_script_translations' ) ) {
            wp_set_script_translations( 'gutencon_common_js', 'gutencon' );
        }

        //Common Editor styles for blocks for editor
        wp_register_style(
            'gutencon_common_css',
            GUTENCON_PLUGIN_URL. 'build/index.css',
            array( 'wp-edit-blocks' ),
            $asset_file['version']
        );
        //wp_style_add_data( 'gutencon_common_css', 'rtl', true );

        //Block registration and frontend conditional asset registration
        foreach($this->gutblockassets as $gutname=>$gutvalue){
            if(!empty($gutvalue['frontcss'])){
                foreach ($gutvalue['frontcss'] as $cssname=>$cssvalue){
                    wp_register_style(
                        $cssname,
                        $cssvalue['link'],
                        $cssvalue['dependencies'],
                        GUTENCON_VERSION
                    );
                }
            }
            if(!empty($gutvalue['frontjs'])){
                foreach ($gutvalue['frontjs'] as $jsname=>$jsvalue){
                    wp_register_script(
                        $jsname,
                        $jsvalue['link'],
                        $jsvalue['dependencies'],
                        GUTENCON_VERSION,
                        true
                    );
                }
            }
            if(!empty($gutvalue['editorjs'])){
                foreach ($gutvalue['editorjs'] as $jsname=>$jsvalue){
                    wp_register_script(
                        $jsname,
                        $jsvalue['link'],
                        $jsvalue['dependencies'],
                        GUTENCON_VERSION,
                        true
                    );
                }
            }
        }

        //Additional registration for complex blocks
		wp_register_style( 'simplelightbox',  GUTENCON_PLUGIN_URL.'assets/video/simpleLightbox.min.css', array(), GUTENCON_VERSION );
		wp_register_script( 'simplelightbox',  GUTENCON_PLUGIN_URL.'assets/video/simpleLightbox.min.js', array(), GUTENCON_VERSION, true );
		wp_register_style( 'swiper',  GUTENCON_PLUGIN_URL.'assets/swiper/swiper-bundle.min.css', array(), '7.0' );
		wp_register_script( 'swiper',  GUTENCON_PLUGIN_URL.'assets/swiper/swiper-bundle.min.js', array(), '7.0', true );
        wp_register_script( 'gctoggler',  GUTENCON_PLUGIN_URL.'assets/toggle/toggle.js', array(), GUTENCON_VERSION, true );
        wp_register_script( 'gcfilterpanel',  GUTENCON_PLUGIN_URL.'assets/filterpanel/index.js', array(), GUTENCON_VERSION, true );
        wp_register_script( 'gcajaxpagination',  GUTENCON_PLUGIN_URL.'assets/filterpanel/ajaxpagination.js', array(), GUTENCON_VERSION, true );

	}

	public function gccheck_youtube_url(){
		$url = $_POST['url'];
		$max = wp_safe_remote_head($url);
		wp_send_json_success( wp_remote_retrieve_response_code($max) );
	}

    //Frontend and backend conditional asset enqueue
    public function guten_assets() {

        //root styles
        $options = get_option( 'globalgutencon', array() );
        $btnbgcolor = (!empty($options['btnbgcolor'])) ? $options['btnbgcolor'] : '#de1414';
        $btncolor = (!empty($options['btncolor'])) ? $options['btncolor'] : '#ffffff';
        $gc_global_css = ':root{--gcbtnbg: '.$btnbgcolor.';--gcbtncolor: '.$btncolor.';}';

        wp_add_inline_style( 'wp-block-library', $gc_global_css );

        // conditional scripts
        if(!is_admin()){
   
        }
        else{
            foreach($this->gutblockassets as $gutname=>$gutvalue){
                if(!empty($gutvalue['editorjs'])){  
                    foreach ($gutvalue['editorjs'] as $jsname=>$jsvalue){
                        wp_enqueue_script($jsname);
                    }                      
                }
            }            
        }
    }

    public function guten_render_assets($html, $block){
        if(!$this->disableconditioncss){
            static $renderedg_styles = [];
        }
        foreach($this->gutblockassets as $gutname=>$gutvalue){
            if(!empty($gutvalue['frontcss']) || !empty($gutvalue['frontjs']) ){
                if(isset( $block['blockName'] ) && $block['blockName'] === 'gutencon/'.$gutname){
                    if(!empty($gutvalue['frontcss'])){
                        foreach ($gutvalue['frontcss'] as $cssname=>$cssvalue){
                            if($this->disableconditioncss){
                                ob_start();
                                    echo '<style scoped>' . gutencon_inline_assets( $cssname ) . '</style>';
                                    $dynamic_css = ob_get_contents();
                                ob_end_clean();
                                $html = $dynamic_css.$html;                               
                            }else{
                                if(! in_array( $cssname, $renderedg_styles, true) || defined( 'ICL_LANGUAGE_CODE' )){
                                    //$stylesheet = $cssvalue['link'];
                                    ob_start();
                                        echo '<style scoped>' . gutencon_inline_assets( $cssname ) . '</style>';
                                        $dynamic_css = ob_get_contents();
                                    ob_end_clean();
                                    $html = $dynamic_css.$html;
                                    $renderedg_styles[] = $cssname;
                                }
                            }

                            //wp_add_inline_style( 'wp-block-library', $dynamic_css );
                        }
                    }   
                    if(!empty($gutvalue['frontjs'])){
                        foreach ($gutvalue['frontjs'] as $jsname=>$jsvalue){
                            if(!is_admin()) wp_enqueue_script($jsname);
                            
                        }
                    }                      
                }
            }
        }
        if( $block['blockName'] === 'gutencon/video' ){
            if( $block['attrs']['provider'] === "vimeo" ){
                wp_enqueue_script( 'vimeo-player', 'https://player.vimeo.com/api/player.js', array(), true, '1.0' );
            }
            
            if( isset($block['attrs']['overlayLightbox']) && $block['attrs']['overlayLightbox'] ){
                wp_enqueue_style( 'simplelightbox');
                wp_enqueue_script( 'simplelightbox' );
            }
            $width = isset($block['attrs']['width']) ? $block['attrs']['width'] : '';
            $height = isset($block['attrs']['height']) ? $block['attrs']['height'] : '';
            $block_style = "#gc-video-" . $block['attrs']['blockId']. "{";
                if(!empty($width) && $width['desktop']['size'] > 0){
                    $block_style .= "width: " . $width['desktop']['size'] . $width['desktop']['unit'] .";";
                }
                if(!empty($height) && $height['desktop']['size'] > 0){
                    $block_style .= "height: " . $height['desktop']['size'] . $height['desktop']['unit'] .";";
                }
            $block_style .= "} @media (min-width: 1024px) and (max-width: 1140px) {";
            $block_style .= "#gc-video-" . $block['attrs']['blockId']. "{";
                if(!empty($width) && $width['landscape']['size'] > 0){
                    $block_style .= "width: " . $width['landscape']['size'] . $width['landscape']['unit'] .";";
                }
                if(!empty($height) && $height['landscape']['size'] > 0){
                    $block_style .= "height: " . $height['landscape']['size'] . $height['landscape']['unit'] .";";
                }
            $block_style .= "}";
            $block_style .= "} @media (min-width: 768px) and (max-width: 1023px) {";
            $block_style .= "#gc-video-" . $block['attrs']['blockId']. "{";
                if(!empty($width) && $width['tablet']['size'] > 0){
                    $block_style .= "width: " . $width['tablet']['size'] . $width['tablet']['unit'] .";";
                }
                if(!empty($height) && $height['tablet']['size'] > 0){
                    $block_style .= "height: " . $height['tablet']['size'] . $height['tablet']['unit'] .";";
                }
            $block_style .= "}";
            $block_style .= "} @media (max-width: 767px) {";
            $block_style .= "#gc-video-" . $block['attrs']['blockId']. "{";
                if(!empty($width) && $width['mobile']['size'] > 0){
                    $block_style .= "width: " . $width['mobile']['size'] . $width['mobile']['unit'] .";";
                }
                if(!empty($height) && $height['mobile']['size'] > 0){
                    $block_style .= "height: " . $height['mobile']['size'] . $height['mobile']['unit'] .";";
                }
            $block_style .= "} }";
            $html = '<style scoped>'.$block_style.'</style>'.$html;
            //wp_add_inline_style( 'wp-block-library', $block_style );
        }

        if ( $block['blockName'] === 'gutencon/comparison-table' ) {
            if(isset( $block['attrs']['responsiveView']) && $block['attrs']['responsiveView'] == 'slide'){
                wp_enqueue_style('swiper');
                wp_enqueue_script('swiper');
            }
        }

        if ( $block['blockName'] === 'gutencon/swiper' ) {
            wp_enqueue_script('swiper');
        }

        if ( $block['blockName'] === 'gutencon/tabs' ) {
            if(isset( $block['attrs']['swiper'])){
                wp_enqueue_style('swiper');
                wp_enqueue_script('swiper');
            }
        }
        return $html;
    }

}

Init::instance();