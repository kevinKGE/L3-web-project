<?php
    // Show all the cocktails in the list 
    foreach($cocktails as $recipes){
        echo "<div>";
        $title = $recipes[array_keys($recipes)[0]];
        $index = $recipes[array_keys($recipes)[3]];

        $name = valid_name($title);

        if(!file_exists("../public/photos/".$name)){
            $name = 'cocktail.png';
        }
        
        echo "<p>" .$title. "</p>";
        
        var_dump($name);

        echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';

        echo "<br>";
        echo "</div>";
    }
    

?>