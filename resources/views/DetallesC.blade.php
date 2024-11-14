<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Candidato</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }
        .container {
            display: flex;
            height: 100vh;
            position: relative;
        }
        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: black;
        }
        .sidebar h2 {
            margin: 0 0 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
        }
        .sidebar button {
            width: 80%; /* Ancho del botón */
            margin: 10px 0; /* Separación vertical entre botones */
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            cursor: pointer;
            transition: background 0.3s; /* Efecto de transición al cambiar el color */
        }
        .sidebar button:hover {
            background: #0056b3;
        }
        .sidebar form button {
            width: 80%;
            margin-top: 10px 0;
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }
        .sidebar form button:hover {
            background: #c82333;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            font-size: 18px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .candidato-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
        .details-list {
            list-style-type: none;
            padding: 0;
        }
        .details-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center; /* Alinea verticalmente los elementos */
        }
        .details-list li span {
            font-weight: bold;
            margin-right: 10px; /* Espacio entre llave y la línea divisoria */
        }
        .details-list li .divider {
            height: 20px;
            width: 1px;
            background-color: #ddd;
            margin: 0 10px; /* Espacio alrededor de la línea divisoria */
        }

        /* Estilo para el botón de imprimir contrato */
        .print-button-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }
        .print-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
            <div class="button-container">
                <button type="button" onclick="location.href='/usuarios'">Usuarios</button>
                <button type="button" onclick="location.href='/candidatos'">Candidatos</button>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logout-button">Cerrar sesión</button>
            </form>
        </aside>

        <!-- Botón de Imprimir contrato -->
        @if($candidato->status === 'completo')
<div class="print-button-container">
    <a href="{{ route('impresion.enviar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
        <button id="imprimir-contrato" class="print-button">Imprimir contrato</button>
    </a>
</div>
@endif

        <!-- Contenido principal -->
        <main class="main-content">
            <h1>Detalle del Candidato</h1>
            <div class="candidato-details">
                <ul class="details-list">
                    <!-- Línea divisoria antes de la llave -->
                    <li><div class="divider"></div><span>Nombre:</span> {{ $candidato->nombre }}</li>
                    <li><div class="divider"></div><span>Apellido Paterno:</span> {{ $candidato->apellido_paterno }}</li>
                    <li><div class="divider"></div><span>Apellido Materno:</span> {{ $candidato->apellido_materno }}</li>
                    <li><div class="divider"></div><span>RFC:</span> {{ $candidato->rfc ?? ' ' }}</li>
                    <li><div class="divider"></div><span>CURP:</span> {{ $candidato->curp ?? ' ' }}</li>
                    <li><div class="divider"></div><span>NSS:</span> {{ $candidato->nss ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Dirección 1:</span> {{ $candidato->direccion1 ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Dirección 2:</span> {{ $candidato->direccion2 ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Estado:</span> {{ $candidato->estado ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Ciudad:</span> {{ $candidato->ciudad ?? ' ' }}</li>
                    <li><div class="divider"></div><span>CP:</span> {{ $candidato->cp ?? ' ' }}</li>
                    <li><div class="divider"></div><span>País:</span> {{ $candidato->pais ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Puesto:</span> {{ $candidato->puesto ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Salario Diario:</span> {{ $candidato->salario_diario ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Fecha de Ingreso:</span> {{ $candidato->fecha_ingreso ?? ' ' }}</li>
                    <li><div class="divider"></div><span>Correo Electrónico:</span> {{ $candidato->correo_electronico ?? ' ' }}</li>
                    <!-- No mostramos el campo 'status', pero lo validamos -->
                </ul>
            </div>
        </main>
    </div>
</body>
</html>
