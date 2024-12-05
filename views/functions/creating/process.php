<?php include_once __DIR__ . '/../../../core/admin_header.php'; ?>
<div class="cmsContainer">
    <p class="cmsTitle">Pagina configuratie</p>
    <form action="?view=creating" method="post" enctype="multipart/form-data">
        <label for="naam">Pagina Naam:</label>
        <input type="text" id="naam" name="naam" required>

        <input type="submit" value="Pagina toevoegen">
    </form>
</div>
</body>

</html>