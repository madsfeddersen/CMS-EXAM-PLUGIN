<?php
/*
Plugin Name: Random quotes - Mez
Plugin URI:
Description: This is just a simple plugin. When activated, you will see random quotes from various people
Author: Mads Christian Feddersen
Author URI:
Version: 1.0.0
*/
Defined('ABSPATH') or die("How did you get here? Leave this place at once!");

$url1='https://talaikis.com/api/quotes/random/';


//This function gets the quotes that are currently hardcoded. It also randomizes the quotes.
function hello_random_get_quote()
{
    /*
        $quotes = "Don't worry about what anybody else is going to do. The best way to predict the future is to invent it. Alan Kay
        Premature optimization is the root of all evil (or at least most of it) in programming. Donald Knuth
        Nothing is impossible, the word itself says I'm possible. Audrey Hepburn
        I’ve learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel. Maya Angelou
        To handle yourself, use your head; to handle others, use your heart. Eleanor Roosevelt
        Do or do not. There is no try. Master Yoda
        Strive not to be a success, but rather to be of value. Albert Einstein
        The only way to do great work is to love what you do. Steve Jobs
        Remember that not getting what you want is sometimes a wonderful stroke of luck. Dalai Lama
        I would rather die of passion than of boredom. Vincent van Gogh";

        $q = explode( "\n", $quotes );
    // wptexturize returns given text with transformations of quotes to smart quotes, apostrophes, dashes etc.
        return wptexturize( $q[ mt_rand( 0, count( $q ) - 1 ) ] );
    */
    $output = "";

    $data = file_get_contents(esc_url('https://talaikis.com/api/quotes/random/'));
    $output = json_decode($data);
    if ($output == true) {

        $output = $output->quote;
        // $output = "<script>window.location = 'http://www.easv.dk';</script>";
        $output = filter_var($output, FILTER_SANITIZE_STRING);
    }

    return $output;
}

//This function echoes out the randomly selected quote.
function hello_random()
    {$quote = hello_random_get_quote();

    //The "notice-success" and "is-dismissible" makes the admin notice dismissible, if a user wants to remove it
        echo "<div class='notice notice-success is-dismissible'><p><strong>Hello there! Here is your quote!</strong></p>
        <p id='random'>$quote</p></div>";
    }

//This function adds a bit of CSS styling to the quotes
function add_random_css()
    {
        echo
        "<style type='text/css'>
            #random 
            {
                font-size: 14px;
                padding-left: 5px;
                padding-top: 0px;
                margin-top: -10px;
                font-style: italic;		
            }
            </style>";
    }

//This function adds the notices that is seen under the main title of the given page
add_action('admin_notices', 'hello_random');
add_shortcode('shortcode_random', 'hello_random');
add_action( 'admin_head', 'add_random_css' );


