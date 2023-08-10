<?php
    require_once("../../connect_chd102g3.php");

    $story_no = $_GET['story_no'];

    $sql = "SELECT * FROM story WHERE story_no=". $story_no;
    $result = $pdo->query($sql);
    $storyInfo = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($storyInfo, array(
            "story_no"=> $row['story_no'],
            "story_title"=> $row['story_title'],
            "story_date"=> $row['story_date'],
            "story_image"=> $row['story_image'],
            "story_brief"=> $row['story_brief'],
            "story_detail"=> $row['story_detail'],
            "story_detail_second"=> $row['story_detail_second'],
            "story_detail_third"=> $row['story_detail_third'],
          ));
    }
    // print_r($storyInfo);
    
    $json = array(
        "storyInfo" => $storyInfo
    );
        $res = json_encode($json);
        echo $res;
?>