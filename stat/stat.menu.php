
<?php
	require '../index/header.php';
?>
	
	<table class="TableAccueil">
	
		<tr>
			<td>
				<table>
					<tr><td>Statistique zone g�ographique</td></tr>
					<tr><td class="tdAccueil">
						<p>
							<a href='stat01.php?tystat=1'>Vin par pays</a><br>
							<a href='stat02.php?tystat=1'>Vin par r�gion</a><br>
							<a href='stat03.php?tystat=1'>Vin par appellation</a>
						</p>	
					</td></tr>
				</table>
				
			</td>
			
			<td>
			
				<table>
					<tr><td>Statistique stock</td></tr>
					<tr><td class="tdAccueil">
						<p>
							<a href='stat04.php?tystat=1'>Entr�e par ann�e</a><br>
							<a href='stat05.php?tystat=1'>Sortie par ann�e</a><br>
							<a href='stat11.php?tystat=1'>Bouteille par canal appro</a><br>
						</p>	
					</td></tr>
				</table>
				
			</td>
		
		</tr>
		
		<tr>
			
			<td>
			
				<table>
					<tr><td>Statistique bouteille</td></tr>
					<tr><td class="tdAccueil">
						<p>
							<a href='stat06.php?tystat=1'>Bouteille par mil�sime</a><br>
							<a href='stat07.php?tystat=1'>Entr�e par ann�e</a><br>
						</p>	
					</td></tr>
				</table>
			
			</td>
			
			<td>
			
				<table>
					<tr><td>Statistique autre</td></tr>
					<tr><td class="tdAccueil">
						<p>
							<a href='stat08.php?tystat=1'>Vin par couleur</a><br>
							<a href='stat09.php?tystat=1'>Vin par type</a><br>
							<a href='stat10.php?tystat=1'>Vin par classement</a><br>
						</p>	
					</td></tr>
				</table>
			
			</td>
			
		</tr>
		
	</table>

<?php
	require '../index/Footer.php';
?>




