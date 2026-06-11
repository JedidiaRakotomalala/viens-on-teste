<?php
include ("fonctions.php") ;

$sql = "SELECT 
    a.dept_no AS dept_no,
    a.dept_name AS departement,
    c.first_name AS nom,
    c.last_name AS prenom
FROM departments a
JOIN dept_manager b ON a.dept_no = b.dept_no
JOIN employees c ON b.emp_no = c.emp_no
WHERE b.to_date = '9999-01-01'" ;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Départements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <?php if (isset($_GET["error"])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> Une action a échoué. Veuillez réessayer.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white py-3">
                        <h3 class="mb-0 card-title h4 text-center text-uppercase tracking-wide">
                            Gestion des Départements
                        </h3>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-secondary text-uppercase fs-7">
                                    <tr>
                                        <th class="ps-4">Département</th>
                                        <th>Manager Actuel</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dept = mysqli_query(dbconnect(), $sql) ;
                                    if (mysqli_num_rows($dept) > 0) {
                                        foreach ($dept as $un_dept) { ?>
                                        <tr>
                                            <td class="ps-4 fw-bold text-secondary">
                                                <?php echo htmlspecialchars($un_dept["departement"]) ?>
                                            </td>
                                            
                                            <td>
                                                <a href="ficheEmployees.php?employe_nom=<?=urlencode($un_dept["nom"])?>&employe_prenom=<?=urlencode($un_dept["prenom"])?>" 
                                                   class="text-decoration-none fw-semibold text-primary">
                                                    👤 <?php echo htmlspecialchars($un_dept["nom"]." ".$un_dept["prenom"]) ?>
                                                </a>
                                            </td>
                                            
                                            <td class="text-end pe-4">
                                                <a href="listEmployees.php?departement=<?=urlencode($un_dept["dept_no"])?>" 
                                                   class="btn btn-sm btn-outline-primary px-3">
                                                    Voir les employés
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } 
                                    } else { ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">Aucun département trouvé.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>