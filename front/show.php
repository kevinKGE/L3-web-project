<?php
    // Show ll the cocktails in the list 
    foreach($new_cocktails as $recipes){
        $title = $recipes[array_keys($recipes)[0]];
        $index = $recipes[array_keys($recipes)[3]];
        //$like = ...

        $name = valid_name($title);

        echo "<p>".$title."</p>";
        
        var_dump($name);

        echo "<br>";
    }
    

?>