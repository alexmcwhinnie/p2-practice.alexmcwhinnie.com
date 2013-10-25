<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  

    <div id='menu'>

        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>

        <?php endif; ?>

    </div>

    <br>
    <!-- I think this is where the views appear -->
    <?php if(isset($content)) echo $content; ?>

</body>

</body>
</html>