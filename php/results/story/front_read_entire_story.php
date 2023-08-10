<?php
    require_once("../../connect_chd102g3.php");
    $story_no = $_GET['story_no'];
    $sql = "SELECT * FROM story WHERE is_story_online=1 AND story_no=$story_no ORDER BY story_no DESC";
    $result = $pdo->query($sql);
    $stories = array();
    header("Content-Type: application/json; charset=utf-8");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($stories, array(
            "story_no"=> $row['story_no'],
            "story_id"=> $row['story_id'],
            "story_title"=> $row['story_title'],
            "story_date"=> $row['story_date'],
            "story_image"=> $row['story_image'],
            "story_brief"=> $row['story_brief'],
            "story_detail"=> $row['story_detail'],
            "story_detail_second"=> $row['story_detail_second'],
            "story_detail_third"=> $row['story_detail_third'],
          ));
    }
    
    $json = array(
        "stories" => $stories
    );
        $res = json_encode($json);
         echo $res;
?>