# JAMstack WordPress

This project is a collection of [WordPress (WP)](https://codex.wordpress.org) utilities that I've made to help me with my [JAMstack](https://jamstack.org) setup. I generally write content on WP, build with [Gatsby](https://www.gatsbyjs.org), and host on [Netlify](https://www.netlify.com).

*The directory structure is meant to mirror your `wp-content` folder.*

## Disclaimers

I'm fairly new to WP development, so I'd appreciate any constructive critique that you're willing to give. Since I'm new, please understand that the **Caveat Emptor** is strong with this project. Please test this stuff in a safe dev environment so that it doesn't hurt your production site.

I want to give credit where credit is due, but I sometimes read a tutorial, start a project, only to come back to it later having lost the original link. If I can credit the original author for the idea, I will. Thanks to the giants upon whose shoulders I stand.

## Plugins

### wp-spwh

**WordPress Save-Post WebHook**

This plugin sends a non-blocking POST request to your endpoint over HTTP/1.1 whenever [`save_post`](https://codex.wordpress.org/Plugin_API/Action_Reference/save_post) or `edit_post` is triggered and the `post_status` is `pubish`, `private`, or `trash`. The sending domain's origin is included in the headers. The `post_id`, `post_title`, and [`post_status`](https://codex.wordpress.org/Function_Reference/get_post_status) that triggered `save_post` are included in the body, as is the `api_key` (if you use that option).

I made this because Netlify allows an incoming WebHook for publishing your site. I use this in the following way:

1. put my Gatsby site on GitHub and set up with Netlify
2. install wp-spwh into WP and set up with [incoming WebHook](https://www.netlify.com/docs/webhooks/) URL
3. comment upon, create, update, delete, or change privacy settings on some content
4. WebHook gets posted to Netlify, which triggers rebuild of site's content

## Themes

### wp-headless-cms

**WordPress Headless CMS**

([original idea](https://blog.daftcode.pl/wordpress-as-a-headless-cms-b4144c626695))

This theme redirects requests so that no front-end content will be displayed to someone who has managed to get to your WP site's front-end. It has a `<meta>` tag redirect (primary) and a `window.location` redirect (backup) built in. I also included a Urchin Tracking Module (UTM) query parameter that identifies the soruce as "`wp_headless_cms_theme`".

Since I generally have a self-hosted WP instance attached as a subdomain to the main site, I use this in the following way:

1. replace both instances of `www.example.com` using WP's theme editor, sending traffic to the `wp-admin` login page
2. check the checkbox "Discourage search engines from indexing this site" in WP's `Settings` > `Reading` section

I also have added a `functions.php` file to contain various functions that might be helpful to using the REST API. Be sure to check that over so that you don't include undesired functionality.
