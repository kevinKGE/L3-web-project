<?php
    if(isset($_GET['recipe'])){
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
    }else{
        // Show all the cocktails in the list 
    foreach($cocktails as $recipes){
        $title = $recipes[array_keys($recipes)[0]];
        $index = $recipes[array_keys($recipes)[3]];

        $name = valid_name($title);

        if(!file_exists("../public/photos/".$name)){
            $name = 'cocktail.png';
        }

        echo "<div class='card' style='width: 18rem;'>";

            
        //<a><img class='heart' id=\"".$Recette['titre']."\" height=\"20\" width=\"20\" src=\"../Photos/coeur.png\"/></a>
            echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';
            echo "<div class='card-body'>";

            /*echo "<input type='radio' name='demo3' class='demo3 demoyes' id='demo3-a' checked>";
            echo "<label for='demo3-a'><img src='../public/photos/heart_empty' alt='heart full green'></label>";
            echo "<input type='radio' name='demo3' class='demo3 demono' id='demo3-b' >";
            echo "<label for='demo3-b'><img src='../public/photos/heart_full' alt='heart full green'></label>";*/
            
                echo "<h5 class='card-title'>";
                    echo "<a href='?recipe=" . $title . "'>" . $title . "</a>"; 
                echo "</h5>";
            echo "<p class='card-text'> <ul>";
                foreach($index as $key => $value){ 
                    echo "<li>" . $value . "</li>";
                }
            echo "</ul> </p>";
            echo "</div>";
        echo "</div>";       
    }
    }
    
?>