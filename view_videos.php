<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/98.css" />
    <title>View Videos</title>
    <style>
        body {
            font-family: 'MS Sans Serif', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #008080; /* Dark teal background */
        }

        .container {
            background-color: #c0c0c0; /* Light gray background */
            border: 2px solid #000000; /* Black border */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 50%;
            text-align: center;
        }

        .video-list {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        .video-list li {
            margin-bottom: 10px;
        }

        .video-list a {
            color: #0000ff; /* Blue link */
            text-decoration: none;
            font-weight: bold;
        }

        .video-list a:hover {
            text-decoration: underline;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            background-color: #0000ff; /* Blue button */
            color: #ffffff; /* White text */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #0000cc; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Available Videos</h1>
        <ul class="video-list">
            <?php
            if (file_exists('videos.xml')) {
                if (filesize('videos.xml') > 0) {
                    $xml = simplexml_load_file('videos.xml');
                    if ($xml !== false && isset($xml->video)) {
                        foreach ($xml->video as $video) {
                            echo "<li><a href='play_video.php?path=" . urlencode($video->path) . "'>" . htmlspecialchars($video->name) . "</a></li>";
                        }
                    } else {
                        echo "<li>XML file is invalid or contains no video entries.</li>";
                    }
                } else {
                    echo "<li>XML file is empty.</li>";
                }
            } else {
                echo "<li>No videos found.</li>";
            }
            ?>
        </ul>
        <div class="button-container">
            <a href="index.php" class="button">Upload More Videos</a>
            <a href="index.php" class="button">Back to Index</a>
        </div>
    </div>
</body>
</html>
