<?php
/**
 * Control Repetidor Personalizado
 */

if (class_exists('WP_Customize_Control')) {

    class Gob_Repeater_Control extends WP_Customize_Control
    {
        public $type = 'gob_repeater';
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
            wp_enqueue_script('gob-repeater-js', get_template_directory_uri() . '/assets/admin/js/repeater.js', ['jquery', 'jquery-ui-sortable'], '1.0', true);
            wp_enqueue_style('gob-repeater-css', get_template_directory_uri() . '/assets/admin/css/repeater.css', [], '1.0');
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

            <div class="gob-repeater-wrapper <?php echo esc_attr($this->id); ?>">
                <button type="button" class="button add-repeater-item"><?php echo esc_html($this->button_text); ?></button>

                <ul class="gob-repeater-list">
                    <?php if (!empty($value)): foreach ($value as $item): ?>
                        <li class="gob-repeater-item">
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
                <input type="hidden" class="gob-repeater-hidden" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
            </div>
            <?php
        }
    }
}
/**
 * Control de Rango con Valor Visible (Slider + Texto)
 */
if (class_exists('WP_Customize_Control')) {
    class Gob_Range_Control extends WP_Customize_Control {
        public $type = 'gob_range';
        public $suffix = ''; // Ejemplo: 'px', '%', etc.

        public function render_content() {
            // Obtener límites definidos o usar defaults
            $min = isset($this->input_attrs['min']) ? $this->input_attrs['min'] : 0;
            $max = isset($this->input_attrs['max']) ? $this->input_attrs['max'] : 100;
            $step = isset($this->input_attrs['step']) ? $this->input_attrs['step'] : 1;
            $value = $this->value();
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>
                
                <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                    <input type="range" 
                           <?php $this->link(); ?>
                           value="<?php echo esc_attr( $value ); ?>" 
                           min="<?php echo esc_attr( $min ); ?>"
                           max="<?php echo esc_attr( $max ); ?>"
                           step="<?php echo esc_attr( $step ); ?>"
                           style="flex-grow: 1; cursor: pointer;"
                           oninput="this.nextElementSibling.innerText = this.value + '<?php echo esc_js( $this->suffix ); ?>'"
                    >
                    
                    <span style="
                        font-weight: 600; 
                        background: #f0f0f1; 
                        padding: 4px 8px; 
                        border-radius: 4px; 
                        border: 1px solid #ccc;
                        min-width: 50px;
                        text-align: center;
                        font-size: 11px;
                        color: #333;
                    ">
                        <?php echo esc_html( $value ) . esc_html( $this->suffix ); ?>
                    </span>
                </div>
            </label>
            <?php
        }
    }
}

/**
 * Localización de Scripts (Pasar datos PHP a JS para el repetidor)
 */
function gob_customize_scripts_localize() {
    global $wp_customize;
    $icons = isset($wp_customize->gob_icons) ? $wp_customize->gob_icons : [];
    wp_localize_script('gob-repeater-js', 'gobRepeaterData', ['icons' => $icons]);
}
add_action('customize_controls_enqueue_scripts', 'gob_customize_scripts_localize');