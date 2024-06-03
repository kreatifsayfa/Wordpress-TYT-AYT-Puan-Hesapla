<?php
/**
 * Plugin Name: TYT-AYT Puan Hesaplama
 * Description: TYT ve AYT puanlarını hesaplayan bir eklenti.
 * Version: 1.0
 * Author: SayfaSoft
 * Author URI: https://www.r10.net/profil/112097-sayfasoft.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Shortcode için include
include_once plugin_dir_path( __FILE__ ) . 'public/form-handler.php';

// Eklenti aktif olduğunda yapılacak işlemler
function tyt_ayt_puan_hesaplama_activate() {
    // Gerekli ayarları veya veritabanı tablolarını oluşturabilirsiniz
}
register_activation_hook( __FILE__, 'tyt_ayt_puan_hesaplama_activate' );

// Eklenti deaktif olduğunda yapılacak işlemler
function tyt_ayt_puan_hesaplama_deactivate() {
    // Oluşturulan ayarları veya veritabanı tablolarını temizleyebilirsiniz
}
register_deactivation_hook( __FILE__, 'tyt_ayt_puan_hesaplama_deactivate' );

// CSS ve JS dosyalarını eklemek
function tyt_ayt_puan_hesaplama_enqueue_scripts() {
    wp_enqueue_style( 'tyt-ayt-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'tyt_ayt_puan_hesaplama_enqueue_scripts' );
