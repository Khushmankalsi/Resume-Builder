<?php
require '../Assets/class/database.class.php';
require '../Assets/class/function.class.php';

if ($_GET && isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    
    $authid = $fn->Auth()['id'];

    $slug = $db->real_escape_string($slug);
    $authid = $db->real_escape_string($authid);
    
    $db->begin_transaction();
    
    try {
        $result = $db->query("SELECT id FROM resumes WHERE slug = '$slug' AND user_id = '$authid'");
        if ($result->num_rows === 0) {
            throw new Exception("Resume not found");
        }
        $resume = $result->fetch_assoc();
        $resume_id = $resume['id'];
        
        $db->query("DELETE FROM skills WHERE resume_id = '$resume_id'");
        $db->query("DELETE FROM educations WHERE resume_id = '$resume_id'");
        $db->query("DELETE FROM experiences WHERE resume_id = '$resume_id'");
        
        $db->query("DELETE FROM resumes WHERE id = '$resume_id'");
        
        $db->commit();
        
        if ($db->affected_rows > 0) {
            $fn->setAlert('Resume and all related data deleted successfully!');
        } else {
            error_log("User ID: $authid");
            error_log("Resume Slug: $slug");
            
            $fn->setAlert('Resume and all related data deleted successfully!');
        }
        $fn->redirect('../myresumes.php');
    } catch (Exception $e) {
        $db->rollback();
        die("Database Error: " . $e->getMessage());
    }
} else {
    die("Error: No resume slug provided.");
}
