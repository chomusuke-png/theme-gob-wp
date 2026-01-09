<?php
/**
 * Configuraciones Generales
 */
function gob_customize_general_section($wp_customize) {
    
    // Branding
    $wp_customize->add_section('gob_branding_section', [
        'title'    => __('Identidad y Versiones', 'gob'),
        'panel'    => 'gob_panel_general',
        'priority' => 10,
    ]);

    $wp_customize->add_setting('gob_branding_version', ['default' => 'Example Text', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_branding_version', [
        'label'   => __('Titulo (Línea 1)', 'gob'),
        'section' => 'gob_branding_section', 
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('gob_branding_desc', ['default' => 'Example Description', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_branding_desc', [
        'label'   => __('Descripción (Línea 2)', 'gob'),
        'section' => 'gob_branding_section', 
        'type'    => 'text',
    ]);

    // --- 1.2 Top Bar ---
    $wp_customize->add_section('gob_topbar_section', [
        'title'    => __('Barra Superior (Top Bar)', 'gob'),
        'panel'    => 'gob_panel_general',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('gob_topbar_text', ['default' => 'Centro de Certificación Halal de Chile', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_topbar_text', [
        'label'   => __('Nombre Organización', 'gob'),
        'section' => 'gob_topbar_section',
        'type'    => 'text',
    ]);

    // --- 1.3 Footer Content (Enlaces Relacionados) ---
    $wp_customize->add_section('gob_footer_content', [
        'title'    => __('Footer: Enlaces Relacionados', 'gob'),
        'panel'    => 'gob_panel_general',
        'priority' => 30,
    ]);

    $related_icons = [
        'fa-solid fa-globe' => 'Web Global',
        'fa-solid fa-file-contract' => 'Certificado',
        'fa-solid fa-building-columns' => 'Institución',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];

    $wp_customize->add_setting('_theme_related_sites_repeater', ['default' => '', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control(new gob_Repeater_Control($wp_customize, '_theme_related_sites_repeater', [
        'label'          => __('Gestor de Enlaces', 'gob'),
        'section'        => 'gob_footer_content',
        'repeater_icons' => $related_icons,
        'button_text'    => 'Añadir Enlace'
    ]));

    // --- 1.4 SEO Básico ---
    $wp_customize->add_section('gob_seo_section', [
        'title'    => __('SEO y Metadatos', 'gob'),
        'panel'    => 'gob_panel_general', // Lo ponemos en el panel General
        'priority' => 40,
    ]);

    // Setting para la Meta Descripción
    $wp_customize->add_setting('gob_meta_description', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field', // Limpia el texto
    ]);

    $wp_customize->add_control('gob_meta_description', [
        'label'       => __('Meta Descripción (Google)', 'gob'),
        'description' => __('Resumen corto (aprox. 150 caracteres) que aparecerá en los resultados de búsqueda.', 'gob'),
        'section'     => 'gob_seo_section',
        'type'        => 'textarea', // Usamos textarea para que sea cómodo escribir
    ]);

    // Pasamos iconos a JS para el repetidor
    $wp_customize->gob_icons = $related_icons;
}