<?php
class posts_controller extends base_controller {
	public function __construct() {
		parent::__construct();

		#make sure users is logged in before letting them access contents of controller
		if(!$this->user) {
			die("Members only, Fool. <br> <a href='/users/login'>Login</a>");
		}
	}

	public function add() {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";

        # Render template
        echo $this->template;

	}

	public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('posts', $_POST);

          # Setup view
        $this->template->content = View::instance('v_posts_added');
        $this->template->title   = "Posted!";
        echo $this->template;

	}

	public function users() {

	    # Set up the View
	    $this->template->content = View::instance("v_posts_users");
	    $this->template->title   = "Users";

	    # Build the query to get all the users
	    $q = "SELECT *
	        FROM users";

	    # Execute the query to get all the users. 
	    # Store the result array in the variable $users
	    $users = DB::instance(DB_NAME)->select_rows($q);

	    # Build the query to figure out what connections does this user already have? 
	    # I.e. who are they following
	    $q = "SELECT * 
	        FROM users_users
	        WHERE user_id = ".$this->user->user_id;

	    # Execute this query with the select_array method
	    # select_array will return our results in an array and use the "users_id_followed" field as the index.
	    # This will come in handy when we get to the view
	    # Store our results (an array) in the variable $connections
	    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

	    # Pass data (users and connections) to the view
	    $this->template->content->users       = $users;
	    $this->template->content->connections = $connections;

	    # Render the view
	    echo $this->template;
	}

	public function follow($user_id_followed) {

    # Prepare the data array to be inserted
    $data = Array(
        "created" => Time::now(),
        "user_id" => $this->user->user_id,
        "user_id_followed" => $user_id_followed
        );

    # Do the insert
    DB::instance(DB_NAME)->insert('users_users', $data);

    # Send them back
    Router::redirect("/posts/users");
}

	public function unfollow($user_id_followed) {

	    # Delete this connection
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
	    DB::instance(DB_NAME)->delete('users_users', $where_condition);

	    # Send them back
	    Router::redirect("/posts/users");

	}
	public function index() {

	    # Set up the View
	    $this->template->content = View::instance('v_posts_index');
	    $this->template->title   = "Posts";

	    # Build the query
	    $q = "SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = ".$this->user->user_id;

	    # Run the query
	    $posts = DB::instance(DB_NAME)->select_rows($q);

	    # Pass data to the View
	    $this->template->content->posts = $posts;

	    # Render the View
	    echo $this->template;

	}


	public function edit($post_id) {

        # Setup view
        $this->template->content = View::instance('v_posts_edit');
        $this->template->title   = "Edit Post";


		# Build the query to get all the users posts
        $q = "SELECT *
            FROM posts
            WHERE post_id = ".$post_id;

        # Execute the query to get all the posts. 
        # Store the result array in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass it to the view
        $this->template->content->posts       = $posts;


        # Render template
        echo $this->template;

	}

	public function p_edit($post_id) {

		# update the modified field
        $_POST['modified'] = Time::now();

        # Send the $_POST data into the database, at the row corresponding with post_id (test post_id is 38)
		DB::instance(DB_NAME)->update("posts", $_POST, "WHERE post_id = ".$post_id);
        
        # Setup view (eventually)
        $this->template->content = View::instance('v_posts_edited');
        $this->template->title   = "Your Post has been Edited!";
        echo $this->template;

	}


	public function p_delete($post_id) {

		# Query the DB using post_id param
        $q = "WHERE post_id = ".$post_id;

        # Run the delete query
        DB::instance(DB_NAME)->delete('posts', $q);
        
        # Send them back
	    Router::redirect("/users/profile");

	}
}
#EOC
