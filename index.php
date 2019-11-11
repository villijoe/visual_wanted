<?php
session_start();

require_once('conn_db.php');
require_once('add_theme.php');
require_once('get_themes.php');
//print_r($catalogs);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visual Wanted</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui.theme.min.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="popup_add_want.js"></script>
</head>
<body>
    <form method="post" action="/">
        <div>
            <span>Add theme: </span>
            <input type="text" name="theme" />
            <input type="submit" value="Add" />
        </div>
    </form>

    <div id="dialog-form" title="Add new wanted">
        <p class="validateTips">All form fields are required.</p>

        <form>
            <fieldset>
                <label for="name">Name</label><br />
                <input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all"><br />
                <label for="description">Description</label><br />
                <input type="text" name="description" id="description" value="" class="text ui-widget-content ui-corner-all"><br />
                <label for="img">Photo</label><br />
                <input type="text" name="img" id="img" value="" class="text ui-widget-content ui-corner-all"><br />
                <label for="price">Price</label><br />
                <input type="text" name="price" id="price" value="" class="text ui-widget-content ui-corner-all"><br />
                <label for="link">Link</label><br />
                <input type="text" name="link" id="link" value="" class="text ui-widget-content ui-corner-all"><br />

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

    <div id="catalogs">
        <?php
        foreach($catalogs as $catalog) {
            echo '<div class="catalog" id="' . $catalog['id'] . '">';
            echo $catalog['name'];
            echo '</div>';
        }
        ?>
    </div>
    <div id="list"></div>
</body>
</html>
