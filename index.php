<?php 
ob_start();
session_start();
require_once './_functions/db_functions.php';   //contains db connection function by using PDO.   
require_once './_class/sessionClass.php';   //contains methods for signing in, logging in, session stuffs etc.

        
		//if user already logged in, redirect to message.php file by now.
	if (isset($_SESSION['userId'])) {
		//redirect('message.php');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to Lingomate</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine"></link>
<link rel="stylesheet" type="text/css" href="_css/main.css"></link>
<script src="_js/jquery.js"></script>
<script src="_js/main.js"></script>
</head>
<body>
<header>
    <div class="headerWrap">
    	<div class="logo"><a href="http://www.lingomate.net">Lingomate</a></div>
            <div class="login">
                <form action="" method="POST" />
                    <label for="signEmail">Email:</label>
                    <input type="text" name="signEmail" />
                    <label for="password">Password:</label>
                    <input type="password" name="signPassword" />
                    <button name="submitLogIn" >submit</button>
                 </form>	
                    <?php 
                    
					
			if (isset($_POST['submitLogIn'])) {
                            $login = new Session;
                            $login->signEmail = $_POST['signEmail'];
                            $login->signPassword = $_POST['signPassword'];
                            $login->login();
                            
                            if (isset($_SESSION['userId'])) {
				echo "Successful and session user id is: ".$_SESSION['userId'];
                                //redirect("message.php");		
                            } else {
				echo "Email and password do not match.";
                            }
			}
                    ?>
            
		<div id="warningLogIn">Some informations.</div>
		</div><!--login end-->
	</div><!--headerWrap end-->        
</header><!--header end-->
<div>

</div>
<div id="wrapper">
    <div class="wrapperWrap">
	<div id="navigation">
            <div class="signUp">
                <h3>New to Lingomate?<em>Sign Up</em></h3>
                <form action="" method="POST" novalidate="novalidate" >
                    <input type="text" name="userName" id="userName" placeholder="Your User Name" value="<?php echo $_POST['userName']; ?>" autocomplete="off" />
                    <p></p>
                    <input type="password" name="password" id="password" placeholder="Your Password" />
                    <p></p>
                    <input type="email" name="email" id="email" placeholder="Your Email" value="<?php echo $_POST['email']; ?>" autocomplete="off" />
                    <p></p>
                    <button name="newUserSubmit">Become a Member</button>
                </form>
                    <?php
                    if(isset($_POST['newUserSubmit'])) {
                        $rules = array (
				'email' => 'email|unique',
				'password' => 'limit',
				'userName' => 'limit'
				);
                        
                        $newUser = new Session();
                        $newUser->userName = $_POST['userName'];
                        $newUser->password = $_POST['password'];
                        $newUser->email    = $_POST['email']; 
                        
                        //if all values are appropriate.
                        if($newUser->validate($_POST, $rules) == TRUE) { 
                            //create new user and get messages from method RETURNS.
                            echo $newUser->createNewUser();
                        } else {
                            
                        ?>
                
                        <div id="warningSignUp">
                            <ul>
                                <?php
				foreach($newUser->errors as $error) {
                                    echo '<li>'.$error.'</li>';
				}
				?>
                            </ul>
                        </div><!--warningSignUp end-->
                        
                        <?php
                        } //validation failed end.
                    } //if isset? end.
                    ?>
                </div><!--signUp end-->
        <div id="shortDesc">
        	<h3>How Lingomate Works.</h3>
    		<p>There should be our impressive message that effects users in first look. Tuncay is going to write that simple and incredible message. xo xo gossip boy.</p>
        </div><!--shortDesc end-->
		
	</div><!--navigation end-->
	<div id="content">
    	<img src="_images/mainPage.png" title="World Wide" />
        <ul>
        <li><img src="_images/learn.png" title="learn" /><span><a href="#">Learn:</a></span> Interactive english learning system from beginning to advanced.</li>
        <li><img src="_images/explore.png" title="explore" /><span><a href="#">Explore:</a></span> Lingomate's users experience. And things they have experienced.</li>
        <li><img src="_images/communication.png" title="communicate" /><span><a href="#">Comminicate:</a></span> People who would like to have practices.</li>
        </ul>
        
	</div><!--content end-->
 	</div><!--wrapperWrap end-->
	</div><!--wrapper end-->

	<?php
            require_once './_functions/footer.php';
	?>