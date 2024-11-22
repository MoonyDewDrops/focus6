<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_POST);
    foreach ($_POST as $key => $value) {
        ?>
        <div style="border: 1px solid blue; padding: 5px;">
            <?php
        if (is_array($value)) {
            foreach ($value as $key2 => $value2) {
                ?>
                <div style="border: 1px solid red; padding: 5px;">
                    <?php
                if (is_array($value2)) {
                    foreach ($value2 as $key3 => $value3) {
                        echo $key . ' ' . $key2 . ' ' . $key3 . ' ' . $value3 . '<br>';
                    }
                }
                ?>
                </div>
                <?php
            }

        }
        ?>
        </div>
        <?php
    }
}