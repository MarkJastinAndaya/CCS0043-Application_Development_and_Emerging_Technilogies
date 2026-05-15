<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>
    <link rel="stylesheet" href="style-multiplication-table.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=sync_alt" />
</head>
<body>
    <div class = "app">
        <div class = "app-content">
            <div class="app-content-card">
                <div class = "table-title">
                    Multiplication Table
                </div>
                <div class = "table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>&times;</th>
                                <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    echo "<th>$i</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($row = 1; $row <= 10; $row++) {
                                echo "<tr>";

                                echo "<th>$row</th>";
                                
                                for ($col = 1; $col <= 10; $col++) {
                                    $product = $row * $col;
                                    
                                    $class = ($row == $col) ? "diagonal" : "";
                                    
                                    echo "<td class='$class'>$product</td>";
                                }

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table> 
                </div>
                
            </div> 
        </div>
        <footer>
            <p>Tchnical Summative Assessment 1 - Mark Jastin Andaya</p>
        </footer>
    </div>
</body>

</html>