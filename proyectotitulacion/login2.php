<?php
    // Sanitización en el login

    // Conexión con la base
    include("conexion.php");
    $conn = OpenCon();

    // Validación para determinar si las entradas de texto son diferentes de Null
    if (isset($_POST['Usuario']) && isset($_POST['Contraseña'])) {
        // Se guardan en variables los datos recibidos por el formulario 
        // Escapa los caracteres especiales de una cadena para usarla en una sentencia SQL
        $username = mysqli_real_escape_string($conn, $_POST['Usuario']);
        $password = mysqli_real_escape_string($conn, $_POST['Contraseña']);

        // Validación para saber si el usuario o la contraseña se encuenrtan vacíos
        if(empty($username)){
            header("Location: IniciarSesion2.php?error=El USUARIO es requerido");
            exit();
        }elseif(empty($password)){
            header("Location: IniciarSesion2.php?error=La CONTRASEÑA es requerida");
            exit();
        }else{
            // Consulta SQL utilizando prepared statements
            $stmt = $conn->prepare("SELECT * FROM usuarios2 WHERE usuario = ? AND contrasenia = ?");
            $stmt->bind_param("ss", htmlspecialchars($username,ENT_QUOTES,'UTF-8'), htmlspecialchars($password,ENT_QUOTES,'UTF-8'));
            $stmt->execute();
            $rst = $stmt->get_result();
             
            if ($rst->num_rows === 1) {
                $row = mysqli_fetch_assoc($rst);
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['usuario_id'] = $row['usuario_id'];
                $_SESSION['tipo_usr_id'] = $row['tipo_usr_id'];
                $_SESSION['usuario'] = htmlspecialchars($row['usuario']);
                $_SESSION['nombre_completo'] = htmlspecialchars($row['nombre_usuario'] . $row['apellido_pat'] . $row['apellido_mat']);
                $_SESSION['correo'] = htmlspecialchars($row['correo']);

                $usrTipo = $_SESSION['tipo_usr_id'];
                header("Location: home.php");
                exit();
            } else {
                // Error en el inicio de sesión
                header("Location: IniciarSesion2.php?error=El USUARIO o la CONTRASEÑA son incorrectas");
                exit();
            }
        }
    } 

    $conn->close();
?>
