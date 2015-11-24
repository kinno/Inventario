<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Sistema de Inventario y Ventas - Unidad Rosal</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--<link href="css/bootstrap-theme.min.css" rel="stylesheet">-->
        <link href="css/lavish-bootstrap.css" rel="stylesheet">
        <link href="css/estilos.css" rel="stylesheet">
        <script src="js/jquery-1.11.3.js"></script>
        <script src="js/bootbox.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/funcionesMain.js"></script>
    </head>
    <body>
        
        <div id="wrapper">
<!--            <nav class="navbar navbar-default">                
            </nav>-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2 sidebar">
                        <ul class="nav nav-pills nav-stacked" id="navBar">
                            <li role="presentation" class="active" onclick="cambiaMenu(this, 1)"><a href="#">Inicio</a></li>
                            <li role="presentation" onclick="cambiaMenu(this, 2)"><a href="#">Producto</a></li>
                            <li role="presentation" onclick="cambiaMenu(this, 5)"><a href="#">Promociones</a></li>
                            <li role="presentation" onclick="cambiaMenu(this, 6)"><a href="#">Clientes</a></li>
                            <li role="presentation" onclick="cambiaMenu(this, 7)"><a href="#">Ventas</a></li>
                        </ul>
                        <!--                        <ul class="nav nav-pills nav-stacked navFooter">
                                                    <li><a href="https://www.marykayintouch.com.mx/Login/Login.aspx?ReturnURL=%2f/Page.aspx?PageID=13416" target="_blank"><img title="En Contacto" style="width:100%" src="images/logoMkWeb.png"/></a></li>
                                                </ul>-->
                        <div class="col-sm-2 navFooter">
                            <a href="https://www.marykayintouch.com.mx/Login/Login.aspx?ReturnURL=%2f/Page.aspx?PageID=13416" target="_blank"><img title="En Contacto" style="width:75%" src="images/logoMkWeb.png"/></a>
                        </div>    
                    </div>
                    <div class="col-md-offset-2 col-md-10 main" id="mainContainer">
                       
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
