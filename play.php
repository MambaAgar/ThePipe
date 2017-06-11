<?php
/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/9/17
 * Time: 9:20 AM
 */
include_once('elements.php');
include_once('config.php');

if($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['video'])) {
    header('location: index.php');
}

$query = $pdo->prepare('SELECT * FROM Videos WHERE id = ?');
$query->execute([$_GET['video']]);
if($query->rowCount() == 0) {
    header('location: index.php');
}
$video = $query->fetch(PDO::FETCH_ASSOC);

$query = $pdo->prepare('SELECT * FROM Users WHERE id = ?');
$query->execute([$video['uploader']]);
$uploader = $query->fetch(PDO::FETCH_ASSOC);

elements::header($video['title']);
?>
    <div class="jumbotron">
        <span style="float: left;"><h1><?php echo($video['title']) ?></h1></span>
        <span style="float: right;"><p>Uploaded by <strong><?php echo($uploader['username']) ?></strong></p></span>
        <video id="videoPlayer" controls="true"></video>
        <p><?php echo($video['description']) ?></p>
    </div>
<?php elements::footer('https://wamik.ga:470/media/' . $_GET['video'] . '.ism/Manifest'); ?>