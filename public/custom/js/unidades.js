$(document).on('ready', funcPrincipal);

var $modalEditar;
var $formEditar;

// Seleccionado para edición
var $trEditar;

function funcPrincipal() {

    $modalEditar = $('#modalEditar');
    $formEditar = $modalEditar.find('form');

    $('[data-editar]').on('click', modalEditar);
    $formEditar.on('submit', formEditar);

}

function modalEditar() {
    // Take the current data
    var id = $(this).data('editar');
    $trEditar = $(this).parents('tr');
    var start = $trEditar.find('[data-start]').text();
    start = formatDate(start);
    var end = $trEditar.find('[data-end]').text();
    end = formatDate(end);

    // And display in the modal
    $modalEditar.find('[name="unit_id"]').val(id);
    $modalEditar.find('[name="start"]').val(start);
    $modalEditar.find('[name="end"]').val(end);

    $modalEditar.modal('show');
}

function formEditar() {
    event.preventDefault();

    /*
    // New data
    var unit_id = $(this).find('[name="unit_id"]').val();
    var start = $(this).find('[name="start"]').val();
    var end = $(this).find('[name="end"]').val();
    */

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
    }).done(function (data) {
        if(data.success) {
            $trEditar.find('[data-start]').text(data.start);
            $trEditar.find('[data-end]').text(data.end);
            $modalEditar.modal('hide');
        } else {
            if(data.errors) {
                for (var key in data.errors) {
                    renderTemplateAlerta(data.errors[key]);
                }
            }
        }
    });
}

function activateTemplate(id) {
    var t = document.querySelector(id);
    return document.importNode(t.content, true);
};

function renderTemplateAlerta(mensaje) {
    var clone = activateTemplate('#template-alerta');
    clone.querySelector("span").innerHTML = mensaje;
    $modalEditar.find('.modal-body').prepend(clone);
}

function formatDate(fecha) {
    return fecha.split('/').reverse().join('-');
}