<?php
/**
 * Registro de Opciones del Customizer
 * Define todas las secciones y controles del panel de personalización.
 */

function clach_customize_register($wp_customize)
{
    // === 1. SITE IDENTITY & TOP BAR ===
    $wp_customize->add_section('clach_topbar_section', [
        'title' => __('Top Bar Settings', 'clach'),
        'priority' => 20,
    ]);

    $wp_customize->add_setting('clach_topbar_text', ['default' => 'Centro de Certificación Halal de Chile', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_topbar_text', [
        'label' => __('Organization Name', 'clach'),
        'section' => 'clach_topbar_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('clach_branding_version', ['default' => 'N.H.L.A. 2021 - 3.0', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_version', [
        'label' => __('Version Text (Line 1)', 'clach'),
        'section' => 'title_tagline', 'type' => 'text', 'priority' => 20,
    ]);

    $wp_customize->add_setting('clach_branding_desc', ['default' => 'Norma Halal Latinoamericana', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_desc', [
        'label' => __('Description Text (Line 2)', 'clach'),
        'section' => 'title_tagline', 'type' => 'text', 'priority' => 21,
    ]);

    // === 2. GLOBAL COLORS (ACTUALIZADO) ===
    $wp_customize->add_section('clach_colors_global', ['title' => __('Colors: Base & Global', 'clach'), 'priority' => 30]);
    
    // Aquí cambiamos los IDs para que coincidan con la nueva nomenclatura
    $global_colors = [
        'primary'   => ['label' => 'Primary Color (Brand)', 'default' => '#1A428A'],
        'secondary' => ['label' => 'Secondary Color (Brand)', 'default' => '#009B4D'],
        'danger'    => ['label' => 'Danger/Alert Color', 'default' => '#D32F2F'],
        'bg_body'   => ['label' => 'Body Background', 'default' => '#F5F5F5'],
        'text_main' => ['label' => 'Main Text', 'default' => '#333333'],
        'border_color' => ['label' => 'Border Color', 'default' => '#CCCCCC'],
    ];

    foreach ($global_colors as $id => $props) {
        // Esto generará IDs como 'clach_color_primary' en vez de 'clach_color_nhla_blue'
        $setting_id = "clach_color_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'clach_colors_global']));
    }

    // === 3. HEADER & MENU COLORS ===
    $wp_customize->add_section('clach_colors_header', ['title' => __('Colors: Header & Menu', 'clach'), 'priority' => 31]);

    $header_colors = [
        'header_bg'       => ['label' => 'Header Background', 'default' => '#1A428A'],
        'nav_link'        => ['label' => 'Menu Link Color', 'default' => '#FFFFFF'],
        'nav_link_hover'  => ['label' => 'Menu Hover Background', 'default' => 'rgba(255,255,255,0.1)', 'alpha' => true],
    ];

    foreach ($header_colors as $id => $props) {
        $setting_id = "clach_header_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'clach_colors_header']));
    }

    $submenu_colors = [
        'sub_bg'       => ['label' => 'Submenu Background', 'default' => '#1A428A'],
        'sub_text'     => ['label' => 'Submenu Text Color', 'default' => '#FFFFFF'],
        'sub_hover_bg' => ['label' => 'Submenu Hover Background', 'default' => 'rgba(255,255,255,0.15)', 'alpha' => true],
    ];

    foreach ($submenu_colors as $id => $props) {
        $setting_id = "clach_header_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'] . ' (Dropdown)',
            'section' => 'clach_colors_header'
        ]));
    }

    // === 3.1 MOBILE MENU STYLES ===
    $wp_customize->add_section('clach_mobile_menu_section', [
        'title' => __('Mobile Menu Styles', 'clach'),
        'priority' => 32,
    ]);

    $mobile_colors = [
        'toggle_icon' => ['label' => 'Hamburger Icon Color', 'default' => '#FFFFFF'],
        'menu_bg'     => ['label' => 'Mobile Menu Background', 'default' => '#1A428A'],
        'link_color'  => ['label' => 'Mobile Link Color', 'default' => '#FFFFFF'],
        'border_color'=> ['label' => 'Mobile Separator Color', 'default' => 'rgba(255,255,255,0.1)'],
    ];

    foreach ($mobile_colors as $key => $args) {
        $setting_id = "clach_mobile_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $args['label'],
            'section' => 'clach_mobile_menu_section',
        ]));
    }

    // === 4. FOOTER COLORS ===
    $wp_customize->add_section('clach_colors_footer', ['title' => __('Colors: Footer', 'clach'), 'priority' => 33]);

    $footer_colors = [
        'footer_bg'         => ['label' => 'Footer Background', 'default' => '#1A428A'],
        'footer_title'      => ['label' => 'Footer Titles', 'default' => '#FFFFFF'],
        'footer_text'       => ['label' => 'General Text', 'default' => '#CCCCCC'],
        'footer_link'       => ['label' => 'Links', 'default' => '#BBBBBB'],
        'footer_link_hover' => ['label' => 'Links (Hover)', 'default' => '#FFFFFF'],
        'footer_copy'       => ['label' => 'Copyright Text', 'default' => '#888888'],
    ];

    foreach ($footer_colors as $id => $props) {
        $setting_id = "clach_footer_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, ['label' => $props['label'], 'section' => 'clach_colors_footer']));
    }

    // === 5. HOME WIDGET STYLES ===
    $wp_customize->add_section('clach_home_widgets_section', [
        'title' => __('Widgets: Home Page Styles', 'clach'),
        'priority' => 40,
    ]);

    $widget_settings = [
        'bg' => ['default' => '#F5F5F5', 'label' => 'Container Background', 'type' => 'color'],
        'border' => ['default' => '#CCCCCC', 'label' => 'Container Border Color', 'type' => 'color'],
        'radius' => ['default' => '4px', 'label' => 'Container Border Radius', 'type' => 'text', 'desc' => 'E.g: 4px, 10px, 0'],
        'title_color' => ['default' => '#1A428A', 'label' => 'Title Color', 'type' => 'color'],
        'title_decor' => ['default' => '#009B4D', 'label' => 'Title Underline Color', 'type' => 'color'],
    ];

    foreach ($widget_settings as $key => $args) {
        $setting_id = "clach_widget_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => $args['type'] === 'color' ? 'sanitize_hex_color' : 'sanitize_text_field']);
        
        if ($args['type'] === 'color') {
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
                'label' => $args['label'],
                'section' => 'clach_home_widgets_section',
            ]));
        } else {
            $wp_customize->add_control($setting_id, [
                'label' => $args['label'],
                'description' => $args['desc'] ?? '',
                'section' => 'clach_home_widgets_section',
                'type' => 'text',
            ]);
        }
    }

    // === 6. PAGE TEMPLATE STYLES ===
    $wp_customize->add_section('clach_page_settings_section', [
        'title' => __('Page Template Styles', 'clach'),
        'priority' => 45,
    ]);

    $wp_customize->add_setting('clach_page_hide_title', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('clach_page_hide_title', [
        'label' => __('Ocultar Título de la Página', 'clach'),
        'section' => 'clach_page_settings_section',
        'type' => 'checkbox',
        'priority' => 10, 
    ]);

    $page_colors = [
        'bg'            => ['label' => 'Page Background', 'default' => '#FFFFFF'],
        'title_color'   => ['label' => 'Page Title Color', 'default' => '#1A428A'],
        'text_color'    => ['label' => 'Content Text Color', 'default' => '#333333'],
        'heading_color' => ['label' => 'Headings (H2-H6) Color', 'default' => '#1A428A'],
        'accent_color'  => ['label' => 'Accents & Links Color', 'default' => '#009B4D'],
    ];

    foreach ($page_colors as $key => $args) {
        $setting_id = "clach_page_{$key}";
        $wp_customize->add_setting($setting_id, ['default' => $args['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $args['label'],
            'section' => 'clach_page_settings_section',
        ]));
    }

    // === 7. BACK TO TOP SETTINGS ===
    $wp_customize->add_section('clach_backtotop_section', [
        'title' => __('Back to Top Button', 'clach'),
        'priority' => 130,
    ]);

    $wp_customize->add_setting('clach_backtotop_icon', ['default' => 'fas fa-arrow-up', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_backtotop_icon', [
        'label' => __('Icon Class (FontAwesome)', 'clach'),
        'description' => __('E.g: fas fa-arrow-up, fas fa-chevron-up', 'clach'),
        'section' => 'clach_backtotop_section',
        'type' => 'text',
    ]);

    $btt_colors = [
        'bg'        => ['label' => 'Background Color', 'default' => '#1A428A'],
        'color'     => ['label' => 'Icon Color', 'default' => '#FFFFFF'],
        'hover_bg'  => ['label' => 'Hover Background', 'default' => '#009B4D'],
        'hover_color'=> ['label' => 'Hover Icon Color', 'default' => '#FFFFFF'],
    ];

    foreach ($btt_colors as $id => $props) {
        $setting_id = "clach_backtotop_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_backtotop_section',
        ]));
    }

    // === 8. FOOTER CONTENT REPEATER ===
    $wp_customize->add_section('clach_footer_content', [
        'title' => __('Footer: Related Links', 'clach'),
        'priority' => 120,
    ]);

    $related_icons = [
        'fa-solid fa-globe' => 'Global Web',
        'fa-solid fa-file-contract' => 'Certificate',
        'fa-solid fa-building-columns' => 'Institution',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];

    $wp_customize->add_setting('_theme_related_sites_repeater', ['default' => '', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control(new Clach_Repeater_Control($wp_customize, '_theme_related_sites_repeater', [
        'label' => __('Links Manager', 'clach'),
        'section' => 'clach_footer_content',
        'repeater_icons' => $related_icons,
        'button_text' => 'Add Link'
    ]));

    $wp_customize->clach_icons = $related_icons;
}
add_action('customize_register', 'clach_customize_register');