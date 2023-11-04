<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get Your Book</title>
    </head>
    <body>
        <header>
            <a href="formulario_alterar.php">Editar</a>
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
                <div class="img">
                    <div class="imgUpload">
                        <a href="detalhes.php?id=<?php echo $row['id']; ?>"> 
                        <img src="file/' . $row['imagemEntrada'] . '" alt="' . $row['titulo'] . '" style="width: 100%;">
                        </a>
                    </div>
                </div>
                <div class="inputBox">
                    <label for="labelTitulo" name="labelTitulo" id="labelTitulo"><?php echo $row['titulo'] ; ?></label>
                </div>
                <div class="inputBox">
                    <label for="labelAutor" name="labelAutor" id="labelAutor"><?php echo $row['autor'] ; ?></label>
                </div>
                <div class="inputBox">
                    <label for="labelnPaginas" name="labelnPaginas" id="labelnPaginas"><?php echo $row['nPaginas']  ; ?></label>
                </div>
                <div class="inputBox">
                    <label for="labelAvaliacao" name="labelAvaliacao" id="labelAvaliacao"><?php echo $row['avaliacao'] ; ?></label>
                </div>
                <div class="inputBox">
                    <label for="labelDescri" name="labelDescri" id="labelDescri"><?php echo $row['descricao']; ?></label>
                </div>
                <?php
                }else{
                    echo 'Detalhes não encontrados.';
                }
            }
            ?> 
            </div>
        </main>  
    </body>
</html>
