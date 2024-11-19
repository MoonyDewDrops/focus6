<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation process</title>
</head>

<body>
    <div class="addPhoto">
        <p>Pagina configuratie</p>
        <form action="creating" method="post" enctype="multipart/form-data">


            <label for="naam">Pagina Naam:</label><br>
            <input type="text" id="naam" name="naam" required><br>

            <label for="photo">Photo:</label><br>
            <input type="file" id="photo" name="photo" required><br>

            <input type="submit" value="Add Photo">
        </form>
    </div>
</body>

</html>