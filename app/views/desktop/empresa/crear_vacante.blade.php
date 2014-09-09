@extends("desktop.masters.empresa")

@section("contenido")

@include("partials.desktop.empresa.menu-info")

<div id="menu-crear" class="c-menu c-menu-4 clearfix">
    <div class="titulo-menu-1 clearfix">
        <h1 class="titulo">Nueva Vacante</h1>
    </div>
    <div class="c-formulario clearfix">
        <div class="options-1 clearfix">
            <!--            puesto-->
            <div class="c-puesto clearfix">
                <label class="puesto puesto-1">Puesto</label>
                {{ Form::text("puesto", null, array("id" => "puesto_i", "class" => "puesto puesto-2", "placeholder" => "Puesto de la Vacante")) }}
                <span id="puesto" class="err puesto puesto-3" style="color: brown;"></span>
            </div>
            <!--            carrera-->
            <div class="c-carrera clearfix">
                <label class="carrera carrera-1">Carrera</label>
                {{ Form::select('carrera_id', $carreras_lista, null, array('id' => 'carrera_id_i', 'class'=> 'carrera carrera-2')) }}
                <span class="err carrera carrera-3" style="color: brown;" id="carrera_id"></span>
            </div>
            <!--            titulado-->
            <div class="c-titulado clearfix">
                <label class="titulado titulado-1">Titulado</label>
                {{ Form::select('titulado_id', $titulado_lista, null, array('id' => 'titulado_id_i', 'class'=> 'titulado titulado-2')) }}
                <span class="err titulado titulado-3" style="color: brown;" id="titulado_id"></span>
            </div>
        </div>
        <div class="options-2 clearfix">
            <!--            correo-->
            <div class="c-correo clearfix">
                <label class="correo correo-1">Correo</label>
                {{ Form::text("correo", $correo, array("id" => "correo_i", "class" => "correo correo-2", "placeholder" => "correo@reclutador.com")) }}
                <span class="err correo correo-3" style="color: brown;" id="correo"></span>
            </div>
            <!--            experiencia-->
            <div class="c-experiencia clearfix">
                <label class="experiencia experiencia-1">Experiencia</label>
                {{ Form::select('experiencia_id', $experiencia_lista, null, array('id' => 'experiencia_id_i', 'class'=> 'experiencia experiencia-2')) }}
                <span class="err experiencia experiencia-3" style="color: brown;" id="experiencia_id"></span>
            </div>
            <!--            tipo-->
            <div class="c-tipo clearfix">
                <label class="tipo tipo-1">Tipo de Vacante</label>
                {{ Form::select('tipo_id', $tipo_lista, null, array('id' => 'tipo_id_i', 'class'=> 'tipo tipo-2')) }}
                <span class="err tipo tipo-3" style="color: brown;" id="tipo_id"></span>
            </div>
        </div>
        <div class="options-3 clearfix">
            <!--            area-->
            <div class="c-area clearfix">
                <label class="area area-1">Area de desempeño</label>
                {{ Form::text('area', null, array('id' => 'area_i', 'class'=> 'area area-2', 'placeholder' => 'Area de la Vacante')) }}
                <span class="err area area-3" style="color: brown;" id="area"></span>
            </div>
            <!--            software-->
            <div class="c-software clearfix">
                <label class="software software-1">Paquete Computacional (Excel, AutoCad, Visual Studio, etc)</label>
                {{ Form::textarea("software", null, array("id" => "software_i", "class" => "software software-2", "placeholder" => "Separado por comas")) }}
                <span class="err software software-3" style="color: brown;" id="software"></span>
            </div>
        </div>
        <div class="options-4 clearfix">
            <!--            sueldo-->
            <div class="c-sueldo clearfix">
                <label class="sueldo sueldo-1">Sueldo </label>
                {{ Form::text('oferta', null, array('id' => 'oferta_i', 'class'=> 'sueldo sueldo-2', 'placeholder' => "Sueldo Inicial")) }}
                <span class="err sueldo sueldo-3" style="color: brown;" id="oferta"></span>
            </div>
            <!--            ingles-->
            <div class="c-ingles clearfix">
                <label class="ingles ingles-1">Nivel de Inglés</label>
                {{ Form::select('ingles_id', $ingles_lista, null, array('id' => 'ingles_id_i', 'class'=> 'ingles ingles-2')) }}
                <span class="err ingles ingles-3" style="color: brown;" id="ingles_id"></span>
            </div>
            <!--            c-rotar-->
            <div class="c-rotar clearfix">
                <label class="checkbox-rotar clearfix">
                    <input id="c-rotar_i" class="rotar rotar-1" type="checkbox">
                    <span class="rotar rotar-2">Disponibilidad para rotar turno</span>
                </label>
            </div>
        </div>
        <!--        checkboxes-->
        <div class="c-checkboxes clearfix">
            <div class="c-boxes-1 clearfix">
                <!--                c-viajar-->
                <div class="c-viajar clearfix">
                    <label class="viajar clearfix">
                        <input id="c-viajar_i" class="viajar viajar-2" type="checkbox">
                        <span class="viajar viajar-3">Disponibilidad para viajar</span>
                    </label>
                </div>
                <!--                c-prima-->
                <div class="c-prima clearfix">
                    <label class="prima clearfix">
                        <input id="c-prima_i" class="prima prima-2" type="checkbox">
                        <span class="prima prima-3">Prima vacacional</span>
                    </label>
                </div>
                <!--                c-vales-->
                <div class="c-vales clearfix">
                    <label class="vales clearfix">
                        <input id="c-vales_i" class="vales vales-2" type="checkbox">
                        <span class="vales vales-3">Vales de despensa</span>
                    </label>
                </div>
                <!--                c-transporte-->
                <div class="c-transporte clearfix">
                    <label class="transporte clearfix">
                        <input id="c-transporte_i" class="transporte transporte-2" type="checkbox">
                        <span class="transporte transporte-3">Transporte</span>
                    </label>
                </div>
            </div>
            <div class="c-boxes-2 clearfix">
                <!--                c-residencia-->
                <div class="c-residencia clearfix">
                    <label class="residencia clearfix">
                        <input id="c-residencia_i" class="residencia residencia-2" type="checkbox">
                        <span class="residencia residencia-3">Cambio de residencia</span>
                    </label>
                </div>
                <!--                c-aginaldo-->
                <div class="c-aginaldo clearfix">
                    <label class="aginaldo clearfix">
                        <input id="c-aguinaldo_i" class="aginaldo aginaldo-2" type="checkbox">
                        <span class="aginaldo aginaldo-3">Aguinaldo</span>
                    </label>
                </div>
                <!--                c-comision-->
                <div class="c-comision clearfix">
                    <label class="comision clearfix">
                        <input id="c-comision_i" class="comision comision-2" type="checkbox">
                        <span class="comision comision-3">Comisión / Bono</span>
                    </label>
                </div>
                <!--                c-seguro-->
                <div class="c-seguro clearfix">
                    <label class="seguro clearfix">
                        <input id="c-seguro_i" class="seguro seguro-2" type="checkbox">
                        <span class="seguro seguro-3">Seguro de gastos médicos</span>
                    </label>
                </div>
            </div>
            <div class="c-boxes-3 clearfix">
                <!--                c-comedor-->
                <div class="c-comedor clearfix">
                    <label class="comedor clearfix">
                        <input id="c-comedor_i" class="comedor comedor-2" type="checkbox">
                        <span class="comedor comedor-3">Comedor</span>
                    </label>
                </div>
                <!--                c-viaticos-->
                <div class="c-viaticos clearfix">
                    <label class="viaticos clearfix">
                        <input id="c-viaticos_i" class="viaticos viaticos-2" type="checkbox">
                        <span class="viaticos viaticos-3">Viáticos</span>
                    </label>
                </div>
                <!--                c-gasolina-->
                <div class="c-gasolina clearfix">
                    <label class="gasolina clearfix">
                        <input id="c-gasolina_i" class="gasolina gasolina-2" type="checkbox">
                        <span class="gasolina gasolina-3">Vales de gasolina</span>
                    </label>
                </div>
                <!--                c-honorarios-->
                <div class="c-honorarios clearfix">
                    <label class="honorarios clearfix">
                        <input id="c-honorarios_i" class="honorarios honorarios-2" type="checkbox">
                        <span class="honorarios honorarios-3">Honorarios</span>
                    </label>
                </div>
            </div>
        </div>
        <div id="error-mensaje" style="display: none;" class="c-errores clearfix">
            <div class="mensaje-error clearfix">
                <p class="errores">Errores:</p>
            </div>
            <span id="titulo" class="err error-titulo error-titulo-1">
            </span>
            <span id="contenido" class="err error-titulo">
            </span>
        </div>
        <div id="titulo_i" class="title-editable c-titulo-vacante clearfix">
            <h1 class="titulo-vacante">Título de la vacante</h1>
        </div>
        <!--  contenido -->
        <div class="c-texto-vacante clearfix">
            <div id="contenido_i" class="body-editable contenido clearfix">
                <p class="texto-vacante">Contenido...</p>
            </div>
        </div>
        <!-- submit button -->
        <a id="form-submit" class="nueva-vacante" href="#">Crear Vacante</a>
    </div>
    <!-- fin formulario -->
