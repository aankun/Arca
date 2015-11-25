var gulp = require('gulp'),

    // Misc
    fs = require('fs'),
    livereload = require('gulp-livereload'),
    notify = require('gulp-notify'),
    changed = require('gulp-changed'),
    gutil = require('gulp-util'),
    watch = require('gulp-watch'),

    // Styles
    sass = require('gulp-sass'),
    autoprefixer = require('autoprefixer-core'),
    sourcemaps = require('gulp-sourcemaps'),
    postcss = require('gulp-postcss'),
    minifycss = require('gulp-minify-css'),

    // Scripts
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    wrap = require('gulp-wrap'),
    uglify = require('gulp-uglify');

var webroot = './';

var paths = {
    src: webroot + 'src/',
    dist: webroot + 'assets/',
    type: {
        scripts: 'scripts/',
        styles: 'styles/',
        libScripts: 'scripts/lib/',
        libCSS: 'styles/lib/',
        includes: 'template-parts/'
    },
};

var assets = {
    src: {
        scripts: [
            paths.src + paths.type.scripts + '*.js'
        ],
        styles: {
            main: paths.src + paths.type.styles + 'style.scss',
            all: paths.src + paths.type.styles + '*.scss',
        },
        views: [
            webroot + '**/*.php'
        ],
        libScripts: [
            paths.src + paths.type.libScripts + '*.js'
        ],
        libCSS: [
            paths.src + paths.type.libCSS + '*.css'
        ],
    },
    dist: {
        compiled: [
            paths.dist + paths.type.styles + '*.css',
            paths.dist + paths.type.libCSS + '*.css'
        ],
    }
};

/**
 * Default task.
 */
gulp.task('default', ['compile', 'watch'], function () {

});

/**
 * Watch assets for changes.
 */
gulp.task('watch', function () {
    livereload.listen();

    // Watch our views
    watch(assets.src.views, function() {
        gulp.start('views');
    });

    // Watch our styles
    watch(assets.src.styles.all, function() {
        gulp.start('compile-styles');
    });

    // Watch our scripts
    watch(assets.src.scripts, function() {
        gulp.start('compile-scripts');
    });

    // Watch our scripts lib
    watch(assets.src.libScripts, function() {
        gulp.start('compile-libScripts');
    });    

    // Watch our scripts lib
    watch(assets.src.libCSS, function() {
        gulp.start('compile-libCSS');
    });

    // combine CSS
    watch(assets.dist.compiled, function () {
        gulp.start('combine-css');
    });
    
});

/**
 * Compile styles and scripts.
 */
gulp.task('compile', ['compile-styles', 'compile-scripts', 'compile-libScripts', 'compile-libCSS', 'combine-css'], function () {

});

/**
 * Compile styles.
 */
gulp.task('compile-styles', function () {
    var sassOptions = {
        outputStyle: 'compressed',
        errLogToConsole: false
    };

    var autoprefixerOptions = {
        cascade: false
    };

    var fileName = 'styles.min.css'
    var destination = paths.dist + paths.type.styles;

    var handlesassError = function (error) {
        var message = new gutil.PluginError('sass', error.messageFormatted).toString(); // Generate formatted error message

        process.stderr.write('\n' + message + '\n\n'); // Write error to console
        notify().write("ERROR: Compile styles");

        this.emit('end');
    };

    return gulp.src(assets.src.styles.main)
        .pipe(sass(sassOptions).on('error', handlesassError)) // Compile sass files to CSS
        .pipe(postcss([
            autoprefixer(autoprefixerOptions) // Run CSS through Autoprefixer for automatic vendor prefixes
        ]))
        .pipe(concat(fileName)) // Concatenate all scripts to a single file
        .pipe(minifycss())
        .pipe(gulp.dest(destination))
        .pipe(livereload())
        .pipe(notify("Compiled styles"));
});


/**
 * Compile Lib CSS.
 */
gulp.task('compile-libCSS', function () {

    var fileName = 'lib.min.css'
    var destination = paths.dist + paths.type.libCSS;

    var handlesassError = function (error) {
        process.stderr.write('\n' + message + '\n\n'); // Write error to console
        notify().write("ERROR: Compile styles");

        this.emit('end');
    };

    return gulp.src(assets.src.libCSS)
        .pipe(minifycss().on('error', handlesassError))
        .pipe(concat(fileName)) // Concatenate all scripts to a single file
        .pipe(gulp.dest(destination))
        .pipe(livereload())
        .pipe(notify("Compiled CSS Lib"));
});

// combine css files
gulp.task('combine-css', function () {
    var fileName = 'style.css';

    return gulp.src(assets.dist.compiled)
        .pipe(concat(fileName))
        .pipe(gulp.dest(webroot))
        .pipe(livereload())
        .pipe(notify("Css file combined"));

});

/**
 * Compile scripts.
 */
gulp.task('compile-scripts', function () {

    var fileName = 'app.js';
    var destination = paths.dist + paths.type.scripts;

    var handleJsHintError = function (error) {
        notify().write("ERROR: Compile scripts");
        this.emit('end');
    };

    return gulp.src(assets.src.scripts)
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish')) // Use Stylish reporter
        .pipe(jshint.reporter('fail')) // Log error to console
        .on('error', handleJsHintError)
        .pipe(concat(fileName)) // Concatenate all scripts to a single file
        .pipe(uglify())
        .pipe(gulp.dest(destination))
        .pipe(livereload())
        .pipe(notify("Compiled scripts"));
});

/**
 * Compile Lib.
 */
gulp.task('compile-libScripts', function () {

    var fileName = 'lib.min.js';
    var destination = paths.dist + paths.type.libScripts;


    return gulp.src(assets.src.libScripts)
        .pipe(concat(fileName)) // Concatenate all scripts to a single file
        .pipe(uglify())
        .pipe(gulp.dest(destination))
        .pipe(livereload())
        .pipe(notify("Compiled Scripts Lib"));
});

/**
 * Enable livereload for changes to views.
 *
 * @return {Stream}
 */
gulp.task('views', function () {
    return gulp.src(assets.src.views)
        .pipe(livereload());
});