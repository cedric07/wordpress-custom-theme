/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification.
 *      2. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      3. Watches files for changes in CSS or JS.
 *
 * @author Cédric
 * @version 1.0.0
 */

/**
 * Configuration.
 */

// NPM directory
var npmDir = './node_modules';

// Style Vendor related.
var styleVendorSRC = [ // Path to Vendor CSS files
    //npmDir + '/your-vendor-file.css',
    './src/css/lib/*.css'
];
var styleVendorDestination = './dist/css/'; // Path to place the compiled CSS file.
var styleVendorFile = 'vendors'; // Compiled CSS file name.

// Style editor
var styleEditorSrc = './src/sass/style-editor.scss';
var styleEditorDestination = './dist/css/';
var styleEditorFile = 'style-editor'; // Compiled CSS file name.

// Style Custom related.
var styleSRC = './src/sass/main.scss'; // Path to SCSS files
var styleDestination = './dist/css/'; // Path to place the compiled CSS file.
var styleMainFile = 'custom'; // Compiled CSS file name.

// JS Vendor related.
var jsVendorSRC = [ // Path to JS vendor files
    npmDir + '/jquery/dist/jquery.js',
    './src/js/lib/*.js'
];
var jsVendorDestination = './dist/js/'; // Path to place the compiled JS vendors file.
var jsVendorFile = 'vendors'; // Compiled JS vendors file name.

// JS Custom related.
var jsCustomSRC = './src/js/*.js'; // Path to JS custom scripts folder.
var jsCustomDestination = './dist/js/'; // Path to place the compiled JS custom scripts file.
var jsCustomFile = 'custom'; // Compiled JS custom file name.

// Images
var imgSrc = './src/img/*.{png,jpg,jpeg,gif,svg}'; // Path to source images folder.
var imgDestination = './dist/img/'; // Path to place the optimised images.

// Watch files paths.
var styleVendorWatchFiles = './src/css/lib/*.css'; // Path to all vendor CSS files.
var styleWatchFiles = './src/sass/**/*.scss'; // Path to all *.scss files inside css folder and inside them.
var vendorJSWatchFiles = './src/js/lib/*.js'; // Path to all vendor JS files.
var customJSWatchFiles = './src/js/*.js'; // Path to all custom JS files.
var imagesWatchFiles = './src/img/*.{png,jpg,jpeg,gif,svg}'; // Path to all images files.


const {src, dest, watch, series, parallel} = require('gulp');
const gulpLoadPlugins = require('gulp-load-plugins');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const del = require('del');

const $ = gulpLoadPlugins();

function styles() {
    return src(styleSRC)
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sassGlob())
        .pipe($.sass.sync({
            errLogToConsole: true,
            outputStyle: 'expanded',
            precision: 10,
            includePaths: ['.']
        }).on('error', $.notify.onError({
            message: "<%= error.message %>",
            title: "Error Custom styles"
        })))
        .pipe($.postcss([
            autoprefixer()
        ]))
        .pipe($.sourcemaps.write())
        .pipe($.concat(styleMainFile + '.css'))
        .pipe(dest(styleDestination))
        .pipe($.rename({
            basename: styleMainFile,
            suffix: '.min'
        }))
        .pipe($.postcss([
            cssnano()
        ]))
        .pipe(dest(styleDestination))
        .pipe($.notify('Custom styles Completed! 💯'))
}

function stylesVendors() {
    return src(styleVendorSRC)
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sass.sync({
            errLogToConsole: true,
            outputStyle: 'expanded',
            precision: 10,
            includePaths: ['.']
        }).on('error', $.notify.onError({
            message: "<%= error.message %>",
            title: "Error Vendors styles"
        })))
        .pipe($.postcss([
            autoprefixer()
        ]))
        .pipe($.sourcemaps.write())
        .pipe($.concat(styleVendorFile + '.css'))
        .pipe(dest(styleVendorDestination))
        .pipe($.rename({
            basename: styleVendorFile,
            suffix: '.min'
        }))
        .pipe($.postcss([
            cssnano()
        ]))
        .pipe(dest(styleVendorDestination))
        .pipe($.notify('Vendors styles Completed! 💯'))
}

function stylesEditor() {
    return src(styleEditorSrc)
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.sassGlob())
        .pipe($.sass.sync({
            errLogToConsole: true,
            outputStyle: 'expanded',
            precision: 10,
            includePaths: ['.']
        }).on('error', $.notify.onError({
            message: "<%= error.message %>",
            title: "Error Editor styles"
        })))
        .pipe($.postcss([
            autoprefixer()
        ]))
        .pipe($.sourcemaps.write())
        .pipe($.concat(styleEditorFile + '.css'))
        .pipe(dest(styleEditorDestination))
        .pipe($.rename({
            basename: styleEditorFile,
            suffix: '.min'
        }))
        .pipe($.postcss([
            cssnano()
        ]))
        .pipe(dest(styleEditorDestination))
        .pipe($.notify('Editor styles Completed! 💯'))
}

function scripts() {
    var onError = function (err) {
        console.log(err.toString());
        this.emit('end');
    };

    return src(jsCustomSRC)
        .pipe($.plumber())
        .pipe($.jshint())
        .pipe($.jshint.reporter())
        .pipe($.jshint.reporter('fail'))
        .on("error", $.notify.onError({
            title: "JSHint Error",
            message: "<%= error.message %>"
        }))
        .pipe($.concat(jsCustomFile + '.js').on('error', onError))
        .pipe(dest(jsCustomDestination))
        .pipe($.rename({
            basename: jsCustomFile,
            suffix: '.min'
        }))
        .pipe($.uglify().on('error', onError))
        .pipe(dest(jsCustomDestination))
        .pipe($.notify('Custom scripts Completed! 💯'))
}

function scriptsVendor() {
    var onError = function (err) {
        console.log(err.toString());
        this.emit('end');
    };

    return src(jsVendorSRC)
        .pipe($.plumber())
        .pipe($.concat(jsVendorFile + '.js').on('error', onError))
        .pipe(dest(jsVendorDestination))
        .pipe($.rename({
            basename: jsVendorFile,
            suffix: '.min'
        }))
        .pipe($.uglify().on('error', onError))
        .pipe(dest(jsVendorDestination))
        .pipe($.notify('Vendors scripts Completed! 💯'))
}

function images() {
    return src(imgSrc)
        .pipe($.imagemin())
        .pipe(dest(imgDestination))
        .pipe($.notify('Images minification Completed! 💯'))
}

function clean() {
    return del(['./dist']);
}

function cleanImages() {
    return del(imgDestination);
}

function watchAssets() {
    watch(styleVendorWatchFiles, stylesVendors); // Reload on Vendor CSS file changes.
    watch(styleWatchFiles, series(styles, stylesEditor)); // Reload on SCSS file changes.
    watch(vendorJSWatchFiles, scriptsVendor); // Reload on vendorsJs file changes.
    watch(customJSWatchFiles, scripts); // Reload on customJS file changes.
    watch(imagesWatchFiles, series(cleanImages, images)); // Reload on images changes.
}

const build = series(
    clean,
    parallel(styles, stylesEditor, stylesVendors, scripts, scriptsVendor, images)
);

const watcher = series(build, watchAssets);

exports.default = build;
exports.watch = watcher;
