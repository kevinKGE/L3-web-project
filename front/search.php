<?php
    $query = isset($_GET['query']) ? $_GET['query'] : null;
    
if(!$query){
    $result = [
        'status' => true,
        'message' => 'No query provided'
    ];
    return;
}

$query = trim($query);

// The search must only containe letters, double quotes, spaces, +, -
if(preg_match_all('/[^a-zÀ-ú" +-]/i', $query)){
    $result = [
        'status' => true,
        'message' => 'Query contains multiple words'
    ];
    return;
}

//Normal treatment

$result = [
    'status' => true,
    'exclude' => [],
    'include' => [],
    'unknown' => [],
    'data' => [],
];

preg_match_all('/[-+]?"[^"]+"|[^ ]+/', $query, $matches);

if(substr_count($query, '"') % 2 != 0){
    $result = [
        'status' => true,
        'message' => 'Query contains multiple words'
    ];
    return;
}

foreach($matches[0] as $matches)
{
    $firstCharacter = substr($matches, 0, 1);

    if($firstCharacter == '-' || $firstCharacter == '+'){
        $matches = substr($matches, 1);
    }

    $matches = trim($matches, '"');
    /// If the first letter is a '-', we don't want this ingredient.

    if($firstCharacter == '-'){
        if(isset($result['exclude'][$matches])){
            if(!in_array($matches, $result['exclude'])){
                $result['exclude'][] = $matches;
            }
    } else {
        $result['unknown'][] = $matches;
    }
}
    else
    {
        if(isset($result['include'][$matches])){
            if(!in_array($matches, $result['include'])){
                $result['include'][] = $matches;
            }
        } else {
            $result['unknown'][] = $matches;
        }
    }
    
}

/** 
 * For each recipe, we will look for all the common points
 * and assign them a score according to this principle:
 * If the ingredient is requested +1; otherwise -1
 * At the output, we can therefore sort according to this score to make an efficient search,
 * the higher the score, the closer to what the user wanted */
foreach($Recipes as $recipe){
    $score = 0;
    foreach($recipe['ingredients'] as $ingredient){
        if(in_array($ingredient, $result['include'])){
            $score++;
        } else if(in_array($ingredient, $result['exclude'])){
            $score--;
        }
    }
    $result['data'][] = [
        'score' => $score,
        'recipe' => $recipe
    ];
}

function cmp($a, $b){
    return $a['score'] < $b['score'];
}

usort($result['data'], 'cmp');
