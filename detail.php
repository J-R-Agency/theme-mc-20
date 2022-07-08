<?php
/**
 * Template Name: Job Detail
 */
get_header();
?>
<div class="inner-wrap">
    <div class="section group maincontent">
        <div class="col span_1_of_4 sidebar">Vacancy Detail</div>
        <div class="col span_2_of_4 mainblk">
            <?php

                $key = "ffe53559b2e2d4c7eb84e106b4580910";
                $apiUrl = "reach-ats.com";
                $jobId = $_GET['job']; //assumes querystring variable e.g. https://www.example.com/vacancies/detail?job=94260
                $type = "ext"; //ext|int (external/internal)

                //FETCH DATA FORM URL
                function get_reach_data($dataURL)
                {
                    //if open use allow_url_fopen,
                    //else use cURL
                    if (ini_get('allow_url_fopen') == true) {
                        $reachData = @file_get_contents($dataURL);
                    } else if (function_exists('curl_init')) {
                        $curl = curl_init($dataURL);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        $reachData = curl_exec($curl);
                        curl_close($curl);
                    } else {
                        // Enable 'allow_url_fopen' or install cURL.
                        die("Can't load data. Please enable 'allow_url_fopen' or install cURL.");
                    }

                    return $reachData;
                }

                //RETRIEVE JOB DETAIL
                function jobDetail($key, $apiUrl, $jobid, $type)
                {

                    //set output var
                    $output = array();
                    $output['error'] = 0;

                    switch($type){
                        case 'int':
                            $apiEndpoint = "internalInformation";
                            break;
                        default:
                            $apiEndpoint = "information";
                    }

                    // Retrieve and parse the job data from the ATS server in JSON format
                    $dataURL = "https://$key.$apiUrl/get/job/$apiEndpoint/$jobid/JSON";
                    $parsedJobData = json_decode(get_reach_data($dataURL));

                    // if there are no live vacancies
                    if (empty($parsedJobData)) {
                        // Replace this with your preferred code/message & styling
                        $output['error'] = 1;
                        $output['errorMsg'] = "<p>Sorry, we can't find that job ID in our system.</p>";
                    } else {
                        $output['job'] = $parsedJobData[0];
                        $output['applyLink'] = trim(get_reach_data("https://$key.$apiUrl/get/job/applyurlsource/$jobid/$type"));
                        $output['jobDesc'] = get_reach_data("https://$key.$apiUrl/get/job/advert/$jobid");
                        $output['jobFilesArray'] = json_decode(get_reach_data("https://$key.$apiUrl/get/job/fileurls/$jobid/JSON"));
                    }

                    return $output;
                }

                $job = jobDetail($key, $apiUrl, $jobId, $appendApply);

            ?>

            <!-- access data -->
            <?php if ($job['error'] == 0) : ?>
                <h2><?= $job['job']->title; ?></h2>
                <p>
                    <strong>Type</strong>: <?= $job['job']->type; ?><br />
                    <strong>Hours</strong>: <?= $job['job']->hours; ?><br />
                    <strong>Salary</strong>: <?= $job['job']->salarydescription; ?>
                </p>
                <br />
                <?= $job['jobDesc']; ?>
                <br />
                <a href="<?= $job['applyLink']; ?>" target="_blank">Apply Here</a>
                <br />
                <?php
                if (!empty($job['jobFilesArray'])) {
                    foreach ($job['jobFilesArray'] as $jobFile) {
                        echo "<a href=\"" . $jobFile->url . "\" title=\"" . $jobFile->type . "\">Download " . $jobFile->type . "</a><br />";
                    }
                } else {
                    //echo "No Files";
                }
                ?>
            <?php else : ?>
                <?= $job['errorMsg']; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>