jQuery(document).ready(function ($) {

    if (typeof ClachRepeaterData === 'undefined') return;

    // Función para actualizar el input oculto que guarda el JSON
    function updateField(wrapper) {
        let items = [];
        wrapper.find('.clach-repeater-item').each(function () {
            items.push({
                title: $(this).find('.title-field').val(),
                icon: $(this).find('.icon-field').val(),
                url: $(this).find('.url-field').val()
            });
        });
        // Dispara el cambio para que WP detecte la modificación
        wrapper.find('.clach-repeater-hidden').val(JSON.stringify(items)).trigger('change');
    }

    // Generador de opciones para el select
    function generateOptions() {
        let options = '<option value="">Elegir icono...</option>';
        for (const [cls, lbl] of Object.entries(ClachRepeaterData.icons)) {
            options += `<option value="${cls}">${lbl}</option>`;
        }
        return options;
    }

    // Inicialización
    $('.clach-repeater-wrapper').each(function () {
        const wrapper = $(this);
        const optionsHtml = generateOptions();

        // Ordenable (Sortable)
        wrapper.find('.clach-repeater-list').sortable({
            handle: '.drag-handle',
            update: function () { updateField(wrapper); }
        });

        // Añadir Ítem
        wrapper.on('click', '.add-repeater-item', function () {
            const itemHtml = `
                <li class="clach-repeater-item">
                    <label class="field-label">Texto del Enlace</label>
                    <input type="text" class="title-field">
                    
                    <label class="field-label">Icono</label>
                    <select class="icon-select">${optionsHtml}</select>
                    <input type="text" class="icon-field" placeholder="o clase manual">
                    
                    <label class="field-label">Destino URL</label>
                    <input type="text" class="url-field">
                    
                    <div class="item-actions">
                        <span class="drag-handle">☰ Mover</span>
                        <button type="button" class="button remove-item" style="color:#b32d2e;">Eliminar</button>
                    </div>
                </li>`;
            
            wrapper.find('.clach-repeater-list').append(itemHtml);
            updateField(wrapper);
        });

        // Eliminar Ítem
        wrapper.on('click', '.remove-item', function () {
            $(this).closest('.clach-repeater-item').remove();
            updateField(wrapper);
        });

        // Sincronizar Select con Input de texto
        wrapper.on('change', '.icon-select', function () {
            $(this).closest('.clach-repeater-item').find('.icon-field').val($(this).val());
            updateField(wrapper);
        });

        // Actualizar al escribir
        wrapper.on('input', 'input', function () {
            updateField(wrapper);
        });
    });
});