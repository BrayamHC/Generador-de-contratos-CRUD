<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Candidato</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <link rel="icon" href="{{ asset('logo.ico') }}" type="image/x-icon">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px; /* Ancho de la barra lateral */
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Permitir que los botones se apilen verticalmente */
            justify-content: space-between; /* Separar botones y el de cerrar sesión */
        }
        .sidebar h2 {
            margin: 0 0 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column; /* Colocar botones en columna */
            align-items: center; /* Centrar los botones horizontalmente */
            flex-grow: 1; /* Para que tome el espacio disponible */
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
            background: #0056b3; /* Color al pasar el ratón sobre el botón */
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
            position: relative; /* Asegura que el botón de "Agregar" se posicione en la esquina superior derecha */
            overflow-y: auto; /* Agregar desplazamiento vertical */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto; /* Habilitar desplazamiento horizontal si es necesario */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .acciones {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espaciado entre botones */
            text-align: center; /* Centrar el texto */
        }
        /* Estilo para los botones de acción */
        .view-button, .edit-button, .delete-button {
            width: 90%; /* Asegura que los botones de acción tengan el mismo tamaño */
            padding: 8px;
            font-size: 14px; /* Tamaño de fuente más pequeño */
            border-radius: 25px; /* Bordes redondeados */
            color: white; /* Letra en blanco */
            margin-bottom: 5px;
        }

        .view-button {
            background-color: #007bff; /* Azul para ver */
        }

        .edit-button {
            background-color: #28a745; /* Verde para editar */
        }

        .delete-button {
            background-color: #dc3545; /* Rojo para eliminar */
        }

        .view-button:hover {
            background-color: #0056b3; /* Azul oscuro al pasar el ratón */
        }

        .edit-button:hover {
            background-color: #218838; /* Verde oscuro al pasar el ratón */
        }

        .delete-button:hover {
            background-color: #c82333; /* Rojo oscuro al pasar el ratón */
        }
        .acciones a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .acciones a:hover {
            color: #0056b3;
        }

        /* Estilo para el formulario */
        .form-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 1000px; /* Ampliar el ancho máximo */
    width: 100%; /* Hacerlo flexible */
    margin: 20px auto; /* Centrar el formulario */
}

        .form-container .form-group {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input, .form-container select, .form-container textarea {
            width: 100%;
            padding: 12px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
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

        <!-- Contenido principal -->
        <main class="main-content">
            <h1>Registro de Candidato</h1>

            <div class="form-container">
                <form action="{{ route('candidatos.crear') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" required>
                    </div>
                    <div class="form-group">
                        <label for="rfc">RFC:</label>
                        <input type="text" id="rfc" name="rfc">
                    </div>
                    <div class="form-group">
                        <label for="curp">CURP:</label>
                        <input type="text" id="curp" name="curp">
                    </div>
                    <div class="form-group">
                        <label for="nss">NSS:</label>
                        <input type="number" id="nss" name="nss">
                    </div>
                    <div class="form-group">
                        <label for="direccion1">Dirección 1:</label>
                        <input type="text" id="direccion1" name="direccion1">
                    </div>
                    <div class="form-group">
                        <label for="direccion2">Dirección 2:</label>
                        <input type="text" id="direccion2" name="direccion2">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" id="ciudad" name="ciudad">
                    </div>
                    <div class="form-group">
                        <label for="cp">Código Postal:</label>
                        <input type="number" id="cp" name="cp">
                    </div>
                    <div class="form-group">
                        <label for="pais">País:</label>
                        <input type="text" id="pais" name="pais">
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <input type="text" id="puesto" name="puesto">
                    </div>
                    <div class="form-group">
                        <label for="salario_diario">Salario Diario:</label>
                        <input type="number" id="salario_diario" name="salario_diario" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso">
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico:</label>
                        <input type="email" id="correo_electronico" name="correo_electronico">
                    </div>
                    <button type="submit" class="save-button">Guardar</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
