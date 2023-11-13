<?php
if (isset($_POST['submit'])){
    include ('conexaoReview.php');
    $titulo = $_POST['nome'];
    $image = $_FILES['imagemEntrada']['name'];
    $file_image = $_FILES['imagemEntrada']['tmp_name'];
    $autor = $_POST['autor'];
    $npaginas = $_POST['nPaginas'];
    $descri = $_POST['descEntrada'];

    if (!empty($_POST['avaliacao'])){
        $avalia = $_POST['avaliacao'];

        $result_avaliacoes = mysqli_query($conexaor, "INSERT INTO avaliacoes (qnt_estrela, created) VALUES ('$avalia', NOW())");

        if ($result_avaliacoes) {
            move_uploaded_file($file_image, 'file/' . $image);
            $result = mysqli_query($conexaor, "INSERT INTO tbl_upload(titulo, image, autor, nPaginas, avaliacao, descri) 
                VALUES ('$titulo', '$image', '$autor', '$npaginas', '$avalia', '$descri')");

            if ($result) {
                header('Location: lista_review.php');
            } else {
                echo "Erro ao inserir dados na tabela tbl_upload: " . mysqli_error($conexaor);
            }
        } else {
            echo "Erro ao inserir dados na tabela avaliacoes: " . mysqli_error($conexaor);
        }
    } else {
        echo "Avaliação não foi selecionada.";
    }
}
?>
