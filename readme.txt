== Arca ==

Hi. I'm a starter theme called Arca. I'm a theme based on _s, i meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.

=== Features ===

- Gulp ( Sass, concat, jshint, livereload, minify-css, notify, postcss, uglify, wrap )
-  Multilingual support


=== Instalation ===

- Clone the repository to your WP theme directory `git clone https://github.com/adiardana/Arca.git`
- Go inside arca folder using terminal then type `npm install` to install all the dependencies ( make sure you already install node js )
- Open `gulpfile.js` and then change the `url` variable with your local site url eg: `wp.dev`
- Run `gulp` in your terminal to execute the gulp file, after that gulp will automatically open a new window to your site
- To check on mobile go to url `http://your-site-ip-address:3000` to check the site with browsersync feature ( note: you mobile must be using same network with the server ) or
- Go to `https://arca.localtunnel.me` if you're not in the same network ( Note: browsersync feature will not working so you need to refresh manually every time you make a change )


=== Built In Functions ===

- `get_the_image();` ( libs/extends/get-the-image.php ) plugin by justin tadlock, this function will make it easier to grab an image from custom fields, post attachment, etc. [Docs](https://github.com/justintadlock/get-the-image)
- `placeholder();` ( libs/inc/theme-functions.php:22 ) a simple function to generate placeholder image based on [placehold.it](http://placehold.it)
- `limit();` ( libs/inc/theme-functions.php:99 ) limit string
- `wp_pagination();` ( libs/inc/theme-functions.php:115 ) add numeric pagination to wordpress looping


=== Credits ===

- Starter Theme Based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)