/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      2. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      3. Watches files for changes in CSS or JS.
 *      4. Corrects the line endings.
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
	'./src/css/lib/_variables-vendors.scss',
	'./src/css/lib/*.css'
];
var styleVendorDestination = './dist/css/'; // Path to place the compiled CSS file.
var styleVendorFile = 'vendors'; // Compiled CSS file name.

// Style Custom related.
var styleSRC = [ // Path to SCSS files
	'./src/sass/*.scss/',
];
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

// Watch files paths.
var styleVendorWatchFiles = [ // Path to all vendor CSS files.
	'./src/css/lib/*.css',
	'./src/css/lib/_variables-vendors.scss'
];
var styleWatchFiles = './src/sass/**/*.scss'; // Path to all *.scss files inside css folder and inside them.
var vendorJSWatchFiles = './src/js/lib/*.js'; // Path to all vendor JS files.
var customJSWatchFiles = './src/js/*.js'; // Path to all custom JS files.


// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
	'last 2 version',
	'> 1%',
	'ie >= 9',
	'ie_mob >= 10',
	'ff >= 30',
	'chrome >= 34',
	'safari >= 7',
	'opera >= 23',
	'ios >= 7',
	'android >= 4',
	'bb >= 10'
];

// STOP Editing Project Variables.

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
var gulp = require('gulp'); // Gulp of-course

// CSS related plugins.
var sass = require('gulp-sass'); // Gulp pluign for Sass compilation.
var sassGlob = require('gulp-sass-glob'); // Gulp plugin for Sass import global
var minifycss = require('gulp-uglifycss'); // Minifies CSS files.
var autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic.
var mmq = require('gulp-merge-media-queries'); // Combine matching media queries into one media query definition.

// JS related plugins.
var concat = require('gulp-concat'); // Concatenates JS files
var uglify = require('gulp-uglify'); // Minifies JS files

// Utility related plugins.
var rename = require('gulp-rename'); // Renames files E.g. style.css -> style.min.css
var lineec = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
var filter = require('gulp-filter'); // Enables you to work on a subset of the original files by filtering them using globbing.
var sourcemaps = require('gulp-sourcemaps'); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)
var notify = require('gulp-notify'); // Sends message notification to you
var plumber = require('gulp-plumber'); //Prevent pipe breaking caused by errors from gulp plugins

var gutil = require('gulp-util');

/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 */
gulp.task('styles', function () {
	gulp.src(styleSRC)
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sassGlob())
		.pipe(sass({
			errLogToConsole: true,
			outputStyle: 'compact',
			// outputStyle: 'compressed',
			// outputStyle: 'nested',
			// outputStyle: 'expanded',
			precision: 10
		}))
		.pipe(concat(styleMainFile + '.css'))
		.on('error', console.error.bind(console))
		.pipe(sourcemaps.write({includeContent: false}))
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(autoprefixer(AUTOPREFIXER_BROWSERS))

		.pipe(sourcemaps.write('./'))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(styleDestination))

		.pipe(filter('**/*.css')) // Filtering stream to only css files
		//.pipe(mmq({log: true})) // Merge Media Queries only for .min.css version.

		.pipe(rename({
			basename: styleMainFile,
			suffix: '.min'
		}))
		.pipe(minifycss({
			maxLineLen: 0
		}))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(styleDestination))

		.pipe(filter('**/*.css')) // Filtering stream to only css files
		.pipe(notify({message: 'TASK: "styles" Completed! 💯', onLast: true}))
});

gulp.task('stylesVendor', function () {
	gulp.src(styleVendorSRC)
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass({
			errLogToConsole: true,
			outputStyle: 'compact',
			// outputStyle: 'compressed',
			// outputStyle: 'nested',
			// outputStyle: 'expanded',
			precision: 10
		}))
		.pipe(concat(styleVendorFile + '.css'))
		.on('error', console.error.bind(console))
		.pipe(sourcemaps.write({includeContent: false}))
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(autoprefixer(AUTOPREFIXER_BROWSERS))

		.pipe(sourcemaps.write('./'))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(styleVendorDestination))

		.pipe(filter('**/*.css')) // Filtering stream to only css files
		//.pipe(mmq({log: true})) // Merge Media Queries only for .min.css version.

		.pipe(rename({
			basename: styleVendorFile,
			suffix: '.min'
		}))
		.pipe(minifycss({
			maxLineLen: 0
		}))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(styleVendorDestination))

		.pipe(filter('**/*.css')) // Filtering stream to only css files
		.pipe(notify({message: 'TASK: "styles vendor" Completed! 💯', onLast: true}))
});

/**
 * Task: `vendorJS`.
 *
 * Concatenate and uglify vendor JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS vendor files
 *     2. Concatenates all the files and generates vendors.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates vendors.min.js
 */
gulp.task('vendorsJs', function () {
	gulp.src(jsVendorSRC)
		.pipe(plumber())
		.pipe(concat(jsVendorFile + '.js'))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(jsVendorDestination))
		.pipe(rename({
			basename: jsVendorFile,
			suffix: '.min'
		}))
		.pipe(uglify())
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(jsVendorDestination))
		.pipe(notify({message: 'TASK: "vendorsJs" Completed! 💯', onLast: true}));
});


/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task('customJS', function () {

	var onError = function (err) {
		gutil.log(gutil.colors.green(err.message));
		this.emit('end');
	};

	gulp.src(jsCustomSRC)
		.pipe(plumber())
		.pipe(concat(jsCustomFile + '.js').on('error', onError))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(jsCustomDestination))
		.pipe(rename({
			basename: jsCustomFile,
			suffix: '.min'
		}))
		.pipe(uglify().on('error', onError))
		.pipe(lineec()) // Consistent Line Endings for non UNIX systems.
		.pipe(gulp.dest(jsCustomDestination))
		.pipe(notify({message: 'TASK: "customJs" Completed! 💯', onLast: true}));
});

/**
 * Default Tasks.
 */
gulp.task('default', ['stylesVendor', 'styles', 'vendorsJs', 'customJS']);

/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task('watch', ['default'], function () {
	gulp.watch(styleVendorWatchFiles, ['stylesVendor']); // Reload on Vendor CSS file changes.
	gulp.watch(styleWatchFiles, ['styles']); // Reload on SCSS file changes.
	gulp.watch(vendorJSWatchFiles, ['vendorsJs']); // Reload on vendorsJs file changes.
	gulp.watch(customJSWatchFiles, ['customJS']); // Reload on customJS file changes.
});
