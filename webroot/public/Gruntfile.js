//Gruntfile
module.exports = function (grunt) {

    //Initializing the configuration object
    grunt.initConfig({
        less: {
            development: {
                options: {
                    compress: false //minifying the result
                },
                files: {
                    "./css/main.css": "./less/main.less",
                    "./css/admin.css": "./less/admin/admin.less"
                }
            }
        },
        watch: {
            less: {
                files: [
                    './less/**/*.less'
                ],  //watched files
                tasks: ['less']                          //tasks to run
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');

    // Task definition
    grunt.registerTask('default', ['watch']);
};
