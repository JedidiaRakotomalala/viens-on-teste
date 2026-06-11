<?php
include ("fonctions.php") ;
if (isset($_GET["departement"])) {
    $dept_no = $_GET["departement"] ;
} else {
    header('location:index.php?error=0') ;
    exit(); // Bonne pratique : on arrête le script après une redirection
}
$sql = "SELECT 
    a.first_name AS nom,
    a.last_name AS prenom
FROM employees a
JOIN dept_emp b ON a.emp_no = b.emp_no
JOIN departments c ON b.dept_no = c.dept_no
WHERE c.dept_no = '$dept_no' " ;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des employés par département</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h3 class="mb-0 card-title">
                            Département :  
                            <?php 
                                $departement = mysqli_query(dbconnect(), "SELECT dept_name FROM departments WHERE dept_no='$dept_no'") ;
                                $row = mysqli_fetch_assoc($departement) ;
                                echo htmlspecialchars($row["dept_name"]) ;
                            ?>
                        </h3>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-4">Employés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $listeEmployes = mysqli_query(dbconnect(), $sql) ;
                                    if (mysqli_num_rows($listeEmployes) > 0) {
                                        foreach ($listeEmployes as $un_employe) { ?>
                                            <tr>
                                                <td class="ps-4 py-3 align-middle font-monospace">
                                                    <?php echo htmlspecialchars(strtoupper($un_employe["nom"])." ".$un_employe["prenom"]) ; ?>
                                                </td>
                                            </tr>
                                        <?php } 
                                    } else { ?>
                                        <tr>
                                            <td class="text-center text-muted py-4">Aucun employé dans ce département.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div> <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-sm btn-secondary">← Retour à l'accueil</a>
                </div>

            </div>
        </div>
    </div>
    <h2>TEST DE MODIFICATION (modifiee par 01)</h2>
    <h2>TEST DE MODIFICATION (modifiee par 01 le vrai)</h2>
    <h2>TEST DE MODIFICATION (modifiee par 01 le faut)</h2>
    <h2>TEST DE MODIFICATION (modifiee par 01 le vrai 2)</h2>

</body>
</html>