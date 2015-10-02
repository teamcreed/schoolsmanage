function BindFormEstudiante(){
    Uchip.formitem = $('.manejaform').validar({
        ColocarEtiqueta: false,
        Bloquear: false
    });
    function cancelarRep(){
        Uchip.toggleDiv('#addrep','#formulario');
        Uchip.activeDialog.getButton('backrep').hide();
        Uchip.activeDialog.getButton('buttonSaveRep').hide();
        Uchip.activeDialog.getButton('buttonAdd').show();
    }
    var boton = $('#AddRep').RotarBot({
        onEvent: function(object){
            Uchip.activeDialog.enableButtons(false);
            Uchip.activeDialog.setClosable(false);
            Uchip.Asincrono('index.php?com=represent&ajax=true&task=addform',function(response){
                //$('#addrep').html(response);
                var botonadd = Uchip.activeDialog.getButton('buttonAdd');
                botonadd.hide();
                var botonback = Uchip.activeDialog.getButton('backrep');
                Uchip.toggleDiv('#formulario','#addrep');
                if(botonback === null){
                    Uchip.activeDialog.AddBoton({
                        icon: 'glyphicon glyphicon-arrow-left',
                        label: 'Volver',
                        id: 'backrep',
                        cssClass: 'btn-warning',
                        action: function(dialogRef){
                            cancelarRep();
                        }
                    });

                    Uchip.activeDialog.AddBoton({
                        icon: 'glyphicon glyphicon-floppy-disk',
                        label: 'Guardar',
                        id: 'buttonSaveRep',
                        BegOf: true,
                        cssClass: 'btn-primary',
                        action: function(){
                            Uchip.disableDialog(Uchip.activeDialog)
                            this.spin();
                            var $button = this;
                            Uchip.Asincrono('index.php?com=represent&ajax=true&task=test',function(response){
                                $button.stopSpin();
                                var rep = JSON.parse(response);
                                var padre = $('#representante').parent();
                                padre.hide();
                                var element = $('#representante');
                                var idtags = 'tagrep'+ element.attr('id');
                                var idtags2 = '#'+idtags;
                                if($(idtags2).length<1){
                                    var $abuelo = padre.parent();
                                    $abuelo.append('<div class="tagsinput-primary" id="div'+ idtags +'"><input id="'+ idtags +'" class="form-control inputTags" type="text" value="'+rep.value+'"></div>');
                                    $('#repid').val(rep.id);
                                    $(idtags2).tagsinput({maxTags: 1});
                                    $(idtags2).on('itemRemoved', function(event) {
                                        $('#repid').val('');
                                        element.val('');
                                        $('#div'+ idtags).hide();
                                        padre.show();
                                    });
                                }else{
                                    $(idtags2).tagsinput('removeAll');
                                    $(idtags2).tagsinput('add', rep.value);
                                    $('#repid').val(rep.id);
                                    $('#div'+ idtags).show();
                                }
                                $(idtags).tagsinput('add', rep.value);
                                cancelarRep();
                                Uchip.enableDialog(Uchip.activeDialog);
                                Uchip.Growl('¡Excelente!','El representante ha sido guardado con exito.');
                            });
                        }
                    });
                }else{
                    botonback.show();
                    Uchip.activeDialog.getButton('buttonSaveRep').show();
                }
                Uchip.activeDialog.enableButtons(true);
                Uchip.activeDialog.setClosable(true);
                boton.stop();
            });
        },
        label: 'Add. Representante'
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
    Uchip.activeDialog.close();
    Uchip.Growl('¡Excelente!','El estudiante se ha guardado exitosamente en la base de datos.');
    //alert(response);
}
function starter(){
    $.cachedScript('templates/default/js/typeahead.js');
}
starter();