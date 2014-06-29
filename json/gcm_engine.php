<?php

require_once '../conexion.php';
if($_REQUEST['registrationIDs']=='todos'){
$ids=array();
$quetemp="select * from jugadores where movil_id!=''";
$restemp = mysql_query($quetemp, $conexion) or die(mysql_error());
	if(mysql_affected_rows()>0){
		while($row = mysql_fetch_array($restemp)){
		$ids[]= $row['movil_id'];	
			
		}
	}
	//echo($ids[1]);
}else{
	$ids=array($_REQUEST['registrationIDs']);
	
}
// Message to be sent
$message = $_REQUEST['message'];
if(isset($_REQUEST['tipo'])){
    $tipo=$_REQUEST['tipo'];
    
}else{
    $tipo=0;
}
//echo($ids[0]);
echo($message);
// Set POST variables
$url = 'https://android.googleapis.com/gcm/send';

$fields = array(
                'registration_ids'  => $ids,
                'data'              => array( "message" => utf8_encode($message),'tipo' => $tipo ),
                );

$headers = array( 
                    'Authorization: key=' . $_REQUEST['apiKey'],
                    'Content-Type: application/json'
                );

// Open connection
$ch = curl_init();

// Set the url, number of POST vars, POST data
curl_setopt( $ch, CURLOPT_URL, $url );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);

echo $result;

?>