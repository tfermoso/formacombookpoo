<?php
require_once 'utils/Database.php';


$db=new Database();
$conn=$db->getConnection();

$stmt=$conn->prepare('select * from fotos');
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

$fotos=array();
foreach($result as $row){
    require_once 'model/Foto.php';
    $foto=new Foto(
        $row['fotos_id'],
        $row['titulo'],
        $row['descripcion'],
        $row['ruta']
    );
  
    array_push($fotos,$foto);
}

