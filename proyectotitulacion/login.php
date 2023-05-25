<?php
	// Conexión con la base
    include("conexion.php");
    $conn = OpenCon();

	// Validación para determinar si las entradas de texto son diferentes de Null
	if (isset($_POST['Usuario']) && isset($_POST['Contraseña'])) {
		// Se guardan en variables los datos recibidos por el formulario 
		$username = $_POST['Usuario'];
		$password = $_POST['Contraseña'];
		// Validación para saber si el usuario o la contraseña se encuenrtan vacíos
		if(empty($username)){
            header("Location: IniciarSesion.php?error=El USUARIO es requerido");
            exit();
        }elseif(empty($password)){
            header("Location: IniciarSesion.php?error=La CONTRASEÑA es requerida");
            exit();
        }else{
			// Consulta SQL vulnerable a inyección SQL
			$sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contrasenia = '$password'";
			// Mostrar la consulta
			// echo $sql;
			$rst = $conn->query($sql);
			// Mostrar numero de registros encontrados
			// echo "<br><br>".$rst->num_rows;
			if ($rst->num_rows > 0) {
				$row = mysqli_fetch_assoc($rst);
				// Inicio de sesión exitoso
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['usuario_id'] = $row['usuario_id'];
				$_SESSION['tipo_usr_id'] = $row['tipo_usr_id'];
				$_SESSION['usuario'] = $row['usuario'];
				$_SESSION['nombre_completo'] = $row['nombre_usuario'] . $row['apellido_pat'] . $row['apellido_mat'];
				$_SESSION['correo'] = $row['correo'];
				$usrTipo = $_SESSION['tipo_usr_id'];
				// Acceder a la página principal
				header("Location: home.php");
				exit();
			} else {
				// Error en el inicio de sesión
				header("Location: IniciarSesion.php?error=El USUARIO o la CONTRASEÑA son incorrectas");
				exit();
			}
		}
	} 
	$conn->close();
?>