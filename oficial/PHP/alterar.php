<?php
$titulo = $image = $autor = $npaginas = $avalia = $descri = '';

if (!empty($_GET['titulo'])) {
    include('conexaoReview.php');
    $titulo = $_GET['titulo'];

    $titulo = mysqli_real_escape_string($conexaor, $titulo);

    $sqlSelect = "SELECT * FROM tbl_upload WHERE titulo = '$titulo'";
    $result = $conexaor->query($sqlSelect);
    if ($result->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if (isset($user_data['nome'])) {
            $titulo = $user_data['nome'];
        }
        if (isset($user_data['imagemEntrada'])) {
            $image = $user_data['imagemEntrada'];
        }

        if (isset($user_data['autor'])) {
            $autor = $user_data['autor'];
        }

        if (isset($user_data['nPaginas'])) {
            $npaginas = $user_data['nPaginas'];
        }

        if (isset($user_data['avaliacao'])) {
            $avalia = $user_data['avaliacao'];
        }

        if (isset($user_data['descEntrada'])) {
            $descri = $user_data['descEntrada'];
        }
    } else {
        header('Location: lista_review.php');
        exit;
    }
    if (isset($_POST['submit'])) {
        $novoTitulo = mysqli_real_escape_string($conexaor, $_POST['nome']);
        $novaAutor = mysqli_real_escape_string($conexaor, $_POST['autor']);
        $novaNPaginas = (int)$_POST['nPaginas'];
        $novaDescricao = mysqli_real_escape_string($conexaor, $_POST['descEntrada']);

        if (isset($_POST['avaliacao']) && in_array($_POST['avaliacao'], [1, 2, 3, 4, 5])) {
            $novaAvaliacao = (int)$_POST['avaliacao'];
        } else {
            $novaAvaliacao = 0; 
        }
    
        $sqlUpdate = "UPDATE tbl_upload SET nome = '$novoTitulo', autor = '$novaAutor', nPaginas = $novaNPaginas, avaliacao = $novaAvaliacao, descEntrada = '$novaDescricao' WHERE titulo = '$titulo'";
    
        if ($conexaor->query($sqlUpdate) === TRUE) {
            echo "Dados atualizados com sucesso!";
            header('Location: lista_review.php');
            exit;
        } else {
            echo "Erro ao atualizar";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Get Your Book</title>
        <style>
        .btnAva {
                display: inline-block;          
        }
        .btnAva input {
            display: none;
            direction: ltr;
        }
        .btnAva label {
            font-size: 24px;
            cursor: pointer;
            color: #4B1B0D;
         }
         .btnAva label:before {
             content: '\2605'; 
        }
        .btnAva label:hover:before{
            content: '\2606';
        }
        .btnAva input:checked ~ label:before {
            content: '\2605';    
        }
        .btnAva input:checked ~ label ~ label:before {
            content: '\2606';    
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
        <section>
            <div class="box">
                <form action="alterar.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <div id="telaDeReview">
                            <h2>Sabemos que ama livros! Adicione a review sobre um livro</h2>
                            <div class="inputBox">
                                <label for="labelTitulo" name="labelTitulo" id="labelNome">Titulo</label>
                                <p><input type="text" name="nome" id="nome" value="<?php echo $titulo; ?>" size="20" maxlength="50"></p>
                            </div>
                            <div id="imagemUploadTela" class="tela">
                                    <div class="tela-container">
                                        <label>Faça upload da imagem do livro</label>
                                        <input type="file" name="imagemEntrada" accept="image/*" class="form-control"/>
                                        <button type="button" id="uploadBtn">Upload</button>
                                    </div>
                            </div>
                            <div class="inputBox">
                                <label for="labelAutor" name="labelAutor" id="labelAutor">Autor</label>
                                <p><input type="text" name="autor" id="autor" value="<?php echo $autor; ?>" size="20" maxlength="50"></p>
                                <i></i>
                            </div>
                            <div class="inputBox">
                                <label for="labelPagina" name="labelPaginas" id="labelPaginas">Número de Páginas</label>
                                <p><input type="text" name="nPaginas" id="nPaginas" value="<?php echo $npaginas; ?>" maxlength="4"></p>
                                <i></i>
                            </div>
                            <div class="avaliacao">
                                <label for="labelAvalia" name="labelAvalia" id="labelAvalia">Avaliação</label>
                                <div class="btnAva">
                                    <input type="radio" name="avaliacao" value="5" id="estrela5" <?php if ($avalia == 5) echo 'checked'; ?>><label for="estrela5"></label>
                                    <input type="radio" name="avaliacao" value="4" id="estrela4" <?php if ($avalia == 4) echo 'checked'; ?>><label for="estrela4"></label>
                                    <input type="radio" name="avaliacao" value="3" id="estrela3" <?php if ($avalia == 3) echo 'checked'; ?>><label for="estrela3"></label>
                                    <input type="radio" name="avaliacao" value="2" id="estrela2" <?php if ($avalia == 2) echo 'checked'; ?>><label for="estrela2"></label>
                                    <input type="radio" name="avaliacao" value="1" id="estrela1" <?php if ($avalia == 1) echo 'checked'; ?>><label for="estrela1"></label>
                                </div>
                            </div>
                            <div id="descriTela" class="tela">
                                    <div class="telad-container">
                                        <h3>Escreva a review sobre o livro:</h3>
                                        <textarea id="descEntrada" name="descEntrada"></textarea>
                                        <button type="button" id="adiciBtn">Adicionar</button>
                                    </div>
                            </div>
                            <div class="botoes">
                                <input type="submit" name="submit" id="submit" value="Salvar">
                                <button id="cancel" name="cancel">Cancelar</button>
                            </div>
                            
                        </div>
                    </fieldset>
                </form>
            </div>
        </section>
        <img src="img/_a1bbcdd3-674f-4ab8-9c8a-33ddd7d7755a.jfif">
    </main>
</body>
<script>
    const estrelas = document.querySelectorAll('input[name="avaliacao"]');
    estrelas.forEach(estre => {
        estre.addEventListener('click', (event) => {
            estrelas.forEach(estre => estre.checked = false);
            event.target.checked = true;
        });
    });
    
</script>
</html>

