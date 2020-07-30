<?php
/*
Plugin Name: Plugin obrigatório
Description: Website desenvolvido por Jean Franz.
Author: Jean Franz
Version: padrão
Author URI: https://www.facebook.com/JeanFranz.dev
*/

function jean_franz_get_lyric() {
	$lyrics = "<i>Desenvolvido por <b>Jean Franz</b>.</i>";
	$lyrics = explode( "\n", $lyrics );
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

function jean_franz() {
	$chosen = jean_franz_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="jean"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Plugin de assinatura, desenvolvido por Jean Franz:', 'jean-franz' ),
		$lang,
		$chosen
	);
}

add_action( 'admin_notices', 'jean_franz' );

function jean_css() {
	echo "
	<style type='text/css'>
	#jean {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #jean {
		float: left;
	}
	.block-editor-page #jean {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#jean,
		.rtl #jean {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'jean_css' );

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');