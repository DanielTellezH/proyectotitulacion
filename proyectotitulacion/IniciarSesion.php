<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("login.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <title>Inicio de sesión</title>

    <style>
        body{
            background: radial-gradient(circle at 50% -20.71%, #a6ffa7 0, #90ffab 12.5%, #76ffb0 25%, 
            #54ffb5 37.5%, #08ffbb 50%, #00fbc2 62.5%, #00f8ca 75%, #00f4d3 87.5%, #00f1dc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 98vh; 
            flex-direction:column;
        }

        *{
            font-family: 'Lato', sans-serif;
            font-family: 'Open Sans', sans-serif;
            font-family: 'TP Sans', sans-serif;
            box-sizing: border-box;
        }
        form{

            width: 600px;
            padding: 6rem;
            background-color: #48bad5;
            border: 2px solid #318599;
            border-radius: 20px;
            color: aliceblue;
        }
        h1{
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid #318599;
            width: 95%;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
        }
        h2{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 95%;
            padding: 10px;
            margin: 10px;
        }
        label{
            color: aliceblue;
            font-size: 18px;
            padding: 10px;
            font-weight: 300;
        }
        input{
            display: block;
            border: 2px solid #318599;
            width: 95%;
            padding: 10px; 
            margin: 10px;
            border-radius: 10px;
        }
        button{
            float: right;
            background-color: #00f1dc;
            color: #254148;
            padding: 10px;
            font-weight: 300;
            border: 2px solid #318599;
            width: 40%;
            border-radius: 5px;
            margin-right:10px;
        }
        button:hover{
            background-color: white;
            color: #318599;
        }
        a{
            float: left;
            margin-left: 10px;
            padding: .5rem;
            text-decoration: none;
        }
        a:hover{
            color: white;
        }
        .error{
            background-color: rgb(175,74,74);
            color: black;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin: 20px auto;
        }
    </style>

</head>
<body>
    <form method="GET">
        <h1>INICIO DE SESIÓN 
        </h1>
        <h2>(INSEGURO)</h2>
        <hr>

        <?php
            if(isset($_REQUEST['error'])){
                ?>
                <p class="error">
                    <?php
                        echo $_REQUEST['error']
                    ?>
                </p>
                <hr>
                <?php
            }
        ?>

        <i class="fa-solid fa-user"></i>
        <label>Ingrese su usuario</label>
        <input type="text" name="Usuario" placeholder="Usuario">

        <i class="fa-solid fa-unlock"></i>
        <label>Ingrese su contraseña</label>
        <input type="text" name="Contraseña" placeholder="Contraseña">
        <hr>
        <button type="submit">Iniciar Sesión</button>
        <a href="CrearCuenta.php">Crear Cuenta</a>
    </form>
</body>
</html>
