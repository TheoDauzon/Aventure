<?php // si la porte est trouvée affichage de la porte
if ($porteTrouve) 
{
	$strHTMLCarte='<div class="porte espaceHaut">
	<table><tr><td width=60%>
	<img src="../vue/img/porte.jpg" width=100%></img>
	</td><td width=40%>
   Aventurier,<br> tu as atteint la porte menant au prochain monde. Si tu souhaites passer au monde suivant, clique sur la porte. Mais attention, il n\'y a pas de retour possible.
	</td></tr></table>
	</div>';
}
else // affichage du plan
{ 
	$strHTMLCarte='<TABLE class="carte espaceHaut">';
	for ($ity=0 ; $ity < $y ; $ity ++) {
		$strHTMLCarte=$strHTMLCarte."<TR>";
		for ($itx=0;$itx<$x;$itx++) {
			
			$tdClass="tdCarteDecouverte";
			$tdText="&nbsp";
			if (($itx==$xInit) && ($ity==$yInit))
			{
				$tdClass="tdEpee";
			}
			elseif ($tabCarteDecouvert[$ity][$itx]==0) 
			{
				$tdClass="tdCarteNonDecouverte";
			}
			elseif ($tabCarteDecouvert[$ity][$itx]==1)  
			{
				if ($tabCarte[$ity][$itx]==0) 
				{
					$tdClass="tdCarteBloquee";
				}
				elseif ($tabCarte[$ity][$itx]==2)
				{
					$tdClass="tdPorte";
				}
			}
			$strHTMLCarte=$strHTMLCarte.'<TD  class="tdCarte ';
			$strHTMLCarte=$strHTMLCarte.$tdClass.'">'.$tdText.'</TD>';
		}
		$strHTMLCarte=$strHTMLCarte."</TR>";
	}
	$strHTMLCarte=$strHTMLCarte."</TABLE>";
}


// Création du personnage
$strHTMLPerso="";
	// création de l'affichage de la carte personnage
	$strHTMLPerso=$strHTMLPerso . '<div class="cartePerso centrer espaceHaut" >';
	$strHTMLPerso=$strHTMLPerso . '<div class="carteTitre">'.$perso->get_persoNom()."</div>";
	$strHTMLPerso=$strHTMLPerso . "Epée dégât 1-5 (" . $perso->getBonus($perso->get_persoFor()).")<br>";
	$strHTMLPerso=$strHTMLPerso . '<table class="barre"><tr">';
	for ($itCase=0;$itCase<$perso->get_persoCon();$itCase++)
	{
		$strHTMLPerso=$strHTMLPerso . '<td class="barreVieOK"></td>';
	}
	$strHTMLPerso=$strHTMLPerso . '</tr></table>';
	$strHTMLPerso=$strHTMLPerso . '<table class="barre"><tr>';
	for ($itCase=0;$itCase<$perso->get_persoMag();$itCase++)
	{
		$strHTMLPerso=$strHTMLPerso . '<td class="barreMagieOK"></td>';
	}
	$strHTMLPerso=$strHTMLPerso . "</tr></table>";
	//$strHTMLPerso=$strHTMLPerso . '</td><td></td></tr></table>';
	$strHTMLPerso=$strHTMLPerso . '</div>';
	

require_once "../vue/pageEntete.php";
echo '<div class="centrer">';
echo '<a href="../controleur/index.php"><img src="../vue/IMG/LogoAventureMini.jpg" width="80%" class="centrer espaceHaut"/></a>';
echo $strHTMLPerso;
echo $strHTMLCarte; 

?> 

<form action=# method="post">
		<input type="hidden" name="xInit" value="<?php echo $xInit; ?>"/>
		<input type="hidden" name="yInit" value="<?php echo $yInit; ?>"/>
		<input type="hidden" name="tabCarte" value="<?php echo $strTabCarte ?>"/>
		<input type="hidden" name="tabCarteHash" value="<?php echo $strTabCarteHash ?>"/>		
		<input type="hidden" name="perso" value="<?php echo $strPerso ?>"/>
		<input type="hidden" name="persoHash" value="<?php echo $strPersoHash ?>"/>
		<input type="hidden" name="tabCarteDecouvert" value="<?php echo $strTabCarteDecouvert ?>"/>
		<input type="hidden" name="tabCarteDecouvertHash" value="<?php echo $strTabCarteDecouvertHash ?>"/>
		<table class="centrerTableau espaceHaut" ><tr><td>
		<input type="submit" name="ouest" value="" class="boutonOuest"/>
		</td><td>
		<input type="submit" name="nord" value="" class="boutonNord" /><br>
		<input type="submit" name="sud" value="" class="boutonSud"/>
		</td><td>
		<input type="submit" name="est" value="" class="boutonEst"/>
		</td></tr></table>
</form>

<?php 
echo '</div>';
require_once "../vue/pagePied.php";?>