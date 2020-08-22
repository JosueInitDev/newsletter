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
			if ($howMany=="one"){
				$elt = file_get_contents('../data/recievedMails.json');
				$elt = json_decode($elt, true);
				$rpl = $elt[$id]['authorMail'];
				$obj = $elt[$id]['object'];
				$rplcc = '';
				$rplcci = '';
				//echo $elt;
			}else if ($howMany=="all"){
				$elt = file_get_contents('../data/recievedMails.json');
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
		}
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