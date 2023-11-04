<?php
if (isset($_GET['id'])) {
    $imageId = $_GET['id'];
    include('conexaoReview.php');
    $sql = "DELETE FROM tbl_upload WHERE id = $imageId";
    
    if (mysqli_query($conexaor, $sql)) {
        echo "Informações excluídas com sucesso.";
    } else {
        echo "Erro ao excluir informações: " . mysqli_error($conexaor);
    }
    mysqli_close($conexaor);
} else {
    echo 'ID não especificado.';
}
?>
