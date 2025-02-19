<?php
/**
 * Plugin Name: WP Page Top Text
 * Description: Adds custom text above pages with Customizer section to customize text.
 * Version: 1.0
 * Author: Daryl Malibiran
 * Author URI: https://malibiran.com
 */

 function wp_page_top_text_enqueue() {

    wp_enqueue_style( 'wp-page-top-text', plugin_dir_url( __FILE__ ) . 'css/style.css' );
  
  }
  add_action( 'wp_enqueue_scripts', 'wp_page_top_text_enqueue' );

  function wp_page_top_text() {

    $text = get_theme_mod( 'wp_page_top_text' );
  
    echo '<div class="wp-page-top-text" style="text-align: center; color: ' . esc_attr(get_theme_mod( 'wp_page_top_text_color' )) . '; background-color:' . esc_attr(get_theme_mod( 'wp_page_top_text_bg_color' )) . ';">' . esc_html( $text ) . '</div>';
  
  }
  add_action( 'wp_body_open', 'wp_page_top_text' );

  function wp_page_top_text_customizer( $wp_customize ) {

    $wp_customize->add_section( 'wp_page_top_text', array(
      'title' => __( 'Page Top Text', 'wp-page-top-text' ),
      'priority' => 30
    ) );
  
    $wp_customize->add_setting( 'wp_page_top_text', array(
      'default' => __( 'Welcome to our site!', 'wp-page-top-text' ),
      'sanitize_callback' => 'sanitize_textarea_field'
    ) );
  
    $wp_customize->add_control( 'wp_page_top_text', array(
      'label' => __( 'Page Top Text', 'wp-page-top-text' ),
      'section' => 'wp_page_top_text',
      'type' => 'textarea',
      'input_attrs' => array(
        'maxlength' => 70
     )
    ) );

    $wp_customize->add_setting( 'wp_page_top_text_bg_color', array(
        'default' => '#ffffff',
      ) );
      
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_page_top_text_bg_color', array(
    'label' => __( 'Background Color', 'wp-page-top-text' ),
    'section' => 'wp_page_top_text',
    ) ) );

    $wp_customize->add_setting( 'wp_page_top_text_color', array(
        'default' => '#000000',
      ) );
      
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wp_page_top_text_color', array(
    'label' => __( 'Text Color', 'wp-page-top-text' ),
    'section' => 'wp_page_top_text',
    ) ) );
  
  }
  add_action( 'customize_register', 'wp_page_top_text_customizer' );