<?php
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

//allow upload file type
function restrict_file_types($mime_types)
{
    $mime_types = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon',
        'svg'          => 'image/svg+xml',
        'pdf'          => 'application/pdf',
        'ppt'          => 'application/vnd.ms-powerpoint',
        'pptx'         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'xls'          => 'application/vnd.ms-excel',
        'xlsx'         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'mp4'          => 'video/mp4'
    );
    return $mime_types;
}
add_filter('upload_mimes', 'restrict_file_types', 1, 1);

add_filter('pll_the_languages_args', function ($args) {
    $args['display_names_as'] = 'slug';
    return $args;
});
function current_year_shortcode()
{
    $current_year = date('Y');
    return $current_year;
}
add_shortcode('footer_current_year', 'current_year_shortcode');

function custom_rewrite_home_url()
{
    // Check if Polylang is active
    if (function_exists('pll_current_language')) {
        // Check if the current language is 'en'
        if (pll_current_language() === 'en') {
            add_rewrite_rule('^en/contact-2/?$', 'en/contact/', 'top');
        }
    }
}
add_action('init', 'custom_rewrite_home_url');

add_action('wp_footer', 'custom_footer_script', 99);
function custom_footer_script()
{

    if (is_page(752)) {
?>
        <script>
            //  function getOverlayHeight() {
            //             var windowWidth = jQuery(window).width();

            //             if (windowWidth >= 770 && windowWidth <= 1024) {
            //                 // Tablet view
            //                 return "84%";
            //             } else {
            //                 // Desktop view
            //                 return "76%";
            //             }
            //         }
            console.log('752');
            jQuery(document).ready(function() {
                jQuery(window).on('load resize', function() {
                    console.log('resized');


                    // var windowWidth = jQuery(window).width();
                    // var overlayHeightPercentage = 76;

                    // if (windowWidth >= 770 && windowWidth <= 1024) {
                    //     console.log('INNNNNNNNN');
                    //     overlayHeightPercentage = 84;
                    // }
                    "use strict";
                    if (document.readyState !== 'loading') init();
                    else document.addEventListener('DOMContentLoaded', init);

                    function init() {
                        if (window.runOnce) return;

                        if (typeof YT === 'undefined') {
                            var tag = document.createElement('script');
                            tag.src = "https://www.youtube.com/iframe_api";
                            var firstScriptTag = document.getElementsByTagName('script')[0];
                            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                        }

                        var videoMappings = {
                            "https://www.youtube.com/embed/lGeSkcftE44": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/image.png",
                            "https://www.youtube.com/embed/uBSHWSAfs7I": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/card.png",
                            "https://www.youtube.com/embed/W8N-q60w-7k": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/image-1-1.png",
                            // Add more video URLs and their corresponding overlay images as needed
                        };

                        var iframes = [];

                        for (var iframe of document.querySelectorAll("iframe[src]")) {
                            var src = iframe.getAttribute("src");
                            if (src.includes("youtube.com/embed/")) {
                                if (!src.includes("enablejsapi=1"))
                                    if (src.includes("?"))
                                        iframe.setAttribute("src", src + "&enablejsapi=1");
                                    else
                                        iframe.setAttribute("src", src + "?enablejsapi=1");

                                iframes.push({
                                    iframe,
                                    overlay: videoMappings[src],
                                    player: null
                                });
                            }
                        }

                        window.onYouTubeIframeAPIReady = function() {
                            iframes.forEach(function(item) {
                                var iframe = item.iframe;
                                var overlayImage = item.overlay;
                                var player;

                                var overlay = document.createElement('div');
                                overlay.classList.add('responsive-overlay-class');
                                overlay.style.position = "absolute";
                                overlay.style.width = "100%";
                                overlay.style.height = "100%";
                                overlay.style.backgroundImage = "url('" + overlayImage + "')"; // Set overlay image
                                overlay.style.backgroundRepeat = "no-repeat";
                                overlay.style.backgroundPosition = "center";
                                overlay.style.backgroundSize = "cover";
                                overlay.style.cursor = "pointer";
                                overlay.style.borderRadius = "10px";

                                var wrapper = document.createElement('div');
                                wrapper.style.position = "relative";
                                wrapper.style.display = "inline-block";

                                iframe.parentNode.insertBefore(wrapper, iframe);

                                wrapper.appendChild(overlay);
                                wrapper.appendChild(iframe);

                                overlay.addEventListener("click", function() {
                                    if (!player) {
                                        player = new YT.Player(iframe, {
                                            events: {
                                                'onReady': function(event) {
                                                    player.playVideo();
                                                    overlay.style.display = "none";
                                                },
                                                'onStateChange': function(event) {
                                                    if (event.data == YT.PlayerState.ENDED) {
                                                        overlay.style.display = "inline-block";
                                                    } else if (event.data == YT.PlayerState.PAUSED) {
                                                        // Change the overlay image based on the current video
                                                        switch (iframe.getAttribute("src")) {
                                                            case "https://www.youtube.com/embed/lGeSkcftE44":
                                                                overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-image.png";
                                                                // overlay.classList.add('responsive-overlay');
                                                                overlay.style.height = getOverlayHeight();
                                                                break;
                                                            case "https://www.youtube.com/embed/uBSHWSAfs7I":
                                                                overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-card.png";
                                                                // overlay.classList.add('responsive-overlay');
                                                                overlay.style.height = getOverlayHeight();
                                                                break;
                                                            case "https://www.youtube.com/embed/W8N-q60w-7k":
                                                                overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-image-1-1.png";
                                                                // overlay.classList.add('responsive-overlay');
                                                                overlay.style.height = getOverlayHeight();
                                                                break;
                                                                // Add more cases for additional video URLs
                                                        }


                                                        overlay.style.backgroundImage = "url('" + overlayImage + "')";
                                                        overlay.style.backgroundSize = "cover";
                                                        overlay.style.bottom = "50px";
                                                        overlay.style.display = "inline-block";
                                                        overlay.style.borderRadius = "0px";
                                                        overlay.style.width = "100%";
                                                        overlay.style.height = ""; // Use the adjusted height;
                                                        // Remove previous responsive height classes
                                                        overlay.classList.remove('overlay-height-76', 'overlay-height-84');

                                                        // Add the appropriate responsive height class based on the window width
                                                        if (window.innerWidth >= 776 && window.innerWidth <= 1024) {
                                                            overlay.classList.add('overlay-height-84');
                                                        } else if(window.innerWidth >= 465 && window.innerWidth <= 766){
                                                            overlay.classList.add('overlay-height-81');
                                                        }else if(window.innerWidth <= 775){
                                                            overlay.classList.add('overlay-height-74');
                                                        }else {
                                                            overlay.classList.add('overlay-height-76');
                                                        }
                                                    } else if (event.data == YT.PlayerState.PLAYING) {
                                                        overlay.style.display = "none";
                                                    }
                                                }
                                            }
                                        });
                                        item.player = player; // Save the player instance for future use
                                    } else {
                                        var playerState = player.getPlayerState();
                                        if (playerState == YT.PlayerState.ENDED) {
                                            player.seekTo(0);
                                        } else if (playerState == YT.PlayerState.PAUSED) {
                                            player.playVideo();
                                        }
                                    }
                                });
                            });
                        };
                        window.runOnce = true;
                    }
                });

            });
        </script>
    <?php
    }


    if (is_page(547)) {
    ?>
        <script>
            "use strict";
            if (document.readyState !== 'loading') init();
            else document.addEventListener('DOMContentLoaded', init);

            function init() {
                if (window.runOnce) return;

                if (typeof YT === 'undefined') {
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                }

                var videoMappings = {
                    "https://www.youtube.com/embed/lGeSkcftE44": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/image.png",
                    "https://www.youtube.com/embed/uBSHWSAfs7I": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/card.png",
                    "https://www.youtube.com/embed/W8N-q60w-7k": "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/image-1-1.png",
                    // Add more video URLs and their corresponding overlay images as needed
                };

                var iframes = [];

                for (var iframe of document.querySelectorAll("iframe[src]")) {
                    var src = iframe.getAttribute("src");
                    if (src.includes("youtube.com/embed/")) {
                        if (!src.includes("enablejsapi=1"))
                            if (src.includes("?"))
                                iframe.setAttribute("src", src + "&enablejsapi=1");
                            else
                                iframe.setAttribute("src", src + "?enablejsapi=1");

                        iframes.push({
                            iframe,
                            overlay: videoMappings[src],
                            player: null
                        });
                    }
                }

                window.onYouTubeIframeAPIReady = function() {
                    iframes.forEach(function(item) {
                        var iframe = item.iframe;
                        var overlayImage = item.overlay;
                        var player;

                        var overlay = document.createElement('div');
                        overlay.classList.add('yt_video-overlay');
                        overlay.style.position = "absolute";
                        overlay.style.width = "100%";
                        overlay.style.height = "100%";
                        overlay.style.backgroundImage = "url('" + overlayImage + "')"; // Set overlay image
                        overlay.style.backgroundRepeat = "no-repeat";
                        overlay.style.backgroundPosition = "center";
                        overlay.style.backgroundSize = "cover";
                        overlay.style.cursor = "pointer";
                        overlay.style.borderRadius = "10px";

                        var wrapper = document.createElement('div');
                        wrapper.style.position = "relative";
                        wrapper.style.display = "inline-block";

                        iframe.parentNode.insertBefore(wrapper, iframe);

                        wrapper.appendChild(overlay);
                        wrapper.appendChild(iframe);

                        overlay.addEventListener("click", function() {
                            if (!player) {
                                player = new YT.Player(iframe, {
                                    events: {
                                        'onReady': function(event) {
                                            player.playVideo();
                                            overlay.style.display = "none";
                                        },
                                        'onStateChange': function(event) {
                                            if (event.data == YT.PlayerState.ENDED) {
                                                overlay.style.display = "inline-block";
                                            } else if (event.data == YT.PlayerState.PAUSED) {
                                                // Change the overlay image based on the current video
                                                switch (iframe.getAttribute("src")) {
                                                    case "https://www.youtube.com/embed/lGeSkcftE44":
                                                        overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-image.png";
                                                        break;
                                                    case "https://www.youtube.com/embed/uBSHWSAfs7I":
                                                        overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-card.png";
                                                        break;
                                                    case "https://www.youtube.com/embed/W8N-q60w-7k":
                                                        overlayImage = "http://localhost/sharonkroes-divi/wp-content/uploads/2024/02/updated-image-1-1.png";
                                                        break;
                                                        // Add more cases for additional video URLs
                                                }

                                                overlay.style.backgroundImage = "url('" + overlayImage + "')";
                                                overlay.style.backgroundSize = "cover";
                                                overlay.style.bottom = "50px";
                                                overlay.style.display = "inline-block";
                                                overlay.style.borderRadius = "0px";
                                                overlay.style.width = "100%";
                                                overlay.style.height = "84%";
                                            } else if (event.data == YT.PlayerState.PLAYING) {
                                                overlay.style.display = "none";
                                            }
                                        }
                                    }
                                });
                                item.player = player; // Save the player instance for future use
                            } else {
                                var playerState = player.getPlayerState();
                                if (playerState == YT.PlayerState.ENDED) {
                                    player.seekTo(0);
                                } else if (playerState == YT.PlayerState.PAUSED) {
                                    player.playVideo();
                                }
                            }
                        });
                    });
                };
                window.runOnce = true;
            }
        </script>
<?php
    }
}
