<?php
/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/9/17
 * Time: 8:54 PM
 */
include_once('elements.php');
include_once('config.php');

elements::header('All Videos');
?>
    <div class="jumbotron">
        <h1>List of all Videos</h1>
        <div class="list-group">
            <?php foreach ($pdo->query('SELECT * FROM Videos') as $video): ?>
                <button type="button" class="list-group-item" onclick="window.location = 'play.php?video=<?php echo($video['id']) ?>'">
                    <?php echo($video['title']) ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
<?php elements::footer(); ?>