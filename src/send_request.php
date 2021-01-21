<?php

interface iVCS{
  public function create_conf(); // создать конференцию - возвращает ссылку на конференцию.
  public static function get_user(); //получить список пользователей TrueConf
  public function scheduled_conference(); //создать запланированную конференцию - возвращает ссылку на конференцию.
  public function conferense_start(); //запустить конференцию - возможность запустить конференцию без входа в нее.
  public function conferense_stop(); //закончить конференцию - возможность закончить конференцию без входа в нее.
  public function conferense_start_record(); // запустить запись конференции.
  public function conferense_pause_record(); //поставить на паузу запись конференции.
  public function conferense_stop_record(); //остановить запись конференции.
  public function generate_iframe_conference(); // сгенерисовать код iframe текущей конференции для вставки на сайт.
}

class VCS implements iVCS{

private $key;
private $variables; // параметры передоваемые POST запросом с фронта.
private $access_token; // ключ доступа к API TrueConf Server.
public $url;
public $duration_conf; // продолжительность конференции в секундах.
public $guest; // false- приватная конференция, true - публичная.
public $timeStart; //-1: начало сейчас.

public function __construct(bool $guest = false, int $timeStart = -1, int $duration_conf = 3600, string $url = 'https://localhost'){
  $this->key = ['rgsu' => ['client' => '', 'key' => ''],
                'localhost' => ['client' => '205f3f87e2473e9a15191b0e46417fce7b551569', 'key' => 'daec9656748bbca1b297fd2929c0f867cc03f81b']];
  $this->url = $url;
  $this->variables = $_POST;
  $this->guest = $guest;
  $this->timeStart = $timeStart;
  $this->duration_conf = $duration_conf;
  $this->access_token = $this->get_token();
  
}
private function send_request(string $url, string $fields, string $method){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_SSL_VERIFYHOST => false,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_USERAGENT => 'User-Agent: Some-Agent/1.0',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $fields,
      CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
private function get_token() : string{
  $method = 'POST';
  $url = $this->url.'/oauth2/v1/token';
  $fields = json_encode(['grant_type'=>'client_credentials',
  'client_id'=>$this->key['localhost']['client'],
  'client_secret'=>$this->key['localhost']['key']]);
  $result = $this->send_request($url, $fields, $method);
  return $result->access_token;
}
public function create_conf(){
    $method = 'POST';
    $conferenses = [
      "type"=> 0,
      "topic"=> $this->variables['title'],//
      "owner"=> $this->variables['login'],//,
      "description"=>$this->variables['description'],// 
      "max_podiums"=> 25,
      "max_participants"=> 25,
      "schedule"=> [
        "type"=> 1,
        "start_time"=> $this->timeStart,
        "duration"=> 360
      ],
      "allow_guests"=> $this->guest,
      "auto_invite"=> 0,
      "state"=> "stopped",
      "recording"=> 0
    ];
    $conferenses = json_encode($conferenses, JSON_UNESCAPED_SLASHES);
    $url = $this->url."/api/v3.3/conferences?access_token=".$this->access_token;
    $result = $this->send_request($url, $conferenses, $method);
    return  $result;
}
public static function get_user(){
  return 'GilmanovSB';
}
public function scheduled_conference(){
  //TODO
}
public function conferense_start(){
  //TODO
}
public function conferense_stop(){
  //TODO
}
public function conferense_start_record(){
  //TODO
}
public function conferense_pause_record(){
  //TODO
}
public function conferense_stop_record(){
  //TODO
}
public function generate_iframe_conference(){
  //TODO
}

}

//VCS::get_user(); // использовать для реализации проверки имен из AD и TrueConf.

echo (new VCS())->create_conf()->conference->url;
?>
