
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Flat UI - Free Bootstrap Framework and Theme</title>
        <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
        <link href="templates/default/css/bootstrap.min.css" rel="stylesheet">
        <link href="templates/default/css/default.css" rel="stylesheet">
        <link href="templates/default/css/flat-ui.css" rel="stylesheet">
        <link href="templates/default/css/calendar.css" rel="stylesheet">
        <link href="application/css/general.css" rel="stylesheet">
        <link href="templates/default/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="templates/default/js/vendor/html5shiv.js"></script>
          <script src="templates/default/js/vendor/respond.min.js"></script>
        <![endif]-->
        
        <script src="templates/default/js/vendor/jquery.min.js"></script>
        <script src="templates/default/js/vendor/video.js"></script>
        <script src="templates/default/js/application.js"></script>
        <script src="templates/default/js/flat-ui.min.js"></script>
        <script src="templates/default/js/jquery.form.js"></script>
        <script src="templates/default/js/blockui.js"></script>
<script src="templates/default/js/ui.js"></script>
<script src="templates/default/js/typeahead.js"></script>
        <script>
            $( document ).ready(function() {
                var urlw = 'index.php?com=estudiantes&ajax=true&task=autocompleterep&query=%QUERY';
                $("#represe").typeahead({
                    hint: false,
  highlight: false,
  minLength: 2,
                    remote: {
                        url : urlw
                    },
                    onResult: function(){
                        $("#represe").val('hola');
                    } 
                });
            });
        </script>
    </head>
    <body>hola
        <input type="text" class="form-control typeahead" depende="#repid" placeholder="Nombre del representante..." name="representante" id="represe" />
    </body>
</html>