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
                    <button class="button" id="<?php echo $res; ?>">
                <?php if (isset($_SESSION['favorites_temp'])){
                    if (in_array($res, $_SESSION['favorites_temp'])) {
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
        $title = $recipes[array_keys($recipes)[0]];
        $index = $recipes[array_keys($recipes)[3]];
        $res =  get_index($title);
        $name = valid_name($title);

        if (!file_exists("../public/photos/" . $name)) {
            $name = 'cocktail.png';
        }

    ?>
        <div class="card" style="width: 18rem;">

            <button class="button" id="<?php echo $res; ?>">
                <?php if (isset($_SESSION['favorites_temp'])) {
                    if (in_array($res, $_SESSION['favorites_temp'])) {
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
                </p>
            </div>
        </div>
<?php
    }
}
?>

<script>
    $('.button').on('click', function() {
        var img = $(this).find('img');
        if (img.attr('src').match('../public/photos/heart_empty.png')) {
            img.attr('src', '../public/photos/heart_full.png');
        } else {
            img.attr('src', '../public/photos/heart_empty.png');
        }

        $.ajax({
            url: '../public/favorites_like.inc.php',
            type: 'GET',
            data: {
                index: (this.id)
            }
        });
    });
</script>