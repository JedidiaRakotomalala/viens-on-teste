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
    <title>Liste des Départements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="container" style="max-width: 900px;">
        
        <?php if (isset($_GET["error"])): ?>
            <div class="alert alert-danger">Une erreur est survenue.</div>
        <?php endif; ?>

        <h3 class="mb-4 text-center">Gestion des Départements</h3>
        
        <table class="table table-bordered table-striped bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Département</th>
                    <th>Manager</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dept = mysqli_query(dbconnect(), $sql) ;
                foreach ($dept as $un_dept) { ?>
                <tr>
                    <td><strong><?php echo $un_dept["departement"] ?></strong></td>
                    <td><a href="ficheEmployees.php?employe_nom=<?=$un_dept["nom"]?>&employe_prenom=<?=$un_dept["prenom"]?>"><?php echo $un_dept["nom"]." ".$un_dept["prenom"] ?></a></td>
                    <td><a href="listEmployees.php?departement=<?=$un_dept["dept_no"]?>" class="btn btn-sm btn-primary">Voir les employés</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>