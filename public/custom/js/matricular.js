$(document).on('ready', funcPrincipal);

var $cboGrade;
var $cboSection;

function funcPrincipal() {
    $cboGrade = $('#grade_id');
    $cboSection = $('#section_id');

    $cboGrade.on('change', cambiarGrado);
}

function cambiarGrado() {
    var sectionsUrl = $cboSection.data('source');
    var grade_id = $cboGrade.val();
    sectionsUrl = sectionsUrl.replace('{id}', grade_id);

    $.get(sectionsUrl, function (sections) {
        $cboSection.find('option').remove();
        $(sections).each(renderOption);
    });
}

function renderOption() {
    var option = '<option value="'+this.id+'">'+this.name+'</option>';
    $cboSection.append(option);
}