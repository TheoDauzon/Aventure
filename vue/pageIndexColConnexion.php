
				<div class="col">
						<img class="auCentre" src="../vue/img/LogoAventure.jpg" alt="">

						<h2>Déjà inscrit !</h2>
						<form action="../controleur/pageConnexion.php" method="post" id="formConnexion">
							<div class="form-group row" >
								<div class="col">
									<input id="form1Login" name="form1Login" placeholder="Adresse mail" class="form-control">
									<div id="form1LoginError"></div>
								</div>
							</div>
							<div class="form-group row" >
								<div class="col"><input type="password" id="form1Mdp" name="form1Mdp" placeholder="Mot de passe" class="form-control">
									<div id="form1MdpError" ></div>
									<?php if ($errorConnexion) 
											echo '<div id="form1MdpError" class="formErrorMsg" >Les informations saisies sont erronées !</div>';  ?>
								</div>
							</div>
							<input type="submit" id="btnConnecter" value="Se Connecter" name="btnConnection"/>  
						</form>
				</div>
		<script>
			validationConnexion();			
		</script>
			
			
