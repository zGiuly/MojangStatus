<?php
/** Status Class*/

class MojangStatus
{
    private $curl;
    /** Constructor */
    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, [
           CURLOPT_URL => "https://status.mojang.com/check",
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_FORBID_REUSE => true
        ]);
    }
    /** Curl request */
    private function curl_request() {
        return curl_exec($this->curl);
    }
    /** @inheritdoc Get status */
    public function getStatus($type){
        $r = json_decode(self::curl_request(), true);
        switch ($type){
            case 'session':
                return $r[1]['session.minecraft.net'];
                break;
            case 'minecraft':
                return $r[0]['minecraft.net'];
                break;
            case 'api':
                return $r[5]['api.mojang.com'];
                break;
            case 'authserv':
                return $r[3]['authserver.mojang.com'];
                break;
            case 'account':
                return $r[2]['account.mojang.com'];
                break;
            default:
                return null;
                break;
        }
    }
    public function getAll($json = false) {
        $r = json_decode(self::curl_request(), true);
        $session = $r[1]['session.minecraft.net'];
        $minecraft = $r[0]['minecraft.net'];
        $api = $r[5]['api.mojang.com'];
        $authserv = $r[3]['authserver.mojang.com'];
        $account = $r[2]['account.mojang.com'];
        if(!$json) {
            return "Session: " . $session . " Minecraft: " . $minecraft . " Api: " . $api . " AuthServ: " . $authserv . " Account: " . $account;
        }else{
            return ["Session" => $session, "Minecraft" => $minecraft, "Api" => $api, "AuthServ" => $authserv, "Account" => $account];
        }
    }
}