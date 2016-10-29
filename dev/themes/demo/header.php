<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demo theme</title>

    <!-- mmmmm bootstrappy goodness -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- starting php wp_head -->
<?php 
    
// add this at the end of the <head> block in order to bring in all the wordpress goodness
// including emojis, the admin bar, and whatever theme stuff you've added.
wp_head(); 

?>
<!--    ending php wp_head -->
</head>
<body <?php

// oh this is so smart! Only put a logged-in class on the body when a user is logged in, and
// do special CSS formatting in that case.
// see https://codex.wordpress.org/Function_Reference/get_current_user_id
if (0 !== get_current_user_id ()) {
    echo "class=\"logged-in\"";
}

?>>
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo get_site_url(); ?>">#wcmpls demo theme</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo get_site_url(); ?>/employee/">Employees</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</header>

<main class="container">
<!-- end of header.php -- remainder of content follows -->
<?php

// this is the end of the header. The regular content of whatever page being called
// happens after this. The closing </main> tag occurs at the beginning of the footer.php
// file. I find this sort of templating abhorent.