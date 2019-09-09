<?php
	function ot_custom_fonts() { 

		//fonts
		$google_font_1 = ot_get_option(THEME_NAME."_google_font_1");
		$google_font_2 = ot_get_option(THEME_NAME."_google_font_2");

		
		$font_size_1 = ot_get_option(THEME_NAME."_font_size_1");
		$font_color_1 = ot_get_option(THEME_NAME."_font_color_1");

		if(ot_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "<style>";	
		} 
?>

/* Titles & Menu Font, default: 'Roboto Condensed' */
h1, h2, h3, h4, h5, h6,
.widget .ot-widget-review .item strong,
.widget .article-block .item-button,
.ot-slide .ot-slider-layer a .content-bottom > strong,
#main-menu, .under-menu a {
	font-family: '<?php echo esc_html($google_font_1);?>', sans-serif;
}

/* Paragraph Font, default 'Roboto' */
p, .ot-panel-block .title-block span,
.split-block > #sidebar .widget > .title-block span,
.ot-panel-block .title-block span, .top-menu {
	font-family: '<?php echo esc_html($google_font_2);?>', sans-serif;
}


<?php
		if(ot_get_option(THEME_NAME."_scriptLoad") == "on") {
			echo "</style>";	
		} 
	}

	if(ot_get_option(THEME_NAME."_scriptLoad") != "on") {
		ot_custom_fonts();	
	} 

?>