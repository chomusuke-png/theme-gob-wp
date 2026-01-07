<?php
/**
 * Configuraciones de Color
 */
function gob_customize_colors_section($wp_customize) {
    
    // --- 2.1 Global Colors ---
    $wp_customize->add_section('gob_colors_global', [
        'title'    => __('Base y Globales', 'gob'), 
        'panel'    => 'gob_panel_colors', // Asignado al panel Colores
        'priority' => 10
    ]);
    
    $global_colors = [
        'primary'   => ['label' => 'Color Primario (Marca)', 'default' => '#1A428A'],
        'secondary' => ['label' => 'Color Secundario (Marca)', 'default' => '#009B4D'],
        'danger'    => ['label' => 'Color Alerta/Peligro', 'default' => '#D32F2F'],
        'bg_body'   => ['label' => 'Fondo del sitio (Body)', 'default' => '#F5F5F5'],
        'text_main' => ['label' => 'Texto Principal', 'default' => '#333333'],
        'border_color' => ['label' => 'Color de Bordes', 'default' => '#CCCCCC'],
    ];

    foreach ($global_colors as $id => $props) {
        $setting_id = "gob_color_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'gob_colors_global']));
    }

    // --- 2.2 Header & Menu Colors ---
    $wp_customize->add_section('gob_colors_header', [
        'title'    => __('Cabecera y Menú', 'gob'), 
        'panel'    => 'gob_panel_colors',
        'priority' => 20
    ]);

    $header_colors = [
        'header_bg'       => ['label' => 'Fondo Cabecera', 'default' => '#1A428A'],
        'branding_color'  => ['label' => 'Texto Branding', 'default' => '#FFFFFF'],
        'nav_link'        => ['label' => 'Color Enlace Menú', 'default' => '#FFFFFF'],
        'nav_link_hover'  => ['label' => 'Fondo Hover Menú', 'default' => '#EEEEEE', 'alpha' => true],
    ];

    foreach ($header_colors as $id => $props) {
        $setting_id = "gob_header_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'gob_colors_header']));
    }

    $submenu_colors = [
        'sub_bg'       => ['label' => 'Fondo Submenú', 'default' => '#1A428A'],
        'sub_text'     => ['label' => 'Texto Submenú', 'default' => '#FFFFFF'],
        'sub_hover_bg' => ['label' => 'Fondo Hover Submenú', 'default' => '#EEEEEE', 'alpha' => true],
    ];

    foreach ($submenu_colors as $id => $props) {
        $setting_id = "gob_header_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'gob_colors_header'
        ]));
    }

    // --- 2.3 Mobile Menu Styles ---
    $wp_customize->add_section('gob_mobile_menu_section', [
        'title'    => __('Menú Móvil', 'gob'),
        'panel'    => 'gob_panel_colors',
        'priority' => 25,
    ]);

    $mobile_colors = [
        'toggle_icon' => ['label' => 'Icono Hamburguesa', 'default' => '#FFFFFF'],
        'menu_bg'     => ['label' => 'Fondo Menú Móvil', 'default' => '#1A428A'],
        'link_color'  => ['label' => 'Color Enlace Móvil', 'default' => '#FFFFFF'],
        'border_color'=> ['label' => 'Separador Móvil', 'default' => '#EEEEEE'],
    ];

    foreach ($mobile_colors as $key => $args) {
        $setting_id = "gob_mobile_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $args['label'],
            'section' => 'gob_mobile_menu_section',
        ]));
    }

    // --- 2.4 Footer Colors ---
    $wp_customize->add_section('gob_colors_footer', [
        'title'    => __('Pie de Página (Footer)', 'gob'), 
        'panel'    => 'gob_panel_colors',
        'priority' => 30
    ]);

    $footer_colors = [
        'footer_bg'         => ['label' => 'Fondo Footer', 'default' => '#1A428A'],
        'footer_title'      => ['label' => 'Títulos', 'default' => '#FFFFFF'],
        'footer_text'       => ['label' => 'Texto General', 'default' => '#CCCCCC'],
        'footer_link'       => ['label' => 'Enlaces', 'default' => '#BBBBBB'],
        'footer_link_hover' => ['label' => 'Enlaces (Hover)', 'default' => '#FFFFFF'],
        'footer_copy'       => ['label' => 'Texto Copyright', 'default' => '#888888'],
    ];

    foreach ($footer_colors as $id => $props) {
        $setting_id = "gob_footer_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'gob_colors_footer']));
    }

    // --- 2.5 Home Widgets Styles ---
    $wp_customize->add_section('gob_home_widgets_section', [
        'title'       => __('Widgets Inicio', 'gob'),
        'description' => __('Estilos de los contenedores de widgets en la portada.', 'gob'),
        'panel'       => 'gob_panel_colors',
        'priority'    => 40,
    ]);

    $widget_settings = [
        'bg' => ['default' => '#F5F5F5', 'label' => 'Fondo Contenedor', 'type' => 'color'],
        'border' => ['default' => '#CCCCCC', 'label' => 'Borde Contenedor', 'type' => 'color'],
        'radius' => ['default' => '4px', 'label' => 'Radio Borde (px)', 'type' => 'text', 'desc' => 'Ej: 4px, 10px, 0'],
        'title_color' => ['default' => '#1A428A', 'label' => 'Color Título', 'type' => 'color'],
        'title_decor' => ['default' => '#009B4D', 'label' => 'Subrayado Título', 'type' => 'color'],
    ];

    foreach ($widget_settings as $key => $args) {
        $setting_id = "gob_widget_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => $args['type'] === 'color' ? 'sanitize_hex_color' : 'sanitize_text_field']);
        
        if ($args['type'] === 'color') {
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
                'label' => $args['label'],
                'section' => 'gob_home_widgets_section',
            ]));
        } else {
            $wp_customize->add_control($setting_id, [
                'label' => $args['label'],
                'description' => $args['desc'] ?? '',
                'section' => 'gob_home_widgets_section',
                'type' => 'text',
            ]);
        }
    }

    // --- 2.6 Page Template Styles ---
    $wp_customize->add_section('gob_page_settings_section', [
        'title'       => __('Estilos de Página', 'gob'),
        'description' => __('Colores para páginas estándar (page.php).', 'gob'),
        'panel'       => 'gob_panel_colors',
        'priority'    => 45,
    ]);

    // Checkbox (Aunque es config, está muy ligado al estilo de la página, lo dejamos aquí)
    $wp_customize->add_setting('gob_page_hide_title', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('gob_page_hide_title', [
        'label'   => __('Ocultar Título H1', 'gob'),
        'section' => 'gob_page_settings_section',
        'type'    => 'checkbox',
        'priority' => 5, 
    ]);

    $page_colors = [
        'bg'            => ['label' => 'Fondo Página', 'default' => '#FFFFFF'],
        'title_color'   => ['label' => 'Color Título Principal', 'default' => '#1A428A'],
        'text_color'    => ['label' => 'Color Texto Contenido', 'default' => '#333333'],
        'heading_color' => ['label' => 'Color Encabezados (H2-H6)', 'default' => '#1A428A'],
        'accent_color'  => ['label' => 'Color Acentos y Links', 'default' => '#009B4D'],
    ];

    foreach ($page_colors as $key => $args) {
        $setting_id = "gob_page_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $args['label'],
            'section' => 'gob_page_settings_section',
        ]));
    }

    // --- 2.7 Back to Top Button ---
    $wp_customize->add_section('gob_backtotop_section', [
        'title'    => __('Botón Volver Arriba', 'gob'),
        'panel'    => 'gob_panel_colors',
        'priority' => 130,
    ]);

    $wp_customize->add_setting('gob_backtotop_icon', ['default' => 'fas fa-arrow-up', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_backtotop_icon', [
        'label'       => __('Clase Icono (FontAwesome)', 'gob'),
        'description' => __('Ej: fas fa-arrow-up', 'gob'),
        'section'     => 'gob_backtotop_section',
        'type'        => 'text',
    ]);

    $btt_colors = [
        'bg'        => ['label' => 'Color Fondo', 'default' => '#1A428A'],
        'color'     => ['label' => 'Color Icono', 'default' => '#FFFFFF'],
        'hover_bg'  => ['label' => 'Fondo Hover', 'default' => '#009B4D'],
        'hover_color'=> ['label' => 'Icono Hover', 'default' => '#FFFFFF'],
    ];

    foreach ($btt_colors as $id => $props) {
        $setting_id = "gob_backtotop_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'gob_backtotop_section',
        ]));
    }
}