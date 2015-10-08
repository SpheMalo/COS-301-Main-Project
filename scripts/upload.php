<?php
require_once("FigbookActionHandler/databaseHandler.php");
session_start();

$target_dir = "../images/profilePictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
    $newfilename = $_COOKIE['username'].".".$imageFileType;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename))
    {
        $dbHandler = new databaseHandler();

        if($dbHandler->isConnected())
        {
          $sql = "UPDATE user SET user_profile_picture='$newfilename'";
          $result = mysqli_query($dbHandler->getConnection(), $sql);

          if ($result == false)//Incase the update Failed
          {
            echo "Failed";
          }
          else{
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          }

        }
        else //db connection failed
        {
            echo "dbError: database connection failed!";
        }

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
