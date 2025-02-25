<?php
require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

function updateResume($post, $db, $fn) {
    $authid = $fn->Auth()['id'];

    $required_fields = ['id', 'full_name', 'email_id', 'objective', 'phone_no', 'dob', 
                       'gender', 'religion', 'nationality', 'marital_status', 'hobbies', 
                       'languages', 'address'];
    
    foreach ($required_fields as $field) {
        if (!isset($post[$field]) || empty(trim($post[$field]))) {
            throw new Exception("Missing required field: $field");
        }
    }

    $set_values = [];
    foreach ($post as $index => $value) {
        if ($index !== 'id') { 
            $escaped_value = $db->real_escape_string($value);
            $set_values[] = "$index = '$escaped_value'";
        }
    }

    
    $set_values[] = "updated_at = " . time();

    
    $resume_id = $db->real_escape_string($post['id']);
    
    
    $query = "UPDATE resumes SET " . implode(', ', $set_values) . 
             " WHERE id = '$resume_id' AND user_id = '$authid'";

    return $db->query($query);
}

if ($_POST) {
    try {
        if (updateResume($_POST, $db, $fn)) {
            $fn->setAlert('Resume updated successfully!');
            $fn->redirect('../myresumes.php');
        } else {
            throw new Exception("Database update failed");
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Error: No POST data received.");
}
