<?php
// Multidimensional array configured to read images from a local 'fruit-img' directory
$fruits = [
    [
        "name" => "Mango (Mangga)",
        "image" => "fruit-img/mango.jpg",
        "description" => "Color Yellow/Green. Sweet, juicy, and fleshy.",
        "facts" => "The Philippine Carabao Mango is internationally recognized as one of the sweetest mango varieties in the world."
    ],
    [
        "name" => "Rambutan",
        "image" => "fruit-img/rambutan.jpg",
        "description" => "Color Red/Green. Hairy exterior with translucent flesh.",
        "facts" => "The name comes from the Malay word 'rambut', meaning hair. The sweet flesh inside is very similar to a lychee."
    ],
    [
        "name" => "Mangosteen",
        "image" => "fruit-img/mangosteen.jpg",
        "description" => "Color Dark Purple. Thick rind with snow-white segments.",
        "facts" => "Often referred to as the 'Queen of Fruits', it is highly prized in Southeast Asia for its perfect balance of sweet and tangy flavors."
    ],
    [
        "name" => "Jackfruit (Langka)",
        "image" => "fruit-img/jackfruit.jpg",
        "description" => "Color Yellow-Green. Massive size with a spiky exterior.",
        "facts" => "It is the largest tree-borne fruit in the world. In the Philippines, it's eaten raw when ripe or cooked as a vegetable in coconut milk when unripe."
    ],
    [
        "name" => "Papaya",
        "image" => "fruit-img/papaya.jpg",
        "description" => "Color Orange/Yellow. Soft, buttery flesh with black seeds.",
        "facts" => "Green, unripe papaya is a staple ingredient in the classic Filipino chicken soup, Tinola, and is also pickled to make Atchara."
    ],
    [
        "name" => "Guava (Bayabas)",
        "image" => "fruit-img/guava.jpg",
        "description" => "Color Green/Pink. Crisp exterior with edible seeds.",
        "facts" => "Rich in Vitamin C, the sourness of native Philippine guavas is a traditional and highly popular base for Sinigang broth."
    ],
    [
        "name" => "Dragonfruit (Pitaya)",
        "image" => "fruit-img/dragonfruit.jpg",
        "description" => "Color Bright Pink. Scaly skin with speckled, kiwi-like flesh.",
        "facts" => "Despite its exotic tropical appearance, this fruit actually grows on a climbing species of cactus that blooms only at night."
    ],
    [
        "name" => "Coconut (Buko)",
        "image" => "fruit-img/coconut.jpg",
        "description" => "Color Green/Brown. Hard shell containing water and meat.",
        "facts" => "Known as the 'Tree of Life'. Every single part of the coconut palm can be used, from the fruit and leaves to the trunk and roots."
    ],
    [
        "name" => "Banana (Saging)",
        "image" => "fruit-img/banana.jpg",
        "description" => "Color Yellow. Elongated and curved.",
        "facts" => "The Philippines is one of the world's top exporters of bananas. Local varieties like Saba are widely used for street foods like Turon and Banana Cue."
    ],
    [
        "name" => "Pineapple (Pinya)",
        "image" => "fruit-img/pineapple.jpg",
        "description" => "Color Yellow/Brown. Spiky, tough skin with a leafy crown.",
        "facts" => "Beyond being a delicious fruit, the leaves of the Red Spanish pineapple variety are used in the Philippines to weave Piña, a luxurious traditional textile."
    ]
];

// Pre-defined function to sort the array alphabetically by the 'name' key
usort($fruits, function($a, $b) {
    return strcmp($a['name'], $b['name']);
}); // Fixed syntax error by adding the missing semicolon

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tropical Fruit Directory</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f2a15; 
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            
            background-blend-mode: overlay;
            opacity: 0.95; 
            
            color: #333;
            padding: 0 0 20px;
            max-width: 1134px;
            margin: 0 auto;
        }
        
        h2 {
            margin: 20px 0;
            text-align: center;
            color: #def2cd;
            font-size: 2.2em;
        }

        .table-wrapper {
            max-width: 1000px;
            background-color: #f8fff9;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(52, 219, 94, 0.5);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #eeeeee;
            border-right: 1px solid #eeeeee;
            vertical-align: middle;
            font-size: 1.05em;
            font-weight: 500;
        }

        th:last-child, td:last-child {
            border-right: none;
        }

        .list-header-row {
            background-color: #289a45;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.2em;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 10px;
        }

        .column-headers th {
            background-color: #ffffff;
            color: #3f7c4c;
            font-weight: 700;
            font-size: 1.1em;
            border-bottom: 2px solid #34db5e;
        }

        tbody tr:nth-of-type(even) {
            background-color: #e5fdeb;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
            transition: background-color 0.2s ease;
        }

        tbody tr:last-of-type td {
            border-bottom: none;
        }

        .fruit-name {
            font-weight: 700;
            color: #0f2a15;
        }
        
        .fruit-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
            border: 2px solid #e0e0e0;
            background-color: #f0f0f0; 
        }
        
        .facts-cell {
            text-align: left;
            padding: 12px 20px;
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <h2>Fruit Directory</h2>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th colspan="4" class="list-header-row">Native Philippine Fruits</th>
                </tr>
                <tr class="column-headers">
                    <th style="width: 15%;">Image</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 25%;">Description</th>
                    <th style="width: 45%;">Facts</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterate through the sorted multidimensional array using foreach loop
                foreach ($fruits as $fruit) {
                    echo "<tr>";
                    echo "<td><img class='fruit-image' src='" . htmlspecialchars($fruit['image']) . "' alt='" . htmlspecialchars($fruit['name']) . "'></td>";
                    echo "<td class='fruit-name'>" . htmlspecialchars($fruit['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($fruit['description']) . "</td>";
                    echo "<td class='facts-cell'>" . htmlspecialchars($fruit['facts']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>