<?php
require_once 'DbConnect.php';

$db = new DbConnect();
$conn = $db->connect();

if (isset($_POST['UserEdit'])) {
    $id = $_POST['Id'];
    $stmt = $conn->prepare("SELECT * FROM UserTable WHERE Id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['UserUpdate'])) {
    $id = $_POST['Id'];
    $nom = $_POST['LastName'];
    $prenom = $_POST['FirstName'];
    $telephone = $_POST['Phone'];
    $ville = $_POST['City'];
    $adresse = $_POST['Address'];

    $stmt = $conn->prepare("UPDATE UserTable SET LastName = :nom, FirstName = :prenom, Phone = :telephone, City = :ville, Address = :adresse WHERE Id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->execute();

    echo "<script>alert('Enregistrement modifié avec succès'); window.location.href='PersonalContact.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Contact</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <h1>Modifier Utilisateur</h1>
    <form method="POST" action="">
        <input type="hidden" name="Id" value="<?= $contact['Id'] ?>">
        <label for="LastName">Nom :</label><br>
        <input type="text" id="LastName" name="LastName" value="<?= $contact['LastName'] ?>" required><br>
        <label for="FirstName">Prénom :</label><br>
        <input type="text" id="FirstName" name="FirstName" value="<?= $contact['FirstName'] ?>" required><br>
        <label for="Phone">Téléphone :</label><br>
        <input type="text" id="Phone" name="Phone" value="<?= $contact['Phone'] ?>"><br>
        <label for="City">Ville :</label><br>
        <input type="text" id="City" name="City" value="<?= $contact['City'] ?>"><br>
        <label for="Address">Adresse :</label><br>
        <textarea id="Address" name="Address"><?= $contact['Address'] ?></textarea><br>
        <button type="submit" name="UserUpdate">Mettre à jour</button>
    </form>
</body>
</html>
