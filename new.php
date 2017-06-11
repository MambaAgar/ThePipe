<?php
/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/9/17
 * Time: 10:24 AM
 */

session_start();

include_once('config.php');
include_once('elements.php');

if(!isset($_SESSION['user'])) {
    header('location: login.php');
}

if (!isset($_SESSION['new_video_id'])) {
    if (($_SERVER['REQUEST_METHOD'] == 'POST')
        && isset($_FILES['file'])
        && (pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'mp4')
        && isset($_POST['title'])
        && isset($_POST['description'])
    ) {
        $query = $pdo->prepare("INSERT INTO Videos (title, description, uploader) OUTPUT inserted.id VALUES (?, ?, ?);
SELECT * FROM Videos WHERE id = SCOPE_IDENTITY();");
        $query->execute([$_POST['title'], $_POST['description'], $_SESSION['user']['id']]);
        $video = $query->fetch(PDO::FETCH_ASSOC);
        move_uploaded_file($_FILES['file']['tmp_name'], 'D:\\ThePipeUploads\\' . $video['id'] . '.mp4');
        unset($query, $response);
        $_SESSION['new_video_id'] = $video['id'];
    }
} else {
    $dir = opendir('D:\\ThePipeUploads\\WorkQueue\\Finished');
    while (false !== ($entry = readdir($dir))) {
        if ($entry != '.' && $entry != '..'
            && file_exists('D:\\ThePipeUploads\\WorkQueue\\Finished\\' . $entry . '\\' . $_SESSION['new_video_id'] . '.ism')
        ) {
            $files = scandir('D:\\ThePipeUploads\\WorkQueue\\Finished\\' . $entry);
            $source = 'D:\\ThePipeUploads\\WorkQueue\\Finished\\' . $entry . '\\';
            $destination = 'D:\\ThePipeMedia\\';
            foreach ($files as $file) {
                if (in_array($file, array('.', '..'))) continue;
                if (copy($source . $file, $destination . $file)) {
                    $delete[] = $source . $file;
                }
            }
            foreach ($delete as $file) {
                unlink($file);
            }
            rmdir($source);
            unset($source, $destination, $delete, $file, $files);
            header('location: play.php?video=' . $_SESSION['new_video_id']);
            unset($_SESSION['new_video_id']);
        }
    }
    //no folder yet, keep waiting
}

elements::header('New Video');

if (!isset($_SESSION['new_video_id'])): ?>
    <div class="jumbotron">
        <h1>New Video</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <p>
                <input class="form-control" type="file" name="file"/>
            </p>
            <p>
                <input class="form-control" type="text" name="title" placeholder="Video Title">
            </p>
            <p>
                <textarea class="form-control" name="description" rows="10" cols="30"
                          placeholder="Video Description"></textarea>
            </p>
            <input class="btn btn-default" type="submit" name="submit" value="Submit"/>
        </form>
    </div>
<?php else: ?>
    <div class="jumbotron text-center">
        <h2>Please Wait</h2>
        <p>Your video is being processed and you will be redirected to it when it's ready.</p>
        <h1><span class="glyphicon glyphicon-refresh spin" ></span></h1>
    </div>
    <meta http-equiv="refresh" content="5"/>
<?php endif;
elements::footer(); ?>