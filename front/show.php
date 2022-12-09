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
        ?>
            <div class='recipe'>
        <?php
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

                ?>
                <div class="in_detail_recipe">
                    <h3> <?php echo $title; ?> </h3>
                    <br>

                    <img src="../public/photos/<?php echo $name; ?>" alt="img" width="200">
                    <br>
                </div>

                <div class="detail_recipe">
                    <h4>Liste d'ingrédient :</h4>
                </div>

                <ul>
                    <?php
                        foreach ($ingredients_split as $key => $ingredient) {
                            ?><li><?php echo $ingredient; ?></li><?php
                        }
                    ?>
                </ul>

                <br>

                <div class="detail_recipe">
                    <h4>Préparation :</h4>
                </div>

                <ol>
                    <?php
                        foreach ($preparations_split as $key => $preparation) {
                            ?><li><?php echo $preparation; ?></li><?php
                        }
                    ?>
                </ol>
                <?php
            }
        }
        ?>
            </div>
        <?php

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

            ?>
                <div class="card" style="width: 18rem;">
                    <button type="button" id="button" onclick="favoris(<?php $res ?>);"> <img id="<?php $res ?>" src="../public/photos/heart_full.png"></button>
                    <img src="../public/photos/<?php echo $name; ?>" alt="img" width="100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="?recipe=<?php echo $title; ?>"><?php echo $title; ?></a>
                        </h5>
                        <p class='card-text'> 
                            <ul>

                                <?php
                                    foreach ($index as $key => $value) {
                                        ?><li> <?php echo $value; ?> </li> <?php
                                    }
                                ?>

                            </ul> 
                        </p>
                    </div>
                </div>
            <?php
        }
    }

?>