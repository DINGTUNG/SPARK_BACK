<?php
    require_once("../../connect_chd102g3.php");
    header("Access-Control-Allow-Origin: *");

    try{
        $story_no = $_POST['story_no'];
        $sql = "UPDATE story SET del_flg=1, updater='希', update_time=Now() WHERE story_no = :story_no";
        $deleteStory = $pdo->prepare($sql);
        $deleteStory->bindValue(":story_no", $story_no);
        $deleteStory->execute();
        if ($deleteStory->rowCount() > 0) {
            $json = array(
                "status" => "ok",
            );
            echo json_encode($json);
        } else {
            $json = array(
                "status" => "error",
            );
            echo json_encode($json);
        }
    } catch (InvalidArgumentException $e) {
        http_response_code(400);
        echo $e->getMessage();
      } catch (UnexpectedValueException $e) {
        http_response_code(412);
        echo $e->getMessage();
        
      } catch (Exception $e) {
        http_response_code(500);
         echo "狸猫正在搗亂伺服器!請聯絡後端管理員!(或地瓜教主!)";
        echo $e->getMessage();
      }
?>