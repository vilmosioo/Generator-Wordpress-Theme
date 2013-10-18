'use strict';

/* globals require, module */

module.exports = function(grunt) {
	// load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	var pkg = grunt.file.readJSON('package.json');

	// Project configuration.
	grunt.initConfig({
		pkg: pkg,
		config: pkg.config || {
			app: 'app',
			dist: 'dist'
		},
		clean: {
			dist: ['<%%= config.dist %>']
		},
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%%= config.app %>/**/*.js',
				'!<%%= config.app %>/**/*.min.js'
			]
		},
		watch: {
			general: {
				files: ['<%%= config.app %>/js/**/*.js', '.tmp/*.css'],
				tasks: ['build']
			},
			templates: {
				files: ['<%%= config.app %>/**/*.php', '<%%= config.app %>/**/*.html'],
				tasks: ['copy:templates']
			},
			compass: {
				files: ['<%%= config.app %>/**/*.scss'],
				tasks: ['compass']
			}
		},
		compass: {
			dist: {
				options: {
					sassDir: '<%%= config.app %>',
					cssDir: '.tmp',
					importPath: 'components/bootstrap-sass/lib'
				}
			}
		},
		cssmin: {
			options: {
				keepSpecialComments: 1
			},
			minify: {
				expand: true,
				cwd: '.tmp',
				src: '**/*.css',
				dest: '<%%= config.dist %>'
			}
		},
		uglify: {
			options: {
				banner: '/*! <%%= pkg.name %> - v<%%= pkg.version %> */',
				preserveComments: false
			},
			dist: {
				expand: true,
				cwd: '<%%= config.app %>',
				src: '**/*.js',
				dest: '<%%= config.dist %>'
			}
		},
		copy: {
			templates: {
				expand: true,
				cwd: '<%%= config.app %>',
				src: [
					'**/*.{php,html,css,ico,txt}',
					'**/*.{png,jpg,jpeg,gif}',
					'**/*.{webp,svg}',
					'**/*.{eot,svg,ttf,woff}',
					'**/*.{md}'
				],
				dest: '<%%= config.dist %>'
			},
			dist: {
				expand: true,
				cwd: '<%%= config.app %>',
				src: [
					'**/*.{png,jpg,jpeg,gif}',
					'**/*.{webp,svg}',
					'**/*.{eot,svg,ttf,woff}',
					'**/*.{md}'
				],
				dest: '<%%= config.dist %>'
			},<% if (dependencies.fontAwesome) { %>
			awesome: {
				expand: true,
				cwd: 'components/font-awesome',
				src: [
					'css/font-awesome.min.css',
					'css/font-awesome-ie7.min.css',
					'font/*'
				],
				dest: '<%%= config.dist %>'
			},<% } %>
			jquery: {
				expand: true,
				cwd: 'components',
				src: [
					'jquery/jquery.min.js',
				],
				dest: '<%%= config.dist %>/js/vendor'
			},
			components: {
				expand: true,
				cwd: 'components/wordpress-tools',
				src: [
					'**/*'
				],
				dest: '<%%= config.dist %>/inc'
			},
		},<% if (dependencies.modernizr) { %>
		modernizr: {
			devFile: "components/modernizr/modernizr.js",
			outputFile: "dist/js/vendor/modernizr/modernizr.js",
			files: [
				'app/**/*'
			]
		}<% } %>
	});

	grunt.registerTask('build', [
		'clean', // delete dist folder
		'jshint', // validate all js files
		'compass', // process all scss file and dump result in .tmp
		'cssmin', // minify all css files from app folder and move them to dist folder
		'uglify', // uglify all JS files from app folder and move them to in the dist folder
		'copy', // copy rest of files from app folder to dist (php ,html, txt, ico, fonts) and copy components in dist<% if (dependencies.modernizr) { %>
		'modernizr' // parse mdoernizr and copy only necessary tests<% } %>
	]);

	grunt.registerTask('server', [
		'watch'
	]);

	// Default task(s).
	grunt.registerTask('default', ['build']);

};