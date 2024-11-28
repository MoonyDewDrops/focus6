<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="?view=createSocial" method="post" enctype="multipart/form-data">

    <label for="photo">Photo:</label><br>
    <input type="file" id="photo" name="photo"><br>
    
    <label for="media">Social media:</label><br>
      <input type="text" id="media" name="media" required><br>

      <label for="Link">Link:</label><br>
      <textarea type="text" id="Link" name="Link" required></textarea><br>

      <input type="submit" value="Add social">
    </form>
</body>
</html>