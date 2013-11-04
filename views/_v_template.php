<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  
    <div id = "wrapper"
    <header>
        <h1><?=APP_NAME?></h1>
        <nav>
            <ul>
                <li><a href='/'>Home</a></li>

                <!-- Menu for users who are logged in -->
                <?php if($user): ?>
                    <li><a href='/posts'>View Posts</a></li>
                    <li><a href='/posts/add'>Add a Post</a></li>
                    <li><a href='/posts/users'>Following</a></li>
                    <li><a href='/users/profile'>Profile</a></li>
                    <li><a href='/users/logout'>Logout</a></li>

                <!-- Menu options for users who are not logged in -->
                <?php else: ?>

                    <li><a href='/users/signup'>Sign up</a></li>
                    <li><a href='/users/login'>Log in</a></li>

                <?php endif; ?>
                <hr>
            </ul>
        </nav>
    </header>
    <div id = "content">
        <!-- Load in content -->
        <?php if(isset($content)) echo $content; ?>
    </div>
    <footer>
    </footer>
    </div>
</body>

</body>
</html>