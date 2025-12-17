<?php
/**
 * CLACH Customizer Settings
 * Define controles personalizados como el Repetidor para el footer.
 */

if (class_exists('WP_Customize_Control')) {

    class Clach_Repeater_Control extends WP_Customize_Control
    {
        public $type = 'clach_repeater';
        public $repeater_icons = [];
        public $button_text = 'Añadir elemento';
        public $input_labels = [
            'title' => 'Título',
            'icon'  => 'Icono / Imagen',
            'url'   => 'URL'
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
            // Cargar assets necesarios para el Drag & Drop en el admin
            wp_enqueue_script('jquery-ui-sortable');
            
            // Assets propios del repetidor (rutas ajustadas a la estructura modular)
            wp_enqueue_script('clach-repeater-js', get_template_directory_uri() . '/assets/admin/js/repeater.js', ['jquery', 'jquery-ui-sortable'], '1.0', true);
            wp_enqueue_style('clach-repeater-css', get_template_directory_uri() . '/assets/admin/css/repeater.css', [], '1.0');
        }
        
        public function render_content()
        {
            $value = $this->value();
            $value = $value ? json_decode($value, true) : [];
            $icons = $this->repeater_icons;
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
                    <?php if (!empty($value)): ?>
                        <?php foreach ($value as $item): ?>
                            <li class="clach-repeater-item">
                                <label class="field-label"><?php echo esc_html($this->input_labels['title']); ?></label>
                                <input type="text" class="title-field" value="<?php echo esc_attr(isset($item['title']) ? $item['title'] : ''); ?>">

                                <label class="field-label"><?php echo esc_html($this->input_labels['icon']); ?></label>
                                <select class="icon-select">
                                    <option value="">Elegir icono...</option>
                                    <?php foreach ($icons as $class => $label): ?>
                                        <option value="<?php echo esc_attr($class); ?>" <?php selected(isset($item['icon']) ? $item['icon'] : '', $class); ?>>
                                            <?php echo esc_html($label); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" class="icon-field" placeholder="o clase (fa-solid fa-user)" value="<?php echo esc_attr(isset($item['icon']) ? $item['icon'] : ''); ?>">

                                <label class="field-label"><?php echo esc_html($this->input_labels['url']); ?></label>
                                <input type="text" class="url-field" value="<?php echo esc_attr(isset($item['url']) ? $item['url'] : ''); ?>">

                                <div class="item-actions">
                                    <span class="drag-handle">☰ Mover</span>
                                    <button type="button" class="button remove-item" style="color: #b32d2e;">Eliminar</button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <input type="hidden" class="clach-repeater-hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </div>
            <?php
        }
    }
}

/**
 * Registro de Opciones
 */
function clach_customize_register($wp_customize)
{
    // Iconos disponibles para selección rápida
    $related_icons = [
        'fa-solid fa-globe' => 'Web Global',
        'fa-solid fa-file-contract' => 'Certificado',
        'fa-solid fa-building-columns' => 'Institución',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];

    // Iconos disponibles para selección rápida
    $related_icons = [
        'fa-solid fa-globe' => 'Web Global',
        'fa-solid fa-file-contract' => 'Certificado',
        'fa-solid fa-building-columns' => 'Institución',
        'fa-solid fa-scale-balanced' => 'Legal',
    ];
    
    // [NUEVO] === CAMPOS PARA LA CABECERA (Al lado del Logo) ===
    // Usamos la sección 'title_tagline' que es la nativa de "Identidad del sitio"
    
    // 1. Texto Superior (Versión)
    $wp_customize->add_setting('clach_branding_version', [
        'default' => 'N.H.L.A. 2021 - 3.0',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('clach_branding_version', [
        'label' => __('Texto Versión (Línea 1)', 'clach'),
        'description' => 'Ej: N.H.L.A. 2021 - 3.0',
        'section' => 'title_tagline', 
        'type' => 'text',
        'priority' => 20, // Aparecerá debajo del logo
    ]);

    // 2. Texto Inferior (Descripción)
    $wp_customize->add_setting('clach_branding_desc', [
        'default' => 'Norma Halal Latinoamericana',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('clach_branding_desc', [
        'label' => __('Texto Descripción (Línea 2)', 'clach'),
        'description' => 'Ej: Norma Halal Latinoamericana',
        'section' => 'title_tagline',
        'type' => 'text',
        'priority' => 21,
    ]);
    
    // Sección Footer
    $wp_customize->add_section('clach_footer_section', [
        'title' => __('Configuración del Footer', 'clach'),
        'priority' => 120,
    ]);

    // Setting: Sitios Relacionados
    $wp_customize->add_setting('_theme_related_sites_repeater', ['default' => '', 'sanitize_callback' => 'wp_kses_post']);
    
    // Control: Repetidor
    $wp_customize->add_control(new Clach_Repeater_Control($wp_customize, '_theme_related_sites_repeater', [
        'label' => __('Enlaces "Sitios Relacionados"', 'clach'),
        'section' => 'clach_footer_section',
        'repeater_icons' => $related_icons,
        'button_text' => 'Añadir Enlace',
        'input_labels' => ['title' => 'Texto del Enlace', 'icon' => 'Icono', 'url' => 'Destino URL']
    ]));

    // Pasar variables a JS
    $wp_customize->clach_icons = $related_icons;
}
add_action('customize_register', 'clach_customize_register');

/**
 * Localización de Scripts para pasar datos PHP a JS
 */
function clach_customize_scripts_localize() {
    global $wp_customize;
    $icons = isset($wp_customize->clach_icons) ? $wp_customize->clach_icons : [];

    wp_localize_script('clach-repeater-js', 'ClachRepeaterData', [
        'icons' => $icons,
        'related_id' => '_theme_related_sites_repeater' 
    ]);
}
add_action('customize_controls_enqueue_scripts', 'clach_customize_scripts_localize');