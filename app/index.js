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

  // set up defaults, synced with the prompts defaults
  this.defaults = {
    author : {
      name: '',
      uri: '',
      email: ''
    },
    theme : {
      name: 'Hyperion',
      version: '0.0.1',
      description: 'The Hyperion blank WordPress Theme is a highly customised developer\'s theme, having a lots of features, suitable for a wide range of projects.'
    },
    dependencies : {
      modernizr: true,
      fontAwesome: true
    },
    templates : {
      customPost: true,
      metabox: true,
      settings: true,
      widget: true,
      shortcode: true
    }
  };

  var prompts = [
    {
      type: 'confirm',
      name: 'defaults',
      message: 'Install default configuration?',
      default: true
    },
    {
      type: 'input',
      name: 'authorName',
      message: 'What is your name?',
      default: this.defaults.author.name,
      when: function (props) {
        console.log('\nPlease answer the following:');
        return !props.defaults;
      }
    },
    {
      type: 'input',
      name: 'authorUri',
      message: 'What is your URI?',
      default: this.defaults.author.uri,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'input',
      name: 'authorEmail',
      message: 'What is your email?',
      default: this.defaults.author.email,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'input',
      name: 'themeName',
      message: 'What is your theme\'s name?',
      default: this.defaults.theme.name,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'input',
      name: 'themeVersion',
      message: 'What is your theme\'s version?',
      default: this.defaults.theme.version,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'input',
      name: 'themeDescription',
      message: 'What is your theme\'s description? (you can edit this later)',
      default: this.defaults.theme.description,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'dependenciesModernizr',
      message: 'Do you wish to use Modernizr?',
      default: this.defaults.dependencies.modernizr,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'dependenciesFontAwesome',
      message: 'Do you wish to use Font Awesome?',
      default: this.defaults.dependencies.fontAwesome,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'templateCustomPost',
      message: 'Would you like to include a custom post template?',
      default: this.defaults.templates.customPost,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'templateMetabox',
      message: 'Would you like to include a custom metabox?',
      default: this.defaults.templates.metabox,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'templateSettings',
      message: 'Would you like to include a theme settings template?',
      default: this.defaults.templates.settings,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'templateWidget',
      message: 'Would you like to include a custom widget template?',
      default: this.defaults.templates.widget,
      when: function (props) {
        return !props.defaults;
      }
    },
    {
      type: 'confirm',
      name: 'templateShortcode',
      message: 'Would you like to include a theme shortcode template?',
      default: this.defaults.templates.shortcode,
      when: function (props) {
        return !props.defaults;
      }
    }
  ];

  this.prompt(prompts, function (props) {
    if(this.defaults){
      this.author = this.defaults.author;
      this.theme = this.defaults.theme;
      this.dependencies = this.defaults.dependencies;
      this.templates = this.defaults.templates;
    } else {
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
    }

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