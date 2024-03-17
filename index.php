<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prosit 6</title>
    <!--Le CSS n'est pas dans un fichier à part pour simplifier le code-->
    <style>
		* {
			font-family: Verdana, sans-serif;
		}
        table {
            border-collapse: collapse;
			margin: auto;
            width: 700px;
            height: 700px;
        }

        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        .boutons {
            text-align: center;
            margin-top: 20px;
        }

        .boutons input[type="text"] {
            width: 10px;
        }
    </style>
</head>

<body>
<?php

$nbrPages = 3;
$emojisParPage = 256;
$nbrEmojis = $emojisParPage * $nbrPages; // 3 pages avec un tableau de 16x16 émojis

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$startIndex = ($page - 1) * $emojisParPage;

// Tableau d'emojis
echo "<h1>Page $page</h1>";
echo "<table>";

for ($i = $startIndex; $i < $startIndex + $emojisParPage && $i < $nbrEmojis; $i++) {
    if ($i % 16 == 0) {
        echo "<tr>";
    }

    $emojiCode = dechex(128512 + $i); // Code hexadécimal du premier emoji + incrément
    echo "<td>&#x$emojiCode;</td>";

    if (($i + 1) % 16 == 0) {
        echo "</tr>";
    }
}

echo "</table>";

// Pagination
echo "<div class='boutons'>";
echo "<a href='?page=1'><<</a> ";
$prevPage = max($page - 1, 1);
echo "<a href='?page=$prevPage'><</a> ";

echo "<input type='text' id='gotoPage' value='$page' onkeypress='selecPage(event)'> ";

$nextPage = min($page + 1, $nbrPages);
echo "<a href='?page=$nextPage'>></a> ";
echo "<a href='?page=$nbrPages'>>></a> ";
echo "</div>";
?>

<!--Le Javascript n'est pas séparé pour la même raison-->
<script>
    function selecPage(event) {
        if (event.key === 'Enter') {
            var pageInput = document.getElementById('gotoPage').value;
            var nbrPages = <?php echo $nbrPages; ?>;
            if (pageInput >= 1 && pageInput <= nbrPages) {
                window.location.href = '?page=' + pageInput;
            } else {
                alert('Page invalide.');
            }
        }
    }
</script>

</body>
</html>
