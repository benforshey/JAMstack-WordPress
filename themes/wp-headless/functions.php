 <?php
// Allow anonymous comments over REST API v2
function filter_rest_allow_anonymous_comments () {
    return true;
}

add_filter('rest_allow_anonymous_comments', 'filter_rest_allow_anonymous_comments');
