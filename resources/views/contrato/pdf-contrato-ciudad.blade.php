<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('src/pdf/contrato.css') }}">
    <title>Contrato</title>
</head>

<body>
    <div class="main-pdf">
        <div class=header-title>
            <h1>
                CONTRATO PRIVADO DE COMPROMISO DE CONSTRUCCIÓN DE INMUEBLE URBANO Y RECONOCIMIENTO DE DEUDA
            </h1>
        </div>

        <p class="text-parrafo">
            Conste por el presente documento privado que adquirirá fuerza y valor de instrumento público a solo
            reconocimiento de firmas, de conformidad al Art. 1.297 del Código Civil, constituyéndose ley entre partes al
            tenor del Artículo 519 del mismo cuerpo legal, que de común acuerdo y plena capacidad entre la partes
            intervinientes se ha convenido este contrato, sujeto al tenor de las cláusulas siguientes:
        </p>

        <p class="text-parrafo">
            <span class="text-bold">PRIMERA: (DE LAS PARTES).-</span> Intervienen en la celebración del presente
            contrato, las siguientes partes:
        </p>

        <p class="text-parrafo">
            <span class="text-bold">1.1. MIGUEL ANGEL GUZMAN CABRERA,</span> mayor de edad, hábil por ley, casado,
            portador de la cédula de identidad N° 4709987 SC domiciliado en esta ciudad, que pasa a ser parte integrante
            del presente documento privado y que en adelante denominará <span class="text-bold">“EL ACREEDOR”.</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold">
                1.2. {{ strtoupper($contrato->nombres) }}&nbsp;
                {{ strtoupper($contrato->apellido_paterno) }}&nbsp;
                {{ strtoupper($contrato->apellido_materno) }},
            </span>&nbsp;portador de la cédula de identidad para
            N° {{ $contrato->ci }}&nbsp;{{ $contrato->ci_expedido }}, mayor de edad, hábil por ley, domiciliada en
            esta ciudad, quien en adelante para efecto del presente documento se lo denominará,
            <span class="text-bold">“EL DEUDOR”.</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> SEGUNDA: (DERECHO PROPIETARIO).-</span> EL ACREEDOR, declara ser aportante de la
            construcción de un inmueble
            identificado legalmente en el lote {{ $contrato->n_lote }}, en la U.V. {{ $contrato->n_uv }},
            zona {{ $contrato->zona }},
            Barrio {{ $contrato->barrio }}, calle {{ $contrato->calle }} con una superficie de terreno
            de {{ $contrato->superficie_terreno }} m<sup>2</sup>, Distrito {{ $contrato->numero_distrito }}, que a la
            fecha se encuentra registrado en Derechos
            Reales bajo la Matrícula Computarizada N° {{ $contrato->numero_identificacion_terreno }}.
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> TERCERA: (COLINDANCIAS).- </span> El inmueble identificado legalmente con el N°
            {{ $contrato->numero_identificacion_terreno }},
            objeto del presente contrato, tiene las siguientes colindancias:
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> Al Norte </span> mide {{ $contrato->norte_medida_terreno }} metros y colinda con
            lote {{ $contrato->norte_colinda_lote }}.
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> Al Sur </span> mide {{ $contrato->sur_medida_terreno }} metros y colinda con lote
            {{ $contrato->sur_colinda_lote }}.
        </p>

        <p class="text-parrafo">
            <span class="text-bold">Al Este </span> mide {{ $contrato->este_medida_terreno }} metros y colinda con lote
            {{ $contrato->este_colinda_lote }}.
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> Al Oeste </span> mide {{ $contrato->oeste_medida_terreno }} metros y colinda con
            lote {{ $contrato->oeste_colinda_lote }}.
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> CUARTA: (COMPROMISO DE CONSTRUCCIÓN DE INMUEBLE URBANO Y RECONOCIMIENTO DE DEUDA).-
                EL PROMITENTE ACREEDOR</span> se
            compromete a construir el inmueble signado legalmente con el N°
            {{ $contrato->numero_identificacion_terreno }}, señalado
            en las cláusulas segunda y tercera del presente documento, por el valor de la suma de
            {{ $contrato->valor_monto_total_construccion_literal }} Dólares Americanos
            ($us. {{ $contrato->monto_total_construccion }}.-).
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> El presente COMPROMISO DE CONSTRUCCIÓN DE INMUEBLE URBANO </span> por parte del
            <span class="text-bold">ACREEDOR,</span> se convierte automáticamente
            en un <span class="text-bold">RECONOCIMIENTO DE DEUDA</span> en favor del <span
                class="text-bold">ACREEDOR</span> por parte del <span class="text-bold">DEUDOR.</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> QUINTA: (PRECIO Y FORMA DE PAGO).- </span>El precio libremente convenido por la
            presente construcción, es de {{ $contrato->valor_monto_total_construccion_literal }} Dólares Americanos
            ($us. {{ $contrato->monto_total_construccion }}.-).
        </p>

        <p class="text-parrafo">
            Para el caso de que <span class="text-bold">EL DEUDOR</span> cancelaré el precio establecido en moneda
            nacional, deberá hacerlo al tipo de cambio comprador del día en el que se efectivicen los pagos.
        </p>

        <p class="text-parrafo">
            <span class="text-bold">EL DEUDOR</span> al aceptar el presente Reconocimiento de Deuda, tal como se
            estipula en este contrato, se obliga y compromete a pagar el precio convenido, en las condiciones
            siguientes:
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> 5.1. La modalidad de pago, es la siguiente:</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> 5.1.1. </span> A la suscripción del presente documento,
            <span class="text-bold"> EL DEUDOR</span> abona la suma de
            ($us. {{ $contrato->couta_inicial }})&nbsp;{{ $contrato->valor_couta_inicial_literal }} Dólares
            Americanos a cuenta del precio de la construcción
            con recursos propios en calidad de <span class="text-bold">“ARRAS”.</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> 5.1.2. </span> El saldo del precio pactado, que corresponde a
            {{ $contrato->valor_couta_mensual_literal }} Dólares Americanos ($us. {{ $contrato->couta_mensual }})
            será cancelado en forma mensual en fecha 15 de cada mes, durante un periodo
            {{ $contrato->cantidad_couta_mensual }} meses, completando con estos pagos el precio
            de total de la construcción incluyendo interes.
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> SEXTA: (DESISTIMIENTO UNILATERAL).-</span> Para el caso de que <span
                class="text-bold">EL DEUDOR</span> incumpliera con la obligación de cancelar el
            saldo de precio dentro del plazo estipulado en el presente contrato o incumpliera con cualquiera de
            los pagos previsto en la Cláusula Quinta, <span class="text-bold">EL ACREEDOR</span> podrá
            <span class="text-bold">UNILATERALMENTE</span> declarar resuelto el presente contrato
            (Art.569 del Código Civil), sin necesidad de intimación o requerimiento judicial o extrajudicial, ni
            de otro acto, formalidad o requisito, situación que dará derecho al <span class="text-bold">ACREEDOR</span>
            a retener el pago efectuado en calidad de
            <span class="text-bold"> ARRAS</span> por <span class="text-bold">EL DEUDOR,</span> es decir, la suma de
            $us. {{ $contrato->couta_inicial }} ({{ $contrato->valor_couta_inicial_literal }} Dólares Americanos).
            Dicha retención se establece enconsideración y como resarcimiento a los daños y perjuicios que el
            incumplimiento de
            <span class="text-bold"> EL DEUDOR </span> le ha originado al <span class="text-bold">ACREEDOR.</span>
        </p>

        <p class="text-parrafo">
            <span class="text-bold"> SEPTIMA: (ENTREGA DEL INMUEBLE).-</span> En la oportunidad de la entrega del
            inmueble, <span class="text-bold"> EL DEUDOR </span> debe tener cumplido en
            su totalidad los pagos con recursos propios, con el derecho legítimo que le asiste al
            <span class="text-bold">EL ACREEDOR</span> bajo ninguna
            circunstancia, ni excepciones solicitadas, se efectuará la entrega del inmueble, materia del presente
            contrato.
        </p>

        <p class="text-parrafo">
            <span class="text-bold">OCTAVA: (ACEPTACIÓN Y CONFORMIDAD).- Nosotros: MIGUEL ANGEL GUZMAN CABRERA
                como ACREEDOR </span> por una parte y por la otra
            <span class="text-bold">
                {{ strtoupper($contrato->nombres) }}&nbsp;{{ strtoupper($contrato->apellido_paterno) }}
                {{ strtoupper($contrato->apellido_materno) }},</span> como <span class="text-bold">EL DEUDOR </span>
            aceptamos el
            presente contrato en todas y cada una de sus partes, declarando estar conformes y debidamente enterados
            de su redacción, obligándonos a su fiel y estricto cumplimiento, firmándolo en constancia en un original
            y dos copias de un mismo tenor y para un solo efecto.
        </p>

        <p class="text-parrafo-center">
            @php
                use Carbon\Carbon;
                $carbon = Carbon::parse($contrato->fecha_firma_contrato)->locale('es');
                $carbon->settings(['formatFunction' => 'translatedFormat']);
            @endphp
            {{ $contrato->lugar_firma_contrato }} - {{ $carbon->format('d \\d\\e F \\d\\e Y') }}
        </p>

        <div class="footer-page">
            <table>
                <tr>
                    <td>
                        <span
                            class="as-full text-bold">.........................................................................................</span>
                        <span class="as-full text-bold">MIGUEL ANGEL GUZMAN CABRERA</span>
                        <span class="as-full text-bold">EL ACREEDOR</span>
                    </td>
                    <td>
                        <span
                            class="as-full text-bold">.........................................................................................</span>
                        <span class="as-full text-bold">
                            {{ strtoupper($contrato->nombres) }}
                            {{ strtoupper($contrato->apellido_paterno) }}
                            {{ strtoupper($contrato->apellido_materno) }}
                        </span>
                        <span class="as-full text-bold">EL DEUDOR</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
