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
        $row['usuarios_id'],
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

//Recorro las fotos y les agrego los votos
foreach($fotos as $foto){
    foreach($result as $row){
        if($row['fotos_id']==$foto->fotos_id()){
            //buscar el usuario correspondiente
            foreach($usuarios as $usuario){
                if($usuario->usuario_id()==$row['usuarios_id']){
                    $foto->agregarVoto($usuario);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Fotos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">

    <h1 class="text-center mb-4">Lista de Fotos</h1>

    <div class="row g-4">
        <?php foreach ($fotos as $foto): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">

                    <img 
                        src="/formacombookpoo<?= htmlspecialchars($foto->ruta()) ?>" 
                        class="card-img-top"
                        alt="<?= htmlspecialchars($foto->titulo()) ?>"
                    >

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($foto->titulo()) ?>
                        </h5>
                        <p class="card-text">
                            <?= htmlspecialchars($foto->descripcion()) ?>
                        </p>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Bootstrap 5 JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>