<?php
$cas = (isset($_GET['cas']))?(htmlspecialchars($_GET['cas'])):'install';
switch($cas){
	case 'install':
		?>
		<div style="margin:auto; padding:15px; border-style:inset; border-radius:25px 0px 25px 0px; max-width:500px; align-center; margin-top:20vh;">
			<h1>Welcome to JosNewsletter !</h1>
			<p>Enter your SMTP informations to set up correctly.</p>
			<hr>
			<form method="post" action="installation.php?cas=submit">
				<label for="host">HOST</label><br>
				<input type="text" id="host" name="host" placeholder="Ex: smtp.exemple.com" required="" style="width:100%; padding:7px">
				<label for="user">USER NAME</label><br>
				<input type="email" id="user" name="user" placeholder="Ex: exemple@exemple.com" required="" style="width:100%; padding:7px">
				<label for="pwd">PASSWORD</label><br>
				<input type="password" id="pwd" name="pwd" placeholder="Your email(user name) password" required="" style="width:100%; padding:7px">
				<label for="port">PORT</label><br>
				<input type="number" id="port" name="port" placeholder="Ex: 587" required="" min="0" style="width:100%; padding:7px">
				<br><br>
				<center><input type="submit" value="FINISH AND SAVE" style="width:100%"></center>
			</form>
		</div>
		<?php
	break;
	case 'submit':
		$host = (isset($_POST['host']))?(htmlspecialchars($_POST['host'])):'yourSmtpHost';
		$user = (isset($_POST['user']))?(htmlspecialchars($_POST['user'])):'yourSmtpUserName@example.com';
		$pwd = (isset($_POST['pwd']))?(htmlspecialchars($_POST['pwd'])):'yourSmtpUserName@example.com';
		$port = (int) (isset($_POST['port']))?(htmlspecialchars($_POST['port'])):25;
		
		//edit data.json (it contents SMTP parametters)
		//this code is created by Josué - jose.init.dev@gmail.com
		// create php object
		$json = (object) array('host' => $host, 'user' => $user, 'password' => $pwd, 'port' => $port);
		// write out file
		$dataNew = json_encode($json);
		file_put_contents('phpmailer/data.json', $dataNew);
		
		echo "<center style='margin-top:35vh'><h3>Installed successfully !</h3><br><a href='index.php'>Finish</a></center>";
	break;
	default:
		echo "<p style='color:red'>Something went wrong, please try installing again.</p>";
	break;
}
?>