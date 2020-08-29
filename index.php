<!--
Author: Josué
Author URL: jose.init.dev@gmail.com
License: Apache License :: Josué Yao
License Version: 2.0, January 2004
License URL: http://mailto:jose.init.dev@gmail.com :: http://www.apache.org/licenses
Project First version : 2020-08-18
Project Actual Version: 1.0  -  date: 2020-08-18
-->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Newsletter</title>
        
        <meta name="description" content="Newsletter sofware to send and recieve html mails." />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf8mb4" />
        
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/calendar.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton" type="text/css">
		<link rel="shortcut icon" type="image/x-icon" href="img/gmail.png" type="text/css" media="all" />
		
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='js/bootstrap.min.js'></script>
        <script src='js/calendar.js'></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<?php
				//----read mails data//-------
				$mails = file_get_contents('data/recievedMails.json');
				$mails = json_decode($mails, true);
				$notRead=0;
				foreach ($mails as $mail){ if ($mail['read']==false) $notRead++; }
				?>
				<!--------left row---------->
				<div class="col-1 leftRow">
					<div class="row" style="margin-top:-15px">
						<div class="col-12 logoBlock" onclick="home(reload=true)" title="Accueil newsletter">
						<!----logo (edit it in style class .logo)---->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<hr><hr>
							<button class="fa fa-edit newMess" onclick="writeNewMail()"> nouveau</button><br>
							<hr>
							<button class="fa fa-envelope btnIcon" onclick="reception()"><i><?php echo $notRead ?></i></button><br>
							<span>Reception</span>
							<hr>
							<button class="fa fa-paper-plane btnIcon" onclick="sent()"></button><br>
							<span>Envoyé</span>
							<hr>
							<button class="fa fa-trash btnIcon" onclick="draft()"></button><br>
							<span>Brouillon</span>
							<hr>
							<button class="fa fa-users btnIcon" onclick="groups()"></button><br>
							<span>Groupes</span>
							<hr><hr>
							<div class="leftBottom">
								<button title="Paramètres" onclick="parametres()"><i class="fa fa-cog fa-spin"></i></button> | <button title="Calendrier" onclick="calendar()"><i class="far fa-calendar-alt"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--------//left row---------->
				<!--------center row-------->
				<div class="col-3 centerRow">
					<input type="text" name="search" required="" placeholder="Requette + Entrer" class="form-control">
					<br>
					<div id="centerBody">
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
											<i><?php echo htmlspecialchars_decode(substr($mails[$i]['message'],0,35)).'...' ?></i>
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
											<i><?php echo htmlspecialchars_decode(substr($mails[$i]['message'],0,35)).'...' ?></i>
										</div>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
				<!--------//center row-------->
				<!--------right row-------->
				<div class="col-8 rightRow">
					<div class="row">
						<div class="col-12 bodyTop">
							<ul class="nav nav-tabs justify-content-end" id="bodyHead">
								<!------body head-------->
							</ul>
						</div>
						<div class="col-12" id="mailBody">
							<hr>
							<?php include('includes/myMail.php'); ?>
						</div>
					</div>
					<i style="font-size:8px;position:absolute;bottom:1px">&copy; Made by Josué</i>
				</div>
				<!--------//right row-------->
			</div>
		</div>
		
		<div class="loader" id="joSpinner"></div>
		
		<script>
			//---------------------------
			function loadSpinner(){
				setTimeout(function() { //-------wait 1sec so we can voir spinner effect//-----------
					document.getElementById('joSpinner').style.display='none';
				}, 800);
			}
			//---------------------------
			function ajaxLoad(link){
				loadSpinner();
				
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("mailBody").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", link, true);
				xhttp.send();
			}
			function ajaxLoad_2(link){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("centerBody").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", link, true);
				xhttp.send();
			}
			//this code is created by Josué - jose.init.dev@gmail.com
			//---------------------------
			let readClick=false; //let us know if mail body contents a mail or not
			let actualId=-1;
			function readIt(id){
				if (!readClick || actualId!=id){ //no mail in body, so display it
					readClick=true;
					actualId=id;
					//set as read
					setAsRead(id);
					
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php?opt=readMail&id="+id);
					document.getElementById('bodyHead').innerHTML='<li class="nav-item"><a class="nav-link" href="#" onclick="reply('+id+', \'recieved\', \'one\')"><b class="fa fa-reply"> Répondre</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="reply('+id+', \'recieved\', \'all\')"><b class="fa fa-reply-all"> Répondre à tous</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="transfert('+id+', \'recieved\')"><b class="fa fa-share"> Transférer</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="supprimer('+id+', \'recieved\')"><b class="fas fa-eraser"> Supprimer</b></a></li>';
				}else{ //mail already in body, so hide it
					readClick=false;
					actualId=-1;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php");
					document.getElementById('bodyHead').innerHTML='';
				}
			}
			//---------------------------
			readClick=false; //let us know if mail body contents a mail or not
			actualId=-1;
			function readSent(id){
				if (!readClick || actualId!=id){ //no mail in body, so display it
					readClick=true;
					actualId=id;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php?opt=readMail&id="+id+"&st=yes"); //yes means it's a sent mail and non une reception
					document.getElementById('bodyHead').innerHTML='<li class="nav-item"><a class="nav-link" href="#" onclick="reply('+id+', \'sent\', \'one\')"><b class="fa fa-reply"> Répondre</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="reply('+id+', \'sent\', \'all\')"><b class="fa fa-reply-all"> Répondre à tous</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="transfert('+id+', \'sent\')"><b class="fa fa-share"> Transférer</b></a></li><li class="nav-item"><a class="nav-link" href="#" onclick="supprimer('+id+', \'sent\')"><b class="fas fa-eraser"> Supprimer</b></a></li>';
				}else{ //mail already in body, so hide it
					readClick=false;
					actualId=-1;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php");
					document.getElementById('bodyHead').innerHTML='';
				}
			}
			//---------------------------
			readClick=false; //let us know if mail body contents a mail or not
			actualId=-1;
			function readDraft(id){
				if (!readClick || actualId!=id){ //no mail in body, so display it
					readClick=true;
					actualId=id;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php?opt=readDraft&id="+id);
					document.getElementById('bodyHead').innerHTML='<h3 style="color: #fff"><i class="fa fa-th"></i> Mes Brouilons <i class="fa fa-caret-right"></i> <button class="newMess fa fa-eraser" onclick="supprimer('+id+', \'draft\')"> Supprimer</button> <button class="newMess fa fa-trash" onclick="addTrash()"> Brouillon</button></h3>';
				}else{ //mail already in body, so hide it
					readClick=false;
					actualId=-1;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php");
					document.getElementById('bodyHead').innerHTML='';
				}
			}
			//---------------------------
			function calendar(){
				//load and display the calendar
				ajaxLoad("includes/myMail.php?opt=calendar");
			}
			//---------------------------
			function writeNewMail(){ //load for writing a new mail
				ajaxLoad("includes/myMail.php?opt=new");
				document.getElementById('bodyHead').innerHTML='<h3 style="color: #fff"><i class="fa fa-th"></i> Nouveau Message <i class="fa fa-caret-right"></i> <span id="btnElts"><button class="newMess fa fa-home" onclick="home()"> Annuler</button></span></h3>';
			}
			//---------------------------
			function writeGroupMail(id){ //load for writing a new group mail
				ajaxLoad("includes/myMail.php?opt=newGroupMail&id="+id);
				document.getElementById('bodyHead').innerHTML='<h3 style="color: #fff"><i class="fa fa-th"></i> Nouveau Message au Groupe <i class="fa fa-caret-right"></i> <span id="btnElts"><button class="newMess fa fa-home" onclick="home()"> Annuler</button> <button class="newMess fa fa-trash" onclick="addTrash()"> Brouillon</button></span></h3>';
			}
			//---------------------------
			function home(reload=false){
				if (reload){ location.reload(); } //reload full page
				else{ ajaxLoad("includes/myMail.php"); } //just reload right section (read mail section)
			}
			//---------------------------
			function setAsRead(id){ //set a mail comme read
				ajaxLoad("includes/myMail.php?opt=isRead&id="+id);
				reception(); //reaload aside section (centerRow)
			}
			//---------------------------
			function reception(){ //boite de reception
				ajaxLoad_2("includes/aside.php");
			}
			//---------------------------
			function sent(){ //sent mails
				ajaxLoad_2("includes/aside.php?opt=sent");
			}
			//---------------------------
			function draft(){ //draft mails
				ajaxLoad_2("includes/aside.php?opt=draft");
			}
			//---------------------------
			function reply(id, type, howMany){ //reply to mail from data type with this id
				//alert(id+" -- "+type+" -- "+howMany);
				//one => reply to sender and all=>reply to all
				ajaxLoad("includes/myMail.php?opt=reply&id="+id+"&type="+type+"&howMany="+howMany);
				document.getElementById('bodyHead').innerHTML='<h3 style="color: #fff"><i class="fa fa-th"></i> Répondre <i class="fa fa-caret-right"></i> <span id="btnElts"><button class="newMess fa fa-home" onclick="home()"> Annuler</button></span></h3>';
			}
			//---------------------------
			function transfert(id, type){ //share a mail from data type with this id
				//alert(id+" -- "+type);
				ajaxLoad("includes/myMail.php?opt=share&id="+id+"&type="+type);
				document.getElementById('bodyHead').innerHTML='<h3 style="color: #fff"><i class="fa fa-th"></i> Transférer <i class="fa fa-caret-right"></i> <span id="btnElts"><button class="newMess fa fa-home" onclick="home()"> Annuler</button></span></h3>';
			}
			//---------------------------
			function supprimer(id, type){ //delete a mail from data type with this id
				//alert(id+" -- "+type);
				ajaxLoad("includes/myMail.php?opt=suppr&id="+id+"&type="+type);
				if (type=="sent"){
					sent(); //reload sent mails list
				}else if (type=="recieved"){
					reception(); //reload recieved mails list
				}else if (type=="draft"){
					draft(); //reload draft mails list
				}
			}
			//---------------------------
			function parametres(){ //display and modifier SMTP infos
				ajaxLoad("includes/myMail.php?opt=parametres");
			}
			//---------------------------
			function groups(){ //display groups into aside (center) section
				ajaxLoad_2("includes/aside.php?opt=groups");
			}
			//---------------------------
			function displayGroup(id, action='none', effacer='none'){ //display group info into right section
				if (action=="newGroup"){
					ajaxLoad("includes/myMail.php?opt=group&id="+id+"&act=newGroup");
				}else if (effacer=='delete'){
					ajaxLoad("includes/myMail.php?opt=group&id="+id+"&delete=true");
				}else{
					ajaxLoad("includes/myMail.php?opt=group&id="+id);
				}
			}
			//---------------------------
			function editLogo(){
				let input = document.getElementById('edit-logo');
				if(input.theLogo.files.length > 0){
					input.submit();
				};
			}
			//---------------------------
		</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
		<div class="spinner-grow" id="loadingPage" style="position:fixed; top:15px; right:15px; width:60px; height:60px; color:orange; z-index:999;"></div>
		<script>
		  document.onreadystatechange = function(){
				if (document.readyState !== "complete"){
					document.getElementById('loadingPage').style.display = "block";
				}else{
					document.getElementById('loadingPage').style.display = "none";
				}
			};
		</script>
	</body>
</html>
        