<?php
include __DIR__ . '/../core/header.php';
?>

<?php
if (isset($_GET["id"])) {
    $currentPage = $_GET["id"];
    $sql1 = "SELECT id, columnType FROM paginagrid WHERE pageValue = ? ORDER BY rowPosition ASC;";
    $stmt1 = $con->prepare($sql1);
    if ($stmt1 === false) {
        echo mysqli_error($con);
    }
    $stmt1->bind_param('i', $currentPage);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $paginaGrid = $result->fetch_all(MYSQLI_ASSOC) ?: [];
    $stmt1->close();

    $sql2 = "SELECT informatie, foto, backgroundColor, bold, italic, opacity, kleur FROM paginainfo WHERE whichRow = ? AND colum = ?;";
    $stmt2 = $con->prepare($sql2);
    if ($stmt2 === false) {
        echo mysqli_error($con);
    }
    $stmt2->bind_param('ii', $rowId, $columnID);
    $stmt2->bind_result($informatie, $foto, $backgroundColor, $bolded, $italic, $opacity, $kleur);

    
    $sql3 = "SELECT paginaNaam FROM paginas WHERE id = ?;";
    $stmt3 = $con->prepare($sql3);
    if ($stmt3 === false) {
        echo mysqli_error($con);
    }
    $stmt3->bind_param('i', $currentPage);
    $stmt3->bind_result($paginaNaam);
    if ($stmt3->execute()) {
        $stmt3->fetch();
    }
    $stmt3->close();
}
?>
<div class="page-container">
    <h1 class="page-title"><?= $paginaNaam ?></h1>
<?php
    if (!empty($paginaGrid)){
      foreach ($paginaGrid as $row){
        $rowId = $row['id'];
        $columnType = $row['columnType'];
        ?>
        <div class="rowContainer">
          <?php
          switch ($columnType){
            case 1:
              $columnAmount = 1;
              break;
            case 2:
              $columnAmount = 2;
              break;
            case 3:
              $columnAmount = 2;
              break;
            case 4:
              $columnAmount = 3;
              break;
            default:
              $columnAmount = 1;
              break;
          }
          if ($columnType == 1){
            ?>
            <div class="top-content">
            <?php
          } else if ($columnType == 2 || $columnType == 3){
            ?>
            <div class="middle-content">
            <?php
          } else {
          ?>
          <div class="row<?= $columnType?>">
          <?php
          }
          for ($i = 1; $i < $columnAmount + 1; $i++){
            $columnID = $i;
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->fetch();
            $newOpacity = $opacity / 10;
            if ($foto == 0){
              if ($italic == 1 && $bolded == 1){
                if ($backgroundColor == 1){
                  ?>
                  <div class="coloredColumn">
                  <?php
                } else {
                  ?>
                  <div class="normalColumn">
                  <?php
                }
                ?>

                <p class="home-text italic bold" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>"><?= $informatie ?></p>
                </div>
                <?php
              } else if ($italic == 1){
                if ($backgroundColor == 1){
                  ?>
                  <div class="coloredColumn">
                  <?php
                } else {
                  ?>
                  <div class="normalColumn">
                  <?php
                }
                ?>

                <p class="home-text italic" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>"><?= $informatie ?></p>
                </div>
                <?php
              } else if ($bolded == 1){
                if ($backgroundColor == 1){
                  ?>
                  <div class="coloredColumn">
                  <?php
                } else {
                  ?>
                  <div class="normalColumn">
                  <?php
                }
                ?>

                <p class="home-text bold" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>"><?= $informatie ?></p>
                </div>
                <?php
              } else {
                if ($backgroundColor == 1){
                  ?>
                  <div class="coloredColumn">
                  <?php
                } else {
                  ?>
                  <div class="normalColumn">
                  <?php
                }
                ?>

                <p class="home-text" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>"><?= $informatie ?></p>
                </div>
                <?php
              }
            } else {
              if ($columnType == 1){
                ?>
                <div class="top-image">
                  <img class="team-image" src="assets/img/fotos/<?= $informatie ?>" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>" alt="foto">
                </div>
                <?php
            } else {
              ?>
              <img src="assets/img/fotos/<?= $informatie ?>" style="opacity:<?=$newOpacity?>; color:<?=$kleur?>" alt="foto">
              <?php
            }
          }
          }
          ?>
            </div>
            </div>
           
            <?php
      }
    }
          ?>
</div>
<?php
include __DIR__ . '/../core/footer.php';
?>