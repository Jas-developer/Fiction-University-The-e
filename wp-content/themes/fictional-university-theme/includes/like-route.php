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


function createLike($data){
    
    $professorId = $data['professor-id'];

    wp_insert_post(array(
       'post_type' => 'like',
       'post_status' => 'publish',
       'post_title' => 'Like has been Created!',
       'meta_input' => array(
            'like_professor_id' => $professorId
       )
    ));
    

}

function deleteLike(){
    return "You Deleted a LIKE";
}