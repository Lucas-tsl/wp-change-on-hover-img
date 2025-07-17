<?php
/**
 * Plugin Name: Hover Product Image Swap
 * Description: Rendez vous dans ?? -> Hover  || Affiche une image secondaire au survol des produits WooCommerce, avec activation dans un menu dédié.
 * Version: 3.0
 * Author: Troteseil Lucas
 */

 if ( ! defined( 'ABSPATH' ) ) exit;

 // === CSS FRONT ===
 add_action('wp_head', function () {
     if (get_option('hover_image_enabled') && !wp_is_mobile()) { // Apply CSS only on desktop
         echo '<style>
         .hover-swap {
             position: relative;
             display: block;
             overflow: hidden;
         }
         .hover-swap img {
             width: 100%;
             height: auto;
             display: block;
             transition: opacity 0.4s ease;
         }
         .hover-swap .img-back {
             position: absolute;
             top: 0;
             left: 0;
             opacity: 0;
             z-index: 2;
         }
         .hover-swap:hover .img-back {
             opacity: 1;
         }
         .hover-swap:hover .img-front {
             opacity: 0;
         }
         </style>';
     }
 });
 
 // === IMAGE DE SURVOL ===
 add_filter('woocommerce_product_get_image', function ($image, $product, $size, $attr, $placeholder) {
     if (!get_option('hover_image_enabled') || wp_is_mobile()) return $image; // Skip hover functionality on mobile
 
     $main_image = wp_get_attachment_image_src($product->get_image_id(), $size);
     $main_url = $main_image[0];
 
     $gallery = $product->get_gallery_image_ids();
     if (!empty($gallery)) {
         $second_url = wp_get_attachment_image_url($gallery[0], $size);
 
         $html  = '<div class="hover-swap">';
         $html .= '<img src="' . esc_url($main_url) . '" class="img-front" alt="' . esc_attr($product->get_name()) . '">';
         $html .= '<img src="' . esc_url($second_url) . '" class="img-back" alt="' . esc_attr($product->get_name()) . ' - vue 2">';
         $html .= '</div>';
 
         return $html;
     }
 
     return $image;
 }, 10, 5);
 
 // === MENU ADMIN PERSONNALISÉ ===
 add_action('admin_menu', function () {
     add_menu_page(
         'Hover Image Swap',              // Titre de la page
         'Hover Image',                   // Nom dans le menu
         'manage_options',                // Capacité requise
         'hover-image-settings',          // Slug
         'hover_image_settings_page',     // Fonction de rendu
         'dashicons-images-alt2',         // Icône du menu
         56                               // Position dans le menu
     );
 });
 
 // === PAGE DE PARAMÈTRES ===
 function hover_image_settings_page() {
     ?>
     <div class="wrap">
         <h1>Paramètres : Hover Image</h1>
         <form method="post" action="options.php">
             <?php
                 settings_fields('hover_image_settings_group');
                 do_settings_sections('hover-image-settings');
                 submit_button();
             ?>
         </form>
     </div>
     <?php
 }
 
 // === ENREGISTREMENT DES OPTIONS ===
 add_action('admin_init', function () {
     register_setting('hover_image_settings_group', 'hover_image_enabled');
 
     add_settings_section('hover_image_main_section', '', null, 'hover-image-settings');
 
     add_settings_field(
         'hover_image_enabled',
         'Activer l’effet de survol',
         'hover_image_enabled_callback',
         'hover-image-settings',
         'hover_image_main_section'
     );
 });
 
 function hover_image_enabled_callback() {
     $enabled = get_option('hover_image_enabled');
     echo '<input type="checkbox" name="hover_image_enabled" value="1"' . checked(1, $enabled, false) . '> Activer';
 }
