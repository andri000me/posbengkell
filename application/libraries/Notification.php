<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Notification{
    protected $_ci;
     function __construct(){
        $this->_ci =&get_instance();
    }

    public function Push($to, $title, $message, $type, $data){
        
        $registrationIds = $to;
        // prep the bundle
        $msg = array
        (
            "title" => $title,
            "message"  => $message,
            "body"   => $message,
            "type"  => $type,
            "data" => $data
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'          => $msg,
            'notification'  => $msg,
            'apns'          => array('headers' => array('apns-expiration' => '1604750400')),
            'android'       => array('ttl' => '4500s'),
            'webpush'       => array('headers' => array('TTL' => '4500')),
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        // echo $result;
    }
}