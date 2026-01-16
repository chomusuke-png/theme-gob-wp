# Manual de Usuario: GobStyleTheme

**Versión del Tema:** 1.7.10
**Descripción:** Plantilla personalizable orientada a portales institucionales o corporativos con estética gubernamental.
**Autor:** Zumito

## Introducción
Bienvenido a la documentación de **GobStyleTheme**. Este tema ha sido diseñado para ofrecer una apariencia limpia, institucional y altamente personalizable a través del "Personalizador" nativo de WordPress. No se requieren conocimientos de código para ajustar colores, textos o estructuras principales.

## Características Principales
* **Diseño Modular:** Secciones de Hero (Banner) y Video en portada.
* **Personalización Total de Colores:** Control sobre cabecera, pie de página, menús y cuerpo.
* **Gestión de Enlaces Institucionales:** Módulo repetidor para enlaces en el pie de página.
* **Diseño Responsivo:** Menú móvil adaptado y elementos flexibles.
* **SEO Básico:** Campo para meta descripción integrado.

# Instalación y Activación

## Requisitos Previos
* WordPress 6.0 o superior.
* PHP 7.4 o superior.

## Pasos de Instalación
1.  Descarga el archivo `.zip` del tema.
2.  Ingresa a tu panel de administración de WordPress.
3.  Navega a **Apariencia > Temas**.
4.  Haz clic en **Añadir nuevo** y luego en **Subir tema**.
5.  Selecciona el archivo `theme-gob-wp.zip` y presiona **Instalar ahora**.
6.  Una vez instalado, haz clic en **Activar**.

**Nota:** Al activar el tema, se cargarán automáticamente los estilos base y la librería de iconos FontAwesome (v6.5.0) para su uso en todo el sitio.

# Configuración General

Toda la configuración del sitio se realiza desde **Apariencia > Personalizar > Configuración General**.

## 1. Identidad y Versiones
Configura los textos que aparecen junto al logo en la cabecera.
* **Logo:** Se gestiona desde la opción nativa "Identidad del sitio".
* **Título (Línea 1):** Texto principal de la institución (Ej. "Gobierno Regional").
* **Descripción (Línea 2):** Bajada o nombre del departamento (Ej. "División de Finanzas").

## 2. Barra Superior (Top Bar)
Controla la franja delgada en la parte superior del sitio.
* **Nombre Organización:** Texto institucional alineado a la izquierda.
* **Widgets:** La zona derecha se gestiona desde *Apariencia > Widgets > Barra Superior*.

## 3. Footer: Enlaces Relacionados
Gestor de enlaces con iconos para el pie de página.
* **Botón "Añadir Enlace":** Crea un nuevo elemento en la lista.
* **Título:** Texto visible del enlace.
* **Icono:** Selecciona un icono de la lista predefinida o escribe manualmente una clase de FontAwesome (ej: `fa-solid fa-user`).
* **URL:** Enlace de destino.

## 4. SEO y Metadatos
* **Meta Descripción:** Define el resumen (aprox. 150 caracteres) que aparecerá en los resultados de Google. Si se deja vacío, WordPress usará el extracto por defecto.

# Personalización de la Portada

Estas opciones afectan exclusivamente a la página de inicio (Home). Accede desde **Apariencia > Personalizar > Configuración General**.

## 1. Portada: Banner Principal (Hero)
Esta sección controla el gran banner visual al inicio.

### Contenido
* **Título y Subtítulo:** Textos principales de bienvenida.
* **Botón de Acción:** Texto (ej. "Explorar") y URL de destino. Si se dejan vacíos, el botón no aparece.

### Diseño Visual
* **Alineación:**
    * *Horizontal:* Izquierda, Centro o Derecha.
    * *Vertical:* Arriba, Centro o Abajo.
* **Imagen de Fondo:** Sube una imagen de alta resolución (se recomienda 1920x1080px).
* **Capa (Overlay):** Color superpuesto a la imagen para mejorar la lectura del texto. Puedes controlar su opacidad.

### Estilo de la "Curva"
El tema permite encerrar el texto en un contenedor con bordes curvos dinámicos.
* **Color de Fondo del Texto:** Define el color de la caja de texto.
* **Intensidad de la Curva:** Ajusta el radio de los bordes (0px a 250px).
* **Opacidad de la Curva:** Define qué tan transparente es la caja de texto.

## 2. Portada: Video Destacado
Aparece justo debajo del Banner Principal.
* **Subir Video:** Carga un archivo `.mp4` directamente a la biblioteca de medios.
* **Poster:** Imagen estática que se muestra mientras carga el video.
* **Ancho Máximo:** Control deslizante para ajustar el tamaño del reproductor en pantalla (300px a 1200px).

# Colores y Apariencia

El tema permite un control granular de los colores desde el panel **Colores del Tema**.

## Secciones Configurables

### 1. Base y Globales
Define la paleta corporativa principal.
* **Color Primario:** Usado en cabeceras, botones principales y footer.
* **Color Secundario:** Usado en bordes, acentos y botones de acción.
* **Fondo y Texto:** Colores base del cuerpo del sitio (body).

### 2. Cabecera y Menú
Personaliza la barra de navegación principal.
* Permite cambiar el fondo, color de enlaces y estados "hover" (al pasar el mouse) tanto para el menú principal como para los submenús desplegables.

### 3. Pie de Página (Footer)
Control total sobre el fondo, títulos de widgets, textos generales y el color del copyright.

### 4. Widgets de Inicio
Afecta a los bloques de contenido que se añaden en la zona "Widgets Inicio".
* Puedes definir el fondo de las tarjetas, bordes, radio de curvatura y color de los títulos.

### 5. Estilos de Página (Global)
Afecta a todas las páginas estáticas (`page.php`).
* **Ocultar Título H1:** Casilla para ocultar globalmente el título automático de las páginas si deseas maquetarlo manualmente en el editor.
* **Colores de Encabezados:** Define el color para H1, H2, H3, etc., dentro del contenido.

### 6. Botón Volver Arriba
Personaliza el botón flotante que aparece al hacer scroll.
* **Icono:** Clase de FontAwesome (por defecto `fas fa-arrow-up`).
* **Colores:** Estado normal y hover.

# Widgets y Menús

## Áreas de Menú
El tema soporta una ubicación de menú principal:
1.  Vaya a **Apariencia > Menús**.
2.  Cree un menú y asigne la ubicación **"Menú Principal (Cabecera)"**.
3.  **Nota:** El icono de búsqueda (lupa) se añade automáticamente al final del menú; no es necesario agregarlo manualmente.

## Áreas de Widgets
El tema dispone de tres zonas de widgets específicas:

### 1. Widgets Inicio (`home-widgets`)
* **Ubicación:** Aparece en la portada, debajo del Video/Hero.
* **Uso:** Ideal para tarjetas de acceso rápido, imágenes institucionales o avisos importantes.
* **Estilo:** Estos widgets heredan los estilos definidos en el Personalizador > Colores > Widgets Inicio.

### 2. Barra Superior (`topbar-widget`)
* **Ubicación:** Esquina superior derecha.
* **Uso:** Diseñado para selectores de idioma, iconos de redes sociales pequeños o enlaces de accesibilidad.

### 3. Footer Principal (`footer-widget-main`)
* **Ubicación:** Centro del pie de página.
* **Uso:** Texto legal, dirección, contacto o mapa del sitio.

