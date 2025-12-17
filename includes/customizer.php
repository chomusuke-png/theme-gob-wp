<?php
/**
 * CLACH Customizer Settings
 * Manages WordPress Customizer options including:
 * 1. Custom Repeater Control (Clach_Repeater_Control).
 * 2. Section & Setting Registration (Base, Header, Footer).
 * 3. Dynamic CSS injection to override theme styles.
 */

if (class_exists('WP_Customize_Control')) {

    /**
     * Class Clach_Repeater_Control
     * Renders a custom control for managing a list of links with icons.
     */
    class Clach_Repeater_Control extends WP_Customize_Control
    {
        public $type = 'clach_repeater';
        public $repeater_icons = [];
        public $button_text = 'Add Item'; // Default in English
        public $input_labels = [
            'title' => 'Title', 
            'icon' => 'Icon / Class', 
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
                                <option value="">Select Icon...</option>
                                <?php foreach ($this->repeater_icons as $class => $label): ?>
                                    <option value="<?php echo esc_attr($class); ?>" <?php selected($item['icon'] ?? '', $class); ?>>
                                        <?php echo esc_html($label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="icon-field" placeholder="or manual class (fa-solid fa-user)" value="<?php echo esc_attr($item['icon'] ?? ''); ?>">

                            <label class="field-label"><?php echo esc_html($this->input_labels['url']); ?></label>
                            <input type="text" class="url-field" value="<?php echo esc_attr($item['url'] ?? ''); ?>">

                            <div class="item-actions">
                                <span class="drag-handle">☰ Move</span>
                                <button type="button" class="button remove-item" style="color: #b32d2e;">Remove</button>
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
 * Register Customizer Options
 */
function clach_customize_register($wp_customize)
{
    // === 1. SITE IDENTITY & TOP BAR ===
    
    // Top Bar Section
    $wp_customize->add_section('clach_topbar_section', [
        'title' => __('Top Bar Settings', 'clach'),
        'priority' => 20, // Before Site Identity
    ]);

    // Top Bar Text Setting
    $wp_customize->add_setting('clach_topbar_text', [
        'default' => 'Centro de Certificación Halal de Chile',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('clach_topbar_text', [
        'label' => __('Organization Name', 'clach'),
        'description' => __('Text displayed in the gray top bar.', 'clach'),
        'section' => 'clach_topbar_section',
        'type' => 'text',
    ]);

    // Branding Extra Fields (added to native title_tagline section)
    $wp_customize->add_setting('clach_branding_version', ['default' => 'N.H.L.A. 2021 - 3.0', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_version', [
        'label' => __('Version Text (Line 1)', 'clach'),
        'section' => 'title_tagline', 
        'type' => 'text',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('clach_branding_desc', ['default' => 'Norma Halal Latinoamericana', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('clach_branding_desc', [
        'label' => __('Description Text (Line 2)', 'clach'),
        'section' => 'title_tagline',
        'type' => 'text',
        'priority' => 21,
    ]);

    // === 2. GLOBAL COLORS (Base) ===
    $wp_customize->add_section('clach_colors_global', [
        'title' => __('Colors: Base & Global', 'clach'),
        'priority' => 30
    ]);

    $global_colors = [
        'nhla_blue'    => ['label' => 'Primary Blue (Brand)', 'default' => '#1A428A'],
        'nhla_green'   => ['label' => 'Primary Green (Brand)', 'default' => '#009B4D'],
        'nhla_red'     => ['label' => 'Red (Alerts)', 'default' => '#D32F2F'],
        'bg_body'      => ['label' => 'Body Background', 'default' => '#F5F5F5'],
        'text_main'    => ['label' => 'Main Text', 'default' => '#333333'],
        'border_color' => ['label' => 'Border Color', 'default' => '#CCCCCC'],
    ];

    foreach ($global_colors as $id => $props) {
        $setting_id = "clach_color_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_global',
        ]));
    }

    // === 3. HEADER COLORS ===
    $wp_customize->add_section('clach_colors_header', [
        'title' => __('Colors: Header & Menu', 'clach'),
        'priority' => 31
    ]);

    $header_colors = [
        'header_bg'       => ['label' => 'Header Background', 'default' => '#1A428A'],
        'nav_link'        => ['label' => 'Menu Link Color', 'default' => '#FFFFFF'],
        'nav_link_hover'  => ['label' => 'Menu Hover Background', 'default' => 'rgba(255,255,255,0.1)', 'alpha' => true],
    ];

    foreach ($header_colors as $id => $props) {
        $setting_id = "clach_header_{$id}";
        $wp_customize->add_setting($setting_id, ['default' => $props['default'], 'sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_header',
        ]));
    }

    // === 4. FOOTER COLORS ===
    $wp_customize->add_section('clach_colors_footer', [
        'title' => __('Colors: Footer', 'clach'),
        'priority' => 32
    ]);

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
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
            'label' => $props['label'],
            'section' => 'clach_colors_footer',
        ]));
    }

    // === 5. FOOTER CONTENT REPEATER ===
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

    // Pass icons to JS
    $wp_customize->clach_icons = $related_icons;
}
add_action('customize_register', 'clach_customize_register');

/**
 * Inject Dynamic CSS into Head.
 * Priority 100 ensures this loads after theme styles to override them.
 */
function clach_customize_css() {
    // --- Global Values ---
    $c_blue = get_theme_mod('clach_color_nhla_blue', '#1A428A');
    $c_green = get_theme_mod('clach_color_nhla_green', '#009B4D');
    $c_red = get_theme_mod('clach_color_nhla_red', '#D32F2F');
    $c_bg = get_theme_mod('clach_color_bg_body', '#F5F5F5');
    $c_text = get_theme_mod('clach_color_text_main', '#333333');
    $c_border = get_theme_mod('clach_color_border_color', '#CCCCCC');

    // --- Header Values ---
    $h_bg = get_theme_mod('clach_header_header_bg', '#1A428A');
    $h_link = get_theme_mod('clach_header_nav_link', '#FFFFFF');
    $h_hover = get_theme_mod('clach_header_nav_link_hover', 'rgba(255,255,255,0.1)');

    // --- Footer Values ---
    $f_bg = get_theme_mod('clach_footer_footer_bg', '#1A428A');
    $f_title = get_theme_mod('clach_footer_footer_title', '#FFFFFF');
    $f_text = get_theme_mod('clach_footer_footer_text', '#CCCCCC');
    $f_link = get_theme_mod('clach_footer_footer_link', '#BBBBBB');
    $f_link_hover = get_theme_mod('clach_footer_footer_link_hover', '#FFFFFF');
    $f_copy = get_theme_mod('clach_footer_footer_copy', '#888888');

    ?>
    <style type="text/css" id="clach-customizer-css">
        /* 1. Global Variables */
        :root {
            --nhla-blue: <?php echo esc_attr($c_blue); ?>;
            --nhla-green: <?php echo esc_attr($c_green); ?>;
            --nhla-red: <?php echo esc_attr($c_red); ?>;
            --bg-body: <?php echo esc_attr($c_bg); ?>;
            --text-main: <?php echo esc_attr($c_text); ?>;
            --border-color: <?php echo esc_attr($c_border); ?>;
        }

        /* 2. Header & Nav */
        .site-header .main-header {
            background-color: <?php echo esc_attr($h_bg); ?> !important;
        }
        .main-navigation li a {
            color: <?php echo esc_attr($h_link); ?> !important;
        }
        .main-navigation li a:hover {
            background-color: <?php echo esc_attr($h_hover); ?> !important;
        }

        /* 3. Footer */
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
        }
        .footer-copy {
            color: <?php echo esc_attr($f_copy); ?> !important;
        }
    </style>
    <?php
}
add_action('wp_head', 'clach_customize_css', 100);

/**
 * Localize Script for Repeater Control
 */
function clach_customize_scripts_localize() {
    global $wp_customize;
    $icons = isset($wp_customize->clach_icons) ? $wp_customize->clach_icons : [];
    wp_localize_script('clach-repeater-js', 'ClachRepeaterData', ['icons' => $icons]);
}
add_action('customize_controls_enqueue_scripts', 'clach_customize_scripts_localize');