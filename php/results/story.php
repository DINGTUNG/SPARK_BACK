<?php
    require_once("../conn.php");
    $sql = "SELECT * FROM story ORDER BY story_no DESC";
    $result = $link->query($sql);
    $stories = array();
    header("Content-Type: application/json; charset=utf-8");
    while ($row = $result->fetch_assoc()) {
        array_push($stories, array(
            "story_no"=> $row['story_no'],
            "story_title"=> $row['story_title'],
            "story_date"=> $row['story_date'],
            "story_image"=> $row['story_image'],
            "story_brief"=> $row['story_brief'],
            "story_detail"=> $row['story_detail'],
            "story_detail_second"=> $row['story_detail_second'],
            "story_detail_third"=> $row['story_detail_third']
          ));
    }
    $json = array(
        "stories" => $stories
    );
        $response = json_encode($json);


        echo $response;
?>