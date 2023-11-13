<?php
include('conexaoReview.php');

if (!empty($_GET['search'])) {
    $search = $conexaor->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM tbl_upload WHERE titulo LIKE '%$search%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM tbl_upload ORDER BY id DESC";
    $search = "";
}

$result = $conexaor->query($sql);

if (isset($_GET['clear'])) {
    header("Location: lista_review.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Your Book</title>
    <style>
        .adicionar {
            background-image: url('img/botao-adicionar.png');
            background-size: cover;
            background-repeat: no-repeat;
            border: none;
            width: 20px;
            height: 20px;
            cursor: pointer;
            background-color: #F3BABA;
        }

        .btn {
            background-image: url('img/pesquisa-de-lupa.png');
            background-size: cover;
            background-repeat: no-repeat;
            border: none;
            width: 20px;
            height: 20px;
            cursor: pointer;
            background-color: #F3BABA;
        }

        .remover {
            background-image: url('img/excluir.png');
            background-size: cover;
            background-repeat: no-repeat;
            border: none;
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

        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
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
            <div id="telaDeReview">
                <div class="box-search">
                    <input type="search" class="procurar" placeholder="Pesquisar" id="procurar" value="<?php echo $search; ?>">
                    <button onclick="searchData()" class="btn"></button>
                    <?php
                        if (!empty($search)) {
                            echo '<a href="lista_review.php?clear=1">Limpar Pesquisa</a>';
                        }
                        ?>
                </div>
                <p></p>
                <button class="adicionar" onclick="location.href='formulario_review.html'"></button>

                <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="img">
                                <div class="imgUpload">
                                    <a href="detalhes.php?id=<?php echo $row['id']; ?>">
                                        <img src="file/<?php echo $row['image']; ?>" style="width: 100%;">
                                    </a>

                                    <button class="remover" onclick="selecionarParaExcluir(<?php echo $row['id']; ?>)"></button>
                                </div>
                            </div>
                            <div class="inputBox">
                                <label for="labelTitulo" name="labelTitulo" id="labelTitulo"><?php echo $row['titulo']; ?></label>
                            </div>
                            <div class="inputBox">
                                <label for="labelAvaliacao" name="labelAvaliacao" id="labelAvaliacao">
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
                            <?php
                        }
                    } else {
                        echo "Nenhum resultado encontrado.";
                    }
                    ?>
            </div>
        </div>
    </section>
</main>
<script>
    function selecionarParaExcluir(imageId) {
        if (confirm("Deseja realmente excluir esta imagem?")) {
            window.location.href = "excluir.php?id=" + imageId;
        }
    }

    var search = document.getElementById('procurar');
    search.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'lista_review.php?search=' + search.value;
    }
</script>
</body>
</html>
