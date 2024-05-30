<?php
require_once 'DbConnect.php';

$db = new DbConnect();
$conn = $db->connect();

if (isset($_POST['UserSave'])) {
    $nom = $_POST['LastName'];
    $prenom = $_POST['FirstName'];
    $telephone = $_POST['Phone'];
    $ville = $_POST['City'];
    $adresse = $_POST['Address'];

    $stmt = $conn->prepare("INSERT INTO UserTable (LastName, FirstName, Phone, City, Address) VALUES (:nom, :prenom, :telephone, :ville, :adresse)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->execute();

    echo "<script>alert('Enregistrement effectué avec succès')</script>";
}

if (isset($_POST['UserDelete'])) {
    $id = $_POST['Id'];
    $stmt = $conn->prepare("DELETE FROM UserTable WHERE Id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<script>alert('Enregistrement supprimé avec succès')</script>";
}

if (isset($_POST['UserEdit'])) {
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

    echo "<script>alert('Enregistrement modifié avec succès')</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Personnel</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <h1>UserSave</h1>
    <form method="POST" action="">
        <label for="LastName">Nom :</label><br>
        <input type="text" id="LastName" name="LastName" required><br>
        <label for="FirstName">Prénom :</label><br>
        <input type="text" id="FirstName" name="FirstName" required><br>
        <label for="Phone">Téléphone :</label><br>
        <input type="text" id="Phone" name="Phone"><br>
        <label for="City">Ville :</label><br>
        <input type="text" id="City" name="City"><br>
        <label for="Address">Adresse :</label><br>
        <textarea id="Address" name="Address"></textarea><br>
        <button type="submit" name="UserSave">Enregistrer</button>
    </form>

    <h1>Afficher Contacts</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM UserTable ORDER BY LastName");
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($contacts as $contact): ?>
        <tr>
            <td><?= $contact['Id'] ?></td>
            <td><?= $contact['LastName'] ?></td>
            <td><?= $contact['FirstName'] ?></td>
            <td><?= $contact['Phone'] ?></td>
            <td><?= $contact['City'] ?></td>
            <td><?= $contact['Address'] ?></td>
            <td>
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="Id" value="<?= $contact['Id'] ?>">
                    <button type="submit" name="UserDelete">Supprimer</button>
                </form>
                <form method="POST" action="edit.php" style="display:inline;">
                    <input type="hidden" name="Id" value="<?= $contact['Id'] ?>">
                    <button type="submit" name="UserEdit">Modifier</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
