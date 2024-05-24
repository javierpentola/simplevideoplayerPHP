<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/98.css" />
    <title>Upload Video</title>
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
            width: 400px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #000000; /* Black text */
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 2px solid #000000; /* Black border */
            background-color: #ffffff; /* White background */
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #008000; /* Green submit button */
            color: #ffffff; /* White text */
            border: none;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-bottom: 10px;
        }

        .view-videos {
            background-color: #0000ff; /* Blue button */
            color: #ffffff; /* White text */
            border: none;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Video</h1>
        <form action="upload_video.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="video">Select video to upload:</label>
                <input type="file" name="video" id="video" accept="video/*" required>
            </div>
            <input type="submit" value="Upload Video">
        </form>
        <a href="view_videos.php" class="view-videos">View Videos</a>
    </div>
</body>
</html>
