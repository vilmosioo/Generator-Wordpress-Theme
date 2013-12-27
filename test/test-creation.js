/*global describe, beforeEach, it*/
'use strict';

var path    = require('path');
var helpers = require('yeoman-generator').test;


describe('wordpress-theme generator', function () {
  beforeEach(function (done) {    
    helpers.testDirectory(path.join(__dirname, 'temp'), function (err) {
      if (err) {
        return done(err);
      }

      this.app = helpers.createGenerator('wordpress-theme:app', [
        '../../app'
      ]);
      done();
    }.bind(this));
  });

  it('creates expected files', function (done) {
    var expected = [
      // add files you expect to exist here.
      'package.json',
      'Gruntfile.js',
      'README.md',
      'bower.json',
      '.jshintrc',
      '.gitignore',
      '.bowerrc',
      'app/404.php', 
      'app/archive.php', 
      'app/comments.php', 
      'app/footer.php', 
      'app/front-page.php', 
      'app/functions.php', 
      'app/header.php', 
      'app/index.php', 
      'app/page.php', 
      'app/screenshot.png', 
      'app/search.php', 
      'app/searchform.php', 
      'app/sidebar.php', 
      'app/single.php', 
      'app/style.scss'  
    ];

    helpers.mockPrompt(this.app, {
      'defaults': true
    });
    this.app.options['skip-install'] = true;
    this.app.run({}, function () {
      helpers.assertFiles(expected);
      done();
    });
  });
});
