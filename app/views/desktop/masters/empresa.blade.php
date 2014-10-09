<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Bolsa de Trabajo: Menú Empresa</title>
    <link href="//fonts.googleapis.com/css?family=Josefin+Slab:400,400,300|Muli:400" rel="stylesheet" type="text/css">
    {{ HTML::style('css/standardize.css') }}
    {{ HTML::style('css/empresa_inicio.css') }}
    {{ HTML::style('editor/css/medium-editor.css') }}
    {{ HTML::style('editor/css/themes/default.css') }}
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <style>
        * {
            /*box-shadow: inset 0 0 5px green;*/
        }

        .logo-empresa {
            float: left;
            width: 104px;
            height: 57px;
            margin-left: 15px;
            background-image: url("{{ asset('images/empresa_logo/' . $empresa->logo) }}");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
        }

        .vacante {
            /*box-shadow: inset 0 0 5px blue;*/
            /*margin: 0 auto;*/
            display: inline-block;
            /*width: auto;*/
        }

        .c-info-vacante {
            /*box-shadow: inset 0 0 5px brown;*/
            /*display: inline-block;*/
            /*width: auto;*/
            margin: 0 auto;

        }

        .vacantes-cerradas, .editar-vacante, .cerrar-vacante, .numero-aplicantes {
            width: auto;
        }

        /* pagination links */
        .pagina ._text {
            color: #F7F7F7;
            font-size: 16px;
        }

        .enlace-pagina:hover {
            border-radius: 3px;
            background-color: #F7F7F7;
            font-size: 16px;
        }

        .enlace-pagina {
            font-size: 16px;
        }

        /* center (fix) the number in te links */
        .number-1, .number-2 {
            float: none;
        }

        /* menu links */
        a.menu:hover, .feedback:hover, .option-1:hover, .option-2:hover, .logout:hover {
            border-bottom: 1px dotted white;
        }

        /* menus fixes */
        .c-menu, .mensaje-verde {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="body empresa_inicio clearfix">
<div class="container-nav clearfix">
    <div class="navigation clearfix">
        <div class="container-logo clearfix">
            <div class="logo"></div>
        </div>
        <div class="container-links clearfix">
            <div class="container-l clearfix">
                <div class="c-link-1 clearfix">
                    <a id="menu" class="menu" href="{{ route('empresa.inicio') }}">Inicio</a>
                </div>
                <div class="c-link-2 clearfix">
                    <a id="option-1" class="option-1" href="{{ route('empresa.vacantes') }}">Vacantes</a>

                    <div class="num-1 clearfix">
                        <span class="number-1">{{ $vacantes_activas or '0' }}</span>
                    </div>
                </div>
                <div class="c-link-4 clearfix">
                    <a id="feedback" class="feedback" href="{{ route('empresa.feedback') }}">FeedBack</a>
                </div>
                <div class="c-link-5 clearfix">
                    <a id="logout" class="logout"
                       href="{{ route('session.destroy') }}">
                        SALIR
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-main clearfix">
    @if( Session::has('mensaje') )
    <p class="mensaje-verde">
        {{ Session::get('mensaje') }}
    </p>
    @endif

    @yield('contenido')
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/classlist/2014.01.31/classList.min.js"></script>
<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
{{ HTML::script('editor/js/medium-editor.js') }}
<script>
    jQuery.fn.center = function (parent) {
        if (parent) {
            parent = this.parent();
        }
        else {
            parent = window;
        }
        console.log(parent)
        this.css({
            "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
        });
        return this;
    };
    // initializing editors
    var titleEditor = new MediumEditor('.title-editable', {
        buttons               : ['bold'],
        buttonLabels: 'fontawesome'
    });
    var bodyEditor = new MediumEditor('.body-editable', {
        cleanPastedHTML: true,
        checkLinkFormat: true,
        buttonLabels: 'fontawesome',
        anchorInputPlaceholder: 'Escribe el enlace \"http://...\"',
        buttons               : ['bold', 'italic', 'underline', 'anchor'],
        //		diffLeft: 25,
        //		diffTop: 10,
        firstHeader           : 'h1',
        secondHeader          : 'h2',
        delay                 : 222,
        targetBlank           : true
    });
    $(function () {
        // initializing insert image on body editor
        //		$('.body-editable').mediumInsert({
        //			editor: bodyEditor,
        //			images: true,
        //			imagesUploadScript: "{{ URL::to('upload') }}"
        //		});
        // deactivate editors on show view
        if ($('#hideEditor').length) {
            $('.body-editable').mediumInsert('disable');
            bodyEditor.deactivate();
            titleEditor.deactivate();
        }
    });
    // hiding messages
    //	$('.error').hide().empty();
    //	$('.success').hide().empty();
</script>
@yield('js-editor')
</body>
</html>
