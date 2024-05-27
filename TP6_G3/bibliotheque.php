<?php function getPDO() {
    $host = 'localhost';
    $dbname = 'banque';
    $user = 'root';
    $pass = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "erreur de connection :" . $e->getMessage();
        return null;
    }
}
getPDO();

function ExisteClient($codeCIN) {
    $pdo = getPDO();
    if(!$pdo) return false;
    $sql = "SELECT COUNT(*) FROM clients WHERE cin = :cin";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':cin' => $codeCIN]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function Existecompte($numerodecompte) {
    $pdo = getPDO();
    if (!$pdo) return false;
    
    $sql = "SELECT COUNT(*) FROM comptes WHERE numero_compte = :numero_compte";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([':numero_compte' => $numerodecompte]);

    $count = $stmt->fetchColumn();
    
    return $count > 0;
}


function NouveauClient($nom,$prenom,$adresse,$codeCIN,$numerodecompte,$montant) {
    $pdo = getPDO();
    if (!$pdo) return false;
    try {
        $pdo->beginTransaction();
        if(ExisteClient($codeCIN)) {
            $pdo->rollBack();
            return false;
        }

        $sqlClient = "INSERT INTO clients (nom,prenom,adresse,cin)
        VALUES (:nom, :prenom, :adresse, :cin)";
        $stmtClient = $pdo->prepare($sqlClient);
        $stmtClient->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':adresse' => $adresse,
            ':cin' => $codeCIN
        ]);
        $sqlCompte = "INSERT INTO comptes (numero_compte, montant , cin_client) VALUES (:numero_compte, :montant, :cin_client)";
        $stmtCompte = $pdo->prepare($sqlCompte);
        $stmtCompte->execute([
            ':numero_compte' => $numerodecompte,
            ':montant' => $montant,
            ':cin_client' => $codeCIN
        ]);
        $pdo->commit();
        return true;
    }
    catch (PDOException $e){
        $pdo->rollBack();
        echo 'Erreur lors de l\'ajout du nouveau client :' . $e->getMessage();
        return false;
    }
}

function Virement($numeroCompte,$valeur) {
    $pdo = getPDO();
    if(!$pdo) return false;

    try {
        $pdo->beginTransaction();

        if(!ExisteCompte($numeroCompte)) {
            $pdo->rollBack();
            return false;
        }

        $sql = "UPDATE comptes SET montant = montant + :valeur WHERE numero_compte = :numero_compte";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':valeur'=>$valeur,
            ':numero_compte'=>$numeroCompte
        ]);

        $pdo->commit();
        return true;
    }
    catch(PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors du virement: " .$e->getMessage();
        return false;
    }
}

function infos($codeCIN) {
    $pdo = getPDO();
    if(!$pdo) return;

    try {
        $sqlClient = "SELECT nom, prenom FROM clients WHERE cin = :cin";
        $stmtClient = $pdo->prepare($sqlClient);
        $stmtClient->execute([':cin' => $codeCIN]);
        $client = $stmtClient->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo "Nom: " . $client['nom'] . "<br>";
            echo "Prenom: " . $client['prenom'] . "<br>";

            $sqlComptes = "SELECT numero_compte, montant FROM comptes WHERE cin_client = :cin_client";
            $stmtComptes = $pdo->prepare($sqlComptes);
            $stmtComptes->execute([':cin_client' => $codeCIN]);
            $comptes = $stmtComptes->fetchAll(PDO::FETCH_ASSOC);

            if ($comptes) {
                echo "Comptes: <br>";
                foreach ($comptes as $compte) {
                    echo "Numéro de compte: " . $compte['numero_compte'] . ", Montant: " . $compte['montant'] . "<br>";
                }
            } else {
                echo "Aucun compte trouvé pour ce client.<br>";
            }
        } else {
            echo "Client non trouvé.<br>";
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors de la récupération des informations: " . $e->getMessage();
        return false;
    }
}


function supprimer($codeCIN){
    $pdo = getPDO();
    if(!$pdo) return false;
    try {
        $pdo->beginTransaction();

        $sqlDeleteComptes = "DELETE FROM comptes WHERE cin_client = :cin_client";
        $stmtDeleteComptes = $pdo->prepare($sqlDeleteComptes);
        $stmtDeleteComptes->execute([':cin_client' => $codeCIN]);

        $sqlDeleteClients ="DELETE FROM clients WHERE cin = :cin";
        $stmtDeleteClients = $pdo->prepare($sqlDeleteClients);
        $stmtDeleteClients->execute([':cin' => $codeCIN]);
        $pdo->commit();
        return true;
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erreur lors du suppression: " .$e->getMessage();
        return false;
    }
}

function debiteurs() {
    $pdo = getPDO();
    if (!$pdo) return;

    try {
        $sqlComptes = "SELECT cin_client FROM comptes WHERE montant < 0";
        $stmtComptes = $pdo->prepare($sqlComptes);
        $stmtComptes->execute();
        $cinList = $stmtComptes->fetchAll(PDO::FETCH_COLUMN, 0);

        if ($cinList) {
            $placeholders = str_repeat('?,', count($cinList) - 1) . '?';
            $sqlClients = "SELECT nom, prenom FROM clients WHERE cin IN ($placeholders)";
            $stmtClients = $pdo->prepare($sqlClients);
            $stmtClients->execute($cinList);
            $clients = $stmtClients->fetchAll(PDO::FETCH_ASSOC);

            if ($clients) {
                echo "Noms et prénoms des clients débiteurs :<br>";
                foreach ($clients as $client) {
                    echo "- " . $client['nom'] . " " . $client['prenom'] . "<br>";
                }
            } else {
                echo "Aucun client débiteur trouvé.<br>";
            }
        } else {
            echo "Aucun compte débiteur trouvé.<br>";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des informations: " . $e->getMessage();
    }
}
?>