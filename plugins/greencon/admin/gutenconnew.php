<?php
if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}
echo '<style>
.wrap{background:white;max-width: 900px;margin: 2.5em auto;border: 1px solid #dbdde2;box-shadow: 0 10px 20px #ececec; text-align:center}
.wrap .notice, .wrap .error{display:none}
.wrap h2{font-size:2em; margin-bottom:1em; font-weight:bold}
.gc-introtext{font-size:15px; margin: 0 auto 50px auto; max-width:600px}
.gc-intro-form{margin-bottom:50px;display: flex;justify-content: center; overflow:hidden}
.wrap h1{text-align: left;padding: 15px 20px;margin: -1px -1px 60px -1px;font-size: 13px;font-weight: bold;text-transform: uppercase;box-shadow: 0 3px 8px rgb(0 0 0 / 5%);}
.gc-padd {padding:25px;overflow: hidden;}
.gc-intro-form input {padding: 10px 15px;width: 30%;margin-right: 20px;float: left;}
.gc-intro-form .button-large{font-size:17px; font-weight: bold}
</style>';
echo '<div class="gc-padd">';
echo '<p class="gc-introtext">'.esc_html__("Thank you for choosing Greencon plugin. You can", "gutencon").' <a href="http://codecanyon.net/user/sizam#contact">'.esc_html__("through the contact form", "gutencon").'</a></p>';
echo '</div>';