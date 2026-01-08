<?php
/**
 * Secciones de Portada: Hero, Video, etc.
 */
function gob_customize_home_section($wp_customize) {

    // ==============================================
    // PESTAÑA: HERO / BANNER PRINCIPAL
    // ==============================================
    $wp_customize->add_section('gob_hero_section', [
        'title'       => __('Portada: Banner Principal', 'gob'),
        'description' => __('Configura el texto y fondo del banner inicial.', 'gob'),
        'panel'       => 'gob_panel_general',
        'priority'    => 15,
    ]);

    // 2. Controles
    
    // Título
    $wp_customize->add_setting('gob_hero_title', ['default' => 'Título Principal', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_hero_title', [
        'label'   => __('Título', 'gob'),
        'section' => 'gob_hero_section',
        'type'    => 'text',
    ]);

    // Subtítulo
    $wp_customize->add_setting('gob_hero_subtitle', ['default' => 'Bajada o descripción corta.', 'sanitize_callback' => 'sanitize_textarea_field']);
    $wp_customize->add_control('gob_hero_subtitle', [
        'label'   => __('Subtítulo', 'gob'),
        'section' => 'gob_hero_section',
        'type'    => 'textarea',
    ]);

    // Botón Texto
    $wp_customize->add_setting('gob_hero_btn_text', ['default' => 'Explorar', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_hero_btn_text', [
        'label'   => __('Texto del Botón', 'gob'),
        'section' => 'gob_hero_section',
        'type'    => 'text',
    ]);

    // Botón URL
    $wp_customize->add_setting('gob_hero_btn_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('gob_hero_btn_url', [
        'label'   => __('Enlace del Botón', 'gob'),
        'section' => 'gob_hero_section',
        'type'    => 'url',
    ]);

    // Alineación Horizontal (Izquierda, Centro, Derecha)
    $wp_customize->add_setting('gob_hero_align_h', [
        'default' => 'left',
        'sanitize_callback' => 'sanitize_key', // 'left', 'center', 'right' son claves seguras
    ]);
    $wp_customize->add_control('gob_hero_align_h', [
        'label'       => __('Alineación Horizontal', 'gob'),
        'section'     => 'gob_hero_section',
        'type'        => 'select',
        'choices'     => [
            'left'   => __('Izquierda', 'gob'),
            'center' => __('Centro', 'gob'),
            'right'  => __('Derecha', 'gob'),
        ],
    ]);

    // Alineación Vertical (Arriba, Centro, Abajo)
    $wp_customize->add_setting('gob_hero_align_v', [
        'default' => 'center',
        'sanitize_callback' => 'sanitize_key',
    ]);
    $wp_customize->add_control('gob_hero_align_v', [
        'label'       => __('Alineación Vertical', 'gob'),
        'section'     => 'gob_hero_section',
        'type'        => 'select',
        'choices'     => [
            'flex-start' => __('Arriba', 'gob'),
            'center'     => __('Centro', 'gob'),
            'flex-end'   => __('Abajo', 'gob'),
        ],
    ]);

    // Imagen de Fondo
    $wp_customize->add_setting('gob_hero_bg_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gob_hero_bg_image', [
        'label'    => __('Imagen de Fondo', 'gob'),
        'section'  => 'gob_hero_section',
        'settings' => 'gob_hero_bg_image',
    ]));

    // Color del Overlay (Capa transparente)
    $wp_customize->add_setting('gob_hero_overlay_color', [
        'default' => '#ffffff', // Blanco por defecto (para desvanecer)
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'gob_hero_overlay_color', [
        'label'    => __('Color de Capa (Overlay)', 'gob'),
        'description' => __('Elige Blanco para aclarar la imagen o Negro para oscurecerla.', 'gob'),
        'section'  => 'gob_hero_section',
    ]));

    // Opacidad del Overlay
    $wp_customize->add_setting('gob_hero_overlay_opacity', [
        'default' => 0,
        'sanitize_callback' => 'absint'
    ]);
    $wp_customize->add_control('gob_hero_overlay_opacity', [
        'label'       => __('Nivel de Transparencia (0-100%)', 'gob'),
        'description' => __('Aumenta este valor para que la imagen se vea más transparente (se mezcle con el color).', 'gob'),
        'section'     => 'gob_hero_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 95, // No dejamos 100 para no tapar la imagen totalmente
            'step' => 5,
        ],
    ]);

    // Control de Altura Mínima
    $wp_customize->add_setting('gob_hero_height', [
        'default' => 500, // Un buen valor por defecto
        'sanitize_callback' => 'absint'
    ]);
    
    $wp_customize->add_control('gob_hero_height', [
        'label'       => __('Altura Mínima del Banner (px)', 'gob'),
        'description' => __('Define el alto mínimo de la sección. El contenido se centrará automáticamente.', 'gob'),
        'section'     => 'gob_hero_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 300,
            'max'  => 900,
            'step' => 10,
        ],
    ]);

    // ==============================================
    // SECCIÓN: VIDEO DESTACADO
    // ==============================================

    $wp_customize->add_section('gob_video_section', [
        'title'    => __('Portada: Video Destacado', 'gob'),
        'priority' => 25, // Aparecerá debajo del Banner
        'panel'    => 'gob_panel_general',
    ]);

    // Campo: Título de la Sección
    $wp_customize->add_setting('gob_video_title', ['default' => '', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('gob_video_title', [
        'label'   => __('Título del Video', 'gob'),
        'section' => 'gob_video_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('gob_video_id', [
        'default' => '',
        'sanitize_callback' => 'absint' // Sanitizamos como un ID numérico
    ]);
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'gob_video_id', [
        'label'       => __('Subir Video (MP4)', 'gob'),
        'description' => __('Sube un video directamente desde tu PC.', 'gob'),
        'section'     => 'gob_video_section',
        'mime_type'   => 'video', // Filtra solo videos en la biblioteca
    ]));

    // (Opcional) Puedes añadir una imagen de portada (Poster) para antes de dar play
    $wp_customize->add_setting('gob_video_poster', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gob_video_poster', [
        'label'    => __('Imagen de Portada (Poster)', 'gob'),
        'section'  => 'gob_video_section',
    ]));

    // Campo: Control de Ancho (Range)
    $wp_customize->add_setting('gob_video_width', ['default' => '800', 'sanitize_callback' => 'absint']);
    $wp_customize->add_control('gob_video_width', [
        'label'       => __('Ancho Máximo (px)', 'gob'),
        'description' => __('Ajusta qué tan grande se ve el video en pantalla.', 'gob'),
        'section'     => 'gob_video_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 300,
            'max'  => 1200,
            'step' => 50,
        ],
    ]);
}