<?php
/**
 * CLACH Customizer Settings
 * * Gestiona las opciones del personalizador de WordPress.
 * Incluye:
 * 1. Control Repetidor (Clach_Repeater_Control).
 * 2. Registro de Secciones y Settings (Base, Header, Footer).
 * 3. Inyección de CSS dinámico para sobrescribir estilos del tema.
 */

if (class_exists('WP_Customize_Control')) {

    /**
     * Clase Clach_Repeater_Control
     * Control personalizado para listas de enlaces con iconos.
     */
    class Clach_Repeater_Control extends WP_Customize_Control
    {
        public $type = 'clach_repeater';
        public $repeater_icons = [];
        public $button_text = 'Añadir elemento';
        public $input_labels = [
            'title' => 'Título', 
            'icon' => 'Icono / Imagen', 
            'url' => 'URL'
        ];

        public function __construct($manager, $id, $args = array())
        {
            parent::__construct($manager, $id, $args);
            if (isset($args['repeater_icons'])) $this->repeater_icons = $args['repeater_icons'];
            if (isset($args['button_text'])) $this->button_text = $args['button_text'];
            if (isset($args['input_labels'])) $this->input_labels = array_merge($this->input_labels, $args['input_labels']);
        }

        public function enqueue()
        {
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('clach-repeater-js', get_template_directory_uri() . '/assets/admin/js/repeater.js', ['jquery', 'jquery-ui-sortable'], '1.0', true);
            wp_enqueue_style('clach-repeater-css', get_template_directory_uri() . '/assets/admin/css/repeater.css', [], '1.0');
        }
        
        public function render_content()
        {
            $value = $this->value() ? json_decode($this->value(), true) : [];
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
            </label>

            <div class="clach-repeater-wrapper <?php echo esc_attr($this->id); ?>">
                <button type="button" class="button add-repeater-item"><?php echo esc_html($this->button_text); ?></button>

                <ul class="clach-repeater-list">
                    <?php if (!empty($value)): foreach ($value as $item): ?>
                        <li class="clach-repeater-item">
                            <label class="field-label"><?php echo esc_html($this->input_labels['title']); ?></label>
                            <input type="text" class="title-field" value="<?php echo esc_attr($item['title'] ?? ''); ?>">

                            <label class="field-label"><?php echo esc_html($this->input_labels['icon']); ?></label>
                            <select class="icon-select">
                                <option value="">Elegir icono...</option>
                                <?php foreach ($this->repeater_icons as $class => $label): ?>
                                    <option value="<?php echo esc_attr($class); ?>" <?php selected($item['icon'] ?? '', $class); ?>>
                                        <?php echo esc_html($label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="icon-field" placeholder="o clase (fa-solid fa-user)" value="<?php echo esc_attr($item['icon'] ?? ''); ?>">

                            <label class="field-label"><?php echo esc_html($this->input_labels['url']); ?></label>
                            <input type="text" class="url-field" value="<?php echo esc_attr($item['url'] ?? ''); ?>">

                            <div class="item-actions">
                                <span class="drag-handle">☰ Mover</span>
                                <button type="button" class="button remove-item" style="color: #b32d2e;">Eliminar</button>
                            </div>
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
                <input type="hidden" class="clach-repeater-hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </div>
            <?php
        }
    }
}

/**
 * Registro de opciones del Customizer
 */
function clach_customize_register($wp_customize)
{
    // === 1. IDENTIDAD DEL SITIO (Añadidos) ===
    $wp_customize->add_setting('clach_branding_version', ['default' => 'N.H.L.A. 2021 - 3.0', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_version', [
        'label' => __('Texto Versión', 'clach'),
        'section' => 'title_tagline', 
        'type' => 'text',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('clach_branding_desc', ['default' => 'Norma Halal Latinoamericana', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_desc', [
        'label' => __('Texto Descripción', 'clach'),
        'section' => 'title_tagline',
        'type' => 'text',
        'priority' => 21,
    ]);

    // === 2. COLORES GLOBALES (Base) ===
    $wp_customize->add_section('clach_colors_global', [
        'title' => __('Colores: Base & Globales', 'clach'),
        'priority' => 30
    ]);

    $global_colors = [
        'nhla_blue'    => ['label' => 'Azul Principal (Brand)', 'default' => '#1A428A'],
        'nhla_green'   => ['label' => 'Verde Principal (Brand)', 'default' => '#009B4D'],
        'nhla_red'     => ['label' => 'Rojo (Alertas)', 'default' => '#D32F2F'],
        'bg_body'      => ['label' => 'Fondo Web (Body)', 'default' => '#F5F5F5'],
        'text_main'    => ['label' => 'Texto Principal', 'default' => '#333333'],
        'border_color' => ['label' => 'Color Bordes', 'default' => '#CCCCCC'],
    ];

    foreach ($global_colors as $id => $props) {
        $setting_id = "clach_color_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_global',
        ]));
    }

    // === 3. COLORES HEADER Y NAV ===
    $wp_customize->add_section('clach_colors_header', [
        'title' => __('Colores: Cabecera y Menú', 'clach'),
        'priority' => 31
    ]);

    $header_colors = [
        'header_bg'       => ['label' => 'Fondo Cabecera', 'default' => '#1A428A'],
        'nav_link'        => ['label' => 'Color Enlaces Menú', 'default' => '#FFFFFF'],
        'nav_link_hover'  => ['label' => 'Fondo Hover Menú', 'default' => 'rgba(255,255,255,0.1)', 'alpha' => true], // Alpha permite transparencias
    ];

    foreach ($header_colors as $id => $props) {
        $setting_id = "clach_header_{$id}";
        // Nota: sanitize_hex_color no soporta alpha, usamos sanitize_text_field para permitir rgba si fuera necesario
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        
        // Usamos Color Control estándar (WordPress moderno soporta alpha en algunos contextos, si falla volver a hex simple)
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_header',
        ]));
    }

    // === 4. COLORES FOOTER ===
    $wp_customize->add_section('clach_colors_footer', [
        'title' => __('Colores: Footer', 'clach'),
        'priority' => 32
    ]);

    $footer_colors = [
        'footer_bg'         => ['label' => 'Fondo Footer', 'default' => '#1A428A'],
        'footer_title'      => ['label' => 'Títulos Footer', 'default' => '#FFFFFF'],
        'footer_text'       => ['label' => 'Texto General', 'default' => '#CCCCCC'],
        'footer_link'       => ['label' => 'Enlaces', 'default' => '#BBBBBB'],
        'footer_link_hover' => ['label' => 'Enlaces (Hover)', 'default' => '#FFFFFF'],
        'footer_copy'       => ['label' => 'Texto Copyright', 'default' => '#888888'],
    ];

    foreach ($footer_colors as $id => $props) {
        $setting_id = "clach_footer_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_footer',
        ]));
    }

    // === 5. REPETIDOR FOOTER (Contenido) ===
    $wp_customize->add_section('clach_footer_content', [
        'title' => __('Footer: Enlaces Relacionados', 'clach'),
        'priority' => 120,
    ]);

    $related_icons = [
        'fa-solid fa-globe' => 'Web Global',
        'fa-solid fa-file-contract' => 'Certificado',
        'fa-solid fa-building-columns' => 'Institución',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];

    $wp_customize->add_setting('_theme_related_sites_repeater', ['default' => '', 'sanitize_callback' => 'wp_kses_post']);
    $wp_customize->add_control(new Clach_Repeater_Control($wp_customize, '_theme_related_sites_repeater', [
        'label' => __('Gestor de Enlaces', 'clach'),
        'section' => 'clach_footer_content',
        'repeater_icons' => $related_icons,
    ]));

    // Datos para JS
    $wp_customize->clach_icons = $related_icons;
}
add_action('customize_register', 'clach_customize_register');

