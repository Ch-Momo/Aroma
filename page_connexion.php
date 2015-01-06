<?php

session_start();

echo '
<form method="post" action="connexion2.php">
	<p>
		<label for="pseudo">Pseudo :</label>
		<input type="text" name="pseudo" id="pseudo" autofocus required />

		<br />
		<label for="pass">Mot de passe :</label>
		<input type="password" name="pass" id="pass" required />

		<br />
		<input type="submit" value="Se connecter" />

	</p>
</form>';

?>
