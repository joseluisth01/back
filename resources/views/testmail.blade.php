<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a Tapacos Autocinemas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: black
        }
        .container {
            width: 600px;
            margin: 20px auto;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #37FF8B;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: black;
        }
        .content {
            padding: 20px;
            color: black !important;
        }
        .content p {
            line-height: 1.6;
        }
        .content p.center {
            text-align: center;
        }
        .footer {
            padding: 10px 20px;
            background-color: black;
            text-align: center;
            font-size: 15px;
            color: white !important;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>¡BIENVENIDO A TAPACOS AUTOCINEMAS!</h1>
        </div>
        <div class="content">
            <p class="center" style="font-size:17px"><b>¡Bienvenido {{$nombre}} a la familia de Tapacos Autocinemas!</b></p>
            <p>Nos llena de alegría y emoción tenerte como parte de nuestra comunidad cinéfila al aire libre. En Tapacos Autocinemas, nos esforzamos por ofrecerte una experiencia de entretenimiento única, donde el cine y la comodidad se fusionan para crear momentos inolvidables.</p>
            <p>Nuestro equipo está aquí para asegurarse de que cada visita a Tapacos Autocinemas sea una experiencia memorable y divertida. Desde los clásicos del cine hasta los estrenos más esperados, cada proyección está llena de magia y dedicación hacia el séptimo arte.</p>
            <p>Como nuevo miembro de Tapacos Autocinemas, tendrás acceso a ofertas exclusivas, eventos especiales y sorpresas que harán de cada noche de cine una experiencia especial.</p>
            <p>No podemos esperar para recibirte en nuestro autocine y compartir contigo la verdadera esencia del cine al aire libre.</p>
            <p>Una vez más, ¡bienvenido a Tapacos Autocinemas!</p>
            <p>¡Saludos cinéfilos!</p>
        </div>
        <div class="footer">
            &copy; 2024 Tapacos Autocinemas. Todos los derechos reservados.
        </div>
    </div>

</body>
</html>
