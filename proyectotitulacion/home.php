<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();

    include("conexion.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <title>Proyecto de titulación</title>
</head>
<body>
    <div>
        <?php include('Menu_principal.php'); ?>
    </div>
    
    <section class="body">
        <br><br><br><br>
        
        <div class="wrapper-container">
            <div class="placa">
                <div class="header2">
                    <div class="nombre-sis">
                        TIENDA DE COMPONENTES PARA COMPUTADORAS 
                        <i class='bx bx-desktop' style="margin-left: 5px;"></i>
                    </div>
                </div>

            </div>
            <div class="form-divider">
                <div class="formulario">
                    <div class="form-header">
                        <div class="title" style="font-size: 26.5px;">
                            <!-- <i class='bx bxs-right-arrow-square' ></i> -->
                            <i class='bx bxs-user-detail'></i>
                            Integrantes del equipo:
                        </div>
                        <div class="description" style="font-size: 20.5px;">
                            San Miguel Jimenez Yareth
                        </div>
                        <div class="description" style="font-size: 20.5px;">
                            Téllez Hernández Daniel
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</body>
</html>