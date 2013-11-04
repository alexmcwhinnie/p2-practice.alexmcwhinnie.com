<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
<p>
	Nulla fringilla vehicula est ac rutrum. Sed eu massa auctor, aliquet dui a, dapibus ante. Phasellus a vulputate odio. Integer venenatis magna et turpis adipiscing, ac cursus diam euismod. Praesent tincidunt orci nisl, fringilla vestibulum augue gravida ac. Morbi sodales interdum viverra. Aliquam cursus nibh mauris, quis laoreet lacus vulputate vitae. Donec id pellentesque lacus, egestas mollis metus. Etiam quis neque quis sem placerat aliquam. Integer porttitor pharetra orci. Aenean accumsan semper pulvinar.
</p>

<?php if(!$user): ?>
    <!-- If user isnt logged in, show signup/login panel -->
	<div id='leftColumn'>
		<h3>New to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?>?<br>Sign up!</h3>
		<form method='POST' action='/users/p_signup'>

		    First Name<br>
		    <input type='text' name='first_name' required>
		    <br><br>

		    Last Name<br>
		    <input type='text' name='last_name' required>
		    <br><br>

		    Email<br>
		    <input type='text' name='email' required>
		    <br><br>

		    Password<br>
		    <input type='password' name='password' required>
		    <br><br>

		    <input type='submit' value='Sign me up!'>

		</form>
	</div>

	<div id='rightColumn'>
		<h3>Got an account?<br>Log in</h3>
		<form method='POST' action='/users/p_login'>

		    Email<br>
		    <input type='text' name='email' required>

		    <br><br>

		    Password<br>
		    <input type='password' name='password' required>

		    <br><br>

		    <?php if(isset($error)): ?>
		        <div class='error'>
		            Login failed. Please double check your email and password.
		        </div>
		        <br>
		    <?php endif; ?>
			<input type='submit' value='Log in'>
		</form>
	</div>
    <!-- Otherwise, hide it follow link -->
    <?php else: ?>
        

    <?php endif; ?>

