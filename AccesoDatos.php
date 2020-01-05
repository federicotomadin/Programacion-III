<?php
class AccesoDatos
{
    private static $_objetoAccesoDatos;
    private $_objetoPDO;
 
    private function __construct()
    {
        $username = 'ottos_25007339';
        $servername= 'sql208.tonohost.com';
        $database= 'ottos_25007339_restaurante';
        $password= 'fede1299';
        try {     
       
           $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=ottos_25007339_restaurante; charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

           
         /*  $this->_objetoPDO = new PDO("mysql:host=localhost;dbname=ottos_25007339_restaurante", $username ,$password);

            $this->_objetoPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_objetoPDO->exec("SET CHARACTER SET utf8");*/
 
        } catch (PDOException $e) {
 
            print "Error!!!<br/>" . $e->getMessage();
 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    {
        return $this->_objetoPDO->prepare($sql);
    }

 
    public static function DameUnObjetoAcceso()//singleton
    {
        if (!isset(self::$_objetoAccesoDatos)) {       
            self::$_objetoAccesoDatos = new AccesoDatos(); 
        }
 
        return self::$_objetoAccesoDatos;        
    }
 
    // Evita que el objeto se pueda clonar
    public function __clone()
    {
        trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
    }
}
?>