<?php

namespace App\Helpers;

use App\Models\LangModel;

class AppHelper
{
    public static function instance(){
        return new AppHelper();
    }

    public  function getAllLangs(){
        return LangModel::where('lang_status','=',1)->orderBy('lang_order', 'asc')->get();
    }

    public  function getAllLangsByOrder(){
        return LangModel::orderBy('lang_order', 'asc')->get();
    }

    public  function geraHash($qtd){
        $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;
        $Hash=NULL;
        for($x=1;$x<=$qtd;$x++){
            $Posicao = rand(0,$QuantidadeCaracteres);
            $Hash .= substr($Caracteres,$Posicao,1);
        }
        return $Hash;
    }

    public function renameFile($file){
        $t=time();
        $gethash = $this->geraHash(8);
        $getType = explode(";",$file)[0];
        $getType = explode("/",$getType)[1];
        $fileName = $t.$gethash.'.'.$getType;
        return $fileName;
    }

    public function uploadFile($path,$fileName,$file){
        $filePath = base_path().$path.'/'.$fileName;
        $fileData = substr($file,strpos($file,",") + 1);
        $decodedData = base64_decode($fileData);
		file_put_contents($filePath,$decodedData );
    }

    public function deleteImg($path){
		if (file_exists($path)) {
			unlink($path);
		}
	}

    public function arrange_date_time($date){
        // dump($date);
        preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}/', $date, $date_time);
        preg_match('/\.[0-9]{3}Z/', $date, $time_zon);
        // dump($date_time,$time_zon);
        if ($date_time && $time_zon) { /* 2020-11-02T16:00:00.000Z */
            if($time_zon[0]=='.000Z'){
                $date_time = str_replace('T', ' ', $date_time[0]);
                $date = strtotime( $date_time.' + 8hours');
                $date = date('Y-m-d',$date);
            }
        }
        return $date;
    }

    public function http_request($url, $data = null){
        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_URL, $url);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {  
            curl_setopt($curl, CURLOPT_POST, 1);  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded',
            ]);
        }  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);  
        $output = curl_exec($curl);  
        curl_close($curl);  
        return $output;  
    }

    public function get_clinet_ip(){
        $ips = [];
        if (!empty($_SERVER["HTTP_CLIENT_IP"])){
            array_push($ips,$_SERVER["HTTP_CLIENT_IP"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            array_push($ips,$_SERVER["HTTP_X_FORWARDED_FOR"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_X_FORWARDED"])){
            array_push($ips,$_SERVER["HTTP_X_FORWARDED"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])){
            array_push($ips,$_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_FORWARDED_FOR"])){
            array_push($ips,$_SERVER["HTTP_FORWARDED_FOR"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_FORWARDED"])){
            array_push($ips,$_SERVER["HTTP_FORWARDED"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["REMOTE_ADDR"])){ /*(真實 IP 或是 Proxy IP)*/
            array_push($ips,$_SERVER["REMOTE_ADDR"]);
        }else{
            array_push($ips,'');
        }
        if(!empty($_SERVER["HTTP_VIA"])){ /*(參考經過的 Proxy)*/
            array_push($ips,$_SERVER["HTTP_VIA"]);
        }else{
            array_push($ips,'');
        }
        $ip = join('/', $ips);
        return $ip;
    }
}