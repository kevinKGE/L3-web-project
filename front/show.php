<?php
    // Show all the cocktails in the list 
    foreach($cocktails as $recipes){
        $title = $recipes[array_keys($recipes)[0]];
        $index = $recipes[array_keys($recipes)[3]];

        $name = valid_name($title);

        if(!file_exists("../public/photos/".$name)){
            $name = 'cocktail.png';
        }

        echo "<div class='card' style='width: 18rem;'>";
            echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';
            echo "<div class='card-body'>";
                echo "<h5 class='card-title'>";
                    echo "<a href='recette.php?id=" . $title . "'>" . $title . "</a>"; 
                echo "</h5>";
            echo "<p class='card-text'> <ul>";
                foreach($index as $key => $value){ 
                    echo "<li>" . $value . "</li>";
                }
            echo "</ul> </p>";
            echo "</div>";
        echo "</div>";       
    }
?>