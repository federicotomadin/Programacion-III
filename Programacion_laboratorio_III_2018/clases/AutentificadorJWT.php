<?php
require_once '../vendor/autoload.php';
include_once '../vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

class AutentificadorJWT
{
    private static $claveSecreta = 'ClaveSuperSecreta@';
    private static $tipoEncriptacion = ['HS256'];
    private static $aud = null;
    
    public static function CrearToken($datos)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $ahora = time();

        $payload = array(
        	'iat'=> $ahora,
            'exp' => $ahora + (60*240), //TOKEN VENCE A LAS 4 horas
            'aud' => self::Aud(),
            'data' => $datos,
            'app'=> "RESTAURANTE 2018"
        );
     
        return JWT::encode($payload, self::$claveSecreta);
    }
    
    public static function VerificarToken($token)
    {
       
        if(empty($token)|| $token=="")
        {
            throw new Exception("El token esta vacio.");
        } 
        // las siguientes lineas lanzan una excepcion, de no ser correcto o de haberse terminado el tiempo       
        try {
            $decodificado = JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
            );
        } catch (ExpiredException $e) {
            //var_dump($e);
           throw new Exception("Clave fuera de tiempo");
        }
        
        // si no da error,  verifico los datos de AUD que uso para saber de que lugar viene  
        // if($decodificado->aud !== self::Aud())
        // {
        //     throw new Exception("No es el usuario valido"+$decodificado->aud);
        // }
    }
    
   
     public static function ObtenerPayLoad($token)
    {
        return JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        );
    }
     public static function ObtenerData($token)
    {
        return JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        )->data;
    }
    private static function Aud()
    {
        $aud = '';
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }
        
        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();
        
        return sha1($aud);
    }
}