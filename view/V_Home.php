<ul id="menu">
	<li data-menuanchor="firstPage active"><a href="#firstPage">CubbyHole</a></li>
	<li data-menuanchor="secondPage"><a href="#secondPage">Plans</a></li>
	<li data-menuanchor="3rdPage"><a href="#3rdPage">Connectez vous</a></li>
	<li data-menuanchor="4thpage"><a href="#4thpage">Partager</a></li>
</ul>

<div id="fullpage">
	<div class="section active" id="section0">
		<div class="inner txtCenter">
			<img src="images/cubbyhole600.png" alt="Cubbyhole" class="logo">
			<h1 class="title">Tous vos médias, où que vous soyez</h1>
			<p><strong>CubbyHole v1.0 est maintenant disponible !</strong></p>
			<br class="clear">
		</div>
	</div>
	<div class="section" id="section1">
		<div class="inner txtCenter">
			<h1 class="titreSection">Plans & Pricing</h1>
			<ul class="price-tags">
				<li class="price-tag pro">
					<div class="price-tag-body">
						<header>
							<h6>BASIC</h6>
							<h3>FREE</h3>
						</header>
						<ul class="features">
							<li>300 Mo de stockage</li>
							<li>1 Go de bande passante</li>
							<li>Transferts cryptés</li>
							<li>Lien direct aux fichiers</li>
							<li>Accès depuis un mobile</li>
						</ul>
						<div class="select-plan-btn grey-btn bouton">
							<a href="index.php?page=register&plan=basic">Sélectionner</a>
						</div>
					</div>
				</li>
				<li class="price-tag pro-vpn">
					<div class="price-tag-body">
						<header>
							<h6>PRO</h6>
							<h3>5€/mois</h3>
						</header>
						<ul class="features">
							<li>10 Go de stockage</li>
							<li>5 Go de bande passante</li>
							<li>Transferts cryptés</li>
							<li>Support client</li>
							<li>Lien direct aux fichiers</li>
							<li>Accès depuis un mobile</li>
						</ul>
						<div class="select-plan-btn grey-btn bouton">
							<a href="index.php?page=register&plan=pro">Sélectionner</a>
						</div>
				</div>
				</li>
				<li class="price-tag vpn">
					<div class="price-tag-body">
						<header>
							<h6>BUSINESS</h6>
							<h3>40€/mois</h3>
						</header>
						<ul class="features">
							<li>50 Go de stockage</li>
							<li>10 Go de bande passante</li>
							<li>Transferts cryptés</li>
							<li>Support client</li>
							<li>Lien direct aux fichiers</li>
							<li>Accès depuis un mobile</li>
						</ul>
						<div class="select-plan-btn grey-btn bouton">
							<a href="index.php?page=register&plan=business">Sélectionner</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="section" id="section2">
		<div class="inner txtCenter">
			<img src="http://www.clker.com/cliparts/8/4/7/b/1194994519483348359connect_creating.svg.med.png" />
			<h1 class="titreSection">Connectez vous</h1>
			<p class="blanc">CubbyHole vous permet de partager tous vos médias quand vous voulez, où vous êtes et à partir de l'outil que vous souhaitez !</p>
			<div class="buttonslogin">
				<div class="loginregister">
					<p class="blanc">Connectez vous dès maintenant !</p>
					<button class="btn btn-default" data-toggle="modal" data-target="#modalLogin">Connexion</button>
					<!-- Modal -->
					<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
					    		<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        		<h4 class="modal-title" id="myModalLabel">Connexion</h4>
					      		</div>
						      	<form class="form-signin" id="formLogin" method="post" action="index.php?page=login">
						      		<div class="modal-body">
										<input type="text" name="pseudo" class="form-control inputLogin" placeholder="Pseudo">
										<input type="password" name="password" class="form-control inputLogin" placeholder="Password">
						      		</div>
						      		<div class="modal-footer">
						        		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
						        		<input type="submit" value="Connexion" class="btn btn-large btn-primary" style="background: #064e9a;">
						      		</div>
						      	</form>
					    	</div><!-- /.modal-content -->
					  	</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div>
				<div class="loginregister">
					<p class="blanc">Vous n'êtes pas inscrit, n'attendez plus !</p>
					<a href="#secondPage" class="btn btn-default" title="Inscription">Inscription</a>
				</div>
			</div>
		</div>
	</div>
	<div class="section" id="section3">
		<div class="inner txtCenter">
			<h1 class="titreSection">Partager</h1>
			<p class="blanc">Partager tous vos fichiers. Photos, vidéos, documents et musiques en toute simplicité ! Sur Cubbyhole vous pouvez partager, lire ou écouter tous les formats de fichier, <strong>directement depuis votre navigateur ou votre mobile !</strong></p>
			<br><br>
			<img src="http://www.data2save.co.za/Data/Sites/4/images/office365/fileshare.png">
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#fullpage').fullpage({
		slidesColor: ['#1bbc9b', '#4BBFC3', '#7BAABE', 'whitesmoke'],
		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage'],
		menu: '#menu'
	});
});
</script>