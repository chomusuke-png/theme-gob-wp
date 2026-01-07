<?php
/**
 * Registro de Opciones del Customizer (Modularizado)
 */

// 1. Cargar las secciones divididas
require get_template_directory() . '/includes/customizer/sections/general.php';
require get_template_directory() . '/includes/customizer/sections/colors.php';
require get_template_directory() . '/includes/customizer/sections/home.php';

function gob_customize_register($wp_customize)
{
    // ==============================================
    // 0. DEFINICIÓN DE PANELES PRINCIPALES
    // ==============================================
    
    // Panel 1: General
    $wp_customize->add_panel('gob_panel_general', [
        'title'       => __('Configuración General', 'gob'),
        'description' => __('Opciones de contenido, textos y ajustes que no son colores.', 'gob'),
        'priority'    => 10,
    ]);

    // Panel 2: Colores
    $wp_customize->add_panel('gob_panel_colors', [
        'title'       => __('Colores del Tema', 'gob'),
        'description' => __('Personaliza la paleta de colores de todas las secciones.', 'gob'),
        'priority'    => 11,
    ]);

    // ==============================================
    // 1. EJECUTAR LAS SECCIONES
    // ==============================================

    // Cargamos la lógica desde los archivos incluidos
    gob_customize_general_section($wp_customize); // Branding, Topbar, Footer
    gob_customize_home_section($wp_customize);    // Hero, Video
    gob_customize_colors_section($wp_customize);  // Todos los colores
    
    // Pasamos iconos a JS para el repetidor (si es necesario globalmente)
    $related_icons = [
        'fa-solid fa-globe' => 'Web Global',
        'fa-solid fa-file-contract' => 'Certificado',
        'fa-solid fa-building-columns' => 'Institución',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];
    $wp_customize->gob_icons = $related_icons;
}
add_action('customize_register', 'gob_customize_register');