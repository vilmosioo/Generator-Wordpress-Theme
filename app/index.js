'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');

var WordpressThemeGenerator = module.exports = function WordpressThemeGenerator(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

  this.on('end', function () {
    this.installDependencies({ 
      skipInstall: options['skip-install']
    });
  });

  this.pkg = JSON.parse(this.readFileAsString(path.join(__dirname, '../package.json')));
};

util.inherits(WordpressThemeGenerator, yeoman.generators.Base);

WordpressThemeGenerator.prototype.askFor = function askFor() {
  var cb = this.async();

  // have Yeoman greet the user.
  console.log(this.yeoman);

  var prompts = [
    {
      type: 'input',
      name: 'authorName',
      message: 'A few details...\nAuthor name',
      default: ''
    },
    {
      type: 'input',
      name: 'authorUri',
      message: 'Author URI',
      default: ''
    },
    {
      type: 'input',
      name: 'authorEmail',
      message: 'Author Email',
      default: ''
    },
    {
      type: 'input',
      name: 'themeName',
      message: 'Theme name',
      default: 'Hyperion'
    },
    {
      type: 'input',
      name: 'themeVersion',
      message: 'Theme version',
      default: '0.0.1'
    },
    {
      type: 'input',
      name: 'themeDescription',
      message: 'Theme description',
      default: 'The Hyperion blank WordPress Theme is a highly customised developer\'s theme, having a lots of features, suitable for a wide range of projects.'
    },
    {
      type: 'confirm',
      name: 'dependenciesModernizr',
      message: 'Do you wish to use Modernizr?',
      default: true
    },
    {
      type: 'confirm',
      name: 'dependenciesFontAwesome',
      message: 'Do you wish to use Font Awesome?',
      default: true
    },
    {
      type: 'confirm',
      name: 'templateCustomPost',
      message: 'Create a custom post template?',
      default: true
    },
    {
      type: 'confirm',
      name: 'templateMetabox',
      message: 'Create a custom metabox?',
      default: true
    },
    {
      type: 'confirm',
      name: 'templateSettings',
      message: 'Create a theme settings template?',
      default: true
    },
    {
      type: 'confirm',
      name: 'templateWidget',
      message: 'Create a custom widget template?',
      default: true
    },
    {
      type: 'confirm',
      name: 'templateShortcode',
      message: 'Create a theme shortcode template?',
      default: true
    }
  ];

  this.prompt(prompts, function (props) {
    this.author = {
      name: props.authorName,
      uri: props.authorUri,
      email: props.authorEmail
    };
    
    this.theme = {
      name: props.themeName,
      version: props.themeVersion,
      description: props.themeDescription
    };

    this.dependencies = {
      modernizr: props.dependenciesModernizr,
      fontAwesome: props.dependenciesFontAwesome
    };

    this.templates = {
      customPost: props.templateCustomPost,
      metabox: props.templateMetabox,
      settings: props.templateSettings,
      widget: props.templateWidget,
      shortcode: props.templateShortcode
    };

    cb();
  }.bind(this));
};

// set up application
WordpressThemeGenerator.prototype.app = function app() {
  this.copy('package.json', 'package.json');
  this.copy('bower.json', 'bower.json');
};

// copy project dev files
WordpressThemeGenerator.prototype.projectdevfiles = function projectdevfiles() {
  this.copy('Gruntfile.js');
  this.copy('.jshintrc');
  this.copy('_.gitignore', '.gitignore');
  this.copy('.bowerrc');
  this.copy('README.md');
};

// copy wordpress templates
WordpressThemeGenerator.prototype.wpfiles = function wpfiles() {
  this.directory('app', 'app');
};

WordpressThemeGenerator.prototype.endGenerator = function endGenerator() {
  this.log.writeln('');
  this.log.writeln('Looks like we\'re done!');
  this.log.writeln('The theme source files can be found in the app folder.');
  this.log.writeln('You probably want to link the dist folder to your wp-content/themes/.');
  this.log.writeln('Don\'t forget to activate the new theme in the admin panel, and then you can start coding!');
}