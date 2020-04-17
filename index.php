<?php session_start(); 

	$_SESSION['pseudo'] = "Julian";
	$_SESSION['password'] = "jg062008";

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
        <link rel="stylesheet" type="text/css" href="style.css">
		<meta charset="UTF-8">
			<title>Mon titre</title>
		</head>
		<body>

			<h1>Votre profil</h1>
					<?php
			if(isset($_SESSION['pseudo']) && (isset($_SESSION['password'])))
			
			{
				?>

			<p>Votre pseudo : <?= $_SESSION['pseudo']; ?></p>

			<?php

			}else{
				echo "Veuillez vous connectez !";
			}
			?>


			<form method="post">
				<label>Ton pseudo</label><br/>
				<input type="text" name="pseudo" id="pseudo" required><br/>
				<label>Ton mot de passe</label><br/>
				<input type="password" name="password" id="password" required><br/>				
				<input class="envoyer" type="submit" name="formsend" id="formsend">
			</form>
			<?php
				if(!empty($email) && !empty($password))
				{
					$q = $db->prepare("SELECT * FROM users WHERE email = :email");
					$q->execute(['email' => $email]);
					$result = $q->fetch();
					var_dump($result);
				}
				else{
					echo "Veuillez compléter tous les champs !";
				}		
				if(isset($_POST['formsend'])){
					$pseudo = $_POST['pseudo'];
					$password = $_POST['password'];

				
						$options = [
							'cost' => 12,
						];
						$hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

						if(password_verify($password, $hashpass)){
							echo "Si il arrive a se co";
						}else{
							echo "Mot de passe pas correct";
						}
					include 'includes/database.php';
						global $db;

						$c = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
						$c->execute(array("pseudo" => $pseudo));

						$result = $c->rowCount();

						if($result == 0){
							$q = $db->prepare("INSERT INTO users(pseudo,password) VALUES(:pseudo,:password)");
						$q->execute([
							'pseudo' => $pseudo,
							'password' => $hashpass
						]);
						echo "Ton compte a bien été créé !";
						} else{
							echo "Ton pseudo est déja utilisé mets un 1 ou 0 derriere !";
						}

			}
			?>
			
						</body>
			</html>