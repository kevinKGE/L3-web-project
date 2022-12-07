<?php
    foreach ($Recettes as $index_recipe => $recipes){
        if($recipes['titre'] == $_GET['recipe']){
            $title = $recipes[array_keys($recipes)[0]];
            $ingredients = $recipes[array_keys($recipes)[1]];
            $preparation = $recipes[array_keys($recipes)[2]];
            $index = $recipes[array_keys($recipes)[3]];

            $name = valid_name($title);

            if(!file_exists("../public/photos/".$name)){
                $name = 'cocktail.png';
            }

            echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';
            echo " ' . $ingredients . ' ";
            echo " ' . $preparation . ' ";
            echo "<ul>";
            foreach($index as $key => $value){ 
                echo "<li>" . $value . "</li>";
            }
        echo "</ul>";
        }
    }
?>