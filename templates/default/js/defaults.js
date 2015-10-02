/* 
 * Copyright (C) 2015 Divergente Soluciones
 *
 * Aplicacion destinada a la gention y control de unidades educativas
 * Desarrollada por un grupo de emprendedores 100% Venezolanos,
 * desarrollada en Maracay Estado Aragua
 *
 */
var formatoFecha='DD/MM/YYYY';
var ConfirmarInstancia;
var Uchip;
function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}
$( document ).ready(function() {
    Uchip = new $.Uchip();
    $('#loginform').ajaxForm({
        beforeSubmit:  function(){
            bloquear();
        },
        success: function(response) {
            desbloquear();
            if(response!='1')
                $('.oculto').slideDown();
            else
                window.location.href="index.php";
        }
    });
    addadnfilt();

});
function FechaNormal(fecha){
    var d1 = moment(fecha);
    return d1.format(formatoFecha);
}
function aplyPagination(){
    $('.paginacion').click(function(event){
        navegar($(this).attr('href')+'&ajax=true','#listado',aplyPagination);
        event.preventDefault();
    });
    $('.item').click(function(){
        eval($(this).attr('callback')+'('+$(this).attr('id')+')')
    });
}
function showmodal(){
    $("#myModal").modal('show');
}
function modalTitulo(titulo){
    $('#myModal .modal-title').html(titulo);
}
function modalBotones(botones){
    $('#myModal .modal-footer').html(botones);
}
function modalBotonesAdd(boton){
    $('#myModal .modal-footer').append(boton);
}
function QuitaPon(quita,pon,callback){
    $(quita).slideUp(500,function(){
        $(pon).slideDown(500,function(){
            if( typeof callback == "function" )
                callback();
        });
    });
}
function Confirmar(mensaje,callbackTrue,callbackFalse){
    BootstrapDialog.confirm({
        title: 'Atención',
        cssClass: 'login-dialog',
        message: mensaje,
        type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
        closable: true, // <-- Default value is false
        draggable: true, // <-- Default value is false
        btnCancelLabel: 'Cancelar', // <-- Default value is 'Cancel',
        callback:function(result){
            if(result) {
                this.close();
                if( typeof callbackTrue == "function" )
                    callbackTrue();
            }
        }
    });
}

