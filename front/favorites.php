<?php
    session_start();
    require_once 'source/head.php';
    require_once 'source/header.php';
    require_once '../public/functions.inc.php';

    ?>
    <nav id='nav_index'>
    <div class="strong_front">
            Liste des favoris :
        </div>
    </nav>
    <main>
    <?php
    if (!empty($_SESSION['favorites_temp'])) {
        foreach ($_SESSION['favorites_temp'] as $index => $index_recipes) {
            foreach($Recettes as $index_r => $recipes)
            if ($index_recipes == $index_r){
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
                        <?php if (isset($_SESSION['favorites_temp'])){
                            if (in_array($res, $_SESSION['favorites_temp'])) {
                                ?><img src="../public/photos/heart_full.png"><?php
                            } else {
                                ?><img src="../public/photos/heart_empty.png"><?php
                            }
                        } else {
                            ?><img src="../public/photos/heart_empty.png"><?php
                        }?>
                    </button>
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
    }
    ?>
    
    
    </main>

<script>

    $('.button').on('click', function() {
        var img = $(this).find('img');
        if(img.attr('src').match('../public/photos/heart_empty.png')) {
            img.attr('src', '../public/photos/heart_full.png');
        } else {
            img.attr('src', '../public/photos/heart_empty.png');
        }

        $.ajax({
            url: '../public/like.php',
            type: 'GET',
            data: {
                indice: (this.id)
            },
            complete: function(data){
                location.reload();
            }
        });
        
    }
    );
</script>