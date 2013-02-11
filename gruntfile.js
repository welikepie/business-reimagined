/*global module:false */
module.exports = function (grunt) {
	"use strict";
	
	grunt.initConfig({
	
		'clean': { 'init': ['build'] },
		
		'recess': {
		
			// Linting task runs RECESS without compilation, just for checking
			// the contents of all .less files, to report any errors or warnings.
			'lint': {
				'files': {
					'src': 'styles/*.less'
				},
				'options': {
					'compile': false,
					'compress': false,
					'noIDs': false,
					'noUniversalSelectors': false,
					'noOverqualifying': false,
					'strictPropertyOrder': false
				}
			},
			
			// Compilation tasks should only use the main .less files as source;
			// RECESS doesn't process the @import statements, so compiling the file
			// already included with @import will cause duplicates to show up.
			
			// Tasks used for development should disable compression to increase readability.
			'dev': {
				'options': {
					'compile': true,
					'compress': false
				},
				'src': 'styles/main.less',
				'dest': 'build/styles/styles.css'
			},
			
			// Release tasks can match the dev tasks, with compression enabled.
			'release': {
				'options': {
					'compile': true,
					'compress': true
				},
				'src': '<%= recess.dev.src %>',
				'dest': '<%= recess.dev.dest %>'
			}
		
		},
		
		'jshint': {
		
			'options': {
				'immed': true,		// Complains about immediate function invocations not wrapped in parentheses
				'latedef': true,	// Prohibits using a variable before it was defined
				'forin': true,		// Requires usage of .hasOwnProperty() with 'for ... in ...' loops
				'noarg': true,		// Prohibits usage of arguments.caller and arguments.callee (both are deprecated)
				'eqeqeq': true,		// Enforces the usage of triple sign comparison (=== and !==)
				'bitwise': true,	// Forbids usage of bitwise operators (rare and, most likely, & is just mistyped &&)
				'strict': true,		// Enforces usage of ES5's strict mode in all function scopes
				'undef': true,		// Raises error on usage of undefined variables
				'plusplus': true,	// Complains about ++ and -- operators, as they can cause confusion with their placement
				'unused': true,		// Complains about variables and globals that have been defined, but not used
				'curly': true,		// Requires curly braces for all loops and conditionals
				'browser': true		// Assumes browser enviroment and browser-specific globals
			},
			
			'dev': {
				'options': {
					'devel': true,
					'unused': false
				},
				'files': {
					'src': ['gruntfile.js', 'scripts/*.js']
				}
			},
			'release': {
				'options': {
					'devel': false
				},
				'files': {
					'src': 'scripts/*.js'
				}
			}
		
		},
		
		'concat': {
		
			'custom': {
				'options': {'separator': ";\n\n"},
				'files': {'build/scripts/scripts.js':  'scripts/*.js'}
			},
			'vendor': {
				'options': {'separator': ";"},
				'files': {'build/scripts/vendor.js': 'scripts/vendor/**/*.js'}
			}
		
		},
		
		'uglify': {
			'options': {
				'mangle': true,
				'compress': true,
				'preserveComments': false
			},
			'release': {
				'files': {
					'build/scripts/scripts.js': 'scripts/*.js',
					'build/scripts/vendor.js': 'scripts/vendor/**/*.js'
				}
			}
		},
		
		'copy': {
			'html': { 'files': { 'build/layouts/': 'layouts/*.htm' } },
			'images': { 'files': { 'build/images/': ['images/*.png', 'images/*.jpg'] } },
			'scripts': { 'files': { 'build/scripts/': 'scripts/other/**/*' } }/*,
			'css': { 'files': { 'build/styles/': 'styles/*.css' } }*/
		},
		
		'watch': {
			'less': {
				'files': 'styles/**/*.less',
				'tasks': ['recess:lint', 'recess:dev']
			},
			'js-main': {
				'files': 'scripts/*.js',
				'tasks': ['jshint:dev', 'concat:custom']
			},
			'js-vendor': {
				'files': 'scripts/vendor/**/*.js',
				'tasks': ['concat:vendor']
			},
			'js-other': {
				'files': 'scripts/other/**/*.js',
				'tasks': ['copy:scripts']
			},
			'html': {
				'files': ['layouts/*.htm', 'layouts/*.html'],
				'tasks': ['copy:html']
			},
			'css': {
				'files': 'styles/**/*.css',
				'tasks': ['copy:css']
			}
		}
	
	});
	
	grunt.registerTask('dev', ['clean:init', 'recess:lint', 'recess:dev', 'jshint:dev', 'concat', 'copy', 'watch']);
	grunt.registerTask('release', ['clean:init', 'recess:lint', 'recess:release', 'jshint:release', 'uglify', 'copy']);
	grunt.registerTask('default', 'dev');
	
	/* ************************************************ */
	
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-recess');
	
};