<?php
if(isset($_POST["title"])){
    
    $link=mysql_connect("localhost", "distri", "distri");
    mysql_select_db("distri",$link) OR DIE ("Error: No es posible establecer la conexión");
    mysql_set_charset('utf8');
    $alta = "insert into events (title,body,url,class,start,end) values('" . $_POST["title"] . "','" . $_POST["body"] . "','" . $_POST["url"] .  "','" . $_POST["class"] . "','" . strtotime($_POST["start"]) . "000','" . strtotime($_POST["end"]) . "000')";
    $inserta = mysql_query ($alta, $link);
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