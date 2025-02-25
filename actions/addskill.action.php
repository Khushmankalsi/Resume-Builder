<?php 
require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;



    $required_fields = ['resume_id','skill' ];
    
    foreach ($required_fields as $field) {
        if (!isset($post[$field]) || empty(trim($post[$field]))) {
            die("Error: Missing required field $field");
        }
    }

    $post2 = $post;
    unset($post['slug']);
    
    $columns = '';
    $values = '';

    
    $columns .= "resume_id, ";
    $values .= "'" . (int)$post['resume_id'] . "', "; 

    foreach ($post as $index => $value) {
        if ($index === 'resume_id') {
            $$index = (int)$value;
        } else {
            $$index = $db->real_escape_string($value);
            $columns .= "$index, ";
            $values .= "'$value', ";
        }
    }

    
    
    $query = "INSERT INTO skills (" . rtrim($columns, ', ') . ") VALUES (" . rtrim($values, ', ') . ")";


    
    if ($db->query($query)) {
        $fn->setAlert('Skills Added!');
        $fn->redirect('../updateresume.php?resume=' . $post2['slug']);
    } else {
        die("Database Error: " . $db->error);
        $fn->redirect('../updateresume.php?resume=' . $post2['slug']);


    }
} else {
    die("Error: No POST data received.");
    $fn->redirect('../updateresume.php?resume=' . $post2['slug']);

}
?>
