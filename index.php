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
            <h2><?= htmlspecialchars($foto->getTitulo()) ?></h2>
            <p><?= htmlspecialchars($foto->getDescripcion()) ?></p>
            <img src="<?= htmlspecialchars($foto->getRuta()) ?>" alt="<?= htmlspecialchars($foto->getTitulo()) ?>">
        </div>
    <?php endforeach; ?>
</body>
</html>