</div>
@stop

@section('js-editor')
<script charset="utf-8">

    // create post
    $('body').on('click', '#form-submit', function (e) {
        e.preventDefault();
        $.ajax({
            type    : 'POST',
            dataType: 'json',
            url     : "{{ route('vacante.nueva') }}",
            data    : {
                _token        : "{{ csrf_token() }}",
                puesto        : $("#puesto_i").val().trim(),
                carrera_id    : $("#carrera_id_i").val(),
                titulado_id   : $("#titulado_id_i").val(),
                correo        : $("#correo_i").val().trim(),
                experiencia_id: $("#experiencia_id_i").val(),
                tipo_id       : $("#tipo_id_i").val(),
                area          : $("#area_i").val().trim(),
                software      : $("#software_i").val().trim(),
                oferta        : $("#oferta_i").val().trim(),
                ingles_id     : $("#ingles_id_i").val(),
                titulo        : $("#titulo_i").text().trim(),
                contenido     : $("#contenido_i").html().trim(),
                c_rotar       : $("#c-rotar_i").prop("checked"),
                c_viajar      : $("#c-viajar_i").prop("checked"),
                c_prima       : $("#c-prima_i").prop("checked"),
                c_vales       : $("#c-vales_i").prop("checked"),
                c_transporte  : $("#c-transporte_i").prop("checked"),
                c_residencia  : $("#c-residencia_i").prop("checked"),
                c_aguinaldo   : $("#c-aguinaldo_i").prop("checked"),
                c_comision    : $("#c-comision_i").prop("checked"),
                c_seguro      : $("#c-seguro_i").prop("checked"),
                c_comedor     : $("#c-comedor_i").prop("checked"),
                c_viaticos    : $("#c-viaticos_i").prop("checked"),
                c_gasolina    : $("#c-gasolina_i").prop("checked"),
                c_honorarios  : $("#c-honorarios_i").prop("checked")
            },
            success : function (data) {
                if (data.success === false) {
                    // remove!
                    console.log($("#contenido_i").html().trim());
                    $('.errores').text(data.message);
                    $('#error-mensaje').show();
                    $(".err").map(function (index, el) {
                        $(el).text("");
                    });
                    console.log(data.errors);
                    $.each(data.errors, function (key, value) {
                        $("span#" + key).text(value[0]);
                    });
                }
                else {
                    window.location.href = "{{ route('empresa.inicio') }}";
                }
            },
            error   : function (xhr, textStatus, thrownError) {
                alert('Falló la conexión');
            }
        });
        return false;
    });
</script>
@stop
