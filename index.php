<?php
include ("fonctions.php") ;
    if (isset($_GET["error"])) {
        echo "erreur" ;
    }

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DE DEPARTEMENT</title>
</head>
<body>
    <table border=1>
        <tr>
            <th>departement</th>
            <th>manager_name</th>
            <th>liste des employes</th>
        </tr>
        <?php
        $dept = mysqli_query(dbconnect(), $sql) ;
        foreach ($dept as $un_dept) { ?>
        <tr>
            <th><?php echo $un_dept["departement"] ?></th>
            <th><a href="ficheEmployees.php?employe_nom=<?=$un_dept["nom"]?>&employe_prenom=<?=$un_dept["prenom"]?>"><?php echo $un_dept["nom"]." ".$un_dept["prenom"] ?></a></th>
            <th><a href="listEmployees.php?departement=<?=$un_dept["dept_no"]?>">employes</a></th>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
