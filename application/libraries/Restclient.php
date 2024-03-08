<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Restclient{
    var $API ="";
    function __construct() {
      $this->API="http://localhost/work1/project1/api";
    }
    function get($param = null)
    {
      if($param == null)
      {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $this->API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $buffer = curl_exec($curl_handle);
        return $buffer;
      }else{
        $params = '?';
        foreach ($param as $key => $value) {
         $params .= $key.'='.$value.'&';
       }
       $curl_handle = curl_init();
       curl_setopt($curl_handle, CURLOPT_URL, $this->API.$params);
       curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
       $buffer = curl_exec($curl_handle);
       return $buffer;
     }
   }
   function post($array)
   {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $this->API);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $array);
    $buffer = curl_exec($curl_handle);
    return $buffer;
  }
  function put($array)
  {
   $curl_handle = curl_init();
   curl_setopt($curl_handle, CURLOPT_URL, $this->API);
   curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($array));
   curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
   $buffer = curl_exec($curl_handle);
   return $buffer;
  }

  function delete($id)
  {
   $array = array("item_id" => $id);
   $curl_handle = curl_init();
   curl_setopt($curl_handle, CURLOPT_URL, $this->API);
   curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($array));
   curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
   $buffer = curl_exec($curl_handle);
   return $buffer;
   }
}