/**
 * Inyectar CSS Dinámico en el Head.
 * Priority 100 asegura que cargue después de las hojas de estilo del tema
 * para poder sobrescribir las reglas CSS existentes.
 */
function clach_customize_css() {
    // --- Valores Globales ---
    $c_blue = get_theme_mod('clach_color_nhla_blue', '#1A428A');
    $c_green = get_theme_mod('clach_color_nhla_green', '#009B4D');
    $c_red = get_theme_mod('clach_color_nhla_red', '#D32F2F');
    $c_bg = get_theme_mod('clach_color_bg_body', '#F5F5F5');
    $c_text = get_theme_mod('clach_color_text_main', '#333333');
    $c_border = get_theme_mod('clach_color_border_color', '#CCCCCC');

    // --- Valores Header ---
    $h_bg = get_theme_mod('clach_header_header_bg', '#1A428A');
    $h_link = get_theme_mod('clach_header_nav_link', '#FFFFFF');
    $h_hover = get_theme_mod('clach_header_nav_link_hover', 'rgba(255,255,255,0.1)');

    // --- Valores Footer ---
    $f_bg = get_theme_mod('clach_footer_footer_bg', '#1A428A');
    $f_title = get_theme_mod('clach_footer_footer_title', '#FFFFFF');
    $f_text = get_theme_mod('clach_footer_footer_text', '#CCCCCC');
    $f_link = get_theme_mod('clach_footer_footer_link', '#BBBBBB');
    $f_link_hover = get_theme_mod('clach_footer_footer_link_hover', '#FFFFFF');
    $f_copy = get_theme_mod('clach_footer_footer_copy', '#888888');

    ?>
    <style type="text/css" id="clach-customizer-css">
        /* 1. Variables Globales (Sobrescribe variables.css) */
        :root {
            --nhla-blue: <?php echo esc_attr($c_blue); ?>;
            --nhla-green: <?php echo esc_attr($c_green); ?>;
            --nhla-red: <?php echo esc_attr($c_red); ?>;
            --bg-body: <?php echo esc_attr($c_bg); ?>;
            --text-main: <?php echo esc_attr($c_text); ?>;
            --border-color: <?php echo esc_attr($c_border); ?>;
        }

        /* 2. Cabecera y Navegación (Sobrescribe header.css) */
        .site-header .main-header {
            background-color: <?php echo esc_attr($h_bg); ?> !important;
        }
        .main-navigation li a {
            color: <?php echo esc_attr($h_link); ?> !important;
        }
        .main-navigation li a:hover {
            background-color: <?php echo esc_attr($h_hover); ?> !important;
        }

        /* 3. Footer (Sobrescribe footer.css y valores hardcoded) */
        .footer {
            background-color: <?php echo esc_attr($f_bg); ?> !important;
            color: <?php echo esc_attr($f_text); ?> !important;
        }
        .footer-links h3,
        .footer-widget-title {
            color: <?php echo esc_attr($f_title); ?> !important;
        }
        .footer-links a,
        .footer-widget a {
            color: <?php echo esc_attr($f_link); ?> !important;
        }
        .footer-links a:hover,
        .footer-widget a:hover {
            color: <?php echo esc_attr($f_link_hover); ?> !important;
            /* Opcional: Si quieres que el verde del hover también sea customizable, usa var(--nhla-green) o crea otro control */
        }
        .footer-copy {
            color: <?php echo esc_attr($f_copy); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'clach_customize_css', 100);

/**
 * JS Data Pass
 */
function clach_customize_scripts_localize() {
    global $wp_customize;
    $icons = isset($wp_customize->clach_icons) ? $wp_customize->clach_icons : [];
    wp_localize_script('clach-repeater-js', 'ClachRepeaterData', ['icons' => $icons]);
}
add_action('customize_controls_enqueue_scripts', 'clach_customize_scripts_localize');