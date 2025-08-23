<?php  

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
    register_rest_route( 'university/v1', '/search', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'universitySearchResults'
    ));
}


function universitySearchResults($data){
    $mainQuery = new WP_Query(array(
        'post_type' => array('professor','page','post', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        
    );

    while($mainQuery->have_posts()){
        $mainQuery->the_post();

        if(get_post_type() == 'post' || get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
            'title' => get_the_title(),
            'permalink' => get_permalink(),
            'postType' => get_post_type(),
            'authorName' => get_the_author()
        ));
        };


        if(get_post_type() == 'professor'){
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'image' => get_the_post_thumbnail_url(null,'professorLandscape')
            ));
        }

        if(get_post_type() == 'program'){
           array_push($results['programs'], array(
            'title' => get_the_title(),
            'permalink' => get_permalink(),
            'id' => get_the_ID()
           ));
        }
        
       if(get_post_type() == 'event'){

         $event__date = get_field('event_date');
         $event = new DateTime($event__date);
         $description = null;
        

        if(has_excerpt() ){ 
            $description = get_the_excerpt(); } 
         else{ 
            $description = wp_trim_words(get_the_content(), 18); 
         }


         array_push($results['events'], array(
            'title' => get_the_title(),
            'permalink' => get_permalink(),
            'month' => $event->format('M'),
            'day' => $event->format('d'),
            'description' => $description
         ));
       }
    };
     
     
     if(count($results['programs'])){
        $programsMetaQuery = array('relation' => 'OR');

     foreach($results['programs'] as $item){
            array_push($programsMetaQuery, [
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => $item['id']
            ]);
     }


     $programRelationshipQuery = new WP_Query(
        array(
          'post_type' => ['professor','event'],
          'meta_query' => $programsMetaQuery
        )
     );


    while($programRelationshipQuery->have_posts()){
        $programRelationshipQuery->the_post();

        if(get_post_type() == 'professor'){
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'image' => get_the_post_thumbnail_url(null,'professorLandscape')
            ));
        }

    }
    
    $results['professors'] = array_values(array_unique($results['professors'], SORT_REGULAR));
    $results['events'] = array_values(array_unique($results['events'], SORT_REGULAR));

     }

    return $results;
}