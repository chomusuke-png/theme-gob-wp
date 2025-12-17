<?php
/**
 * Control Repetidor Personalizado
 */

if (class_exists('WP_Customize_Control')) {

    class Clach_Repeater_Control extends WP_Customize_Control
    {
        public $type = 'clach_repeater';
        public $repeater_icons = [];
        public $button_text = 'Add Item';
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
 * Localización de Scripts (Pasar datos PHP a JS para el repetidor)
 */
function clach_customize_scripts_localize() {
    global $wp_customize;
    $icons = isset($wp_customize->clach_icons) ? $wp_customize->clach_icons : [];
    wp_localize_script('clach-repeater-js', 'ClachRepeaterData', ['icons' => $icons]);
}
add_action('customize_controls_enqueue_scripts', 'clach_customize_scripts_localize');