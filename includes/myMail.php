<?php
$option = (isset($_GET['opt']))?(htmlspecialchars($_GET['opt'])):'';

switch ($option){
	case 'readMail':
		?>
		<div class="body">
			<h4><b>Objet:</b> Travail de cet aprem</h4>
		</div>
		<div class="entity">
			<div class="row">
				<div class="p-1">
					<img src="img/gmail.png" class="rounded-circle img-fluid" style="max-width:50px">
				</div>
				<div class="col-11">
					<h6><b>Janette Benisse</b> [janette.benisse@gmail.com]</h6>
					<i class="fa fa-clock"> 2020-08-17</i>
				</div>
				<div class="col-12">
					<i class="fas fa-at"> A</i> : <a href="#demo" data-toggle="collapse"><i>[to.person1@gmail.com], [to.person2@gmail.com], [to.person3@gmail.com], [to.person4@gmail.com] ...</i> <i class="fas fa-angle-down"></i></a>
					<div id="demo" class="collapse">
						<b class="fas fa-pen-alt"> A</b> : <i>[to.person1@gmail.com], [to.person2@gmail.com], [to.person3@gmail.com], [to.person4@gmail.com], [to.person1@gmail.com], [to.person2@gmail.com], [to.person3@gmail.com], [to.person4@gmail.com], [to.person1@gmail.com], [to.person2@gmail.com], [to.person3@gmail.com], [to.person4@gmail.com]</i><br>
						<b class="fas fa-pen"> Cc</b> : <i>[to.person1@gmail.com], [to.person2@gmail.com], [to.person3@gmail.com]</i>
					</div>

				</div>
			</div>
		</div>
		<hr>
		<div class="body">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>
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
			<h2 style="color: #1E5B89"><i class="fa fa-th"></i> Nouveau Message <i class="fa fa-caret-right"></i> <button class="newMess fa fa-eraser" onclick="home()"> Annuler</button> <button class="newMess fa fa-trash" onclick="addTrash()"> Brouillon</button></h2>
			<iframe src="includes/joEditor/joEditor.html" style="width:100%; height:90vh; border:none;"></iframe>
			
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