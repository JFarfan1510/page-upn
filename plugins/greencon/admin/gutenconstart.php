<?php
if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}
echo '<style>
.wrap{background:white;max-width: 900px;margin: 2.5em auto;border: 1px solid #dbdde2;box-shadow: 0 10px 20px #ececec; text-align:center}
.wrap .notice, .wrap .error{display:none}
.wrap h2{font-size:2em; margin-bottom:1em; font-weight:bold}
.gc-introtext{font-size:14px; max-width:500px; margin: 0 auto 50px auto}
.gc-intro-video iframe{box-shadow: 10px 10px 20px rgb(0 0 0 / 15%);}
.gc-intro-video{margin-bottom:80px}
.wrap h1{text-align: left;padding: 15px 20px;margin: -1px -1px 60px -1px;font-size: 13px;font-weight: bold;text-transform: uppercase;box-shadow: 0 3px 8px rgb(0 0 0 / 5%);}
.gc-padd {padding:25px}
</style>';
echo '<div class="gc-padd">';
echo '<p class="gc-introtext">'.esc_html__("Get introduced to Gutencon and Greencon plugins by watching our Getting Started video series. If you have any question, feel free to contact us", "gutencon").' <a href="http://codecanyon.net/user/sizam#contact">'.esc_html__("through the contact form", "gutencon").'</a></p>';
echo '<div class="gc-intro-video"><iframe width="620" height="350" src="https://www.youtube.com/embed/MnMrkEFqxwo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
echo '</div>';