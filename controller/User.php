<?php 

require_once(__DIR__.'/../core/Base_Controller.php');

class User extends Base_Controller{

//http://localhost/RewardGateway/index.php/User/getAll/
function getAll_get(){
    $response = "";
    $url = "https://hiring.rewardgateway.net/list";
    $auth = base64_encode("hard:hard");
    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Basic $auth"
        ]
    ]);
    try{
        $page = self::file_contents($url,false,$context);
        $response = json_decode($page);
    }catch (Exception $e) {
        echo "Error: " , $e->getMessage();
    }
	$this->load_view('home', array('result'=>$response));
}

function file_contents($path,$uip,$context) {
        $str = @file_get_contents($path,$uip,$context);
        if ($str === FALSE) {
            throw new Exception("Cannot access '$path' to read contents.");
        } else {
            return $str;
        }
}

}

?>