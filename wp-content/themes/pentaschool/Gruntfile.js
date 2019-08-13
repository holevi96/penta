/**
 * Gruntfile for task automation.
 * Includes js minify and less compiling.
 */
module.exports = function (grunt) {
    "use strict";
    require('jit-grunt');

    grunt.initConfig({
        uglify: {
            my_target: {
                options: {
                    sourceMap: true
                },
                files: {
                    'dist/pentaschool.min.js': [
                        'dist/pentaschool.js',
                        'js/main.js'
                    ]
                }
            }
        },
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2,
                    sourceMap: true,
                    sourceMapURL: 'proto.min.css.map',
                    sourceMapRootpath: '/../'
                },
                files: [
                    { 'dist/proto.min.css': 'less/pentaschool.less' }
                ]
            }
        },
        watch: {
            scripts: {
                files: 'js/**/*.js',
                tasks: ['uglify'],
                options: {
                    interrupt: true
                }
            },
            styles: {
                files: ['less/**/*.less'],
                tasks: ['less'],
                options: {
                    nospawn: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('js', ['uglify']);
    grunt.registerTask('default', ['uglify', 'less', 'watch']);
};