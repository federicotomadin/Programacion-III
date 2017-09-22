<?php

class Cliente
{
    public $_nombre;

    public $_mail;

    public $_clave;

    public $_sexo;

    public function __construct($nombre,$mail,$clave,$sexo)
    {
        $this->_nombre = $nombre;
        $this->_mail = $mail;
        $this->_clave = $clave;
        $this->_sexo = $sexo;


    }

    public static function Guardar($cliente)
    {              
        $hora = date("   Y-m-d___H-i-s");
               
        $archivo = fopen('Clientes/ClientesActuales.txt',"a");        
        
        fwrite($archivo,$cliente->ToString()); 
        fwrite($archivo,$hora);      
        fclose($archivo);
    }


    public function ToString()
    {
        return 'Nombre '.$this->_nombre.' Mail: '.$this->_mail.' Clave: '.$this->_clave.' Sexo '.$this->_sexo;    
    }

        
    public static function Validar($cliente)
    {
    
        $archivo = fopen('Clientes/ClientesActuales.txt',"a+");   
    
        # return 'Nombre'.$this->_nombre.' Mail: '.$this->_mail.' Clave: '.$this->_clave.' Sexo '.$this->_sexo;  
            
        while(!feof($archivo))
        { 
            $aux = fgets($archivo);
            $mail = explode(" - ",$aux);
           
            if($mail[0] == "")break;

            if($mail[1] == $cliente->_name && $clave[1] == $cliente->_clave )
            {
                echo 'Cliente Logueado';
                break;
            }
                        
        }
        fclose($archivo); 

    }

}

