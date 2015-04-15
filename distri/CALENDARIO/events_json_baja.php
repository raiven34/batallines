<?php
if(isset($_POST["id"])){
    
    $link=mysql_connect("localhost", "distri", "distri");
    mysql_select_db("distri",$link) OR DIE ("Error: No es posible establecer la conexión");
    mysql_set_charset('utf8');
    $baja = "delete from events where id=" . $_POST["id"];
    $inserta = mysql_query ($baja, $link);
if(mysql_error()){
    echo json_encode(array('success' => 0));
    
}else{
    echo json_encode(array('success' => 1));
}
//    $eventos=mysql_query("SELECT * FROM events",$link);
//
//    while($all = mysql_fetch_assoc($eventos)){
//    $e = array();
//    $e['id'] = $all['id'];
//    $e['start'] = $all['start'];
//    $e['end'] = $all['end'];
//    $e['title'] = $all['title'];
//    $e['class'] = $all['class'];
//    $e['url'] = $all['url'];
//    $result[] = $e;
//    }
//
//    echo json_encode(array('success' => 1, 'result' => $result));
} 
?>