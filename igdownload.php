php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Reel Downloader</title>
</head>
<body>
    <h1>Instagram Reel Downloader</h1>
    <form action="" method="post">
        <label for="reelLink">Enter Instagram Reel URL:</label><br>
        <input type="text" id="reelLink" name="reelLink" required><br><br>
        <button type="submit">Download</button>
    </form>

    <?php
    if(isset($_POST['reelLink'])) {
        $instaUrl = $_POST['reelLink'];
        $html = file_get_contents($instaUrl);

        preg_match('/"video_url":"([^"]+)"/', $html, $matches);

        if(isset($matches[1])) {
            $mp4Url = str_replace('\u0026', '&', $matches[1]);

            // Offer the MP4 file for download
            header('Content-Type: video/mp4');
            header('Content-Disposition: attachment; filename="instagram_reel.mp4"');
            readfile($mp4Url);
            exit();
        } else {
            echo 'Error: Unable to extract MP4 link.';
        }
    }
    ?>
</body>
</html>
