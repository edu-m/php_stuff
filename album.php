<?php
// Informazioni di accesso al database
$servername = "localhost"; // Nome del server MySQL
$username = "romae"; // Nome utente del database
$password = "2488"; // Password del database
$database = "myDB"; // Nome del database
$conn = new mysqli($servername, $username, $password, $database);
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["delete_name"])) {
        // gestiamo il caso della cancellazione
        $rigaDaCancellare = $_GET["delete_name"];

        // Query per cancellare la riga specifica
        $sql = "DELETE FROM Album WHERE Nome = '$rigaDaCancellare'";

        if ($conn->query($sql) === true) {
            echo "$rigaDaCancellare è stato cancellato con successo.";
        } else {
            echo "Errore nella cancellazione della riga: " . $conn->error;
        }
    }
    $sql = "SELECT * FROM Album";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Nome</th>
                    <th>Artista</th>
                    <th>Genere</th>
                    <th>Anno</th>
                    <th>Cancella</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" .
                $row["Nome"] .
                "</td>
                    <td>" .
                $row["Artista"] .
                "</td>
                    <td>" .
                $row["Genere"] .
                "</td>
                    <td>" .
                $row["Anno"] .
                "</td>
                    <td>
                        <a href='?delete_name=" .$row["Nome"]."'><button>Cancella</button></a>
                        <a href='/edit.php?edit_name=" .$row["Nome"] ."'><button>Modifica</button></a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    }

    // interfaccia di inserimento
    ?>
        <form method="POST">
            Nome <input type="text" name="Nome" id="Nome">
            Artista <input type="text" name="Artista" id="Artista">
            Genere <input type="text" name="Genere" id="Genere">
            Anno <input type="text" name="Anno" id="Anno">
            <br><button type="submit">Invia</button>
        </form>
    <?php
} else {

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }
    $nomeAlbum = $_POST["Nome"];
    $artista = $_POST["Artista"];
    $genere = $_POST["Genere"];
    $anno = $_POST["Anno"];

    $sql = "INSERT INTO Album (Nome, Artista, Genere, Anno) VALUES ('$nomeAlbum', '$artista', '$genere','$anno')";

    if ($conn->query($sql) === true) {
        echo "Album inserito con successo: $nomeAlbum<br>";
    } else {
        echo "Errore nell'inserimento dell'album: " . $conn->error . "<br>";
    }
    ?>
    <a href="/album.php"><button>Torna indietro</button></a>
    <?php $conn->close();
}

?>
