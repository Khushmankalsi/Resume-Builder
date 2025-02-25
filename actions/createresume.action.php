<?php 
require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    $required_fields = ['full_name', 'email_id', 'objective', 'phone_no', 'dob', 'gender', 'religion', 'nationality', 'marital_status', 'hobbies', 'languages', 'address'];
    
    foreach ($required_fields as $field) {
        if (!isset($post[$field]) || empty(trim($post[$field]))) {
            die("Error: Missing required field $field");
        }
    }
    
    $columns = '';
    $values = '';
    
    foreach ($post as $index => $value) {
        $$index = $db->real_escape_string($value);
        $columns .= "$index, ";
        $values .= "'$value', ";
    }

    $authid = $fn->Auth()['id'];
    
    $columns .= "slug, updated_at,user_id";
    $values .= "'" . $fn->randomstring() . "', " . time().",".$authid;
    
    $query = "INSERT INTO resumes ($columns) VALUES ($values)";
    
    if ($db->query($query)) {
        $fn->setAlert('Resume Added!');
        $fn->redirect('../myresumes.php');
    } else {
        die("Database Error: " . $db->error);
        $fn->redirect('../createresume.php');

    }
} else {
    die("Error: No POST data received.");
    $fn->redirect('../createresume.php');
}
