<?php
require 'vendor/autoload.php';

class Test {
	
	private $client;
	public $token;
	public $apiURL;

	private $email = 'yoksis@omu.edu.tr';
	private $password = 'secret';
	private $serviceBaseURL  = 'https://omuservices.omu.edu.tr/api/';
	private $errorMgs = ["User not found", "Unauthorized", "Token is Invalid", "Token is Expired", "Authorization Token not found", "Record table write error"];
	
	function __construct() {
		
		$this->client = new \GuzzleHttp\Client();
		
	}
	
	function getJWTToken() {

		$response = $this->client->request('POST', $this->serviceBaseURL  .'login', 
			[
				'form_params' => ['email' => $this->email, 'password' => $this->password], 
				'verify' => false
			]
		);
		$token = json_decode($response->getBody(), true);
		return $this->token = (isset($token['token'])?$token['token']:'');
		
	}
	
	function apiClient() {
		
		$response = $this->client->request('GET', $this->serviceBaseURL  .$this->apiURL,
			[
				'headers' => ['Authorization' => 'Bearer '.$this->token],
				'verify' => false
			]
		);
		return json_decode($response->getBody(), true);
	
	}
	
	function apiTest() {
		
		$response = $this->apiClient();
		if( !empty($response['status']) && in_array($response['status'], $this->errorMgs) ) {
			$this->getJWTToken();
			$response = $this->apiClient();
		}
		return $response;
			
	}
	
}

$db_host = '127.0.0.1';
$db_database = 'omuservices_test';
$db_username = 'omuservices_test';
$db_password = 'qazwsx';

try { 
	$pdo = new PDO("mysql:host=" .$db_host. ";dbname=" .$db_database. ";charset=utf8", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$fluent = new \Envms\FluentPDO\Query($pdo);
	$fluent->convertWriteTypes(true);
}catch(PDOException $e) { 
	echo $e->getMessage();
	exit;
}

$test = new Test();

$Methods = array(
'getirAkademikGorevListesi',
'getArastirmaSertifkaBilgisiV1',
'getirUnvDisiDeneyimListesi',
'getirDersListesi',
'getEditorlukBilgisiV1',
'getirIdariGorevListesi',
'getKitapBilgisiV1',
'getMakaleBilgisiV1',
'getOdulListesiV1',
'getirOgrenimBilgisiListesi',
'getPatentBilgisiV1',
'getirProjeListesi',
'getTasarimBilgisiV1',
'getTemelAlanBilgisiV1',
'getirTezDanismanListesi',
'getirUyelikListesi',
'getirYabanciDilListesi',
'getYazarListesiV1',
'getPersonelLinkV1', 
'getSanatsalFaalV1',
'getHakemlikBilgisiV1',
'getBildiriBilgisiV1', 
'getirBeyanTesvik',
'getirBasvuruDurum',
'getirAtifSayilari/2015',
'getirAtifSayilari/2016', 
'getirAtifSayilari/2017', 
'getirAtifSayilari/2018',
'getTesvikKatsayi',
);

$bind = array('');

foreach($Methods as $Method){
	$table = '';
	$isCreatetable = true;
	foreach( $bind as $line ){
		
		$test->apiURL = "Yoksis/Ozgecmisv1/$Method/$line";
		echo $Method. "/" .$test->apiURL. "\n";
		$arr = $test->apiTest();
		
		if ( isset($arr['sonuc']['DurumKodu']) && $arr['sonuc']['DurumKodu'] == '1'){
			
			if (empty($table)){
				foreach($arr as $key=>$value)
					if ($key != 'sonuc'){
						$table = $key;
						break;
					}
			}
			
			if(isset($arr[$table])){
				
				if (count($arr[$table]) == count($arr[$table], COUNT_RECURSIVE))
					$arr[$table] = array($arr[$table]);
		
				if($isCreatetable){
					create_table($table, $arr[$table][0]);
					$isCreatetable = false;
				}
				
				foreach($arr[$table] as $value){
					
					if($table=='tezDanismanListesi')
						$key = 'KAYIT_ID';
					else
						$key = key($value);
				
					$value['TC_KIMLIK_NO'] = $line;
					$query = $fluent
						->from($table)
						->where($key, $value[$key])
						->where('TC_KIMLIK_NO', $value['TC_KIMLIK_NO']);
					
					if( count($query) > 0 ){
						$exist = $query->fetch();
						unset($exist['ZAMAN_DAMGASI']);
						
						if($exist != $value){
							echo 'update ' . $value[$key] . "\n";
							
							$query = $fluent->update($table)
										->set($value)
										->where($key, $value[$key])
										->where('TC_KIMLIK_NO', $value['TC_KIMLIK_NO']);
							$query->execute();
						}
					}else{
						
						echo 'insert ' . $value[$key] . "\n";
						$query = $fluent->insertInto($table, $value);
						$query->execute();
					}
				}
			}
		}
	}
}

function create_table($table, $arr){
	$sql = "CREATE TABLE IF NOT EXISTS $table
			(
			TC_KIMLIK_NO VARCHAR( 11 ) NULL DEFAULT NULL, ";
	foreach($arr as $key=>$value){
		
		$sql .= "$key TEXT NULL DEFAULT NULL, ";
	}
	$sql .= "ZAMAN_DAMGASI TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			INDEX TC_KIMLIK_NO (TC_KIMLIK_NO)
			)
			COLLATE='utf8_general_ci'
			ENGINE=MyISAM;";
	
	global $pdo;
	try {
		 $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
		 if(! ($pdo->query("SHOW TABLES LIKE '$table'")->rowCount() > 0) ){
			$pdo->exec($sql);
			print("Created $table Table.\n");
		 }
	} catch(PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}



