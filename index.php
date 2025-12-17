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
//leo usuarios

$stmt=$conn->prepare('select * from usuarios');
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$usuarios=array();
foreach($result as $row){
    require_once 'model/Usuario.php';
    $usuario=new Usuario(
        $row['usuario_id'],
        $row['nombre'],
        $row['email'],
        $row['password'],
        $row['avatar'],
        $row['bio']
    );
  
    array_push($usuarios,$usuario);
}  

//leo votos
$stmt=$conn->prepare('select * from votos');
$stmt->execute();   
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Fotos</h1>
    <?php foreach ($fotos as $foto): ?>
        <div>
            <h2><?= htmlspecialchars($foto->titulo()) ?></h2>
            <p><?= htmlspecialchars($foto->descripcion()) ?></p>
            <img src="/formacombookpoo<?= htmlspecialchars($foto->ruta()) ?>" alt="<?= htmlspecialchars($foto->titulo()) ?>">
        </div>
    <?php endforeach; ?>
</body>
</html>