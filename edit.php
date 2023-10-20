<p>Modifica di <?= $_GET["edit_name"] ?></p>
<?php if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["edit_name"])) { ?>
        <form method="POST">
            Nome <input type="text" name="Nome" id="Nome">
            Artista <input type="text" name="Artista" id="Artista">
            Genere <input type="text" name="Genere" id="Genere">
            Anno <input type="text" name="Anno" id="Anno">
            <br><a href="?edit_name=" .<?= $_GET[
                "edit_name"
            ] ?>><button>Invia</button></a>
        </form>
    <?php }
} else {
    $servername = "localhost"; // Nome del server MySQL
    $username = "romae"; // Nome utente del database
    $password = "2488"; // Password del database
    $database = "myDB"; // Nome del database
    $conn = new mysqli($servername, $username, $password, $database);
    $nomeVecchio = $_GET["edit_name"];
    $nome = $_POST["Nome"];
    $artista = $_POST["Artista"];
    $genere = $_POST["Genere"];
    $anno = $_POST["Anno"];
    $sql = "UPDATE Album SET Nome = '$nome', Artista = '$artista', Anno = '$anno' WHERE Nome = '$nomeVecchio'";

    if ($conn->query($sql) === true) { ?>
    <a href="/album.php">Torna Indietro</a>
    <?php echo "Riga con Nome $nomeVecchio aggiornata con successo.";} else {echo "Errore nell'aggiornamento della riga: " .
            $conn->error;}
}
?>
