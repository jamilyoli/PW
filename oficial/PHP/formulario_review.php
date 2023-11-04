<?php
if (isset($_POST['submit'])){
    include ('conexaoReview.php');
    $titulo = $_POST['nome'];
    $image = $_FILES['imagemEntrada']['name'];
    $file_image = $_FILES['imagemEntrada']['tmp_name'];
    $autor = $_POST['autor'];
    $npaginas = $_POST['nPaginas'];
    $descri = $_POST['descEntrada'];
    $avalia = $_POST['avaliacao'];

    move_uploaded_file($file_image, 'file/'.$image);
    $result = mysqli_query($conexaor, "INSERT INTO tbl_upload(titulo, image, autor, nPaginas, avaliacao, descricao) 
    VALUES ('$titulo', '$image', '$autor', '$npaginas', '$avalia','$descri')");
    header('Location: lista_review.php');
}
    
        
?>