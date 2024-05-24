<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["video"]["name"]);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual video
        $check = mime_content_type($_FILES["video"]["tmp_name"]);
        if (strpos($check, "video") === 0) {
            $uploadOk = 1;
        } else {
            echo "File is not a video.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["video"]["size"] > 500000000) { // 500MB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov" && $videoFileType != "wmv") {
            echo "Sorry, only MP4, AVI, MOV & WMV files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
                // Update the XML file
                $xml = new DOMDocument("1.0", "UTF-8");

                if (file_exists('videos.xml')) {
                    if (filesize('videos.xml') == 0) {
                        // Initialize with root element if file is empty
                        $root = $xml->createElement("videos");
                        $xml->appendChild($root);
                        $xml->save('videos.xml'); // Save the initial structure
                    } else {
                        $xml->load('videos.xml');
                        $root = $xml->getElementsByTagName("videos")->item(0);
                    }
                } else {
                    $root = $xml->createElement("videos");
                    $xml->appendChild($root);
                    $xml->save('videos.xml'); // Save the initial structure
                }

                $video = $xml->createElement("video");
                $nameElement = $xml->createElement("name", htmlspecialchars($_FILES["video"]["name"]));
                $pathElement = $xml->createElement("path", htmlspecialchars($target_file));
                $sizeElement = $xml->createElement("size", htmlspecialchars($_FILES["video"]["size"]));
                $dateElement = $xml->createElement("upload_date", date("Y-m-d H:i:s"));

                $video->appendChild($nameElement);
                $video->appendChild($pathElement);
                $video->appendChild($sizeElement);
                $video->appendChild($dateElement);

                $root->appendChild($video);

                $xml->save('videos.xml');
                echo "The file " . htmlspecialchars(basename($_FILES["video"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded or file is too large.";
    }
}
?>
