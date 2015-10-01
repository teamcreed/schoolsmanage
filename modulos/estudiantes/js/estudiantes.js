function BindFormEstudiante(){
    Uchip.formitem = $('.manejaform').validar({
        ColocarEtiqueta: false,
        Bloquear: false
    });
    $('#AddRep').click(function(){
        $(this).find('.glyphicon').removeClass('glyphicon-plus-sign');
        $(this).find('.glyphicon').addClass('glyphicon-repeat');
        $(this).find('.glyphicon').addClass('spinning');
    });
    $('#fechanacimineto').datetimepicker({
        locale: 'es',
        showClose: true,
        tooltips: {
            today: 'Ir al día',
            clear: 'Limpiar seleccción',
            close: 'Cerrar selector',
            selectMonth: 'Seleccionar mes',
            prevMonth: 'Mes anterior',
            nextMonth: 'Próximo mes',
            selectYear: 'Seleccionar año',
            prevYear: 'Año anterior',
            nextYear: 'Próximo año',
            selectDecade: 'Seleccionar decada',
            prevDecade: 'Decada anterior',
            nextDecade: 'Próxima decada',
            prevCentury: 'Previous Century',
            nextCentury: 'Next Century'
        },
        maxDate: moment().endOf('day'),
        defaultDate: moment().subtract(5,'years'),
        format: 'DD/MM/YYYY'
    });
    Uchip.BindRepSuggest('#representante','index.php?com=estudiantes&ajax=true&task=autocompleterep&query=%QUERY','#repid');
}
function mkalumno(response){
    alert(response);
    $('#listado').html(response);
    Uchip.BindListado();
    Uchip.formitem.close();
    Uchip.Growl('¡Excelente!','El estudiante se ha guardado exitosamente en la base de datos.');
    //alert(response);
}
function starter(){
    $.cachedScript('templates/default/js/typeahead.js');
}
starter();