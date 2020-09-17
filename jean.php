<?php
/*
Plugin Name: Plugin obrigatório
Description: Website desenvolvido por Jean Franz.
Author: Jean Franz
Version: padrão
Author URI: https://www.facebook.com/JeanFranz.dev
*/

function jean_franz_get_lyric() {
	$mensagem_head = "<i>Desenvolvido por <b>Jean Franz</b>.</i>";
	return wptexturize( $mensagem_head );
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
	$cpy = '© ' . date('Y') . ' ' . $site_title = get_bloginfo('name') . '. Todos os direitos reservados.';
	return $cpy;
}
add_shortcode('cpy', 'cpy_shortcode');

// Footer do painel
function remover_footer_admin () {
	echo '<i>Desenvolvido em WordPress por <b>Jean Franz</b>.</i>';
}
add_filter('admin_footer_text', 'remover_footer_admin');

// Versão do painel
//  function remover_footer_versao () {
//  	echo 'Versão';
//  }
//  add_filter('update_footer', 'remover_footer_versao', 9999 );

function wpbeginner_remove_version() {
	return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');