<?php
include '../include/bdd.inc.php';

if (isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%' . $_POST['keyword'] . '%';

    $sql = "SELECT * FROM race WHERE librace LIKE :var ORDER BY idrace ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        // Highlight the searched keyword in the result
        $highlightedName = str_replace($_POST['keyword'], '<b>' . $_POST['keyword'] . '</b>', $res['librace']);
        // Using `idrace` for unique identification
        echo '<li onclick="set_item(\'' . htmlspecialchars($res['librace'], ENT_QUOTES) . '\', ' . $_POST['index'] . ', ' . $res['idrace'] . ')">' . $highlightedName . '</li>';
    }
}
?>
