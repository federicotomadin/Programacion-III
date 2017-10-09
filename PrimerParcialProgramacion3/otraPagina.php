
<?PHP

include_once "Usuario.php";

Usuario::ModificarUsuario($_POST["nombre"],$_POST["mail"],$_POST["edad"],$_POST["perfil"],$_POST["clave"]);


?>