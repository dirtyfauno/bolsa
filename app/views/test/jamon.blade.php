<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Bolsa de Trabajo: Estadísticas</title>
    <link href="//fonts.googleapis.com/css?family=Muli:300"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/standardize.css">
    <link rel="stylesheet" href="css/estadisticas.css">
    <style>
        .estadisticas-table {
            border: 1px solid rgb(196, 106, 41);
            width: 100%;
            padding: 0;
            border-Radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
        }

        .estadisticas-table table {
            width: 100%;
            height: 100%;
            margin: 0;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .estadisticas-table table thead tr {
            background: rgb(196, 106, 41);
        }

        .estadisticas-table table caption {
            padding-top: 7px;
            padding-bottom: 7px;
            text-align: center;
            font-family: "Muli";
            font-size: 16px;
            background-color: #ffffff;
        }

        .estadisticas-table table thead tr td {
            border: 1px solid rgb(196, 106, 41);
            text-align: center;
            vertical-align: middle;
            border-width: 0px 0px 1px 0px;
            color: #ffffff;
            font-family: "Muli";
            font-size: 16px;
            height: 35px;
        }

        .estadisticas-table table thead tr td label {
            margin-right: 0px;
            margin-left: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
            color: inherit;
            font-weight: inherit;
            font-family: inherit;
            font-size: inherit;
            display: block;
        }

        .estadisticas-table table thead tr td:first-child {
            border-width: 0px 0px 1px 0px;
        }

        .estadisticas-table table tbody tr:last-child td:first-child {
            -moz-border-radius-bottomleft: 4px;
            -webkit-border-bottom-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .estadisticas-table table tbody tr:last-child td:last-child {
            -moz-border-radius-bottomright: 4px;
            -webkit-border-bottom-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .estadisticas-table table tbody tr {
            background-color: #ffffff;
        }

        .estadisticas-table table tbody tr:hover {
            background-color: #ffffff;
        }

        .estadisticas-table table tbody tr td {
            vertical-align: middle;
            height: 30px;
            text-align: center;
            color: #000000;
            font-family: Georgia;
            font-size: 15px;
            border: 1px solid rgb(196, 106, 41);
            border-width: 0px 0px 1px 0px;
        }

        .estadisticas-table table tbody tr td label {
            margin-right: 0px;
            margin-left: 20px;
            margin-top: 0px;
            margin-bottom: 0px;
            color: inherit;
            font-weight: inherit;
            font-family: inherit;
            font-size: inherit;
            display: block;
        }

        .estadisticas-table table tbody tr td:first-child {
            border-width: 0px 0px 1px 0px;
        }

        .estadisticas-table table tbody tr:last-child td {
            border: 0 0 0 1px;
        }
    </style>
</head>
<body class="body estadisticas clearfix">
@include("partials.desktop.estadisticas.nav")
<div class="main clearfix">
    <section class="graficas clearfix">
        @include("partials.desktop.estadisticas.grafica_software")
        @include("partials.desktop.estadisticas.grafica_vacantes")
        @include("partials.desktop.estadisticas.grafica_ofertas")
    </section>
    @include("partials.desktop.estadisticas.aside_carreras")
</div>
@include('partials.js-variables')
</body>
<script src="bower_components/chartjs/Chart.min.js"></script>
<script src="js/jquery-min.js"></script>
<script>
var globales = {
    numeroScalas       : 3,
    fechas             : estadisticas.bolsa.meses,
    formal             : null,
    practicas          : null,
    $labelTablaVacantes: $("#label-tabla-vacantes"),
    $labelTablaOferta  : $("#label-tabla-oferta"),
    $softwareContainer : $("#softwares"),
    $vacantesContainer : $("#vacantes"),
    $ofertasContainer  : $("#ofertas"),
    $selectFechas      : $("#select-fechas"),
    contextoSoftware   : document.getElementById("grafica-software").getContext("2d")
};
var dataVacantes = {
    labels  : estadisticas.bolsa.meses,
    datasets: [
        {
            fillColor  : "rgb(196, 106, 41)",
            strokeColor: "rgba(220,220,220,1)",
            data       : estadisticas.bolsa.ft
        },
        {
            fillColor  : "rgba(220,220,220,0.8)",
            strokeColor: "rgba(151,187,205,1)",
            data       : estadisticas.bolsa.pt
        }
    ]
};
var optionsVacantes = {

    //Boolean - If we show the scale above the chart dataVacantes
    scaleOverlay       : false,
    //Boolean - If we want to override with a hard coded scale
    scaleOverride      : false,
    //** Required if scaleOverride is true **
    //Number - The number of steps in a hard coded scale
    scaleSteps         : globales.numeroScalas,
    //Number - The value jump in the hard coded scale
    scaleStepWidth     : 0,
    //Number - The scale starting value
    scaleStartValue    : 0,
    //String - Colour of the scale line
    scaleLineColor     : "rgba(0,0,0,.1)",
    //Number - Pixel width of the scale line
    scaleLineWidth     : 1,
    //Boolean - Whether to show labels on the scale
    scaleShowLabels    : true,
    //Interpolated JS string - can access value
    scaleLabel         : "<%=value%>",
    //String - Scale label font declaration for the scale label
    scaleFontFamily    : "'Geogia'",
    //Number - Scale label font size in pixels
    scaleFontSize      : 17,
    //String - Scale label font weight style
    scaleFontStyle     : "normal",
    //String - Scale label font colour
    scaleFontColor     : "rgba(0,0,0,.60)",
    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : false,
    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.00)",
    //Number - Width of the grid lines
    scaleGridLineWidth : 1,
    //Boolean - If there is a stroke on each bar
    barShowStroke      : false,
    //Number - Pixel width of the bar stroke
    barStrokeWidth     : 0,
    //Number - Spacing between each of the X value sets
    barValueSpacing    : 10,
    //Number - Spacing between dataVacantes sets within X values
    barDatasetSpacing  : 1,
    //Boolean - Whether to animate the chart
    animation          : true,
    //Number - Number of animation steps
    animationSteps     : 60,
    //String - Animation easing effect
    animationEasing    : "easeOutQuart",
    //Function - Fires when the animation is complete
    onAnimationComplete: null

};
var dataOferta = {
    labels  : estadisticas.bolsa.meses,
    datasets: [
        {
            fillColor  : "rgb(196, 106, 41)",
            strokeColor: "rgba(220,220,220,1)",
            data       : estadisticas.bolsa.fo
        },
        {
            fillColor  : "rgba(220,220,220,0.8)",
            strokeColor: "rgba(151,187,205,1)",
            data       : estadisticas.bolsa.po
        }
    ]
};
var optionsOferta = {

    //Boolean - If we show the scale above the chart dataVacantes
    scaleOverlay       : false,
    //Boolean - If we want to override with a hard coded scale
    scaleOverride      : true,
    //** Required if scaleOverride is true **
    //Number - The number of steps in a hard coded scale
    scaleSteps         : globales.numeroScalas,
    //Number - The value jump in the hard coded scale
    scaleStepWidth     : 0,
    //Number - The scale starting value
    scaleStartValue    : 0,
    //String - Colour of the scale line
    scaleLineColor     : "rgba(0,0,0,.1)",
    //Number - Pixel width of the scale line
    scaleLineWidth     : 1,
    //Boolean - Whether to show labels on the scale
    scaleShowLabels    : true,
    //Interpolated JS string - can access value
    scaleLabel         : "",
    //String - Scale label font declaration for the scale label
    scaleFontFamily    : "'Geogia'",
    //Number - Scale label font size in pixels
    scaleFontSize      : 17,
    //String - Scale label font weight style
    scaleFontStyle     : "normal",
    //String - Scale label font colour
    scaleFontColor     : "rgba(0,0,0,.60)",
    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : false,
    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.00)",
    //Number - Width of the grid lines
    scaleGridLineWidth : 1,
    //Boolean - If there is a stroke on each bar
    barShowStroke      : false,
    //Number - Pixel width of the bar stroke
    barStrokeWidth     : 0,
    //Number - Spacing between each of the X value sets
    barValueSpacing    : 10,
    //Number - Spacing between dataVacantes sets within X values
    barDatasetSpacing  : 1,
    //Boolean - Whether to animate the chart
    animation          : true,
    //Number - Number of animation steps
    animationSteps     : 60,
    //String - Animation easing effect
    animationEasing    : "easeOutQuart",
    //Function - Fires when the animation is complete
    onAnimationComplete: null

};
function setDataVacantes (formal, practicas) {
    dataVacantes.datasets[0].data = formal;
    dataVacantes.datasets[1].data = practicas;
}
function setDataOferta (formal, practicas) {
    dataOferta.datasets[0].data = formal;
    dataOferta.datasets[1].data = practicas;
}
function getMaximoValor (formal, practicas) {
    var maximos = [];
    maximos.push(Math.max.apply(null, formal));
    maximos.push(Math.max.apply(null, practicas));
    return Math.max.apply(null, maximos);
}
function setOpcionesOferta (formal, practicas) {
    var maximo = getMaximoValor(formal, practicas);
    optionsOferta.scaleOverride = true;
    optionsOferta.scaleStepWidth = Math.round(maximo / optionsOferta.scaleSteps);
    optionsOferta.scaleLabel = "$<%=value%>";
}
function setOpcionesVacantes (formal, practicas) {
    var maximo = getMaximoValor(formal, practicas);
    optionsVacantes.scaleOverride = true;
    optionsVacantes.scaleStepWidth = Math.round(maximo / optionsVacantes.scaleSteps);
    optionsVacantes.scaleLabel = "<%=value%> vacantes";
}
function crearNuevaGraficaVacantes () {
    graficaVacantes = new Chart(ctx_vacantes).Bar(dataVacantes, optionsVacantes);
}
function crearNuevaGraficaOferta () {
    graficaOferta = new Chart(ctx_oferta).Bar(dataOferta, optionsOferta);
}
function llenarColumnaFechas (index, elemento) {
    $(elemento).text(globales.fechas[index]);
}
function llenarColumnaFormales (index, elemento) {
    $(elemento).text(globales.formal[index]);
}
function llenarColumnaPracticas (index, elemento) {
    $(elemento).text(globales.practicas[index]);
}
function llenarTablaVacantes () {
    var filas = $(".fila-fecha-vacantes");
    filas.map(llenarColumnaFechas);
    var formales = $(".fila-dato-ft");
    formales.map(llenarColumnaFormales);
    var practicas = $(".fila-dato-pt");
    practicas.map(llenarColumnaPracticas);
}
function llenarTablaOfertas () {
    var filas = $(".fila-fecha-oferta");
    filas.map(llenarColumnaFechas);
    var formales = $(".fila-dato-fo");
    formales.map(llenarColumnaFormales);
    var practicas = $(".fila-dato-po");
    practicas.map(llenarColumnaPracticas);
}
function vacantesGeneral () {
    hideSoftwareContainer();

    globales.$labelTablaVacantes.text("Vacantes en General");
    globales.$labelTablaOferta.text("Vacantes en General - Sueldo");
    globales.formal = estadisticas.bolsa.ft;
    globales.practicas = estadisticas.bolsa.pt;
    setDataVacantes(globales.formal, globales.practicas);
    setOpcionesVacantes(globales.formal, globales.practicas);
    llenarTablaVacantes();
    globales.formal = estadisticas.bolsa.fo;
    globales.practicas = estadisticas.bolsa.po;
    setDataOferta(globales.formal, globales.practicas);
    setOpcionesOferta(globales.formal, globales.practicas);
    llenarTablaOfertas();
    crearNuevaGraficaOferta();
    crearNuevaGraficaVacantes();
}
var ctx_vacantes = document.getElementById("gVacantes").getContext("2d");
var ctx_oferta = document.getElementById("gOfertas").getContext("2d");
var graficaVacantes = new Chart(ctx_vacantes).Bar(dataVacantes, optionsVacantes);
var graficaOferta = new Chart(ctx_oferta).Bar(dataOferta, optionsOferta);

vacantesGeneral();

function vacantesNoIngles () {
    hideSoftwareContainer();

    globales.$labelTablaVacantes.text("Vacantes sin Inglés");
    globales.$labelTablaOferta.text("Vacantes sin Inglés - Sueldo");
    globales.formal = estadisticas.bolsa.nift;
    globales.practicas = estadisticas.bolsa.nipt;
    setDataVacantes(globales.formal, globales.practicas);
    setOpcionesVacantes(globales.formal, globales.practicas);
    llenarTablaVacantes();
    globales.formal = estadisticas.bolsa.nifo;
    globales.practicas = estadisticas.bolsa.nipo;
    setDataOferta(globales.formal, globales.practicas);
    setOpcionesOferta(globales.formal, globales.practicas);
    llenarTablaOfertas();
    crearNuevaGraficaOferta();
    crearNuevaGraficaVacantes();
}
function vacantesInglesBasico () {

    hideSoftwareContainer();

    globales.$labelTablaVacantes.text("Vacantes Inglés Básico");
    globales.$labelTablaOferta.text("Vacantes Inglés Básico - Sueldo");
    globales.formal = estadisticas.bolsa.ibft;
    globales.practicas = estadisticas.bolsa.ibpt;
    setDataVacantes(globales.formal, globales.practicas);
    setOpcionesVacantes(globales.formal, globales.practicas);
    llenarTablaVacantes();
    globales.formal = estadisticas.bolsa.ibfo;
    globales.practicas = estadisticas.bolsa.ibpo;
    setDataOferta(globales.formal, globales.practicas);
    setOpcionesOferta(globales.formal, globales.practicas);
    llenarTablaOfertas();
    crearNuevaGraficaOferta();
    crearNuevaGraficaVacantes();
}
function vacantesInglesIntermedio () {

    hideSoftwareContainer();

    globales.$labelTablaVacantes.text("Vacantes Inglés Medio");
    globales.$labelTablaOferta.text("Vacantes Inglés Medio - Sueldo");
    globales.formal = estadisticas.bolsa.iift;
    globales.practicas = estadisticas.bolsa.iipt;
    setDataVacantes(globales.formal, globales.practicas);
    setOpcionesVacantes(globales.formal, globales.practicas);
    llenarTablaVacantes();
    globales.formal = estadisticas.bolsa.iifo;
    globales.practicas = estadisticas.bolsa.iipo;
    setDataOferta(globales.formal, globales.practicas);
    setOpcionesOferta(globales.formal, globales.practicas);
    llenarTablaOfertas();
    crearNuevaGraficaOferta();
    crearNuevaGraficaVacantes();
}
function vacantesInglesAvanzado () {

    hideSoftwareContainer();

    globales.$labelTablaVacantes.text("Vacantes Inglés Alto");
    globales.$labelTablaOferta.text("Vacantes Inglés Alto - Sueldo");
    globales.formal = estadisticas.bolsa.iaft;
    globales.practicas = estadisticas.bolsa.iapt;
    setDataVacantes(globales.formal, globales.practicas);
    setOpcionesVacantes(globales.formal, globales.practicas);
    llenarTablaVacantes();
    globales.formal = estadisticas.bolsa.iafo;
    globales.practicas = estadisticas.bolsa.iapo;
    setDataOferta(globales.formal, globales.practicas);
    setOpcionesOferta(globales.formal, globales.practicas);
    llenarTablaOfertas();
    crearNuevaGraficaOferta();
    crearNuevaGraficaVacantes();
}
globales.$softwareContainer.hide();
$("#v-g").on("click", vacantesGeneral);
$("#v-ni").on("click", vacantesNoIngles);
$("#v-ib").on("click", vacantesInglesBasico);
$("#v-ii").on("click", vacantesInglesIntermedio);
$("#v-ia").on("click", vacantesInglesAvanzado);

function initSoftware()
{
    globales.$selectFechas.empty();

    $(globales.fechas).each(function(index, fecha){
        globales.$selectFechas.append('<option value="' + index + '">'+ fecha + '</option>');
    });
}

initSoftware();

function hideSoftwareContainer()
{
    globales.$vacantesContainer.show();
    globales.$ofertasContainer.show();
    globales.$softwareContainer.hide();
}
// programas
function graficasProgramas () {

    globales.$vacantesContainer.hide();
    globales.$ofertasContainer.hide();
    globales.$softwareContainer.show();

    var json = JSON.parse(estadisticas.bolsa.programas[globales.$selectFechas.val()]);
    var no_hay_datos = "ND";
    var data = [
        {
            value    : json.data[0].cantidad || no_hay_datos,
            color    : "#fdb45c",
            highlight: "#FF5A5E",
            label    : json.data[0].nombre || no_hay_datos
        },
        {
            value    : json.data[1].cantidad || no_hay_datos,
            color    : "#fdc37c",
            highlight: "#5AD3D1",
            label    : json.data[1].nombre || no_hay_datos
        },
        {
            value    : json.data[2].cantidad || no_hay_datos,
            color    : "#fdd29d",
            highlight: "#FFC870",
            label    : json.data[2].nombre || no_hay_datos
        },
        {
            value    : json.data[3].cantidad || no_hay_datos,
            color    : "#fee1bd",
            highlight: "#FFC870",
            label    : json.data[3].nombre || no_hay_datos
        },
        {
            value    : json.data[4].cantidad || no_hay_datos,
            color    : "#fef0de",
            highlight: "#FF5A5E",
            label    : json.data[4].nombre || no_hay_datos
        }
    ];
    var options = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps       : 100,
        //String - Animation easing effect
        animationEasing      : "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : false
    };
    // crear instania de la grafica
    var PieChart = new Chart(globales.contextoSoftware).Pie(data, options);

    // cambiar labels
    $(".fila-nombre").map(function (index, elementoHtml) {
        $(elementoHtml).text(json.data[index].nombre);
    });
    $(".fila-cantidad").map(function (index, elementoHtml) {
        $(elementoHtml).text(json.data[index].cantidad);
    });
    llenarTablaVacantes();
}

$("#v-p").on("click", graficasProgramas);

globales.$selectFechas.change(function(){
    graficasProgramas();
});

</script>
</html>
