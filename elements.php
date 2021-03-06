<?php

/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/8/17
 * Time: 1:23 PM
 */
class elements
{
    static function header($title)
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <meta name="description" content="">
            <meta name="author" content="">
            <!-- <link rel="icon" href="../../favicon.ico"> -->

            <title><?php echo $title ?> - ThePipe</title>

            <!-- Bootstrap core CSS -->
            <link href="resources/css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="resources/css/main.css" rel="stylesheet">
        </head>
        <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ThePipe</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="new.php">Upload</a></li>
                        <li><a href="list.php">List</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container">
        <?php
    }

    static function footer($videostream = '')
    {
        ?>
        </div><!--/.container -->
        <?php if($videostream != ''): ?>
        <script src="resources/js/hasplayer.js"></script>
        <script>
            (function(){
                var stream = {
                    url: "<?php echo $videostream; ?>"
                };
                var mediaPlayer = new MediaPlayer();
                mediaPlayer.init(document.querySelector("#videoPlayer"));
                mediaPlayer.load(stream);
            })();
        </script>
        <?php endif; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="resources/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }
}