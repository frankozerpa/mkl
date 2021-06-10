<?php

namespace Marketplace\Mirakl;

class Connector
{
    public $url;
    public $params=[];
    public $headers=[];

    function __construct($url,$params,$headers) 
    {
        $this->url= $url;
        $this->params= $params;
        $this->headers= $headers;
    }
    public function getRequest()
    {
        $params     = $this->params;
        $headers    = $this->headers;
        $url        = $this->url;

        //datos a enviar
        $data = $params;
        //url contra la que atacamos
        $ch = curl_init($url);
        //a true, obtendremos una respuesta de la url, en otro caso, 
        //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //enviamos el array data
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        //incluir encabezado
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema
        curl_close($ch);
        if(!$response) {
            return false;
        }else{
            return $response;
        }
    }

}
