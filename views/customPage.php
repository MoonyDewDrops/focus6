    <?php


    include_once __DIR__ . '/../core/db_connect.php';

    $page_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Default to 0 if not provided

    if ($page_id > 0) {
        // Prepare the SQL query
        $sql = "
        SELECT 
            p.id AS page_id,
            p.paginaNaam AS page_name,
            pg.id AS grid_id,
            pg.rowPosition AS grid_row_position,
            pg.columnType AS grid_column_type,
            pi.id AS info_id,
            pi.informatie AS info_text,
            pi.colum AS info_column,
            pi.foto AS info_foto,
            pi.backgroundColor AS info_background_color
        FROM paginas AS p
        LEFT JOIN paginagrid AS pg ON pg.pageValue = p.id
        LEFT JOIN paginainfo AS pi ON pi.whichRow = pg.id
        WHERE p.id = ?
        ORDER BY pg.rowPosition, pi.id;
    ";

        // Prepare and bind parameters
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $page_id);

        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Process the results
        $page = null;
        $grids = [];

        while ($row = $result->fetch_assoc()) {
            // Initialize the page object
            if ($page === null) {
                $page = [
                    "page_id" => $row["page_id"],
                    "page_name" => $row["page_name"],
                    "grids" => []
                ];
            }

            // Group grids
            $grid_id = $row["grid_id"];
            if (!isset($grids[$grid_id])) {
                $grids[$grid_id] = [
                    "grid_id" => $grid_id,
                    "grid_row_position" => $row["grid_row_position"],
                    "grid_column_type" => $row["grid_column_type"],
                    "info" => []
                ];
            }

            // Add info to the grid if available
            if ($row["info_id"] !== null) {
                $grids[$grid_id]["info"][] = [
                    "info_id" => $row["info_id"],
                    "info_text" => $row["info_text"],
                    "info_column" => $row["info_column"],
                    "info_foto" => $row["info_foto"],
                    "info_background_color" => $row["info_background_color"]
                ];
            }
        }

        // Add grids to the page object
        if ($page !== null) {
            $page["grids"] = array_values($grids);
        }

        // Output the formatted result in JSON
    }

    // Close the connection
    $con->close();
    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepagina</title>
    </head>

    <body>
        <?php include __DIR__ . '/../core/header.php'; ?>

        <main class="homepage">
            <h1 class="page-title"><?= $page["page_name"] ?></h1>

            <?php
            foreach ($page['grids'] as $grid) {

                switch ($grid['grid_column_type']) {
                    case 1:
                        $grid_template = "1fr"; // Single item filling the grid
                        break;
                    case 2:
                        $grid_template = "75% 25%"; // 25% left, 75% right
                        break;
                    case 3:
                        $grid_template = "25% 75%"; // 75% left, 25% right
                        break;
                    case 4:
                        $grid_template = "1fr 1fr 1fr"; // 3 items equally divided
                        break;
                    default:
                        $grid_template = "1fr"; // Fallback to single column
                }
            ?>


                <div style="background-color: blue; padding: 10px; margin: 10px; display: grid; grid-template-columns: <?= $grid_template ?>; gap: 5px">
                    <?php
                    if (!empty($grid['info'])) {

                        // Loop through the info entries of the grid
                        foreach ($grid['info'] as $info) { ?>
                            <div style="background-color: white;">
                                <?php
                                echo "  Info ID: " . $info['info_id'] . "\n";
                                echo "  Info Text: " . $info['info_text'] . "\n";
                                echo "  Info Column: " . $info['info_column'] . "\n";
                                echo "  Foto: " . ($info['info_foto'] ? "Yes" : "No") . "\n";
                                echo "  Background Color: " . $info['info_background_color'] . "\n";
                                ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

            <?php
            }
            ?>
        </main>

        <?php include __DIR__ . '/../core/footer.php'; ?>
    </body>

    </html>