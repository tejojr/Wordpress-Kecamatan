<?php
// Google Map embed short code
// Usage: [googlemap src="you_url"]
function GoogleMapEmbed($atts, $content = null) {
	extract(shortcode_atts(array(
		"width" => '100%',
		"height" => '480',
		"src" => '',
	), $atts));
	return '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63302.86244196922!2d109.30762018029333!3d-7.417692579890253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e65599a00834d93%3A0x4027a76e352e5b0!2sKalimanah%2C+Purbalingga+Regency%2C+Central+Java!5e0!3m2!1sen!2sid!4v1538376862923" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>'" ></iframe>';
}
add_shortcode("googlemap", "GoogleMapEmbed");
?>