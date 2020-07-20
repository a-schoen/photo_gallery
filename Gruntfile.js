module.exports = function(grunt) {
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      sass: {
        dist: {
          options: {
            sourcemap: false,
            compress: false,
            yuicompress: false,
            style: 'expanded',
          },
          files: {
            'assets/css/style.css' : 'assets/css/scss/style.scss'
          }
        },
      },
      watch: {
        css: {
          files: 'assets/css/scss/*.scss',
          tasks: ['sass']
        }
      }
    });
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default',['watch']);
  }