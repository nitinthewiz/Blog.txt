Blog.txt
========

A simple blogging tool. Best used as a linkblog.

Setup
------

Edit config.php as appropriate.

Edit index.php to add your own Google Analytics code (can be done later)

Edit searchpathgo.js to change 'emit.nitinkhanna.com' to your own site's name (sign up on searchpath.io for this)

When creating vHost config in Apache (or equivalent), add the following as an environment variable to the vHost file - 
    SetEnv EMITKEY "yourpassword"

This is required to use the create.php file to add new entries to your blog.

Then copy all the files and folders into your server.

And visit your site
