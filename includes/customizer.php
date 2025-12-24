<?php
/**
 * Customizer Loader
 * Carga los módulos individuales del personalizador.
 */

$gob_customizer_dir = get_template_directory() . '/includes/customizer/';

// 1. Controles Personalizados (Clases y scripts JS asociados)
require $gob_customizer_dir . 'class-repeater.php';

// 2. Configuración (Registro de paneles, secciones y settings)
require $gob_customizer_dir . 'settings.php';

// 3. Salida Visual (Inyección de CSS dinámico)
require $gob_customizer_dir . 'styles.php';