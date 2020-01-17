<?php
class AccesoDatos
{
    private static $_objetoAccesoDatos;
    private $_objetoPDO;
 
    private function __construct()
    {
        $username = 'b79b71c21d6cb4';
        $servername= 'mysql.hostinger.com.ar';
        $database= 'u663828753_resta';
        $password= '225fbb00';
        try {     
       
            mysql://b79b71c21d6cb4:225fbb00@us-cdbr-iron-east-05.cleardb.net/heroku_7869f6aa8a7abd0?reconnect=true

          /* $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=u663828753_resta; charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));*/

           $this->_objetoPDO = new PDO("mysql:host=us-cdbr-iron-east-05.cleardb.net;dbname=heroku_7869f6aa8a7abd0", $username ,$password);

            $this->_objetoPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_objetoPDO->exec("SET CHARACTER SET utf8");
 
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