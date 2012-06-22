# Require any additional compass plugins here.
# Susy Grids
require 'susy'
# CSS Normalize
require 'compass-normalize'

# Set this to the root of your project when deployed:
#http_path = "/"
#css_dir = "stylesheets"
#sass_dir = "sass"
#images_dir = "images"
#javascripts_dir = "javascripts"

http_path = "/"
css_path = File.expand_path('../../../')
css_dir = "library/css"
sass_dir = "sass"
images_dir = "library/images"
javascripts_dir = "js"
project_type = :stand_alone
output_style = :nested

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false


# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass


# rename_sprite module from comments at http://www.akawebdesign.com/2011/01/17/building-css-sprites-with-compasssass/
module Sass::Script::Functions
	require 'fileutils'
	
	def rename_sprite(sprite_map, target_relative)
		
		target_relative = target_relative.to_s
		target_relative.gsub!(/.*images\//,'')
		target_relative.gsub!(/"$/,'')
		sprite_map = sprite_map.to_s
		sprite_map["url('"] = ""
		sprite_map["')"] = ""
		
		sass_absolute_path = File.dirname(__FILE__)
		sprite_absolute_path= File.join(sass_absolute_path, "library/images/sprites", File.basename(sprite_map))
		target_absolute_path= File.join(sass_absolute_path, "images", target_relative)
		
		target_manual = File.join( Compass.configuration.css_path, "library/images/", target_relative)
		
		FileUtils.mv(sprite_absolute_path, target_manual)
		return Sass::Script::Bool.new(true)
	end
end