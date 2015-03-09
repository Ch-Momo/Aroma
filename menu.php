<?php
	if(isset($_SESSION["admin"]) and isset($_SESSION["pseudo"]) and trim($_SESSION['pseudo'])!='' and $_SESSION["admin"]=='yes'){
		echo '
			<div id="header">
				<div class="container">
						
					<!-- Le logo -->
						
						<img id="image-logo" src="images/logo.png"/>
					
					<!-- La barre de navigation -->
						<nav id="nav">
							<ul>
								<li><a href="accueil.php">Accueil</a></li>
								<li>
									<a href="">Gestion de bases de données</a>
									<ul>
										<li>
											<a href="">Modifier la base de données des Huiles</a>
											<ul>
												<li><a href="creation_huile.php">Ajouter une huile</a></li>
												<li><a href="modif_huile.php">Modifier une huile</a></li>
												<li><a href="suppr_huile.php">Supprimer une huile</a></li>
											</ul>
										</li>
										<li>
											<a href="">Modifier la base de données des traitements<span id="span-douiller">.</span></a>
											<ul>
												<li><a href="#">Ajouter un traitement</a></li>
												<li><a href="#">Modifier un traitement</a></li>
												<li><a href="#">Supprimer un traitement</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li><a href="left-sidebar.html">Les huiles</a></li>
								<li><a href="right-sidebar.html">Les traitements</a></li>
								<li><a href="deconnexion.php">Déconnexion</a></li>
							</ul>

						</nav>
					</div>	
			</div>';
	}
	else{
		echo '
			<div id="header">
				<div class="container">
						
					<!-- Le logo -->
						
						<img id="image-logo" src="images/logo.png"/>
					
					<!-- La barre de navigation -->
						<nav id="nav">
							<ul>
								<li><a href="index.html">Accueil</a></li>
								<li><a href="left-sidebar.html">La base de données des huiles</a></li>
								<li><a href="right-sidebar.html">La base de données des traitements</a></li>
								<li><a href="no-sidebar.html">Contact</a></li>
							</ul>

						</nav>
					</div>	
			</div>';

	}

?>