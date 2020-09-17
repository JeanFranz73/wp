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
	.alignleft.actions p {
		display: none;
	}
	</style>
	";
}

add_action( 'admin_head', 'jean_css' );

function ano_shortcode() {
  $ano = date('Y');
  return $ano;
}
add_shortcode('ano', 'ano_shortcode');

function cpy_shortcode() {
	$cpy = '© ' . date('Y') . ' NaturalDente. Todos os direitos reservados.';
	return $cpy;
}
add_shortcode('cpy', 'cpy_shortcode');

  function replace_text($text) {
	$text = str_replace('são executados automaticamente', 'replace-with-this-string', $text);
	$text = str_replace('look-for-that-string', 'replace-with-that-string', $text);
	return $text;
}
add_filter('the_content', 'replace_text');

function remove_footer_admin () {
	echo '<i>Desenvolvido em WordPress por <b>Jean Franz</b>.</i>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function wpbeginner_remove_version() {
	return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');