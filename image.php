<?php
include'db.php';
session_start();

$imagenss = $_FILES['imagen'];
$filess = $imagenss['name'];

if($filess != ""){

    $veruno = $_SESSION['primero'];
    $verdos = $_SESSION['segundo'];

    $ree = mysqli_query($conect,"select * from registrar where Usuario = '$veruno' and Pass = '$verdos'");

    $val = mysqli_fetch_array($ree);
    $valuar = $val['Codigo'];
    
    $ver = $valuar;

        $imagen = $_FILES['imagen'];
        $tmp_name = $imagen['tmp_name'];
    
        $directorio_destino = "imagenes";
    
        $file = $imagen['name'];
        $type = $imagen['type'];

        $resultado = mysqli_query($conect,"select * from datos WHERE codigo = '$ver';");
        $archivo = mysqli_fetch_array($resultado);
        $uno = $archivo['imagen'];

        if($uno != ""){
            unlink("../FreeLance/imagenes/".$uno);
            //unlink("../public_html/imagenes/".$uno);//
        }

        if(((strpos($type,"gif") || strpos($type,"jpeg") || strpos($type,"png")))){
    
            $destino = '../FreeLance/imagenes/'.$file;
    
            mysqli_query($conect,"UPDATE datos SET imagen = '$file' WHERE codigo = '$ver';");

            move_uploaded_file($tmp_name,$destino);
            mysqli_close($conect);
            header("Location: perfil.php");
        }
}else{
echo 1;
}
?>