<?php
/*
Plugin Name: 超輕量FB LINE TWITTER 分享外掛
Plugin URI: https://github.com/it-monk-team/Wordpress-Line-FB-Twitter-share
Description: 超輕量FB LINE TWITTER 分享外掛
Version: 1.0
Author: it-monk
Author URI: https://it-monk.com/
License: MIT
*/

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles',20 );
function enqueue_parent_styles() {
    
	wp_enqueue_script('line-share', 'https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js');
	wp_enqueue_script('fb-share', 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v3.0');
	wp_enqueue_script('twitter-share', 'https://platform.twitter.com/widgets.js');
    
    
}

add_filter( 'the_content', 'place_share_button_after_content',1 );
function place_share_button_after_content($content){

    // WP 內判斷是否為 單篇內容
    if( is_single() ){
    	
    	// 取得文章網址	
    	$PostUrl = get_permalink();

        // 在文章內容最後面加一個 share-btn-here 的 div 準備放按鈕
		$content.= "<ul class=\"js-social-share\">";
		$content.= "<li class=\"fb\">"."<div class=\"fb-like\" data-href=\"".$PostUrl."\" data-layout=\"button_count\" data-action=\"like\" data-size=\"small\" data-share=\"true\"></div>"."</li>";
		$content.= "<li>"."<div class=\"line-it-button\" data-lang=\"zh_Hant\" data-type=\"share-a\" data-ver=\"3\" data-url=\"".$PostUrl."\" data-color=\"default\" data-size=\"small\" data-count=\"true\" style=\"display: none;\"></div>"."</li>";
		$content.= "<li>"."<a href=\"https://twitter.com/share\" class=\"twitter-share-button\">Tweet</a>"."</li>";
		$content.= "</ul>";

    }

    return $content;
}


add_action( 'wp_head', 'lite_share_btn_list_style',1 );
function lite_share_btn_list_style()
{
    // WP 內判斷是否為 單篇內容
    if( is_single() ):

        // 取得文章網址
        $PostUrl = get_permalink();

        ?>
        <style>
            .js-social-share {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                padding-left: 0;
                line-height: 1;
                list-style: none;
            }
            .js-social-share li {
               margin-right: 1rem;
				height: 22px;

            }
            .js-social-share li.fb {
				
				width: 110px;
			}
        </style>
    <?php
    endif;
}