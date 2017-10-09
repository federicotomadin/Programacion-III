<?php

class Cliente
{
    public $_nombre;

    public $_mail;

    public $_clave;

    public $_sexo;

    public function GetNombre()
    {
        return $this->_nombre;
    }
    
    public function GetMail()
    {
        return $this->_mail;
    }
    
    public function GetClave()
    {
        return $this->_clave;
    }
    
    public function GetSexo()
    {
        return $this->_sexo;
    }

    public function SetNombre($nombre)
    {
        $this->_nombre = $nombre;
    }
    public function SetCorreo($mail)
    {
        $this->_mail = $mail;
    }
    public function SetEdad($clave)
    {
        $this->_clave = $clave;
    }
    public function SetClave($sexo)
    {
        $this->_sexo = $sexo;
    }

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
               
        $archivo = fopen('Clientes/ClientesActuales.txt',"w");        
        
        fwrite($archivo,$cliente->ToString()."\r\n"); 
        fwrite($archivo,$hora);      
        fclose($archivo);
    }


    public function ToString()
    {
        return $this->_nombre."-".$this->_mail."-".$this->_clave."-".$this->_sexo;    
    }

        
    public static function Validar($nombre,$clave)
    {

        $archivo=fopen("clientes/ClientesActuales.txt", "r");
	    $bandera=false;
        $miarray = array();
        $acumulador = 0;

		while(!feof($archivo))
		{
            if(($lector = fgets($archivo)) != false)
             {
               
            $miarray = explode("-",$lector);
          
       
        
              if($miarray[0] == $nombre && $miarray[2] == $clave)
              {
               
               $bandera=true;
            
              }
           
             }
			
		   
        }
		fclose($archivo);
        return $bandera;
        
    }
       

    
       /* $archivo = fopen('clientes/ClientesActuales.txt',"r");   
    
        # return 'Nombre'.$this->_nombre.' Mail: '.$this->_mail.' Clave: '.$this->_clave.' Sexo '.$this->_sexo;  
            
        while(!feof($archivo))
        { 
            $miArray=array();


            $aux = fgets($archivo);
            $miArray = explode(" - ",$aux);
           
            var_dump($cliente->_nombre);
            if($miArray[0] === $cliente->_nombre && $miArray[3] === $cliente->_clave )
            {
                echo 'Cliente Logueado';
                break;
            }
          
               
            
        
                echo "la concha de la lora";
                        
        }
        fclose($archivo); */

    

}

