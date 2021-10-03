

// Function permettant de modifier la valeur d'une caractéristique lors de l'appui des flèches
// Parmètres : 
// caracteristique => nom de la caractéristique
// valeur => Valeur dont on veut faire évoluer la caractéristique
function modifCar(caracteristique, valeur) {
	
	// On définit que le total des caractéristiques ne peut pas ecxéder 50 
	// et une caractéristique ne peut pas excéder 20 
	const POINT_TOTAL=50;
	const POINT_MIN=0;
	const VALEUR_MAX=20;
	const VALEUR_MIN=0;
	
	// Contruction du total actuel des caractéristiques
    let force = Number(document.getElementById("form2force").value);
    let agilite = Number(document.getElementById("form2agilite").value);
    let dexterite = Number(document.getElementById("form2dexterite").value);
    let constitution = Number(document.getElementById("form2constitution").value);
    let magie = Number(document.getElementById("form2magie").value);

    let totalCarac = force + agilite + dexterite + constitution + magie;
	
	// S'il reste des points à répartir
	if ((totalCarac < POINT_TOTAL && totalCarac > POINT_MIN) || (totalCarac === POINT_TOTAL &&  valeur < 0) || (totalCarac === POINT_MIN &&  valeur > 0))
	{
		// Si la valeur est dans les bornes acceptables
		valeurCarac=Number(document.getElementById("form2" + caracteristique).value);
		if ((valeurCarac < VALEUR_MAX && valeurCarac > VALEUR_MIN) || (valeurCarac === VALEUR_MAX &&  valeur < 0) || (valeurCarac === VALEUR_MIN &&  valeur > 0))  
		{	
			document.getElementById("form2" + caracteristique).value = Number(document.getElementById("form2" + caracteristique).value)+valeur;
			document.getElementById("form2" + caracteristique+"BM").value = Number(document.getElementById("form2" + caracteristique).value)-10 ;
		}
	} 
}

// Fonction permettant de vérifier si l'adresse email est correcte
// La règle utilisée ici dans l'expression régulière est normée
// Paramètre : emailAVerifier chaine de caractères contenant l'adresse email à valider
// Sortie : la fonction renvoie vraie si l'adresse est correctre, faux sinon
function validationEmail(emailAVerifier) {
	var expressionReguliere = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
	if (expressionReguliere.test(emailAVerifier))
	{ 
		return(true);
	}
	return(false);
}

// Fonction permettant de valider complètement le formulaire d'inscription au moment du submit
// Si au moins un des champs n'est pas correctement renseigné, le formulaire n'est pas soumis
function validationInscription() {
	// Récuparation de l'objet formulaire
	var formInsc  = document.getElementById('formInscription');
	// Ajout d'une écoute sur la fonction submit du formulaire
	// La fonction sera interrompue et la fonction de vérification sera jouée 
	formInsc.addEventListener("submit", function (event) {
		var inscriptionValide = true;
		// On efface les messages d'erreurs
		document.getElementById("form2AvatarNomError").className="";		
		document.getElementById("form2GenreError").className="";
		document.getElementById("form2CaracError").className="";
		document.getElementById("form2LoginError").className="";
		document.getElementById("form2MdpError").className = "";
		document.getElementById("form2AvatarNomError").innerHTML="";		
		document.getElementById("form2GenreError").innerHTML="";
		document.getElementById("form2CaracError").innerHTML="";
		document.getElementById("form2LoginError").innerHTML="";
		document.getElementById("form2MdpError").innerHTML = "";

		// On vérifie qu'un nom a été saisi
		if (document.getElementById("form2AvatarNom").value=="")
		{
			errorHTML="Vous devez choisir un nom pour votre avatar !";
			document.getElementById("form2AvatarNomError").innerHTML = errorHTML	
			document.getElementById("form2AvatarNomError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// On vérifie qu'un genre a été sélectionné
		if (document.getElementById("form2Genre").value=="0")
		{
			errorHTML="Vous devez sélectionner un genre !";
			document.getElementById("form2GenreError").innerHTML = errorHTML	
			document.getElementById("form2GenreError").className="formErrorMsg";
			inscriptionValide=false;
		}

		// On vérifie que le total des caractéristiques fait bien 50
	    let force = Number(document.getElementById("form2force").value);
		let agilite = Number(document.getElementById("form2agilite").value);
		let dexterite = Number(document.getElementById("form2dexterite").value);
		let constitution = Number(document.getElementById("form2constitution").value);
		let magie = Number(document.getElementById("form2magie").value);
		let totalCarac = force + agilite + dexterite + constitution + magie;
		if (totalCarac!=50)
		{
			errorHTML=" Le montant total des caracteristiques doit être de 50 !";
			document.getElementById("form2CaracError").innerHTML = errorHTML	
			document.getElementById("form2CaracError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// On vérifie que le login est valide en appelant la fonction ValidationEmail
	  	if (!validationEmail(document.getElementById("form2Login").value))
		{
			errorHTML=" L'adresse email n'est pas valide !";
			document.getElementById("form2LoginError").innerHTML = errorHTML
			document.getElementById("form2LoginError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// On vérifie que le mot de passe est conforme
		var mdp = document.getElementById("form2Mdp").value; 
		if (!mdp.match( /[0-9]/g) ||                // Il y a un chiffre
				!mdp.match( /[A-Z]/g) ||            // Il y a une majuscule
				!mdp.match(/[a-z]/g) ||             // il y a une minuscule 
				!mdp.match( /[^a-zA-Z\d]/g))        // il y a un caractère spécial
		{
			errorHTML=" Le mot de passe doit contenir :<br> Une majuscule, une minuscule, un chiffre, un caractère spécial!";
			document.getElementById("form2MdpError").innerHTML = errorHTML
			document.getElementById("form2MdpError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// Si un des champs n'est pas valide on prévient la soumission du formulaire
		// On reste sur la page d'accueil
		if (!inscriptionValide) {
			event.preventDefault();
		}
	}, false);
}

// Fonction permettant de valider complètement le formulaire de connexion au moment du submit
// Si au moins un des champs n'est pas correctement renseigné, le formulaire n'est pas soumis

function validationConnexion() {
	var formInsc  = document.getElementById('formConnexion');
	// on ajoute une écoute sur l'évennement submit du formulaire
	formInsc.addEventListener("submit", function (event) {
		var inscriptionValide = true;
		// On vide les messages d'erreurs
		document.getElementById("form1LoginError").className="";
		document.getElementById("form1MdpError").className = "";
		document.getElementById("form1LoginError").innerHTML="";
		document.getElementById("form1MdpError").innerHTML = "";

		// On vérifie l'adresse email avec la fonction validationEmail
	  	if (!validationEmail(document.getElementById("form1Login").value))
		{
			errorHTML=" L'adresse email n'est pas valide !";
			document.getElementById("form1LoginError").innerHTML = errorHTML
			document.getElementById("form1LoginError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// A On vérifie si un mot de passe est saisi
		if (document.getElementById("form1Mdp").value=="" )
		{
			errorHTML="Vous devez saisir un mot de passe !";
			document.getElementById("form1MdpError").innerHTML = errorHTML
			document.getElementById("form1MdpError").className="formErrorMsg";
			inscriptionValide=false;
		}
		// Si un des champs n'est pas valide on prévient la soumission du formulaire
		// On reste sur la page d'accueil
		if (!inscriptionValide) {
			event.preventDefault();
		}
	}, false);
}

