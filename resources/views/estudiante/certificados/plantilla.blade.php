<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background: #f8fafc;
            text-align: center;
        }

        .certificado {
            border: 12px solid #1e3a8a;
            padding: 50px;
            width: 90%;
            margin: auto;
            position: relative;
        }

        /* BORDE DECORATIVO INTERNO */
        .certificado::before {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px dashed #2563eb;
        }

        .titulo {
            font-size: 45px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .subtitulo {
            font-size: 18px;
            margin-top: 10px;
        }

        .nombre {
            font-size: 35px;
            font-weight: bold;
            margin: 25px 0;
            color: #111827;
        }

        .curso {
            font-size: 22px;
            margin-top: 10px;
        }

        .fecha {
            margin-top: 20px;
            font-size: 16px;
        }

        .codigo {
            position: absolute;
            bottom: 20px;
            left: 40px;
            font-size: 12px;
            color: #555;
        }

        .firma {
            margin-top: 50px;
        }

        .linea-firma {
            width: 200px;
            margin: 0 auto;
            border-top: 1px solid black;
        }

        .firma-texto {
            font-size: 14px;
            margin-top: 5px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 40px;
            width: 80px;
        }
    </style>
</head>
<body>

<div class="certificado">

    <!-- LOGO (opcional) -->
    <!-- <img src="{{ public_path('logo.png') }}" class="logo"> -->

    <div class="titulo">CERTIFICADO</div>

    <div class="subtitulo">
        Se otorga el presente certificado a:
    </div>

    <div class="nombre">
        {{ $nombre }}
    </div>

    <div class="subtitulo">
        Por haber completado satisfactoriamente el curso:
    </div>

    <div class="curso">
        <strong>{{ $curso }}</strong>
    </div>

    <div class="fecha">
        Fecha: {{ $fecha }}
    </div>

    <!-- FIRMA -->
    <div class="firma">
        <div class="linea-firma"></div>
        <div class="firma-texto">Director Académico</div>
    </div>

    <!-- CODIGO -->
    <div class="codigo">
        Código: {{ $codigo }}
    </div>

</div>

</body>
</html>