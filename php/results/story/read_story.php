<?php
    require_once("../../conn.php");
    $sql = "SELECT * FROM story WHERE del_flg=0 ORDER BY story_no DESC";
    $result = $conn->query($sql);
    $stories = array();
    header("Content-Type: application/json; charset=utf-8");
    while ($row = $result->fetch_assoc()) {
        array_push($stories, array(
            "story_no"=> $row['story_no'],
            "story_id"=> $row['story_id'],
            "story_title"=> $row['story_title'],
            "del_flg"=> $row['del_flg'],
            "story_date"=> $row['story_date'],
            "story_image"=> $row['story_image'],
            "story_brief"=> $row['story_brief'],
            "story_detail"=> $row['story_detail'],
            "story_detail_second"=> $row['story_detail_second'],
            "story_detail_third"=> $row['story_detail_third'],
            "is_story_online"=>$row['is_story_online'],
            "register"=>$row['register'],
            "regist_time"=>$row['regist_time'],
            "updater"=>$row['updater'],
            "updater_time"=>$row['updater_time']
          ));
    }
    $json = array(
        "stories" => $stories
    );
        $res = json_encode($json);


        echo $res;
?>