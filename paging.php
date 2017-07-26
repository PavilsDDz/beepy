<?php

    include ('assets/connect.php');

?>

<body>


    <?php 

        $results_per_page = 10;


        $sql = "SELECT * FROM products";
        $stmt = getAllDataFromDatabase($sql);

        // foreach ($stmt as $row){
        
        //     echo $row['brand'];
        //     echo "<br>";
        //     echo $row['cartype'];
        //     echo "<br>";
        //     echo $row['model'];
        //     echo "<br>";
        //     echo "<br>";
        // }

        $number_of_results = count($stmt);

        $number_of_pages = ceil($number_of_results/$results_per_page);

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $this_page_first_result = ($page-1)*$results_per_page;

        $sql='SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $stmt = getAllDataFromDatabase($sql);

        foreach ($stmt as $row){
        
            echo $row['brand'];
            echo "<br>";
            echo $row['cartype'];
            echo "<br>";
            echo $row['model'];
            echo "<br>";
            echo "<br>";
        }

        for ($page=1; $page<=$number_of_pages; $page++){

            echo '<a href="paging.php?page='. $page .'">' . $page . '</a> ';
        }
    ?>



</body>