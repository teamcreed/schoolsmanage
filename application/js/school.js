var Uchip;

$( document ).ready(function() {
    autoCompleta('#represe','index.php?com=estudiantes&ajax=true&task=autocompleterep&query=%QUERY','#repid');
    
    var wsize = $(window).width()-60;
    var widthBot = wsize*0.25;
    $('#botonera').width(widthBot);
    $('#contenido').width(wsize*0.76);
    $('.panelcontent').height($( document ).height()-100);
    var anterior='#nada';
    $('#accordion div').click(function(){
        var padre = $(this).parent().attr('padre');
        if(anterior != padre){
            $('.active').removeClass('active');
            if($(anterior+' ul').is(':visible') && anterior != $(this).parent().attr('padre')){
                $(anterior+' ul').slideUp();
            }
        }else{
            $(anterior+' .active').removeClass('active');
        }
        $(this).parent().addClass('active');
        if($(this).parent().hasClass('dropdown')){
            $(this).parent().find('ul').slideDown();
        }else{
            var js = $(this).parent().attr('javascript');
            Uchip.bloquear();
            Uchip.Asincrono($(this).parent().attr('enlace'),function(response){
                $('.contenidopanel').html(response);
                if(!Uchip.empty(js)){
                    $.cachedScript(js);
//                    $.cachedScript( js).done(function( script, textStatus ) {
//                        Uchip.BindControles();
//                    });
                }
                Uchip.BindControles();
                Uchip.BindListado();
                Uchip.desbloquear();
            });
        }
        var padre = $(this).parent().attr('padre');
        if(typeof padre !== typeof undefined && padre !== false){
            anterior = $(this).parent().attr('padre');
        }else{
            anterior = '#'+$(this).parent().attr('id');
        }

    });
    
});
jQuery.cachedScript = function( url, options ) {
 
  // Allow user to set any option except for dataType, cache, and url
  options = $.extend( options || {}, {
    dataType: "script",
    cache: true,
    url: url
  });
 
  // Use $.ajax() since it is more flexible than $.getScript
  // Return the jqXHR object so we can chain callbacks
  return jQuery.ajax( options );
};