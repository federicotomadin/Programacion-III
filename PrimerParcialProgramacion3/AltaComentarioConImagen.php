<?php

include_once "Usuario.php";



Usuario::AltaComentarioConFoto($_POST['mail'],$_POST['titulo'],$_POST['comentario'],$_FILES['archivo']);







