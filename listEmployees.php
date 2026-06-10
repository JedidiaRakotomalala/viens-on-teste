<?php
include ("fonctions.php") ;
if (isset($_GET["departement"])) {
    $dept_no = $_GET["departement"] ;
} else {
    header('location:index.php?error=0') ;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE EMPLOYES PAR DEPARTEMENT: </title>
</head>
<body>
    <h3>LISTE EMPLOYES DANS LE DEPARTEMENT: 
        <?php 
            $departement = mysqli_query(dbconnect(), "SELECT dept_name FROM departments WHERE dept_no='$dept_no'") ;
            $row = mysqli_fetch_assoc($departement) ;
            echo $row["dept_name"] ;
        ?>
    </h3>
    <table border=1>
        <tr><th>NOMS</th></tr>
        <?php 
        $listeEmployes = mysqli_query(dbconnect(), $sql) ;
        foreach ($listeEmployes as $un_employe) { ?>
            <tr><th><?php echo $un_employe["nom"]." ".$un_employe["prenom"] ; ?></th></tr>
        <?php } ?>
    </table>
</body>
</html>