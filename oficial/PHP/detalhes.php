<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get Your Book</title>
        <style>
            .alterar{
                background-image: url('img/editar-texto.png');
                background-size: cover;
                background-repeat: no-repeat;
                border:none;
                width: 20px;
                height: 20px;
                cursor: pointer;
                background-color: #F3BABA;
            }
            .star-filled {
                color: #4B1B0D;
                font-size: 24px;
            }
            .star-unfilled {
                color: #D3D3D3;
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="navbar">
                <ul>
                    <li><a href="lista_review.php">Minhas Reviews</a></li>
                    <li><a href="sobreNós.html">Sobre nós</a></li>
                    <input type="radio" name="avaliacao" value="5" id="estrela5"><label
                                            for="estrela5"></label>
                </ul>
            </div>
        </header>
        <main>
            <div class="detalhes">
            <?php
            include "conexaoReview.php";

            if (isset($_GET['id'])) {
                $imageId = $_GET['id'];
                $query = "SELECT * FROM tbl_upload WHERE id = $imageId";
                $result = mysqli_query($conexaor, $query);
                if ($row = mysqli_fetch_array($result)){
                    $titulo = $row['titulo']; 
                ?>
                <div class="img">
                    <div class="imgUpload">
                        <img src="file/' . $row['imagemEntrada'] .' " style="width: 100%;">
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
                    <label for="labelAvaliacao" name="labelAvaliacao" id="labelAvaliacao"><?php echo $row['avaliacao'] ; ?>
                    <?php
                                $avaliacao = $row['avaliacao'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $avaliacao) {
                                        echo '<span class="star-filled">★</span>';
                                    } else {
                                        echo '<span class="star-unfilled">☆</span>';
                                    }
                                }
                                ?>
                    </label>
                </div>
                <p></p>
                <div class="inputBox">
                    <label for="labelDescri" name="labelDescri" id="labelDescri"><?php echo $row['descricao']; ?>
                </label>
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
    <script>
        document.getElementById("alterarButton").addEventListener("click", function() {
            <?php
            if (isset($row['titulo'])) {
                echo "location.href = 'alterar.php?titulo=" . urlencode($row['titulo']) . "';";
            }
            ?>
            });
    </script>
</html>
