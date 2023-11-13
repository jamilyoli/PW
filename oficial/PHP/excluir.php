<?php
include "conexaoReview.php";

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    $query = "SELECT image FROM tbl_upload WHERE id = $imageId";
    $result = mysqli_query($conexaor, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $imagemEntrada = $row['imagemEntrada'];

        $deleteQuery = "DELETE FROM tbl_upload WHERE id = $imageId";
        $deleteResult = mysqli_query($conexaor, $deleteQuery);

        if ($deleteResult) {
            if (unlink("file/" . $imagemEntrada)) {
                echo "Imagem excluída com sucesso.";
            } else {
                echo "Erro ao excluir o arquivo físico.";
            }
        } else {
            echo "Erro ao excluir a imagem do banco de dados.";
        }
    } else {
        echo "Imagem não encontrada.";
    }
    header('Location: lista_review.php');
}
?>
