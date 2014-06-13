module.exports = function(grunt) {
    require('load-grunt-tasks')(grunt);
    
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            css: {
                files: ['styles/*/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                }
            },
            
            scripts: {
                files: ['js/*.js'],
                tasks: ['concat'],
                options: {
                    spawn: false,
                }
            }
        },
        
        sass: {
            dist: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'styles.css': 'styles/import.scss'
                }
            }
        },
        
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: ['js/*.js'],
                dest: 'scripts.js'
            }
        },

        uglify: {
            my_target: {
                files: {
                    'scripts.min.js': ['js/*.js']
                }
            }
        }

    });

    grunt.registerTask('default', ['sass', 'concat', 'watch']);
    grunt.registerTask('prod', ['sass', 'uglify']);
};