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
    var name = $trEditar.find('[data-name]').text();
    var description = $trEditar.find('[data-description]').text();

    // And display in the modal
    $modalEditar.find('[name="course_handbook_id"]').val(id);
    $modalEditar.find('[name="name"]').val(name);
    $modalEditar.find('[name="description"]').val(description);

    $modalEditar.modal('show');
}

function formEditar() {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
    }).done(function (data) {
        if(data.success) {
            $trEditar.find('[data-name]').text(data.name);
            $trEditar.find('[data-description]').text(data.description);
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
