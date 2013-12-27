'use strict';
var util = require('util');
var yeoman = require('yeoman-generator');

var PluginGenerator = module.exports = function PluginGenerator(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

	this.on('end', function () {
		this.installDependencies({ 
			skipInstall: options['skip-install']
		});
	});
};

util.inherits(PluginGenerator, yeoman.generators.NamedBase);


PluginGenerator.prototype.askFor = function askFor() {
	  var cb = this.async();

	  // have Yeoman greet the user.
	  console.log(this.yeoman);

	  // set up defaults, synced with the prompts defaults
	  this.defaults = {
	    name: 'Hyperion',
	  };

	  var prompts = [
	    {
	      type: 'input',
	      name: 'name',
	      message: 'What is your plugin\'s name?',
	      default: this.defaults.name
	    }
	  ];

	  this.prompt(prompts, function (props) {
	  	this.name = props.name;
	  	cb();
  	}.bind(this));
};


// copy project dev files
PluginGenerator.prototype.projectdevfiles = function projectdevfiles() {
	var slug = this._.slugify(this.name);
	
	this.mkdir(slug);

  this.copy('_.gitignore', slug + '/.gitignore');
  this.template('bower.json', slug + '/bower.json');
  this.template('hyperion_plugin.php', slug + '/' + slug + '.php');
  this.template('uninstall.php', slug + '/uninstall.php');
  this.template('README.md', slug + '/README.md');
};

PluginGenerator.prototype.endGenerator = function endGenerator() {
  this.log.writeln('');
  this.log.writeln('Looks like we\'re done!');
  this.log.writeln('You probably want to link this folder to your wp-content/plugins/.');
  this.log.writeln('Don\'t forget to activate the new plugin in the admin panel, and then you can start coding!');
}