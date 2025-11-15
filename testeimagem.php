<?php
include "cone.php";
if(isset($_FILES['imagem']))
{
    
    
    $arquivo = $_FILES['imagem'];
    $pasta = "img/";
    $nomeImg = $arquivo['name'];
    $novoNome = uniqid();
    $extencao= strtolower(pathinfo($nomeImg,PATHINFO_EXTENSION)) ;

    if($extencao !="jpg" && $extencao != "png"){
        die("tipo de arquivo tem que ser uma imagem");
    }
    $path= $pasta . $novoNome . "." . $extencao;
    $ok = move_uploaded_file($arquivo['tmp_name'],$path);
    if($ok)
    {
        $mysqli->query("INSERT INTO arquivos (path) VALUES ('$path')")  or die($mysqli->error);
        echo "<p>enviado com sucesso</p>";
    }
    else
       echo "<p>falha ao enviado o arquivo</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="">

                <p>
                <input type="file"  name="imagem">
                </p>
                <button type="submit" name="upload">enviar arquivo</button>
    </form>
    <img src="<?php echo $path; ?>"> 
</body>
</html>