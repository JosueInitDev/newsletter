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
		
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='js/bootstrap.min.js'></script>
        <script src='js/calendar.js'></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<!--------left row---------->
				<div class="col-1 leftRow">
					<div class="row" style="margin-top:-15px">
						<div class="col-12 logoBlock" onclick="home()" title="Accueil newsletter">
						<!----logo (edit it in style class .logo)---->
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<hr><hr>
							<button class="fa fa-edit newMess" onclick="writeNewMail()"> nouveau</button><br>
							<hr>
							<button class="fa fa-envelope btnIcon"><i>3</i></button><br>
							<span>Reception</span>
							<hr>
							<button class="fa fa-paper-plane btnIcon"></button><br>
							<span>Envoyé</span>
							<hr>
							<button class="fa fa-trash btnIcon"></button><br>
							<span>Brouillon</span>
							<hr>
							<button class="fa fa-users btnIcon"></button><br>
							<span>Groupes</span>
							<hr><hr>
							<div class="leftBottom">
								<button title="Paramètres"><i class="fa fa-cog fa-spin"></i></button> | <button title="Calendrier" onclick="calendar()"><i class="far fa-calendar-alt"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!--------//left row---------->
				<!--------center row-------->
				<div class="col-3 centerRow">
					<input type="text" name="search" required="" placeholder="Requette + Entrer" class="form-control">
					<br>
					<h6><b>Boite de réception</b></h6>
					<div class="entity">
						<div class="row mailEntity" onclick="readIt()">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
							<b class="fa fa-circle notRead"></b>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
							<b class="fa fa-circle notRead"></b>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
							<b class="fa fa-circle notRead"></b>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
					<div class="entity">
						<div class="row mailEntity2">
							<div class="col-2">
								<img src="img/gmail.png" class="rounded-circle img-fluid">
							</div>
							<div class="col-10">
								<h6><b>Janette Benisse</b></h6>
								<span><b>Objet:</b> Travail de cet aprem</span><br>
								<i>Lorem ipsum dolor sit amet, consectetur ...</i>
							</div>
						</div>
					</div>
				</div>
				<!--------//center row-------->
				<!--------right row-------->
				<div class="col-8 rightRow">
					<div class="row">
						<div class="col-12 bodyTop">
							<ul class="nav nav-tabs justify-content-end">
								<li class="nav-item"><a class="nav-link" href="#"><b class="fa fa-reply"> Répondre</b></a></li>
								<li class="nav-item"><a class="nav-link" href="#"><b class="fa fa-reply-all"> Répondre à tous</b></a></li>
								<li class="nav-item"><a class="nav-link" href="#"><b class="fa fa-share"> Transférer</b></a></li>
								<li class="nav-item"><a class="nav-link" href="#"><b class="fas fa-eraser"> Supprimer</b></a></li>
							</ul>
						</div>
						<div class="col-12" id="mailBody">
							<hr>
							<?php include('includes/myMail.php'); ?>
						</div>
					</div>
				</div>
				<!--------//right row-------->
			</div>
		</div>
		
		<script>
			//---------------------------
			function ajaxLoad(link){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("mailBody").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", link, true);
				xhttp.send();
			}
			//this code is created by Josué - jose.init.dev@gmail.com
			//---------------------------
			let readClick=false; //let us know if mail body contents a mail or not
			function readIt(){
				if (!readClick){ //no mail in body, so display it
					readClick=true;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php?opt=readMail");
				}else{ //mail already in body, so hide it
					readClick=false;
					//load includes/displayMail.php with ajax to read the mail content
					ajaxLoad("includes/myMail.php");
				}
			}
			//---------------------------
			function calendar(){
				//load and display the calendar
				ajaxLoad("includes/myMail.php?opt=calendar");
			}
			//---------------------------
			function writeNewMail(){
				//load for writing a new mail
				ajaxLoad("includes/myMail.php?opt=new");
			}
			//---------------------------
			function home(){
				window.location.href="index.php";
			}
		</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
	</body>
</html>
        