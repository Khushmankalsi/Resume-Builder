<?php

    require './Assets/class/function.class.php';
    require './Assets/class/database.class.php';

    // $fn->AuthPage();
    $slug = $_GET['resume']??'';
    $resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND  user_id=".$fn->Auth()['id'].") ");
    $resume = $resumes->fetch_assoc();

    if(!$resume){
        $fn->redirect('myresumes.php');
    }

    $exps = $db->query("SELECT * FROM experiences WHERE (resume_id = ".$resume['id'].") ");
    $exps = $exps->fetch_all(1);

    $edus = $db->query("SELECT * FROM educations WHERE (resume_id = ".$resume['id'].") ");
    $edus = $edus->fetch_all(1);

    $skills = $db->query("SELECT * FROM skills WHERE (resume_id = ".$resume['id'].") ");
    $skills = $skills->fetch_all(1);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./Assets/images/logo-0.png">
    <title><?=$resume['full_name'].' | '.$resume['resume_title']  ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>


<style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Poppins', sans-serif;
            font-size: 12pt;

            background: rgb(0, 0, 0);
            background: radial-gradient(circle, rgb(255, 255, 255) 0%, rgb(134, 126, 126) 49%, rgb(0, 0, 0) 100%);
            background-attachment: fixed;
        }

        * {
            margin: 0px;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {

            width: 21cm;
            min-height: 29.7cm;
            padding: 0.5cm;
            margin: 0.5cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {




        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        * {
            transition: all .2s;
        }

        table {
            border-collapse: collapse;
        }

        .pr {
            padding-right: 30px;
        }
        
        .pd-table td {
            padding-right: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
        }
    </style>

<!-- </body> -->
<body class="pdf-content" >

<div class="page">
    <div class="subpage">
        <table class="w-100">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold fs-4 text-primary ">Resume</td>
                </tr>
                
                <tr>
                    <td></td>
                    <td class="personal-info zsection">
                    <br><br>
                        <div class="fw-bold name"><?=$resume['full_name']?></div>
                        <div>Mobile : <span class="mobile"><?=$resume['phone_no']?></span></div>
                        <div>Email : <span class="email"><?=$resume['email_id']?></span></div>
                        <div>Address : <span class="address"><?=$resume['address']?></span></div>
                        <hr>
                    </td>
                </tr>

                <tr class="objective-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Objective</td>
                    <td class="pb-3 objective">
                    <?=$resume['objective']?>
                    </td>
                </tr>

                <tr class="experience-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Experience</td>
                    <td class="pb-3 experiences">


                    <?php
                    if($exps){
                        foreach($exps as $exp){
                            ?>
                            <div class="experience mb-2">
                            <div class="fw-bold">- <span class="job-role"><?=$exp['position']?></div>
                            <div class="company"><?=$exp['company']?></div>
                            <div><span class="working-from"><?=$exp['started']?></span> – <span class="working-to"><?=$exp['ended']?></span></div>
                            <div class="work-description"><?=$exp['job_desc']?></div>
                        </div>
                            <?php
                        }
                    }else{
                        ?>
                            <h6 class="text-danger" > <b> Enter experience from your home page edit button </b> </h6>
                        <?php
                    }
                    ?>



                    </td>
                </tr>

                <tr class="education-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Education</td>
                    <td class="pb-3 educations">


                    <?php
                    if($edus){
                        foreach($edus as $edu){
                            ?>
                            <div class="education mb-2">
                            <div class="fw-bold">- <span class="course"><?=$edu['course']?></div>
                            <div class="institute"><?=$edu['institute']?></div>
                            <div class="date"><?=$edu['started']?></div>
                            <div class="date"><?=$edu['ended']?></div>
                        </div>
                        </div>
                            <?php
                        }
                    }else{
                        ?>
                            <h6 class="text-danger" > <b> Enter Education Qualifications from your home page edit button </b> </h6> 
                        <?php
                    }
                    ?>


                    </td>
                </tr>

                <tr class="skills-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Skills</td>
                    <td class="pb-3 skills">



                    <?php
                    if($skills){
                        foreach($skills as $skill){
                            ?>
                            <div class="skill">- <?=$skill['skill']?></div>
                        </div>
                        </div>
                            <?php
                        }
                    }else{
                        ?>
                            <h6 class="text-danger" > <b> Enter your Skills from your home page edit button </b> </h6> 
                        <?php
                    }
                    ?>



                        

                    </td>
                </tr>

                <tr class="personal-details-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Personal Details</td>
                    <td class="pb-3">
                        <table class="pd-table">
                            <tr>
                                <td>Date of Birth</td>
                                <td>: <span class="date-of-birth"><?=date(' d F Y',strtotime($resume['dob']))?></span></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>: <span class="gender"><?=$resume['gender']?></span></td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>: <span class="religion"><?=$resume['religion']?></span></td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>: <span class="nationality"><?=$resume['nationality']?></span></td>
                            </tr>
                            <tr>
                                <td>Marital Status</td>
                                <td>: <span class="marital-status"><?=$resume['marital_status']?></span></td>
                            </tr>
                            <tr>
                                <td>Hobbies</td>
                                <td>: <span class="hobbies"><?=$resume['hobbies']?></span></td>
                            </tr>

                        </table>

                    </td>
                </tr>

                <tr class="languages-known-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Languages Known</td>
                    <td class="pb-3 languages">

                    <?=$resume['languages']?>
                    </td>
                </tr>

                <tr class="declaration-section zsection">
                    <td class="fw-bold align-top text-nowrap pr title">Declaration</td>
                    <td class="pb-5 declaration">
                        I hereby declare that above information is correct to the best of my
                        knowledge and can be supported by relevant documents as and when
                        required.
                    </td>
                </tr>
                <tr>
                    <td class="px-3">Date : </td>
                    <td class="px-3 name text-end"><?=$resume['full_name']?></td>

                </tr>
            </tbody>
        </table>
    </div>

</div>
                </body>
                <script>
                    function saveAsPDF() {
                        const element = document.querySelector('.pdf-content'); // Select the content
                        html2pdf().from(element).save('<?=$resume['full_name']?>.pdf'); // Convert & Save as "Resume.pdf"
                    }
                </script>

</html>