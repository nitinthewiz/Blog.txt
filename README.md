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


To make a blogpost - 
--------------------
1. Open yoursite.com/create.php
2. Add the date in the following format - Apr 5 2013
3. Add the content and the password you had set as environment variable in Apache
4. You can choose to not add a URL to the post. If you add it, the Title will have the URL and clicking it will take you to the link
5. Click Done.
