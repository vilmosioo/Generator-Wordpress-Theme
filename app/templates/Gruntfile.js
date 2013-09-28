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
				'<%%= config.app %>/js/**/*.js',
				'!<%%= config.app %>/js/plugins.js'
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
					'**/*.{php,html,ico,txt}'
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
			},
			components: {
				expand: true,
				cwd: 'components',
				src: [
					'jquery/jquery.min.js',
					<% if (dependencies.modernizr) { %>
					'modernizr/modernizr.js',
					<% } if (dependencies.fontAwesome) { %>
					'font-awesome/css/font-awesome.min.css',
					'font-awesome/css/font-awesome-ie7.min.css',
					'font-awesome/font/*',
					<% } %>
					'wordpress-tools/**/*'
				],
				dest: '<%%= config.dist %>/components'
			},
		}
	});

	grunt.registerTask('build', [
		'clean', // delete dist folder
		'jshint', // validate all js files
		'compass', // process all scss file and dump result in .tmp
		'cssmin', // minify all css files from app folder and move them to dist folder
		'uglify', // uglify all JS files from app folder and move them to in the dist folder
		'copy', // copy rest of files from app folder to dist (php ,html, txt, ico, fonts) and copy components in dist
	]);

	grunt.registerTask('server', [
		'watch'
	]);

	// Default task(s).
	grunt.registerTask('default', ['build']);

};