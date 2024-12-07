<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .etiqueta {
            border: 2px solid black;
            padding: 10px;
            width: 300px;
            font-family: Arial, sans-serif;
        }

        .etiqueta .titulo {
            font-weight: bold;
            text-align: center;
        }

        .etiqueta .fila {
            display: flex;
            justify-content: space-between;
        }

        .etiqueta .fila div {
            width: 45%;
        }

        .etiqueta2 {
            border: 2px solid black;
            padding: 10px;
            width: 300px;
            font-family: Arial, sans-serif;
        }

        .etiqueta2 .titulo {
            font-weight: bold;
            text-align: center;
        }

        .etiqueta2 .fila {
            display: flex;
            justify-content: space-between;
        }

        .etiqueta2 .fila div {
            width: 45%;
        }

        .etiqueta,
        .etiqueta2 {
            display: inline-block;
            vertical-align: top;
            margin-right: 10px;
            /* Espacio entre las dos etiquetas */
        }


        .fila-bold div {
            font-weight: bold;
        }
    </style>
    <title>Etiqueta del Vehículo</title>
</head>

<body>
    <div class="etiqueta">
        <div class="fila fila-bold">
            <div>PATENTE</div>
            <div>N° CHASIS</div>
            <div>GRUPO</div>
        </div>
        <div class="fila">
            <div>{{ $placa }}</div>
            <div>{{ $chasis }}</div>
            <div>{{ $grupo }}</div>
        </div>
        <div class="fila fila-bold">
            <div>MODELO</div>
            <div>SUCURSAL</div>
        </div>

        <div class="fila">
            <div>{{ $modelo }}</div>
            <div>{{ $sucursal }}</div>
        </div>
        <div class="fila fila-bold">
            <div>COLOR</div>
            <div>COMBUSTIBLE</div>
        </div>
        <div class="fila">
            <div>{{ $color }}</div>
            <div>{{ $tipo_combustible }}</div>
        </div>
    </div>
    <div class="etiqueta2">
        <div class="fila">
            <div>
                <img src="{{ asset('assets/logo.jpg') }}" alt="Descripción de la imagen"
                    style="width: 300px; height: 69px;" />
            </div>
        </div>
        <div class="fila">
            <div style="text-align:center; font-weight: bold;">Numeros Telefonicos </div>
            <div style="text-align:center;">064 221 6767 - 064 222 1910 </div>
        </div>
    </div>
</body>

</html>
