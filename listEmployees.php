<?php
include ("fonctions.php") ;
if (isset($_GET["departement"])) {
    $dept_no = $_GET["departement"] ;
} else {
    header('location:index.php?error=0') ;
    exit();
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
    <title>Liste Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="container" style="max-width: 600px;">
        
        <h3 class="mb-4 text-center">
            Département : 
            <?php 
                $departement = mysqli_query(dbconnect(), "SELECT dept_name FROM departments WHERE dept_no='$dept_no'") ;
                $row = mysqli_fetch_assoc($departement) ;
                echo $row["dept_name"] ;
            ?>
        </h3>

        <table class="table table-bordered table-striped bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Noms des employés</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $listeEmployes = mysqli_query(dbconnect(), $sql) ;
                foreach ($listeEmployes as $un_employe) { ?>
                    <tr>
                        <td><?php echo $un_employe["nom"]." ".$un_employe["prenom"] ; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-sm btn-secondary">Retour</a>
        </div>
    </div>

</body>
</html>