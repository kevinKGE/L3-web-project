<?php

if (isset($_GET['recipe'])) {//if we are in a detail page of recipe
?>
    <div class='recipe'>
        <?php
        foreach ($Recettes as $index_recipe => $recipes) { // foreach the list of recipe to find the one we want
            if ($recipes['titre'] == $_GET['recipe']) { // if we find the recipe we want
                $title = $recipes[array_keys($recipes)[0]]; // get the title of the recipe
                $ingredients = $recipes[array_keys($recipes)[1]]; // get the ingredients of the recipe
                $preparations = $recipes[array_keys($recipes)[2]]; // get the preparations of the recipe
                $index = $recipes[array_keys($recipes)[3]]; // get the index of the recipe
                $res =  get_index($title); // get the index of the recipe
                $ingredients_split = split_chain($ingredients, '|'); // split the ingredients in an array 
                $preparations_split = split_chain($preparations, '.'); // split the preparations in an array
                $name = valid_name($title); // get the name of the image

                if (!file_exists("../public/photos/" . $name)) { // if the image doesn't exist we put a default image
                    $name = 'cocktail.png';
                }
        ?>
                <div class="in_detail_recipe">
                    <h3> <?php echo $title; ?> </h3>
                    <button class="button" id="<?php echo $res; ?>"> 
                <?php if (isset($_SESSION['favorites_temp']) || isset($favorites)){
                    if(isset($_SESSION['favorites_temp'])){
                            $favorites_temp = $_SESSION['favorites_temp'];
                        }else{
                            $favorites_temp = array();
                        }
                        if(isset($favorites)){
                            $favorite = $favorites;
                        }else{
                            $favorite = array();
                        }

                    if (in_array($res, $favorites_temp) || in_array($res, $favorite)) {
                        ?><img src="../public/photos/heart_full.png" alt=""><?php
                    } else {
                        ?><img src="../public/photos/heart_empty.png" alt=""><?php
                    }
                } else {
                    ?><img src="../public/photos/heart_empty.png" alt=""><?php
                }?>
            </button>
                    <br>

                    <img src="../public/photos/<?php echo $name; ?>" alt="" width="200">
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
        $title = $recipes[array_keys($recipes)[0]]; // get the title of the recipe
        $index = $recipes[array_keys($recipes)[3]]; // get the index of the recipe
        $res =  get_index($title); // get the index of the recipe
        $name = valid_name($title); // get the name of the image 

        if (!file_exists("../public/photos/" . $name)) { // if the image doesn't exist we put a default image
            $name = 'cocktail.png';
        }

    ?>
        <div class="card" style="width: 18rem;">

            <button class="button" id="<?php echo $res; ?>">
                <?php if (isset($_SESSION['favorites_temp']) || isset($favorites)){
                        if(isset($_SESSION['favorites_temp'])){
                            $favorites_temp = $_SESSION['favorites_temp'];
                        }else{
                            $favorites_temp = array();
                        }
                        if(isset($favorites)){
                            $favorite = $favorites;
                        }else{
                            $favorite = array();
                        }

                    if (in_array($res, $favorites_temp) || in_array($res, $favorite)) {
                        ?><img alt="" src="../public/photos/heart_full.png"><?php
                    } else {
                        ?><img alt="" src="../public/photos/heart_empty.png"><?php
                    }
                } else {
                    ?><img alt="" src="../public/photos/heart_empty.png"><?php
                }?>
            </button>
            <img src="../public/photos/<?php echo $name; ?>" alt="" width="100">
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
            </div>
        </div>
<?php
    }
}
?>

<script>
    // this jQuery method is used to change the heart icon when the user click on it
    $('.button').on('click', function() {
        var img = $(this).find('img');
        if (img.attr('src').match('../public/photos/heart_empty.png')) {
            img.attr('src', '../public/photos/heart_full.png');
        } else {
            img.attr('src', '../public/photos/heart_empty.png');
        }

        // this jQuery method is used to send the index of the cocktail to the favorites_like.inc.php file
        $.ajax({
            url: '../public/favorites_like.inc.php',
            type: 'GET',
            data: {
                index: (this.id)
            }
        });
    });
</script>