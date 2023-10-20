<!DOCTYPE html>
<?php

$url = "https://api.edamam.com/api/recipes/v2";
$app_id = "fca7bbad";
$app_key = "526d74dc2864b4b07cce7e4c99493a5e";
function curl_get_data($url, $params)
{
    $query_string = http_build_query($params);
    $request_url = $url . "?" . $query_string;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $request_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    if ($response === false)
        echo "Errore nella richiesta cURL: " . curl_error($curl);
    else
        return $response;
}
?>
<html>
<head>
    <title>ricette brutte</title>
    
</head>
<body>
    
    <h1>ricette brutte</h1>
    <?php
    // Gestione del form PHP
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        ?>
<div class="tenor-gif-embed" data-postid="20948491" data-share-method="host" data-aspect-ratio="1.78771" data-width="25%"><a href="https://tenor.com/view/amogus-among-us-meme-impostor-sus-gif-20948491">Amogus Among Us GIF</a>from <a href="https://tenor.com/search/amogus-gifs">Amogus GIFs</a></div> <script type="text/javascript" async src="https://tenor.com/embed.js"></script>    <form method="POST">
        <label for="inputText">Inserisci gli ingredienti:</label>
        <input type="text" name="query" id="q" placeholder="chicken, lettuce">
        <button type="submit">Invia</button>
    </form>
    <?php
    }
    else{
        ?>
<iframe src="https://giphy.com/embed/wa0HY9DySiuNYQO1Zj" width="480" height="266" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/among-us-rtfkt-studios-wa0HY9DySiuNYQO1Zj"></a></p>
    <a href="/test.php"><button>Torna indietro</button></a>
<?php
        $inputText = $_POST["query"];
        $result = curl_get_data($url, array("type" => "public",
    "app_id" => $app_id,
    "app_key" => $app_key,
    "q" => $inputText));
    $decoded_result = json_decode($result,true);
    $decoded_result = $decoded_result["hits"];
    if(count($decoded_result) == 0){
        ?>
        <div style="font-size:33px;font-family:'Courier New">
        <?php echo "<br><p font-size:45px;font-family:'Courier New>Non sono stati trovati risultati. Prova a cercare qualcos'altro.";
        ?></div><?php
    }
    for ($i = 1; $i < count($decoded_result); $i++) {
        foreach ($decoded_result as $recipe) {
            $url = $recipe["recipe"]["url"];
            $lab = $recipe["recipe"]["label"];
            $source = $recipe["recipe"]["source"];
            $img = $recipe["recipe"]["image"];
            //var_dump($recipe);
            ?>
            <div style="font-size:33px;font-family:'Courier New">
            <?php
            echo "<a href=\"$url\"><img src=$img><br>$lab<br>Link alla ricetta</a> (Fonte: $source)<br>";
            ?></div><?php
        }
    }
}
    ?>
   
</body>
</html>