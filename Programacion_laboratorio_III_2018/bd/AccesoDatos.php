<?php
class AccesoDatos
{
    private static $_objetoAccesoDatos;
    private $_objetoPDO;
 
    private function __construct()
    {
        $username = 'u663828753_admin';
        $servername= 'mysql.hostinger.com.ar';
        $database= 'u663828753_resta';
        $password= 'plSO5GEobXjF';
        try {
           
           // array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            $this->_objetoPDO = new PDO("mysql:host=mysql.hostinger.com.ar;dbname=u663828753_resta", $username ,$password);

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