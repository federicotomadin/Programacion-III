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
        $password= 'o=w1QivNmg$OMW_q';

        // $username = 'id12137946_b79b71c21d6cb4';
        // $servername= 'localhost';
        // $database= 'id12137946_u663828753_resta';
        // $password= '9CbL!t|4{PsFWG7I';

       

        try {     
       
          $this->_objetoPDO = new PDO('mysql:host=localhost;dbname=u663828753_resta; charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //   $this->_objetoPDO = new PDO("mysql:host=localhost;dbname=id12137946_u663828753_resta",
        //   $this->_objetoPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     
        //    $username ,$password);

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