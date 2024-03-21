<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="MVC/vista/js/funciones.js"></script>
	<link rel="stylesheet" type="text/css" href="MVC/vista/styles2.css">
    <link rel="shortcut icon" href="MVC/vista/img2/logo.png"> 
	<title>Star Visory</title>
</head>
<body>
	<nav class="menu"> 
        <div class="hamburguesa" onclick="mostrar()">
            <span></span><span></span><span></span>
        </div>
        
	    <label class="logo">Star Visory</label>
	    <ul id="menu-desplegable">
            <li><span class="cerrar" onclick="ocultar()">X</span></li>
		    <li><a href="index.html">Inicio</a></li>
		    <li><a href="Deportes.html">Visorías</a></li>
		    <li><a href="quienessomos.html">Acerca De</a></li>
		    <li><a href="usuarios.php">Usuarios</a></li>
		    <li><a href="Login.php">Inicio Sesión</a></li>
	    </ul>
    </nav>
	
    <header>
        <h1></h1>
    </header>
        
    <div class="wrapper">
        <div class="form-box login">
            <h2>Iniciar Sesión</h2>
            <form action="MVC/modelo/login_usuario.php" method="POST">
                <div class="input-box">
                   <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                   <input id="email" type="email" name="email" required>
                   <label>Email</label>
                </div>
                <div class="input-box">
                   <span class="icon"><ion-icon name="key-outline"></ion-icon></span>
                   <input id="contraseña" type="password" name="contrasena" required>
                   <label>Contraseña</label>
                </div>
                <button type="submit" class="btnInicioS">Ingresar</button>
                <div class="login-register">
                    <p>¿No tienes una cuenta? <a href="Registro.php" class="register-link">Registráte!</a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>
</html>
