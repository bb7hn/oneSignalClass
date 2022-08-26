<?php
class oneSignal{
    private $APP_ID     ='';
    private $API_KEY    ='';
    function __construct($appId,$apiKey)
    {
        $this->APP_ID    = $appId;
        $this->API_KEY   = $apiKey;
    }
    public function sendMessage($title,$message,$userIdList){
        $content = array(
            "en"=>"$message",
            );
        
        $fields = array(
            'include_player_ids' => $userIdList,
            'headings' => array("en" => "$title"),
            'contents' => $content,
            /* 'subtitle' =>array("en" => "$title") */
        );
        return $this->curl('notifications',$fields);
        
    }
    private function curl($service='',$fields=[],$type='post'){
        $type = strtoupper($type);
        if($type=='POST'){
            $fields['app_id'] = $this->APP_ID;
            $fields = json_encode($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/$service");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->API_KEY));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
            $response = curl_exec($ch);
            curl_close($ch);
            
            return $response;
        }
        else if($type=='GET'){
            $fields['app_id'] = $this->APP_ID;
            $vars = "";
            foreach($fields as $key=>$field){
                $vars .= "$key=$field&";
            }
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/$service?$vars");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->API_KEY));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
            $response = curl_exec($ch);
            curl_close($ch);
            
            return $response;
        }
    }
    public function viewDevices($offset=0){
        $fields = array(
            "limit"     => 50,
            "offset"    => $offset
        );

        $request = json_decode($this->curl('players',$fields,'get'));
        return (isset($request->players)?$request->players:(object)[]);
    }
    public function viewNotifications($offset=0,$kind=''){
        $fields = array(
            "limit"     => 50,
            "offset"    => $offset
            /* "kind"      => ""
                (not set) is all notification types.
                Dashboard only is 0.
                API only is 1.
                Automated only is 3. 
            */
        );
        if(!empty($kind)){
            $fields['kind'] = $kind;
        }
        
        $request = json_decode($this->curl('notifications',$fields,'get'));
        return (isset($request->notifications)?$request->notifications:(object)[]);
    }
}