<?php
if (isset($_POST['id'])) {
    $imageId = $_POST['id'];
    $novoTitulo = $_POST['titulo'];
    $novoAutor = $_POST['autor'];
    $novoNPaginas = $_POST['nPaginas'];
    $novaAvaliacao = $_POST['avaliacao'];
    $novaDescricao = $_POST['descricao'];

    include('conexaoReview.php');

    $query = "UPDATE tbl_upload SET titulo = '$novoTitulo', autor = '$novoAutor', nPaginas = '$novoNPaginas', avaliacao = '$novaAvaliacao', descricao = '$novaDescricao' WHERE id = $imageId";

    if (mysqli_query($conexaor, $query)) {
        // Sucesso na atualização
        header('Location: lista_review.php');
    } else {
        // Erro na atualização
        echo "Erro: " . mysqli_error($conexaor);
    }

    mysqli_close($conexaor);
}
?>
