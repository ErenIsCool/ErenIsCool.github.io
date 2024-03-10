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
