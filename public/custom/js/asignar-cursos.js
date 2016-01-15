$(document).on('ready', funcPrincipal);

var $formAsignar;
var $btnAsignar;
var $cboGrade;

function funcPrincipal() {

    $formAsignar = $('#formAsignar');
    $btnAsignar = $('#btnAsignar');
    $cboGrade = $('#cboGrade');

    $btnAsignar.on('click', asignarCurso);
    $cboGrade.on('change', cambiarGrado);
}

function asignarCurso() {
    var asignarUrl = $formAsignar.data('action');
    var courseId = $formAsignar.find('[name="course"]').val();
    var gradeId = $formAsignar.find('[name="grade"]').val();

    asignarUrl = asignarUrl.replace('{course}', courseId).replace('{grade}', gradeId);

    $formAsignar.attr('action', asignarUrl);
    $formAsignar.submit();
}

function cambiarGrado() {
    var redirectUrl = $cboGrade.data('redirect');
    var grade_id = $cboGrade.val();
    redirectUrl = redirectUrl.replace('{grade}', grade_id);
    location.href = redirectUrl;
}