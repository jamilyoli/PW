<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get Your Book</title>
    </head>
    <body>
        <header>
            <div class="navbar">
                <ul>
                    <li><a href="lista_review.php">Minhas Reviews</a></li>
                    <li><a href="#">Sobre nós</a></li>
                </ul>
            </div>
        </header>
        <main>
            <section>
                <div class="box">
                    <div id="telaDeReview">
                        <a href="formulario_review.html" class="button">Adicionar</a>
                        <a href="excluir.php?id=<?php echo $row['id']; ?>" class="button">Excluir</a>

                        <?php
                            include "conexaoReview.php";
                            $data = mysqli_query($conexaor, "SELECT * FROM tbl_upload order by id DESC") ;
                            while ($row = mysqli_fetch_array($data)){
                        ?>
                        <div class="img">
                            <div class="imgUpload">
                            <a href="detalhes.php?id=<?php echo $row['id']; ?>"> 
                                <img src="file/<?php echo $row['imagemEntrada']; ?>" width = '125' height = '125'>
                            </a>
                            </div>
                        </div>
                        <div class="inputBox">
                            <label for="labelTitulo" name="labelTitulo" id="labelTitulo"><?php echo $row['titulo'] ; ?></label>
                        </div>
                        <div class="inputBox">
                            <label for="labelAvaliacao" name="labelAvaliacao" id="labelAvaliacao"><?php echo $row['avaliacao'] ; ?></label>
                        </div>
                        <?php } ?>    
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>