<?php 


require get_theme_file_path('./includes/search-routes.php');



//added new custom field

function university_custom_rest(){
  register_rest_field( 'post', 'authorName', array(
    'get_callback' => function() { return  get_the_author( ); }
  ) );
}

add_action('rest_api_init', 'university_custom_rest');

// PAGE BANNNER
function pageBanner($args = NULL) {
         
        if(!isset($args['title']) ||  $args['title'] == " "){
          $args['title'] = get_the_title();
        }
       
        if(!isset($args['subtitle']) ||  $args['subtitle'] == " "){
          $args['subtitle'] = get_field('page_banner_subtitle');
        }

        if(!isset($args['photo']) || $args['photo'] == " " ) {
          if(get_field('page_banner_background_image') && !is_archive(  ) && !is_home(  )){
             $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
          }else{
             $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
          }
        }
 
  ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 
      echo $args['photo']
     ?>)">
    </div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php 
              echo $args['subtitle']
            ?></p>  
      </div>
    </div>
  </div>

<?php 
 }
function university_files()
{
    wp_enqueue_script('main-universityjs', get_theme_file_uri('/build/index.js'), array('jquery'),filemtime(get_theme_file_path('/build/index.js')), true);
    wp_enqueue_style("custom-google-fonts", '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style("font-awesome", '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style("university_main_styles", get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style("university_extra_styles", get_theme_file_uri('/build/index.css'));

  wp_enqueue_style(
    'university-main-styles',
    get_theme_file_uri('/build/index.css'),
    array(),
    filemtime(get_theme_file_path('/build/index.css'))
  );



  wp_localize_script('main-universityjs', 'universityData', array(
     'archive_routes' => array(
      'root_url' => home_url(),
      'event_archive'   => get_post_type_archive_link('event'),
      'program_archive' => get_post_type_archive_link('program'),
      'professor_archive' => get_post_type_archive_link('professor'),
      'nonce' => wp_create_nonce( 'wp_rest' ),
     )

  ));
};

add_action('wp_enqueue_scripts', 'university_files');

function university_features()
{
 add_theme_support( 'title-tag' );
 add_theme_support('post-thumbnails');
 add_image_size('professorLandscape', 400, 260, true );
 add_image_size('professorPortrait', 480, 650, true );
 add_image_size('pageBanner', 1500, 350, true );
}

add_action( 'after_setup_theme', 'university_features' );


function university_adjust_queries($query){

   if(!is_admin() && is_post_type_archive( 'program' ) && is_main_query() ){
     $query->set('orderby','title');
     $query->set('order', 'ASC');
     $query->set('posts_per_page', -1);
   }

    $today = date('Ymd');
    if($query->is_main_query() && !is_admin() && is_post_type_archive( 'event' )){
         $query->set('posts_per_page','4');
         $query->set("orderby", 'meta_value_num');
         $query->set("order",'ASC');
         $query->set('meta_key','event_date');
         $query->set('meta_query',array(
          array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
          )));
       }
    };


//pre get post
add_action('pre_get_posts', 'university_adjust_queries');




// Redirect subscriber or user accounts out of admin and onto  homepage instead
function redirectSubsToFrontend(){
   $ourCurrentUser = wp_get_current_user();

   if(count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber'){
      wp_redirect(home_url( '/' ) );
      exit();
   }


}

add_action('admin_init', 'redirectSubsToFrontend');



// remove subscriber admin bar
function noSubsAdminBar(){
   $ourCurrentUser = wp_get_current_user();

   if(count($ourCurrentUser->roles) == 1 && $ourCurrentUser->roles[0] == 'subscriber'){
      show_admin_bar( false );
   }
}

add_action('wp_loaded', 'noSubsAdminBar');


// redirect login logo
function ourHeaderUrl(){
    return esc_url(site_url('/'));
};


add_filter('login_headerurl', 'ourHeaderUrl');


// customize login screen style
function custom_login_logo() {
    ?>
    <style>
        body.login {
            background-color: #111; /* Change login background color */
            background-size: cover;
            color:white;
        }

        .login .wp-login-logo a {
            background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/apples.jpg'); /* Use Site Icon */
            background-size: contain;
            width: 100px;
            height: 100px;
            display:hidden;
            opacity: 100;
            index:-1;

        
        }

        #loginform{
          background-color:Blue;
          color:white;
          border-radius:20px;
          border:none;
          font-weight:500;
        }

        #loginform label{
          font-size:18px;
        }
        
        .submit #wp-submit{
          background-color:orange;
        }
          
        .privacy-policy-link{
          color:transparent
        }


    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
             const loginTitle = document.querySelector('.login .wp-login-logo a').textContent = "Login to your account now";
             const userLoginText = document.querySelector('#loginform p label').textContent = "ENTER EMAIL OR USERNAME";
            // password text
            const userPasswordText = document.querySelector(".user-pass-wrap label").textContent = 'ENTER YOUR PASSWORD';
            // button change text
            const loginButtonText = document.getElementById('wp-submit').value = 'LOGIN NOW';

            const backToLogText = document.querySelector('#backtoblog a').textContent = '<- Back to Home'

        });
    </script>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_logo');


