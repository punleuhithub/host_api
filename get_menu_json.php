<?php 
$cn = new mysqli("localhost","root","","php22");
// $s = $_POST["s"];
// $z = $_POST["z"];
$opt = $_POST["opt"];
//COUNT total_page;
$sql = "SELECT COUNT(*) as total FROM tbl_menu";
$totalrs = $cn->query($sql);
$rowtotal = $totalrs->fetch_array();
// $total = $rowtotal[0];

//search name and id
if($opt=="search"){
$txtsearch = $_POST["txtsearch"];
$selectoption = explode(",",trim($_POST["selectoption"]));
$fld = $selectoption[0]; // id name status
$opt1 = $selectoption[1]; // = , LIKE
$cd = $fld.' = '.$txtsearch;
if($opt1=="LIKE"){
$cd = $fld.' LIKE '."'%$txtsearch%'";
}
$sql = "SELECT * FROM tbl_menu WHERE $cd ORDER BY id DESC"; 
}
else{
$sql = "SELECT * FROM tbl_menu ORDER BY id DESC"; 
}

$rs = $cn->query($sql);
$num  = $rs->num_rows;
$data = array();
if($num>0){
    while($row = $rs->fetch_array()){
         $data[] = array(
            "id"=>$row[0],
            "name"=>$row[1],
            "od"=>$row[2],
            "name_link"=>$row[3],
            "status"=>$row[4],
            "img"=>$row[5],
            "total"=>$rowtotal[0]
         );
    }
}
echo json_encode($data)
?>