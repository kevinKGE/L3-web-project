<?php
/* work in progress ...
function user_already_registered($userRequest) {
    foreach($users as $user){
        if ($userRequest.$email === $user.$email) {
            return true;
        }
    }
    return false;
}
*/

function user_signup($user){
    // if(!user_already_registered($user)){
        array_push($users, $user);
    // }
}