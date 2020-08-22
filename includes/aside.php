<?php
$option = (isset($_GET['opt']))?(htmlspecialchars($_GET['opt'])):'';

switch ($option){
	case 'sent': //sent mails
		//----read sent mails data//-------
		$mails = file_get_contents('../data/sentMails.json');
		$mails = json_decode($mails, true);
		?>
		<h6><b>Boite d'envoi <i style="color:orange"><?php echo sizeof($mails) ?></i></b></h6>
		<?php
		for ($i=sizeof($mails)-1; $i>=0; $i--){
			//echo $mails[$i]['object'];
			?>
			<div class="entity">
				<div class="row mailEntity2" onclick="readSent(<?php echo $i ?>)">
					<div class="col-2">
						<img src="img/<?php echo $mails[$i]['authorPic'] ?>" class="rounded-circle img-fluid">
					</div>
					<div class="col-10">
						<h6><b><?php echo $mails[$i]['author'] ?></b></h6>
						<span><b>Objet:</b> <?php echo $mails[$i]['object'] ?></span><br>
						<i><?php echo substr($mails[$i]['message'],0,35).'...' ?></i>
					</div>
				</div>
			</div>
			<?php
		}
	break;
	case 'draft': //draft mails
		//----read draft mails data//-------
		$mails = file_get_contents('../data/draftMails.json');
		$a=explode('draft=', $mails);
		//print_r($a);
		$mails = json_decode($a[1], true);
		//echo $mails[0]['author'];
		?>
		<h6><b>Corbeille <i style="color:orange"><?php echo sizeof($mails) ?></i></b></h6>
		<?php
		for ($i=sizeof($mails)-1; $i>=0; $i--){
			?>
			<div class="entity">
				<div class="row mailEntity2" onclick="readDraft(<?php echo $i ?>)">
					<div class="col-2">
						<img src="img/<?php echo $mails[$i]['authorPic'] ?>" class="rounded-circle img-fluid">
					</div>
					<div class="col-10">
						<h6><b><?php echo $mails[$i]['author'] ?></b></h6>
						<span><b>Objet:</b> <?php echo $mails[$i]['object'] ?></span><br>
						<i><?php echo substr($mails[$i]['message'],0,35).'...' ?></i>
					</div>
				</div>
			</div>
			<?php
		}
	break;
	default: //recieved mails
		//----read mails data//-------
		$mails = file_get_contents('../data/recievedMails.json');
		$mails = json_decode($mails, true);
		$notRead=0;
		foreach ($mails as $mail){ if ($mail['read']==false) $notRead++; }
		?>
		<h6><b>Boite de réception <i style="color:orange"><?php echo $notRead ?></i></b></h6>
		<?php
		for ($i=sizeof($mails)-1; $i>=0; $i--){
			//echo $mails[$i]['object'];
			if ($mails[$i]['read']==false){
				?>
				<div class="entity">
					<div class="row mailEntity" onclick="readIt(<?php echo $i ?>)">
						<div class="col-2">
							<img src="img/<?php echo $mails[$i]['authorPic'] ?>" class="rounded-circle img-fluid">
						</div>
						<div class="col-10">
							<h6><b><?php echo $mails[$i]['author'] ?></b></h6>
							<span><b>Objet:</b> <?php echo $mails[$i]['object'] ?></span><br>
							<i><?php echo substr($mails[$i]['message'],0,35).'...' ?></i>
						</div>
						<b class="fa fa-circle notRead"></b>
					</div>
				</div>
				<?php
			}else{
				?>
				<div class="entity">
					<div class="row mailEntity2" onclick="readIt(<?php echo $i ?>)">
						<div class="col-2">
							<img src="img/<?php echo $mails[$i]['authorPic'] ?>" class="rounded-circle img-fluid">
						</div>
						<div class="col-10">
							<h6><b><?php echo $mails[$i]['author'] ?></b></h6>
							<span><b>Objet:</b> <?php echo $mails[$i]['object'] ?></span><br>
							<i><?php echo substr($mails[$i]['message'],0,35).'...' ?></i>
						</div>
					</div>
				</div>
				<?php
			}
		}
		//this code is created by Josué - jose.init.dev@gmail.com
	break;
}
?>