function navegar(url,capa,callback) {
    bloquear();
    $.ajax({
        crossDomain : true,
        url:   url,
        type:  'get',
        async: false, // must be set to false
        success:  function (response) { 
            //window.history.pushState({path:url+hash},'',url+hash);
            $(capa).html(response);
            if( typeof callback == "function" )
                callback(response);
            desbloquear();
        },
        error: function(jqXHR,staus,errorThrown ){
            desbloquear();
            alert(jqXHR.responseText)
        }
    });
}
function gotoPantalla(){
    $('#formulario').hide("slide", { direction: "left" },400,function(){
        $('#pantalla').show("slide", { direction: "rigth" }, 400);
    });
}
function aviresult(){
    $('.aviresul').show("slide", { direction: "down" },400,function(){
        setInterval(function () {
            $('.aviresul').hide("slide", { direction: "up" }, 400,function(){
                $('.aviresul').remove();
            });
        }, 8000);
    });
}
function addadnfilt(){
    $('.filt').click(function(){
        $('#filtros').toggle( "slow" );
    });
    $('.agregar').click(function(){
        $('#pantalla').hide("slide", { direction: "left" },400,function(){
            $('#formulario').show("slide", { direction: "right" }, 400);
        });
    });
    $('#filtrosform').validar({limpiar: false});
}
function filtrar(response){
    $('#listado').html(response);
    aplyPagination();
}
function alertar(mensaje,titulo){
    if(empty(titulo))
        titulo='Atención';
    BootstrapDialog.show({
        title: titulo,
        message: mensaje,
        cssClass: 'login-dialog'
    });
}
function autoCompleta(elemento,url,depende){
    $(elemento).typeahead({
        display: 'value',
        remote :  url,
        templates: {
            empty: [
                '<div>',
                'No se ha encontrado ningún respresentante',
                '</div>'
            ].join('\n')
        }
    }).on('typeahead:selected', function (e, datum) {
        $(depende).val(datum.id);
    });
}
function autocompletaTags(elemento,url,depende){
    $(elemento).typeahead({
        display: 'value',
        remote :  url,
        templates: {
            empty: [
                '<div>',
                'No se ha encontrado ningún respresentante',
                '</div>'
            ].join('\n')
        }
    }).on('typeahead:selected', function (e, datum) {
        $(this).tagsinput({maxTags: 1});
        $(this).tagsinput('add', datum.value);
        $(depende).val(datum.id);
    }).on('itemRemoved', function(event) {
        $(depende).val('');
        $(this).tagsinput('destroy');
    });
}
(function( $ ) {
    $.fn.validar = function( options ) {
        var settings = $.extend({
            // These are the defaults.
            etiqueta: "<span class='{CLASE}'>{TEXTO}</span>",
            clase: "requerido",
            clasereq: "errorReq",
            limpiar: true,
            ColocarEtiqueta: true,
            Bloquear: true,
            mensaje: "Este campo es requerido",
            errores: ''
        }, options );
        this.initialize = function(){
            this.submit(function(event){
                var etiqueta;
                var contador=0;

                if(validarForm($(this))){
                    var callback=$(this).attr('callback');
                    var idform=$(this).attr('id');
                    $(this).ajaxSubmit({
                        beforeSubmit:  function(){
                            if(settings.Bloquear)
                                bloquear();
                        },
                        success: function(response) {

                            if(settings.limpiar)
                                $('#'+idform).clearForm();
                            if(callback!=undefined)
                                eval(callback+"(response);");
                            $('.'+settings.clase).remove();
                            if(settings.Bloquear)
                                desbloquear();
                        }
                    });
                }
                event.preventDefault();
            });
            return this;
        };
        this.validar = function() {
            return validarForm($(this))
        };
        this.send = function() {
            $(this).trigger('submit');
        };
        return this.initialize();
        function validarForm(form){
            settings.errores = '';
            var contador=0;
            form.find(':input').each(function() {
                if($(this).attr('requerido')=='true' && empty($(this).val())){
                    settings.errores += mensajeError($(this))
                    contador++;
                }else if($(this).attr('requerido')=='email' && !validarEmail($(this).val())){
                    settings.errores += mensajeError($(this));
                    contador++;
                }else if(!empty($(this).attr('depende')) && empty($($(this).attr('depende')).val())){
                    settings.errores += mensajeError($(this));
                    contador++;
                }
                else{
                    $(this).parent().find('.'+settings.clase).remove();
                }
            });
            if(contador>0){
                if(!settings.ColocarEtiqueta)
                    alertar('Debe corregir los siguientes errores: <br><br>'+settings.errores);
                return false;
            }else
                return true;
        }
        function removerMensaje(elemento){
            elemento.parent().find('.'+settings.clase).remove();
        }
        function mensajeError(elemento){
            removerMensaje(elemento);
            elemento.addClass( settings.clasereq );
            if(elemento.attr('mensaje')==undefined)
                mensaje = settings.mensaje
            else
                mensaje = elemento.attr('mensaje');
            etiqueta = settings.etiqueta.replace('{TEXTO}',mensaje);
            etiqueta = etiqueta.replace('{CLASE}',settings.clase);
            if(settings.ColocarEtiqueta)
                $(etiqueta).appendTo(elemento.parent());
            return etiqueta;
        }
    };
    
    function validarEmail( email ) {
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return expr.test(email)
    }
    this.saludar = function() {
        alert('HOLA')
    };
    function alerta( mensaje ) {
        alert(mensaje)
    }
    function empty(mixed_var) {
        var undef, key, i, len;
        var emptyValues = [undef, null, false, 0, '', '0'];

        for (i = 0, len = emptyValues.length; i < len; i++) {
            if (mixed_var === emptyValues[i]) {
                return true;
            }
        }
        if (typeof mixed_var === 'object') {
            for (key in mixed_var) {
                return false;
                //}
            }
            return true;
        }
        return false;
    }
})( jQuery );
function empty(mixed_var) {
    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }
    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            return false;
            //}
        }
        return true;
    }
    return false;
}
function bloquear(){
    $.blockUI({ 
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        },
        baseZ: 10000
    }); 
}
function desbloquear(){
    $.unblockUI();
}
