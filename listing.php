<?php
/**
 * Template Name: Jobs
 */
get_header();
?>
<div class="inner-wrap">
    <div class="section group maincontent">
        <div class="col span_1_of_4 sidebar">Vacancies</div>
        <div class="col span_2_of_4 mainblk">
            <?php

                $key = "ffe53559b2e2d4c7eb84e106b4580910";
                $apiUrl = "reach-ats.com";
                $type = "ext"; //ext|int (external/internal)

                function jobListing($key,$apiUrl,$type='ext') {

                    $output = "";

                    switch($type){
                        case 'int':
                            $apiEndpoint = "internalListing";
                            break;
                        default:
                            $apiEndpoint = "listing";
                    }

                    //Retrieve and parse the job data from the ATS server in JSON format
                    $parsedJobData = json_decode(@file_get_contents("https://".$key.".".$apiUrl."/get/job/".$apiEndpoint."/-/-/-/-/JSON"));

                    //check if empty
                    if(empty($parsedJobData)) {

                        // Replace this with your preferred code/message & styling
                        $output = "Unfortunately there are no vacancies available at this time";

                    }else{

                        //For each job published to the career site
                        foreach($parsedJobData as $job){

                        //Get the advert text to create a lead line
                        //$advertText = @file_get_contents($fullApiUrl."/get/job/advert/$job->id");

                        $output .= "
                            <div>
                                <h2>".$job->title. "</h2>
                                <p>
                                    <strong>Location</strong>: ".$job->location."<br/>
                                    <strong>Type</strong>: ".$job->type. "<br/>
                                    <strong>Hours</strong>: " . $job->hours . "<br/>
                                    <strong>Salary</strong>: ".$job->salarydescription. "<br/>
                                </p>
                                <p>
                                    " . $job->shortdescription . "
                                </p>
                                <p>
                                    <a href='".$job->applyurl."' target='_blank'>Apply Now</a> | <a href='/vacancies/detail?job=".$job->id."&title=".strtolower(preg_replace(['/ /','/&/'],["-","and"],$job->title))."'>View Detail</a>
                                </p>
                                <hr/>
                            </div>
                        ";
                        }
                    }

                    return $output;
                
                }

                echo jobListing($key,$apiUrl);

            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
