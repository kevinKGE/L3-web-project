    <script type="text/javascript">
       function favoris(idCocktail){
            console.log(idCocktail);
            var img = document.getElementById(idCocktail);

            if (img.getAttribute("src") == "../public/photos/heart_empty.png"){
                img.setAttribute("src", "../public/photos/heart_full.png");
            }else{
                img.setAttribute("src", "../public/photos/heart_empty.png");
            }
        }
    </script>

    <?php
    if (isset($_GET['recipe'])) {
        echo "<div class='recipe'>";
        foreach ($Recettes as $index_recipe => $recipes) {
            if ($recipes['titre'] == $_GET['recipe']) {
                $title = $recipes[array_keys($recipes)[0]];
                $ingredients = $recipes[array_keys($recipes)[1]];
                $preparations = $recipes[array_keys($recipes)[2]];
                $index = $recipes[array_keys($recipes)[3]];
                $res =  get_index($title);
                $ingredients_split = split_chain($ingredients, '|');
                $preparations_split = split_chain($preparations, '.');

                $name = valid_name($title);

                if (!file_exists("../public/photos/" . $name)) {
                    $name = 'cocktail.png';
                }

                echo "<center><h3> $title </h3></center>";
                echo "<br>";

                echo '<center><img src="../public/photos/' . $name . '" alt="img" width="200"></center>';
                echo "<br>";

                echo "<u><h4>Liste d'ingrédient :</h4></u>";
                echo "<ul>";
                foreach ($ingredients_split as $key => $ingredient) {
                    echo "<li>" . $ingredient . "</li>";
                }
                echo "</ul>";

                echo "<br>";
                echo "<u><h4>Préparation :</h4></u>";
                echo "<ol>";
                foreach ($preparations_split as $key => $preparation) {
                    echo "<li>" . $preparation . "</li>";
                }
                echo "</ol>";
            }
        }
        echo "</div>";
    } else if (isset($_POST['submit3'])) {
    } else {
        // Show all the cocktails in the list 
        foreach ($cocktails as $recipes) {
            $title = $recipes[array_keys($recipes)[0]];
            $index = $recipes[array_keys($recipes)[3]];
            $res =  get_index($title);


            $name = valid_name($title);

            if (!file_exists("../public/photos/" . $name)) {
                $name = 'cocktail.png';
            }

            echo "<div class='card' style='width: 18rem;'>";

        echo "<button type='button' id='button' onclick='favoris('.$res.');'> <img id=''.$res.'' src='../public/photos/heart_full.png'></button>";

            echo '<img src="../public/photos/' . $name . '" alt="img" width="100">';
            echo "<div class='card-body'>";

            echo "<h5 class='card-title'>";
            echo "<a href='?recipe=" . $title . "'>" . $title . "</a>";
            echo "</h5>";
            echo "<p class='card-text'> <ul>";
            foreach ($index as $key => $value) {
                echo "<li>" . $value . "</li>";
            }
            echo "</ul> </p>";
            echo "</div>";
            echo "</div>";
        }
    }

    ?>