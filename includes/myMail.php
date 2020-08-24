<?php
$option = (isset($_GET['opt']))?(htmlspecialchars($_GET['opt'])):'';

switch ($option){
	case 'readMail':
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //mail id
		$sent = (isset($_GET['st']))?(htmlspecialchars($_GET['st'])):'no'; //is that a sent mail ?
		//----read mails data-------
		if ($sent=="no"){
			$data = file_get_contents('../data/recievedMails.json');
			$data = json_decode($data, true);
		}else{
			$data = file_get_contents('../data/sentMails.json');
			$data = json_decode($data, true);
		}
		//----//read mails data-------
		?>
		<div class="body">
			<h4><b>Objet:</b> <?php echo $data[$id]['object'] ?></h4>
		</div>
		<div class="entity">
			<div class="row">
				<div class="p-1">
					<img src="img/<?php echo $data[$id]['authorPic'] ?>" class="rounded-circle img-fluid" style="max-width:50px">
				</div>
				<div class="col-11">
					<h6><b><?php echo $data[$id]['author'] ?></b> [<?php echo $data[$id]['authorMail'] ?>]</h6>
					<i class="fa fa-clock"> <?php echo $data[$id]['date'] ?></i>
				</div>
				<div class="col-12">
					<i class="fas fa-at"> A</i>: <a href="#demo" data-toggle="collapse"><i><?php echo substr($data[$id]['to'],0,100) ?></i> <i class="fas fa-angle-down"></i></a>
					<div id="demo" class="collapse">
						<b class="fas fa-pen-alt"> A</b>: <i><?php echo $data[$id]['to'] ?></i><br>
						<b class="fas fa-pen"> Cc</b>: <i><?php echo $data[$id]['cc'] ?></i>
					</div>

				</div>
			</div>
		</div>
		<hr>
		<div class="body">
			<?php
			$message = htmlspecialchars_decode($data[$id]['message']);
			echo $message;
			?>
		</div>
		<?php
	break;
	case 'calendar':
		?>
		<iframe src="calendar.html" style="width:100%; height:90vh; border:none;"></iframe>
		<?php
	break;
	case 'new': //write new mail
		?>
		<div>
			<hr>
			<iframe src="includes/joEditor/joEditor.html" style="width:100%; height:90vh; border:none;"></iframe>
		</div>
		<?php
	break;
	case 'isRead': //update recieved mails json data (set a mail as read)
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //mail id
		$data = file_get_contents('../data/recievedMails.json');
		$json = json_decode($data, true);
		// write out file
		$json[$id]['read'] = true;
		$dataNew = json_encode($json);
		file_put_contents('../data/recievedMails.json', $dataNew);
	break;
	case 'readDraft':
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //mail id
		//echo $id;
		?>
		<div>
			<hr>
			<iframe src="includes/joEditor/joEditor.html?id=<?php echo $id ?>" style="width:100%; height:90vh; border:none;"></iframe>
		</div>
		<?php
	break;
	case 'isSent':
		$obj = (isset($_POST['obj']))?(htmlspecialchars($_POST['obj'])):'';
		$to = (isset($_POST['to']))?(htmlspecialchars($_POST['to'])):'';
		$cc = (isset($_POST['cc']))?(htmlspecialchars($_POST['cc'])):'';
		$cci = (isset($_POST['cci']))?(htmlspecialchars($_POST['cci'])):'';
		$mess = (isset($_POST['messCont']))?(htmlspecialchars($_POST['messCont'])):'';
		
		//$auth = (isset($_POST['author']))?(htmlspecialchars($_POST['author'])):''; //uncomment if info sent from ../includes/joEditor/joEditor.html
		//$authMail = (isset($_POST['authMail']))?(htmlspecialchars($_POST['authMail'])):''; //uncomment if info sent from ../includes/joEditor/joEditor.html
		$elt = file_get_contents('../phpmailer/data.json'); //contient your SMTP infos
		$elt = json_decode($elt, true);
		$auth = explode("@", $elt['user'])[0]; //get your name before @ from your SMTP infos saved into ../phpmailer/data.json
		$authMail = $elt['user']; //get your mail from your SMTP infos saved into ../phpmailer/data.json
		
		$authPic = (isset($_POST['authPic']))?(htmlspecialchars($_POST['authPic'])):'';
		$date=date('Y').'-'.date('m').'-'.date('d');
		$read=true;
		//echo $obj;
		$json = (object) array('author'=>$auth, 'authorMail'=>$authMail, 'authorPic'=>$authPic, 'date'=>$date, 'read'=>$read, 'object'=>$obj, 'to'=>$to, 'cc'=>$cc, 'cci'=>$cci, 'message'=>$mess);
		//write out file
		//print_r($json);
		$mailNew = json_decode(json_encode($json), true);
		$sentMails = file_get_contents('../data/sentMails.json');
		$sentMails = json_decode($sentMails, true);
		array_push($sentMails, $mailNew); //add the nouveau mail
		//print_r($sentMails);
		$sentMails=json_encode($sentMails);
		file_put_contents('../data/sentMails.json', $sentMails);
		?>
		<audio src="../img/notif.mp3" autoplay></audio>
		<div style="background:rgba(0,255,0,0.1); border-radius:15px; padding:20px; margin:30px;">
			<center>Votre mail a été envoyé avec succès !</center>
		</div>
		<?php
	break;
	case 'suppr': //delete a mail
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):'';
		$type = (isset($_GET['type']))?(htmlspecialchars($_GET['type'])):'';
		
		if ($type=="sent"){ //delete a sent mail
			$elt = file_get_contents('../data/sentMails.json');
			$elt = json_decode($elt, true);
			array_splice($elt, $id, 1);
			
			$elt=json_encode($elt);
			//print_r($elt);
			file_put_contents('../data/sentMails.json', $elt);
		}
		else if ($type=="draft"){ //delete a draft mail
			/*****$elt = file_get_contents('../data/draftMails.json');
			$elt = json_decode($elt, true);
			array_splice($elt, $id, 1);
			
			$elt=json_encode($elt);
			//print_r($elt);
			file_put_contents('../data/draftMails.json', $elt); ****/
		}
		else if ($type=="recieved"){ //delete a reception mail
			$elt = file_get_contents('../data/recievedMails.json');
			$elt = json_decode($elt, true);
			array_splice($elt, $id, 1);
			
			$elt=json_encode($elt);
			file_put_contents('../data/recievedMails.json', $elt);
		}
		?>
		<audio src="../img/delete.mp3" autoplay></audio>
		<div style="background:rgba(255,0,0,0.1); border-radius:15px; padding:20px; margin:30px;">
			<center>Mail supprimé avec succès !</center>
		</div>
		<?php
	break;
	case 'reply':
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //mail id
		$type = (isset($_GET['type']))?(htmlspecialchars($_GET['type'])):''; //which data to read ? (sentMails, draftMails or recievedMails)
		$howMany = (isset($_GET['howMany']))?(htmlspecialchars($_GET['howMany'])):''; //one => reply to sender and all=>reply to all
		if ($type=="recieved"){
			$theData = '../data/recievedMails.json';
		}else if ($type=="sent"){
			$theData = '../data/sentMails.json';
		}
		
		if ($howMany=="one"){ //reply to one person
			$elt = file_get_contents($theData);
			$elt = json_decode($elt, true);
			$rpl = $elt[$id]['authorMail'];
			$obj = $elt[$id]['object'];
			$rplcc = '';
			$rplcci = '';
			//echo $elt;
		}else if ($howMany=="all"){ //reply to all
			$elt = file_get_contents($theData);
			$elt = json_decode($elt, true);
			$rpl = $elt[$id]['authorMail'].' ; '.$elt[$id]['to'];
			$obj = $elt[$id]['object'];
			$rplcc = $elt[$id]['cc'];
			$rplcci = $elt[$id]['cci'];
		}
		?>
		<div>
			<hr>
			<iframe src="includes/joEditor/joEditor.html?rpl=<?php echo $rpl ?>&obj=<?php echo $obj ?>&rplcc=<?php echo $rplcc ?>&rplcci=<?php echo $rplcci ?>" style="width:100%; height:90vh; border:none;"></iframe>
		</div>
		<?php
	break;
	case 'share': //transférer a mail
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //mail id
		$type = (isset($_GET['type']))?(htmlspecialchars($_GET['type'])):''; //which data to read ? (sentMails, draftMails or recievedMails)
		if ($type=="recieved"){
			$elt = file_get_contents('../data/recievedMails.json');
			$elt = json_decode($elt, true);
			$obj = $elt[$id]['object'];
			$mess = $elt[$id]['message'];
		}
		else if ($type=="sent"){
			$elt = file_get_contents('../data/sentMails.json');
			$elt = json_decode($elt, true);
			$obj = $elt[$id]['object'];
			$mess = $elt[$id]['message'];
		}
		?>
		<div>
			<hr>
			<iframe src="includes/joEditor/joEditor.html?obj=<?php echo $obj ?>&mess=<?php echo $mess ?>" style="width:100%; height:90vh; border:none;"></iframe>
		</div>
		<?php
	break;
	case 'parametres':
		$data = file_get_contents('../phpmailer/data.json');
		$data = json_decode($data, true);
		?>
		<h3 style="color: #1E5B89"><i class="fa fa-th"></i> Infos SMTP <i class="fa fa-caret-right"></i> <button class="newMess fa fa-home" onclick="home()"> Fermer</button></h3>
		<hr>
		<form method="post" action="installation.php?cas=submit" class="row">
			<div class="form-group col-4 col-md-2">
				<label><img src="img/logo.jpg" class="img-thumbnail img-fluid" style="max-height:100px"></label>
			</div>
			<div class="col-10 col-md-6">
				<div class="form-group">
					<label for="host">Host</label>
					<input type="text" class="form-control" id="host" name="host" value="<?php echo $data['host'] ?>" required="">
				</div>
				<div class="form-group">
					<label for="user">User</label>
					<input type="email" class="form-control" name="user" value="<?php echo $data['user'] ?>" required="">
				</div>
				<div class="form-group">
					<label for="pwd">Password</label>
					<input type="password" class="form-control" id="pwd" name="pwd" value="<?php echo $data['password'] ?>" required="">
				</div>
				<div class="form-group">
					<label for="user">Port</label>
					<input type="number" class="form-control" id="port" name="port" value="<?php echo $data['port'] ?>" required="" min="0">
				</div>
				<button type="submit" class="newMess btn-block">Modifier</button>
			</div>
		</form>
		<?php
	break;
	case 'group':
		if (isset($_GET['delete'])){ //delete a group
			$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):'-1'; //group id
			$elt = file_get_contents('../data/groups.json');
			$elt = json_decode($elt, true);
			
			array_splice($elt, $id, 1); //delete the group
			
			$elt=json_encode($elt);
			file_put_contents('../data/groups.json', $elt); //save data
			
			echo "<center style='margin-top:35vh'><h3>Le groupe a été supprimé avec succès !</h3><br><a href='index.php'>Terminer</a></center>";
		}
		if (!isset($_GET['submit']) and !isset($_GET['act']) and !isset($_GET['delete'])){
			$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):'-1'; //group id
			$data = file_get_contents('../data/groups.json');
			$data = json_decode($data, true);
			?>
			<h3 style="color: #1E5B89"><i class="fa fa-th"></i> <?php echo $data[$id]['name'] ?> <i class="fa fa-caret-right"></i> <button class="newMess fa fa-home" onclick="home()"> Fermer</button> | <button class="newMess fa fa-plus" onclick="displayGroup('-1', 'newGroup')"> Ajouter nouveau group</button></h3>
			<hr>
			<div class="row">
				<div class="col-12 col-md-6" style="padding:15px">
					<button class="newMess btn-block" onclick="writeGroupMail(<?php echo $id ?>)">Envoyer un mail au group <i class="fa fa-paper-plane"></i></button>
					<hr>
					<hr>
					<hr>
					<form method="post" action="includes/myMail.php?opt=group&submit=true" class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Nom du groupe</label>
								<input type="text" class="form-control" id="name" name="name" value="<?php echo $data[$id]['name'] ?>" required="">
							</div>
							<div class="form-group">
								<label for="desc">Description (245 caractères max)</label>
								<textarea class="form-control" name="desc" required="" rows="3" maxlength="245"><?php echo $data[$id]['description'] ?></textarea>
							</div>
							<div class="form-group">
								<label for="mails">Mails</label>
								<input type="text" class="form-control" id="mails" name="mails" value="<?php echo $data[$id]['mails'] ?>" required="">
							</div>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<center><button type="submit" class="newMess" style="width:45%">Modifier ce group</button> | <button type="button" class="newMess" onclick="displayGroup('-1', 'none', 'delete')" title="La suppression est irreversible !" style="width:45%">Supprimer ce group</button></center>
						</div>
					</form>
				</div>
				<div class="col-12 col-md-6" style="padding:15px; max-height:500px; background:#ECF7FF; border-radius:10px; overflow:auto">
					<div class="row">
						<div class="col-12"><h5>Mails du groupe</h5><hr></div>
						<?php
						$j=1;
						$mails=explode(';', $data[$id]['mails']);
						foreach ($mails as $mail){
							echo '<div class="col-6"><b>'.$j.':</b> '.$mail.'<hr></div>';
							$j++;
						}
						?>
					</div>
				</div>
			</div>
			<script>
				document.getElementById('mails').addEventListener("keyup", function(event){ //add separator ( ; ) between mails
					if (event.keyCode === 32){ //if space clicked
						document.getElementById('mails').value = document.getElementById('mails').value+"; ";
					}
				});
			</script>
			<?php
		}
		else if (isset($_GET['submit']) and !isset($_GET['act']) and !isset($_GET['delete'])){ //edit group infos
			$id = (int) (isset($_POST['id']))?(htmlspecialchars($_POST['id'])):'-1'; //group id
			$name = strip_tags( (isset($_POST['name']))?(htmlspecialchars($_POST['name'])):'' );
			$desc = strip_tags( (isset($_POST['desc']))?(htmlspecialchars($_POST['desc'])):'' );
			$mails = strip_tags( (isset($_POST['mails']))?(htmlspecialchars($_POST['mails'])):'' );
			$desc = nl2br($desc);
			//echo $id.'<br>';
			//echo $mails;
			$elt = file_get_contents('../data/groups.json');
			$elt = json_decode($elt, true);
			
			if ($id<0 or $id>=sizeof($elt)) $id="newGroup";
			if ($id=='newGroup') $date=date('Y').'-'.date('m').'-'.date('d');
			else $date=$elt[$id]['date']; //old date because not nouveau group
			
			$json = (object) array('name'=>$name, 'description'=>$desc, 'date'=>$date, 'mails'=>$mails);
			$new = json_decode(json_encode($json), true);
		    if ($id=="newGroup") array_push($elt, $new); //add the new group
			else $elt[$id] = $new; //update the old group
			
			//print_r($elt);
			$elt=json_encode($elt);
			file_put_contents('../data/groups.json', $elt); //save data
			
			echo "<center style='margin-top:35vh'><h3>Le groupe a été modifié avec succès !</h3><br><a href='../index.php'>Terminer</a></center>";
		}
		else if (isset($_GET['act']) and !isset($_GET['newSubmit']) and !isset($_GET['delete'])){ //create a new group (act=action)
			?>
			<h3 style="color: #1E5B89"><i class="fa fa-th"></i> Nouveau Group <i class="fa fa-caret-right"></i> <button class="newMess fa fa-home" onclick="home()"> Annuler</button></h3>
			<hr>
			<h6>Créer un nouveau groupe ( veuillez séparer les adresse mails par des ; ) !</h6>
			<div class="row">
				<div class="col-12 col-md-6" style="padding:15px">
					<hr>
					<form method="post" action="includes/myMail.php?opt=group&act=newGroup&newSubmit=true" class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="name">Nom du groupe</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Titre du groupe" required="">
							</div>
							<div class="form-group">
								<label for="desc">Description (245 caractères max)</label>
								<textarea class="form-control" name="desc" required="" rows="3" placeholder="Description du group" maxlength="245"></textarea>
							</div>
							<div class="form-group">
								<label for="mails">Mails</label>
								<input type="text" class="form-control" id="mails" name="mails" placeholder="Liste des adresses mails (séparées par des ; )" required="">
							</div>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<button type="submit" class="newMess btn-block">Ajouter le groupe</button>
						</div>
					</form>
				</div>
			</div>
			<script>
				document.getElementById('mails').addEventListener("keyup", function(event){ //add separator ( ; ) between mails
					if (event.keyCode === 32){ //if space clicked
						document.getElementById('mails').value = document.getElementById('mails').value+"; ";
					}
				});
			</script>
			<?php
		}
		else if (isset($_GET['act']) and isset($_GET['newSubmit']) and !isset($_GET['delete'])){ //finish creating a new group
			$name = strip_tags( (isset($_POST['name']))?(htmlspecialchars($_POST['name'])):'' );
			$desc = strip_tags( (isset($_POST['desc']))?(htmlspecialchars($_POST['desc'])):'' );
			$mails = strip_tags( (isset($_POST['mails']))?(htmlspecialchars($_POST['mails'])):'' );
			$desc = nl2br($desc);
			$date=date('Y').'-'.date('m').'-'.date('d');
			
			$elt = file_get_contents('../data/groups.json');
			$elt = json_decode($elt, true);
			
			$json = (object) array('name'=>$name, 'description'=>$desc, 'date'=>$date, 'mails'=>$mails);
			$new = json_decode(json_encode($json), true);
		    array_push($elt, $new); //add the new group
			
			//print_r($elt);
			$elt=json_encode($elt);
			file_put_contents('../data/groups.json', $elt); //save data
			
			echo "<center style='margin-top:35vh'><h3>Le nouveau groupe a été créé avec succès !</h3><br><a href='../index.php'>Terminer</a></center>";
		}
	break;
	case 'newGroupMail': //write a mail to a specific group
		$id = (int) (isset($_GET['id']))?(htmlspecialchars($_GET['id'])):''; //group id
		$elt = file_get_contents('../data/groups.json');
		$elt = json_decode($elt, true);
		$mails = $elt[$id]['mails'];
		?>
		<div>
			<hr>
			<iframe src="includes/joEditor/joEditor.html?group=<?php echo $mails ?>" style="width:100%; height:90vh; border:none;"></iframe>
		</div>
		<?php
	break;
	default:
		?>
		<div class="bodyDefault">
			<h1 class="fa fa-envelope"></h1>
			<p><i>Selectionnez un message pour l'afficher</i></p>
		</div>
		<?php
		//this code is created by Josué - jose.init.dev@gmail.com
	break;
}
?>