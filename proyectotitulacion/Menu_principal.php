<?php
    // session_start();
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!--------- Data Tables by jQuery ----------->

<link  href="assets/css/dataTable.css" rel="stylesheet">
<script src="assets/js/dataTable.js"></script>

<!---------Menu Style----------->
<link rel="stylesheet" href="assets/css/menu_style.css">

<!---------Remove favico alert----------->
<link rel="shortcut icon" href="#">


<script src="assets/js/menu_config.js"></script>

<section id="Menu">
    <div class="Menu container">
        <div class="nav-bar">
            <div class="nav-list">
                <ul id="menu_list">
                    <li class="li-dr media1200px"><a href="home.php" style="font-size: 20px !important;">PROYECTO DE TITULACIÓN</a></li>
                </ul>
            </div>
            <!----------------------------------------------->
            <!-- Usuario tipo 1 -->
            <?php
                if($_SESSION["tipo_usr_id"] == "TU1"){ ?>
                <div class="nav-list">
                    <ul id="menu_list">
                        <li class="li-dr media1200px"><a href="Usuarios.php">Usuarios 1</a></li>
                        <li class="li-dr media1200px"><a href="Usuarios2.php">Usuarios 2</a></li>
                        <li class="li-dr media1200px"><a href="Tipo_usr.php">Tipos de usuarios</a></li>
                        <li class="li-dr media1200px"><a href="Edo.php">Estados</a></li>
                        <!-- <li class="li-dr media1200px"><a href="Edo2.php">Estados 2</a></li> -->
                        <li class="li-dr media1200px"><a href="Direccion.php">Direcciones</a></li>
                        <li class="li-dr media1200px"><a href="Productos.php">Productos</a></li>
                        <li class="li-dr media1200px" style="border-radius: 5px; background: #6e878d;">
                            <a href="CerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php
            } ?>
            
            <!-- Usuario tipo 2 -->
            <?php
                if($_SESSION["tipo_usr_id"] == "TU2"){ ?>
                <div class="nav-list">
                    <ul id="menu_list">
                        <li class="li-dr media1200px"><a href="Edo.php">Estados</a></li>
                        <li class="li-dr media1200px"><a href="Direccion.php">Direcciones</a></li>
                        <li class="li-dr media1200px"><a href="Productos.php">Productos</a></li>
                        <li class="li-dr media1200px" style="border-radius: 5px; background: #6e878d;">
                            <a href="CerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php
            } ?>

            <!-- Usuario tipo 3 -->
            <?php
                if($_SESSION["tipo_usr_id"] == "TU3"){ ?>
                <div class="nav-list">
                    <ul id="menu_list">
                        <!-- Editar privilegios en el php -->
                        <li class="li-dr media1200px"><a href="Productos.php">Productos</a></li>
                        <li class="li-dr media1200px" style="border-radius: 5px; background: #6e878d;">
                            <a href="CerrarSesion.php" class="btn btn-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php
            } ?>
        </div>
    </div>
</section>

<!-- Menu -->

<div id="data_content"></div>

<!-- Menu -->
<div class="side-bar">
    <div class="menu-list" id="close_side" style="-webkit-tap-highlight-color: transparent;">
        <ion-icon name="close-circle-outline"></ion-icon>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script> <!--Iconos de IONICONS-->
<script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script> <!--Iconos de IONICONS-->
