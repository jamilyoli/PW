<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Review</title>
</head>
<body>
    <header>
        <a href="lista_review.php">Voltar para a lista</a>
    </header>
    <main>
        <div class="alterar">
        <?php
        include "conexaoReview.php";
        
        if (isset($_GET['id'])) {
            $imageId = $_GET['id'];
            $query = "SELECT * FROM tbl_upload WHERE id = $imageId";
            $result = mysqli_query($conexaor, $query);
            
            if ($row = mysqli_fetch_array($result)){
                ?>
                <form action="alterar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="img">
                        <div class="imgUpload">
                            <img src="file/<?php echo $row['imagemEntrada']; ?>" alt="<?php echo $row['titulo']; ?>" style="width: 100%;">
                        </div>
                    </div>
                    <div class="inputBox">
                        <label for="labelTitulo">Título:</label>
                        <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>">
                    </div>
                    <div class="inputBox">
                        <label for="labelAutor">Autor:</label>
                        <input type="text" name="autor" value="<?php echo $row['autor']; ?>">
                    </div>
                    <div class="inputBox">
                        <label for="labelnPaginas">Número de Páginas:</label>
                        <input type="text" name="nPaginas" value="<?php echo $row['nPaginas']; ?>">
                    </div>
                    <div class="inputBox">
                        <label for="labelAvaliacao">Avaliação:</label>
                        <input type="text" name="avaliacao" value="<?php echo $row['avaliacao']; ?>">
                    </div>
                    <div class="inputBox">
                        <label for="labelDescri">Descrição:</label>
                        <textarea name="descricao"><?php echo $row['descricao']; ?></textarea>
                    </div>
                    <input type="submit" value="Salvar">
                </form>
                <?php
            } else {
                echo 'Revisão não encontrada.';
            }
        }
        ?>
        </div>
    </main>
</body>
</html>
