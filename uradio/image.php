<?php
  error_reporting(0);
?>
<html>
<body>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="file" name="uploadfile" value=""/>
      <input type="submit" name="submit" value="upload file"/>
    </form>
</body>
</html>
<?php
  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $folder = "userimage/".$filename;
  move_uploaded_file($tempname,$folder);
  echo "<img src='$folder' alt='user_image' height='100px' width='100px'/>";
?>
