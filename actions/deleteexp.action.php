<?php 
require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

if ($_GET) {
    $post = $_GET;

    $required_fields = ['id','resume_id'];

    $required_fields = ['id','resume_id'];
    
    
    
    $query = "DELETE FROM experiences WHERE id = {$post['id']} and resume_id = {$post['resume_id']}";



    
    if ($db->query($query)) {
        $fn->setAlert('Experience Deleted!');
        $fn->redirect('../updateresume.php?resume=' . $post['slug']);
    } else {
        die("Database Error: " . $db->error);
        $fn->redirect('../updateresume.php?resume=' . $post['slug']);


    }
} else {
    die("Error: No POST data received.");
    $fn->redirect('../updateresume.php?resume=' . $post['slug']);

}
?>
