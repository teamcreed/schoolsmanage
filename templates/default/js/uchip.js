
(function ($) { //an IIFE so safely alias jQuery to $
    $.Uchip = function () {
        this.item = '';
        this.formitem = '';
    };
    $.Uchip.prototype = {
        alertar: function(mensaje,titulo){
            if(empty(titulo))
                titulo='Atención';
            BootstrapDialog.show({
                title: titulo,
                message: mensaje,
                cssClass: 'login-dialog'
            });
        },
        makeurl: function(url){
            return url+'&ajax=true';
        },
        Asincrono: function(url,callback){
            $.ajax({
                crossDomain : true,
                url:   this.makeurl(url),
                type:  'post',
                success:  function (response) {
                    if( typeof callback == "function" )
                        callback(response);
                }
            });
        },
        bloquear: function(){
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
                baseZ: 1000
            }); 
        },
        desbloquear: function(){
            $.unblockUI();
        },
        BindListado: function(){
            this.item = '';
            $('.paginacion').click(function(event){
                Uchip.Navegar($(this).attr('href')+'&ajax=true','#listado',function(){
                    Uchip.BindListado();
                });
                event.preventDefault();
            });
            var left = ($('.paginado').width()-$('.paginado .pagination').width())/2;
            $('.paginado .pagination').css({left: left+'px'});
            $('.item').click(function(){
                if(Uchip.item!=$(this).attr('id')){
                    $(this).addClass('activo');
                    $('#'+Uchip.item).removeClass('activo');
                    Uchip.item=$(this).attr('id');
                }else{
                    $(this).removeClass('activo');
                    Uchip.item='';
                }
            });
        },
        Growl: function(titulo,mensaje){
            $.growlUI(titulo, mensaje); 
        },
        DialogNewItem: function(html){
            var $textAndPic = $('<div></div>');
            $textAndPic.append(html);
            var binder = $textAndPic.find('.manejaform').attr('binder');
            BootstrapDialog.show({
                title: 'Añadir',
                message: $textAndPic,
                size: BootstrapDialog.SIZE_WIDE,
                onshown: function(dialogRef){
                    if(binder==undefined || Uchip.empty(binder)){
                        $('.manejaform').validar({
                            ColocarEtiqueta: false
                        });
                    }else
                        eval(binder+"();");
                },
                buttons: [{
                    icon: 'glyphicon glyphicon-hdd',
                    label: 'Guardar',
                    cssClass: 'btn-primary',
                    action: function(dialogRef){
                        /*dialogRef.enableButtons(false);
                        dialogRef.setClosable(false);
                        event.data.$footerButton.enable();
                        $(this).stopSpin();*/
                        if(Uchip.formitem.validar()){
                            dialogRef.enableButtons(false);
                            dialogRef.setClosable(false);
                            //$button.disable();
                            this.spin();
                            Uchip.formitem.send()
                            Uchip.formitem=dialogRef;
                        }
                        //forminsert.saludar();
                    }
                }, {
                    label: 'Close',
                    action: function(dialogRef){
                        dialogRef.close();
                    },
                    cssClass: 'btn-warning'
                }]
            });
        },
        BindRepSuggest: function(elemento,url,depende){
            $(elemento).typeahead({
                display: 'value',
                remote :  url,
                hint: true,
                highlight: true,
                templates: {
                    empty: [
                        '<div>',
                        'No se ha encontrado ningún respresentante',
                        '</div>'
                    ].join('\n')
                }
            }).on('typeahead:selected', function (e, datum) {
                var padre = $(this).parent();
                padre.hide();
                var element = $(this);
                var idtags = 'tagrep'+ $(this).attr('id');
                var idtags2 = '#'+idtags;
                if($(idtags2).length<1){
                    var $abuelo = $(this).parent().parent();
                    $abuelo.append('<div class="tagsinput-primary" id="div'+ idtags +'"><input id="'+ idtags +'" class="form-control inputTags" type="text" value="'+datum.value+'"></div>');
                    $(depende).val(datum.id);
                    
                    $(idtags2).tagsinput({maxTags: 1});
                    $(idtags2).on('itemRemoved', function(event) {
                        $(depende).val('');
                        element.val('');
                        $('#div'+ idtags).hide();
                        padre.show();
                    });
                }else{
                    $(idtags2).tagsinput('add', datum.value);
                    $('#div'+ idtags).show();
                }
                $(idtags).tagsinput('add', datum.value);
            }).on('itemRemoved', function(event) {
                $(depende).val('');
                //$(this).tagsinput('destroy');
            });
        },
        BindControles: function(){
            var base = $('#baseControl').val()
            $('.bindable .searchitem').click(function(){
                alertar('BUSCO PS');
            });
            $('.bindable .additem').click(function(){
                Uchip.Asincrono(base+'&task=formulario&ajax=true',function(response){
                    Uchip.DialogNewItem(response);
                });
            });
            $('.bindable .detailitem').click(function(){
                if(!Uchip.empty(Uchip.item)){
                    Uchip.Asincrono(base+'&task=detalles&id='+Uchip.item+'&ajax=true',function(response){
                        //alert(response)
                        var $textAndPic = $('<div></div>');
                        $textAndPic.append(response);
                        BootstrapDialog.show({
                            title: 'Say-hello dialog',
                            message: $textAndPic
                        });
                    });
                }else{
                    alertar("Debe seleccionar un item para poder continuar.");
                }
                
            });
            $('.bindable .deleteitem').click(function(){
                alertar('BUSCO PS');
            });
        },
        empty: function(mixed_var) {
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
        },
        Navegar: function(url,capa,callback) {
                $.ajax({
                    crossDomain : true,
                    url:   this.makeurl(url),
                    type:  'get',
                    async: false, // must be set to false
                    beforeSend: function(){
                        Uchip.bloquear();
                    },
                    success:  function (response) { 
                        //window.history.pushState({path:url+hash},'',url+hash);
                        $(capa).html(response);
                        if( typeof callback == "function" )
                            callback(response);
                        Uchip.desbloquear();
                    },
                    error: function(jqXHR,staus,errorThrown ){
                        Uchip.desbloquear();
                        alert(jqXHR.responseText)
                    }
                });
            }
    };
}(jQuery));