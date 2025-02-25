<?php
    // Set default timezone to India
    date_default_timezone_set('Asia/Kolkata');
    
    $title = " My Resumes | Resume Builder ";
    require './Assets/includes/header.php';
    require './Assets/includes/navbar.php';
    $fn->AuthPage();
    $resumes = $db->query('SELECT * FROM resumes WHERE user_id='.$fn->Auth()['id'].' ORDER BY id DESC');
    $resume = $resumes->fetch_all(1);
?>



    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h3 style="color:#0d6efd;" >Resumes</h3> <h6 style='font-size:12px;'; > CLICK ON EDIT TO ADD MORE DETAILS</h6>
                <div>
                    <a href="createresume.php" class="text-decoration-none"><i class="bi bi-file-earmark-plus"></i> Add New</a>
                </div>
            </div>


<?php

if($resumes){
    ?>
     <div class="d-flex flex-wrap">
        <?php
        
        foreach($resumes as $resume){   
            ?>
            <div class="col-12 col-md-6 p-2">
    <div class="p-2 border rounded">
    <h5><?=$resume['resume_title']?></h5>
        <p class="small text-secondary m-0" style="font-size:12px"><i class="bi bi-clock-history"></i>
            Last Updated <?=date('d F, y h:i A', $resume['updated_at'] )?>
        </p>
        <div class="d-flex gap-2 mt-1">
            <a target="_blank" href="resume.php?resume=<?=$resume['slug']?>" class="text-decoration-none small"><i class="bi bi-file-text"></i> Open</a>
            <a href="Updateresume.php?resume=<?=$resume['slug']?>" class="text-decoration-none small"><i class="bi bi-pencil-square"></i> Edit</a>
            <a href="actions/deleteresume.action.php?resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" class="text-decoration-none small"><i class="bi bi-trash2">  Delete </i></a>
            <!-- <a href="" class="text-decoration-none small"><i class="bi bi-share"></i> Share</a> -->
            <!-- <a href="" class="text-decoration-none small"><i class="bi bi-copy"></i> Clone</a> -->

        </div>
    </div>
</div>

            <?php
            }     
        ?>






</div>
    <?php
}else{
    ?>
                <div class="text-center py-3 border rounded mt-3" style="background-color: rgba(236, 236, 236, 0.56);">
                <i class="bi bi-file-text"></i> No Resumes Available
            </div>
    <?php
}

?>





           

        </div>

    </div>

    <?php

require './Assets/includes/footer.php';

?>

