<?php

//Plugin settings class and init
if ( !class_exists( 'RationalOptionPages' ) ) {
    require_once('RationalOptionPages.php');
}
$styleforsettings = '
    <style>
        .wrap{background:white;max-width: 900px;padding: 1.5em 3em;margin: 2.5em auto;border: 1px solid #dbdde2;box-shadow: 0 10px 20px #ececec;}
        .wrap .notice{display:none}
        .wrap h1{margin-bottom:40px}
        .wrap h2{padding: 15px;background: #f4f4f4;
    </style>
';
$pages = array(
    'gcsettings'	=> array(
        'page_title'	=> esc_html__( 'Greencon', 'gutencon' ),
        'menu_slug' => 'greencon',
        'icon_url' => 'dashicons-superhero-alt',
        'sections'		=> array(
            'section-one'	=> array(
                'title'			=> esc_html__( 'Welcome to Greencon', 'gutencon' ),
                'include'		=> GUTENCON_PLUGIN_DIR . 'admin/gutenconstart.php',
            ),
        ),
        'subpages'		=> array(
            'globalgutencon'	=> array(
                'page_title'	=> esc_html__( 'Global Options', 'gutencon' ),
                'menu_slug' => 'gutenconopt',
                'sections'		=> array(
                    'colors'	=> array(
                        'text'			=> $styleforsettings,
                        'title'			=> esc_html__( 'Color options', 'gutencon' ),
                        'fields'		=> array(
                            'btnbgcolor'			=> array(
                                'title'			=> esc_html__( 'Default Button Background Color', 'gutencon' ),
                                'type'			=> 'color',
                                'value'			=> '#de1414',
                                'id'            => 'btnbgcolor'
                            ),
                            'btncolor'			=> array(
                                'title'			=> esc_html__( 'Default Button Text Color', 'gutencon' ),
                                'type'			=> 'color',
                                'value'			=> '#ffffff',
                                'id'            => 'btncolor'
                            ),
                            'cssdiscondition'		=> array(
                                'title'			=> __( 'Disable conditional style loading', 'gutencon' ),
                                'type'			=> 'checkbox',
                                'text'			=> __( 'Disable this option if you have broken styles of blocks on site', 'gutencon' ),
                                'id'            => 'cssdiscondition'
                            ),
                        ),
                    ),
                ),
            ),
        ),

    ),
);
$option_page = new \RationalOptionPages( $pages );

