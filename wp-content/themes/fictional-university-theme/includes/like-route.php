<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes(){

    register_rest_route( 'university/v1', 'manageLike', 
    array(
     'methods' => 'POST',
     'callback' => 'createLike'
    ));

    register_rest_route( 'university/v1/', 'manageLike',
    array(
      'methods' => 'DELETE',
      'callback' => 'deleteLike'
    ));

};


function createLike(){
    return "You Created a LIKE" ;
}

function deleteLike(){
    return "You Deleted a LIKE";
}