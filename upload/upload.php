<?php

error_reporting(E_ALL);

// we first include the upload class, as we will need it here to deal with the uploaded file
include('class.upload.php');

// retrieve eventual CLI parameters
$cli = (isset($argc) && $argc > 1);
if ($cli) {
    if (isset($argv[1])) $_GET['file'] = $argv[1];
    if (isset($argv[2])) $_GET['dir'] = $argv[2];
    if (isset($argv[3])) $_GET['pics'] = $argv[3];
}

// set variables
$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'test');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

if (!$cli) {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<head>
    <title>class.php.upload test forms</title>

    <style>
        body {
        }
        fieldset {
            width: 50%;
            background: url(bg.gif);
            margin: 15px 0px 25px 0px;
            padding: 15px;
        }
        legend {
            font-weight: bold;
        }
        fieldset img {
            float: right;
        }
        fieldset p {
            font-size: 70%;
            font-style: italic;
        }
        .button {
            text-align: right;
        }
        .button input {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>class.upload.php test forms</h1>

<?php
}


// we have three forms on the test page, so we redirect accordingly
if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'simple') {

    // ---------- SIMPLE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
        $handle->Process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<fieldset>';
            echo '  <legend>file uploaded with success</legend>';
            echo '  <p>' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p>';
            echo '  link to the file just uploaded: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
            echo '</fieldset>';
        } else {
            // one error occured
            echo '<fieldset>';
            echo '  <legend>file not uploaded to the wanted location</legend>';
            echo '  Error: ' . $handle->error . '';
            echo '</fieldset>';
        }

        // we copy the file a second time
        $handle->Process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<fieldset>';
            echo '  <legend>file uploaded with success</legend>';
            echo '  <p>' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p>';
            echo '  link to the file just uploaded: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
            echo '</fieldset>';
        } else {
            // one error occured
            echo '<fieldset>';
            echo '  <legend>file not uploaded to the wanted location</legend>';
            echo '  Error: ' . $handle->error . '';
            echo '</fieldset>';
        }

        // we delete the temporary files
        $handle-> Clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<fieldset>';
        echo '  <legend>file not uploaded on the server</legend>';
        echo '  Error: ' . $handle->error . '';
        echo '</fieldset>';
    }

} else if ((isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '')) == 'image') {

    // ---------- IMAGE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 300;

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
        $handle->Process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<fieldset>';
            echo '  <legend>file uploaded with success</legend>';
            echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  <p>' . $info['mime'] . ' &nbsp;-&nbsp; ' . $info[0] . ' x ' . $info[1] .' &nbsp;-&nbsp; ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p>';
            echo '  link to the file just uploaded: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '</fieldset>';
        } else {
            // one error occured
            echo '<fieldset>';
            echo '  <legend>file not uploaded to the wanted location</legend>';
            echo '  Error: ' . $handle->error . '';
            echo '</fieldset>';
        }

       rename("$dir_pics.'/' . $handle->file_dst_name", "$dir_pics.'/' .aaa");
	   }
?>
</body>

</html>

<?php

?>