(function( $ ) {
    $.fn.RotarBot = function( options ) {
        var settings = $.extend({
            // These are the defaults.
            event: 'click',
            label: 'Presionar',
            iconMaster: 'glyphicon',
            icon: 'glyphicon-floppy-disk',
            spinnerClass: 'glyphicon-spin',
            spinnerIcon: 'glyphicon-refresh',
            girateOnEvent: true,
            spinning: false,
            onEvent: function(){}
        }, options );
        this.initialize = function(){
            $(this).append('<span id="hola" class="' + settings.iconMaster + ' ' + settings.icon + '"></span>');
            $(this).append('<span class="text-ro">  ' + settings.label + '</span>');
            $(this).addClass('spinnerbot');
            if(settings.event=='click'){
                $(this).click(function(){
                    if(!settings.spinning){
                        girateEvent($(this));
                        settings.onEvent($(this));
                    }
                });
            }
            return this;
        };
        function girate($objeto){
            $objeto.toggleClass('active');
            var icono = $objeto.find('.' + settings.iconMaster)
            icono.removeClass(settings.icon);
            icono.addClass(settings.spinnerIcon);
            icono.addClass(settings.spinnerClass);
            settings.spinning = true;
        }
        function girateEvent($objeto) {
            if(settings.girateOnEvent){
                girate($objeto);
            }
        }
        this.stop = function() {
            $(this).toggleClass('active');
            var icono = $(this).find('.' + settings.iconMaster)
            icono.removeClass(settings.spinnerIcon);
            icono.removeClass(settings.spinnerClass);
            icono.addClass(settings.icon);
            settings.spinning = false;
        };
        return this.initialize();
    };
})( jQuery );