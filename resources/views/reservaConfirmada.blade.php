<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Confirmación de Reserva en Tapacos Autocinemas</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #666666;
            line-height: 1.6;
        }

        .reservation-details {
            margin-top: 20px;
            border-top: 1px solid #cccccc;
            padding-top: 10px;
        }

        strong {
            color: #333333;
        }

        .contact-info {
            margin-top: 20px;
            text-align: center;
        }

        .contact-info p {
            margin: 0;
        }

        .highlight {
            color: black;
            font-weight: bold;
        }
        .centrado{
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="centrado">
            <h1>Confirmación de Reserva en Tapacos Autocinemas</h1>
            <p>¡Gracias por elegir Tapacos Autocinemas para tu próxima experiencia cinematográfica! Aquí están los detalles de tu reserva:</p>
        </div>

        <div class="reservation-details">
            <p><strong>Nombre:</strong> {{$nombre}} {{$apellidos}}</p>
            <p><strong>Matrícula:</strong> {{$matricula}}</p>
            <p><strong>Ofertas seleccionadas:</strong>
                @if(empty($productos))
                    Ninguna
                @else
                    <ul>
                        @foreach($productos as $producto)
                            <li>{{$producto['nombre']}} - €{{$producto['precio']}}</li>
                        @endforeach
                    </ul>
                @endif
            </p>
            <p><strong>{{ count($asientosSeleccionados) == 1 ? 'Parcela reservada:' : 'Parcelas reservadas:' }}</strong> 
                {{ implode(', ', $asientosSeleccionados) }}
            </p>
        </div>

        <p>Esperamos darte la bienvenida pronto en Tapacos Autocinemas. ¡Disfruta de la película!</p>

        <div class="contact-info">
            <p>Para cualquier consulta, no dudes en ponerte en contacto con nosotros:</p>
            <p class="highlight">Email: tapacosautocinemas@gmail.com</p>
            <p class="highlight">Teléfono: 957 456 789</p>
        </div>
        <br>
        <div class="centrado">
            <img src="{{ $message->embed(public_path('img/logo.png')) }}" alt="Logo de Tapacos Autocinemas" class="logo">
        </div>
    </div>
</body>
</html>
