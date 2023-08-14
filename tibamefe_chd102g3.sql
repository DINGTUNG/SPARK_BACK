-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-08-14 15:39:49
-- 伺服器版本： 8.0.31
-- PHP 版本： 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `tibamefe_chd102g3`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cms_staff`
--

DROP TABLE IF EXISTS `cms_staff`;
CREATE TABLE IF NOT EXISTS `cms_staff` (
  `staff_no` int NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:CMS',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `staff_name` varchar(100) NOT NULL,
  `staff_permission` varchar(100) NOT NULL COMMENT '超級管理員\r\n一般管理員\r\n協作人員',
  `staff_email` varchar(100) NOT NULL,
  `staff_account` varchar(100) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_no`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `cms_staff`
--

INSERT INTO `cms_staff` (`staff_no`, `staff_id`, `del_flg`, `staff_name`, `staff_permission`, `staff_email`, `staff_account`, `staff_password`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'CMS001', 0, '星太郎', '超級管理員', 'test@gmail.com', 'test', 'test', '星火大老闆', '2023-08-01 19:18:25', '星火大老闆', '2023-08-02 03:18:25'),
(2, 'CMS002', 0, '星八克', '一般管理員', 'spark@gmail.com', 'spark', 'spark', '星火大老闆', '2023-08-01 19:18:25', '星火大老闆', '2023-08-02 03:18:25'),
(3, 'CMS003', 0, '星期六', '協作人員', '666@gmail.com', '666', '666', '星火大老闆', '2023-08-01 19:18:25', '星火大老闆', '2023-08-02 03:18:25');

-- --------------------------------------------------------

--
-- 資料表結構 `donate_order`
--

DROP TABLE IF EXISTS `donate_order`;
CREATE TABLE IF NOT EXISTS `donate_order` (
  `donate_order_no` int NOT NULL AUTO_INCREMENT,
  `donate_order_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:DO',
  `member_id` varchar(10) NOT NULL COMMENT '識別碼:A',
  `donate_project_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:DP',
  `donate_price` int NOT NULL,
  `donate_date` date NOT NULL,
  PRIMARY KEY (`donate_order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `donate_order`
--

INSERT INTO `donate_order` (`donate_order_no`, `donate_order_id`, `member_id`, `donate_project_id`, `donate_price`, `donate_date`) VALUES
(1, 'DO001', 'A001', 'DP001', 666, '2023-07-30'),
(2, 'DO002', 'A004', 'DP005', 500, '2023-07-31'),
(3, 'DO003', 'A003', 'DP003', 8787, '2023-08-01'),
(4, 'DO004', 'A004', 'DP001', 2000, '2023-08-01'),
(5, 'DO005', 'A009', 'DP006', 520, '2023-08-01'),
(6, 'DO006', 'A006', 'DP007', 3000, '2023-08-01'),
(7, 'DO007', 'A005', 'DP002', 1500, '2023-08-02'),
(8, 'DO008', 'A004', 'DP001', 5555, '2023-08-03'),
(9, 'DO009', 'A003', 'DP003', 100, '2023-08-03'),
(10, 'DO010', 'A006', 'DP004', 99999, '2023-08-03');

-- --------------------------------------------------------

--
-- 資料表結構 `donate_project`
--

DROP TABLE IF EXISTS `donate_project`;
CREATE TABLE IF NOT EXISTS `donate_project` (
  `donate_project_no` int NOT NULL AUTO_INCREMENT,
  `donate_project_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:DP',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `donate_project_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `donate_project_summarize` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `donate_project_start_date` date NOT NULL,
  `donate_project_end_date` date NOT NULL,
  `donate_project_amount` int DEFAULT NULL,
  `donate_project_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_donate_project_online` tinyint DEFAULT NULL COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`donate_project_no`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `donate_project`
--

INSERT INTO `donate_project` (`donate_project_no`, `donate_project_id`, `del_flg`, `donate_project_name`, `donate_project_summarize`, `donate_project_start_date`, `donate_project_end_date`, `donate_project_amount`, `donate_project_image`, `is_donate_project_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'DP001', 0, '扶幼捐款', '支持需要幫助的幼兒。通過捐贈金錢，我們能夠提供營養、醫療、教育和其他基本需求，讓這些幼兒擁有更好的生活和未來。', '2023-01-08', '2028-01-08', 114900, 'D001_kids_support.jp', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(2, 'DP002', 0, '兒童保護', '支持兒童保護組織和計劃，確保兒童的安全、健康和福祉。透過捐贈金錢，您可以幫助提供緊急援助、醫療保健、教育、心理支持和法律援助。', '2023-01-08', '2028-01-08', 18800, 'D002_kids_protection.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(3, 'DP003', 0, '助養召集令', '提供受助者孩童所需的經濟援助，為受助者提供穩定的支持，幫助他們改善生活狀況，獲得更好的教育和醫療資源，並提供更積極的未來展望。', '2023-04-22', '2028-04-22', 21500, 'D003_kids_sponsor.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(4, 'DP004', 0, '獎助學金', '支持有潛力但經濟困難的學生，幫助他們實現教育目標並追求更好的未來。您可以資助學生的學費、教材、住宿費用或其他與教育相關的費用。', '2023-05-14', '2028-05-14', 247380, 'D004_scholarship.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(5, 'DP005', 0, '急難救助金', '支援在緊急情況下遭遇困境的孩童，提供迅速而有效的援助。這些情況可能包括自然災害、人道危機、健康危機、家庭悲劇或其他緊急狀況。', '2023-06-25', '2028-06-25', 107660, 'D005_emergency_ relief_fund.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(6, 'DP006', 0, '營養補助', '支持有營養需求但無法獲得足夠營養的人們，提供營養補助食品、營養品、營養教育和餐飲計畫等。有助於改善孩童的營養狀況，促進身體發育和健康。', '2023-07-04', '2028-07-04', 115300, 'D006_nutritional_supplements.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(7, 'DP007', 0, '夢想之星', '讓孩子們探索自我，提出他們的夢想計畫，並邀請您投給您最愛的組別，為該組爭取「夢想成真」獎金！讓我們一同以熱情激勵，為孩子們的夢想點燃璀璨星火。', '2023-08-17', '2028-07-17', 87900, 'D007_spark_project.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55');

-- --------------------------------------------------------

--
-- 資料表結構 `dream_star`
--

DROP TABLE IF EXISTS `dream_star`;
CREATE TABLE IF NOT EXISTS `dream_star` (
  `dream_star_no` int NOT NULL AUTO_INCREMENT,
  `dream_star_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:DS',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `spark_activity_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '識別碼:SA',
  `dream_star_name` varchar(100) NOT NULL,
  `dream_star_content` varchar(1000) NOT NULL,
  `short_term_goals` varchar(30) NOT NULL,
  `medium_term_goals` varchar(30) NOT NULL,
  `late_term_goals` varchar(30) NOT NULL,
  `dream_star_votes` int NOT NULL,
  `dream_star_image` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_dream_star_online` tinyint DEFAULT NULL COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dream_star_no`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `dream_star`
--

INSERT INTO `dream_star` (`dream_star_no`, `dream_star_id`, `del_flg`, `spark_activity_id`, `dream_star_name`, `dream_star_content`, `short_term_goals`, `medium_term_goals`, `late_term_goals`, `dream_star_votes`, `dream_star_image`, `is_dream_star_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'DS001', 0, 'SA001', '美食大師<br>烹飪歷險記', '\"本計畫是由一群充滿熱情的兒童所發起的創意計畫。這個計畫旨在引領孩子們進入美食的奇妙世界，激發他們對烹飪的興趣，並培養出色的烹飪技能。透過這趟烹飪歷險，孩子們將探索各國美食文化、品嘗不同風味，並發揮創意創作屬於自己的美食傑作。\r\n除了希望過程是一段愉快的學習體驗，更透過烹飪的過程，啟發他們的創意思維與合作精神。相信這群孩子將成為未來的美食傳承者，將他們的熱愛與創意融入美食的世界，創造出更多美味與驚喜。\"', '\"學習基本烹飪技巧與食材認識， 親身體驗當小廚師的樂趣，透過', '學習融合異國元素、創作獨特風味的美食，並舉辦小型烹飪展示，分', '\"舉辦大型美食活動，與更多人分享美食文化， 並考取專業執照。', 103, 'dream_star_plan_1.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(2, 'DS002', 0, 'SA001', '繪畫奇想<br>彩筆揮灑繽紛世界', '\"一群對藝術抱有熱情的小朋友們，期待進入色彩斑斕的藝術領域，將他們的創意和想像力透過彩筆在畫布上展現，打造出繽紛多彩的藝術世界。盡情揮灑創意之餘，同時學習專業的繪畫技巧，啟發他們藝術的潛能。我們預計邀請資深藝術家和專業繪畫老師擔任指導，教授兒童基本的繪畫技法和藝術知識。\r\n透過有趣的創意工作坊，孩子們將在輕鬆歡樂的氛圍中，學習用不同材料和媒介創作，例如水彩、蠟筆、油畫等，體驗藝術的多元表現形式，激發無限奇想。也會請藝術家創作心得和經驗，讓孩子們從藝術家身上汲取靈感，激勵他們持續進步。\"', '\"掌握基本繪畫技巧，如線條、形狀和色彩運用， 並培養創意思維', '學習不同繪畫媒材的運用和混合，並和藝術家分享交流創作理念和心', '成員們分別完成2~3項作品，並舉辦小型展覽分享自己的創作成果', 238, 'dream_star_plan_2.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(3, 'DS003', 0, 'SA001', '音樂星光<br>樂韻奏鳴的天空旅程', '\"我們將帶領育小朋友們展開一場奇幻而美妙的音樂之旅。在那裡，每個孩子都擁有一把屬於自己的音樂魔杖。\r\n這場旅程將引導他們探索不同的樂器，從小提琴到鋼琴，從吉他到鼓，讓他們發現自己的音樂天賦和獨特的音樂風格，他們將參與音樂工作坊和課程，與專業音樂家互動學習，掌握各種技巧和表演技巧。\r\n這段音樂夢想旅程將成為孩子們未來人生的寶貴資產，為他們建立堅實的基礎。透過音樂，他們將發現自己的潛力和價值，並培養堅持不懈、努力奮鬥的精神，這些寶貴的品質將伴隨他們走向未來的道路，助他們克服挑戰，實現更大的夢想。\r\n讓我們一起支持這個夢想計畫，為星火協會的小朋友們打開通往音樂世界的大門，讓他們的夢想在音符的旋律中綻放，成為獨一無二的音樂之星！\"', '培養對音樂的興趣和熱愛，享受音樂的樂趣並表達自己', '提供專業音樂指導和訓練，培養團隊合作的意識', '讓孩子們參與音樂比賽和演出，舉辦音樂演奏會和公益音樂活動', 260, 'dream_star_plan_3.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(4, 'DS004', 0, 'SA001', '體育勇者<br>挑戰極限勇者之旅', '\"8位來自屏東的少年想要挑戰自我極限，透過運動探索未知領域。我們希望這趟勇者之旅能讓他們展現潛在的運動天賦，培養團隊合作精神，並在挑戰與努力中茁壯成長。\r\n他們將挑戰挑戰攀登玉山前峰和衝浪課程體驗，在過程中嘗試突破自我極限，超越過去的表現。也期待透過團隊合作訓練，我們希望參與者能學會互相扶持、共同克服困難，培養團隊精神和領導能力，並體驗團結的力量。\r\n希望透過專業教練的指導，讓少年們發現自己的潛能、進一步深耕專長，甚至成為未來職業的方向。\"', '\"提升身體素質、增強體能和耐力， 學會合作與溝通。\"', '每周固定時間共同鍛鍊體能，培養默契並建立團隊凝聚力。', '自主規畫登山行程和尋找衝浪課程，聯絡教練並採買相關配備', 246, 'dream_star_plan_4.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(5, 'DS005', 0, 'SA001', '環保探險家<br>地球奇幻護衛隊', '\"我們的使命是成為地球的小小護衛隊，守護這片美麗的藍色星球，讓我們的未來更璀璨耀眼。我們將一訪原始叢林和潮間帶生態圈，深入探索自然的奧秘。透過親身體驗，學習尊重生態平衡，珍視每一片綠葉與生命脈動。\r\n我們也預計將與當地社區攜手合作，投入環保行動，清理垃圾、種植樹木、推廣再生能源等。用我們的小手牽起更多的小手，一起共護家園，為地球播下永續的種子\"', '\"培養孩子們的自然關懷，了解地球生態多樣性。 學習台灣叢林和', '自主規劃冒險行程，同時進行淨灘活動', '與當地社區合作推行環保行動，並透過社群發起活動號召大眾參與。', 122, 'dream_star_plan_5.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(6, 'DS006', 0, 'SA001', '小科學家<br>探索神秘世界', '\"不只是從書籍吸收知識，而是透過實際實驗和活動進入神秘的科學世界，啟發他們對科學的熱情，培養探索精神，親身體驗科學的樂趣和驚奇。\r\n我們將走訪自然科學博物館，讓小科學家們親自動手進行實驗，如化學反應、物理現象、天文觀察等，從實踐中學習科學原理，培養他們的觀察力和邏輯思維；讓孩子們親身感受科學在現實生活中的應用和奧秘，拓展他們的視野和知識面。\r\n我們相信每個兒童都擁有無限的創造力和探索欲望。透過這個計畫，希望能夠激發孩子們對科學的熱愛，讓他們在探索神秘世界的過程中，發現無盡的可能性。\"', '\"培養孩子們的科學好奇心和實驗技巧。 學習基本科學知識，體驗', '提案想進行的實驗和想去的科學博物館', '自主規劃行程和進行實驗、並將過程拍攝並輔以文字記錄', 191, 'dream_star_plan_6.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(7, 'DS007', 0, 'SA001', '動物園園長<br>照顧和保護動物', '\"這是一個由一群熱愛動物的兒童發起的夢想計畫。我們的目標是成為動物園的小小園長，學習如何照顧動物、保護野生生物，並透過教育和行動，喚起大眾對動物保育的關注和重視。我們將邀請專業動物園照顧人員來指導我們，學習如何照顧不同種類動物的日常需求，包括飲食、運動和環境維護，了解動物的生活習性和特點，並培養愛護動物的意識。\r\n我們將組織專題講座和展覽，向大眾宣傳保護動物的重要性，分享野生動物的生態知識，呼籲大家關心瀕危動物的處境，齊心保護生態平衡。\"', '\"瞭解動物的需求和行為，學習基本照顧技能， 透過實習體會動物', '\"與專業照顧人員合作，參與動物照顧的實際工作。 \"', '舉辦保育教育活動，宣揚保護動物的訊息，喚起社會關注。', 186, 'dream_star_plan_7.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39'),
(8, 'DS008', 0, 'SA001', '創意手作<br>動手創造分享喜悅', '\"發揮創意，動手製作各種手工藝品和藝術品，並透過分享自己的創作，帶來快樂和喜悅給他人。我們將走訪文創基地和手作工作室，學習市場需求和商品化要注意的知識，並學習創造商品如手繪明信片、手工裝飾、DIY小物等，在自由自在的氛圍中發揮創意，學習不同的手工技巧，創造出屬於自己的獨特作品。\r\n我們將舉辦成果分享和義賣活動，讓孩子們把自己的手作成果販售給身邊的朋友、家人或陌生人，透過義賣，將所得提供給慈善機構，讓更多人感受到溫暖和喜悅。\"', '\"學習不同手工技巧，創造出獨特的手作品， 培養孩子們分享喜悅', '自主規劃行程，走訪文創基地和手作工作室', '舉辦成果分享和義賣活動，將所得捐助慈善機構', 89, 'dream_star_plan_8.png', 1, '星火大老闆', '2023-08-01 19:20:39', '星火大老闆', '2023-08-01 19:20:39');

-- --------------------------------------------------------

--
-- 資料表結構 `dream_star_vote`
--

DROP TABLE IF EXISTS `dream_star_vote`;
CREATE TABLE IF NOT EXISTS `dream_star_vote` (
  `vote_ip` varchar(15) NOT NULL,
  `dream_star_id` varchar(10) DEFAULT NULL COMMENT '識別碼:DS',
  `vote_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vote_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `dream_star_vote`
--

INSERT INTO `dream_star_vote` (`vote_ip`, `dream_star_id`, `vote_time`) VALUES
('3.153.134.158', 'DS001', '2023-08-14 15:41:49'),
('228.28.109.118', 'DS003', '2023-08-14 15:41:49'),
('151.180.199.241', 'DS008', '2023-08-14 15:41:49'),
('110.101.206.202', 'DS001', '2023-08-14 15:41:49'),
('204.208.87.111', 'DS007', '2023-08-14 15:41:49'),
('220.55.109.238', 'DS004', '2023-08-14 15:41:49'),
('217.9.157.45', 'DS006', '2023-08-14 15:41:49'),
('185.112.249.222', 'DS001', '2023-08-14 15:41:49'),
('76.128.56.74', 'DS002', '2023-08-14 15:41:49'),
('224.136.134.178', 'DS005', '2023-08-14 15:41:49'),
('3.153.134.157', 'DS001', '2023-08-14 16:30:04'),
('3.153.134.151', 'DS002', '2023-08-14 16:38:17'),
('3.153.134.150', 'DS002', '2023-08-14 16:38:54'),
('::1', 'DS004', '2023-08-14 17:02:49'),
('3.153.134.147', 'DS003', '2023-08-14 16:46:32');

-- --------------------------------------------------------

--
-- 資料表結構 `member_info`
--

DROP TABLE IF EXISTS `member_info`;
CREATE TABLE IF NOT EXISTS `member_info` (
  `member_no` int NOT NULL AUTO_INCREMENT,
  `member_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:A',
  `member_name` varchar(100) NOT NULL,
  `member_img` varchar(50) NOT NULL,
  `member_salutation` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '先生 小姐 公司',
  `member_account` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_mobile` varchar(100) NOT NULL,
  `member_home_phone` varchar(100) DEFAULT NULL,
  `member_business_phone` varchar(100) DEFAULT NULL COMMENT '個人非必填',
  `member_address` varchar(100) NOT NULL,
  `receipt_class` char(2) NOT NULL COMMENT '個人、捐贈、統編、電子',
  `total_sponsor` int DEFAULT NULL COMMENT '人數計算',
  `total_donation` int DEFAULT NULL,
  `member_id_card` char(10) NOT NULL,
  PRIMARY KEY (`member_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member_info`
--

INSERT INTO `member_info` (`member_no`, `member_id`, `member_name`, `member_img`, `member_salutation`, `member_account`, `member_password`, `member_mobile`, `member_home_phone`, `member_business_phone`, `member_address`, `receipt_class`, `total_sponsor`, `total_donation`, `member_id_card`) VALUES
(1, 'A001', '蔡頭瓜', ' photo_stickers_01.jpg', '先生', 'guagua@spark.com', 'ggg999000', '0912-345-678', '03-9876-5432', NULL, '台北市產瓜區快樂路123號13樓1', '個人', 1, NULL, 'T123123678'),
(2, 'A002', '蔡比八', ' photo_stickers_02.jpg', '先生', 'newbie@spark.com', 'too333', '0987-654-321', '05-2777-787', NULL, '新北市最佳新人區吃土街456號3樓1', '電子', 3, NULL, 'A123321123'),
(3, 'A003', '蔡小瓜', ' photo_stickers_03.jpg', '先生', 'smallgua@spark.com', 'fire444', '0933-888-999', NULL, NULL, '基隆市快樂區瓜瓜路987號5樓2', '電子', 1, NULL, 'S225012321'),
(4, 'A004', '阿傻布魯股份有限公司', ' photo_stickers_04.jpg', '公司', 'ashabul@tibame.com', 'bulu999', '0977-123-456', NULL, '02-9919-9989', '嘉義市囧囧區快樂巷456號8樓2', '統編', 12, NULL, 'H122567890'),
(5, 'A005', '王狸貓', ' photo_stickers_05.jpg', '小姐', 'catwang@spark.com', 'tanuki8787', '0934-345-543', '02-1234-6789', NULL, '台北市多貓區喵喵路二段聰明巷50號8樓1', '電子', 1, NULL, 'A123543210'),
(6, 'A006', '陳急先鋒', ' photo_stickers_06.jpg', '先生', 'vanguard@spark.com', 'a87a76a65', '0910-199-888', NULL, NULL, '高雄市衝峰區極急巷666號9樓2', '電子', 2, NULL, 'F213456654'),
(7, 'A007', '陳薯叔', ' photo_stickers_07.jpg', '先生', 'lucky@spark.com', 'pig123', '0980-012-345', '05-6688-888', NULL, '新竹市大吉區大吉街123號3樓2', '捐贈', 2, NULL, 'G111899998'),
(8, 'A008', '王霸氣', ' photo_stickers_08.jpg', '先生', 'mighty@spark.com', 'balabala', '0978-678-890', NULL, NULL, '台中市笑臉區幽默巷321號15樓3', '個人', 1, NULL, 'H126666789'),
(9, 'A009', '王小力', ' photo_stickers_09.jpg', '小姐', 'miniwang@spark.com', 'error404', '0934-567-765', '台北市幸福區小可愛路555號8樓1', NULL, '', '電子', 1, NULL, 'B235791123'),
(10, 'A010', '阿里阿嘟股份有限公司', ' photo_stickers_10.jpg', '公司', 'aliadu@tibame.com', '666olaola', '0988-990-099', NULL, '02-3456-9876', '花蓮縣摳摳區發財路168號2樓1', '統編', 7, NULL, 'Z123321456');

-- --------------------------------------------------------

--
-- 資料表結構 `message_board`
--

DROP TABLE IF EXISTS `message_board`;
CREATE TABLE IF NOT EXISTS `message_board` (
  `message_no` int NOT NULL AUTO_INCREMENT,
  `message_id` varchar(10) NOT NULL,
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `spark_activity_id` varchar(10) DEFAULT NULL COMMENT '識別碼:SA',
  `message_content` varchar(50) NOT NULL,
  `member_id` varchar(10) DEFAULT NULL COMMENT '識別碼:A',
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_no`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `message_board`
--

INSERT INTO `message_board` (`message_no`, `message_id`, `del_flg`, `spark_activity_id`, `message_content`, `member_id`, `message_date`, `updater`, `update_time`) VALUES
(1, 'SM001', 1, 'SA001', '狸貓啾啾叫', 'A001', '2023-07-29 17:41:36', '許咪咪', '2023-08-14 05:41:04'),
(2, 'SM002', 1, 'SA001', '狸猫喵喵喵', 'A005', '2023-07-29 17:41:36', '許咪咪', '2023-08-09 11:39:34'),
(3, 'SM003', 0, 'SP001', '狸貓貓貓嘴', 'A006', '2023-07-30 17:41:36', '許咪咪', '2023-08-11 07:14:59'),
(4, 'SM004', 0, 'SA001', '狸貓肥嘟嘟', 'A009', '2023-07-30 17:41:36', '許咪咪', '2023-08-07 14:07:44'),
(5, 'SM005', 0, 'SA878', '二狸貓豬頭', 'A878', '2023-07-30 17:41:36', '許咪咪', '2023-08-07 15:51:21'),
(6, 'SM006', 0, 'SA001', '狸貓嘟嘟肥', 'A006', '2023-07-30 17:41:36', '許咪咪', '2023-08-09 07:03:31'),
(7, 'SM007', 0, 'SA001', '狸貓呆呆嘟', 'A004', '2023-08-01 17:45:26', '許咪咪', '2023-08-09 07:03:53'),
(79, 'SM079', 0, 'SA001', '狸貓大師!!', 'A087', '2023-08-09 16:17:16', '許咪咪', '2023-08-09 08:17:16'),
(77, 'SM077', 0, 'SA001', '狸貓大成功!!', 'A087', '2023-08-09 15:54:25', '許咪咪', '2023-08-09 07:54:25'),
(80, 'SM080', 1, 'SA001', '新狸貓!', 'A087', '2023-08-09 19:39:03', '許咪咪', '2023-08-10 13:34:19'),
(92, 'SM092', 0, 'SA001', '狸貓之王!!!', 'A087', '2023-08-14 17:07:32', '許咪咪', '2023-08-14 09:07:32'),
(81, 'SM081', 0, 'SP001', '狸貓大臉怪怪仔', 'A087', '2023-08-11 00:19:00', '許咪咪', '2023-08-11 07:14:08'),
(82, 'SM082', 0, 'SA001', '狸貓小不點', 'A087', '2023-08-11 00:20:08', '許咪咪', '2023-08-10 16:20:08'),
(83, 'SM083', 0, 'SA001', '狸貓扭扭舞', 'A087', '2023-08-11 00:40:57', '許咪咪', '2023-08-10 16:40:57'),
(84, 'SM084', 0, 'SA001', '狸貓大地瓜', 'A087', '2023-08-11 00:41:01', '許咪咪', '2023-08-10 16:41:01'),
(85, 'SM085', 0, 'SA001', '狸貓與星龜', 'A087', '2023-08-11 00:41:04', '許咪咪', '2023-08-10 16:41:04'),
(86, 'SM086', 0, 'SA001', '狸貓主題曲', 'A087', '2023-08-11 00:41:07', '許咪咪', '2023-08-10 16:41:07'),
(87, 'SM087', 0, 'SA001', '狸猫裝可憐', 'A087', '2023-08-11 00:41:13', '許咪咪', '2023-08-10 16:41:13'),
(88, 'SM088', 0, 'SA001', '狸貓小海豹', 'A087', '2023-08-11 00:41:20', '許咪咪', '2023-08-10 16:41:20'),
(89, 'SM089', 0, 'SA001', '肥嘟嘟狸貓～ 肥嘟嘟狸貓～ 整天擠貓嘴～整天擠貓嘴～ 明明是隻海豹～卻戴著狸貓帽～ 啾啾叫～啾啾叫～', 'A087', '2023-08-11 00:41:42', '許咪咪', '2023-08-10 16:41:42'),
(90, 'SM090', 0, 'SA001', '小屁顛狸貓 小屁顛狸貓 掀開是海豹 禿頭的海豹 隨便亂打路人 還叫星龜背著 散播幸福 散播幸福～', 'A087', '2023-08-11 00:41:51', '許咪咪', '2023-08-10 16:41:51'),
(91, 'SM091', 0, 'SA001', '狸貓躺躺王', 'A087', '2023-08-11 00:42:34', '許咪咪', '2023-08-10 16:42:34');

-- --------------------------------------------------------

--
-- 資料表結構 `milestone`
--

DROP TABLE IF EXISTS `milestone`;
CREATE TABLE IF NOT EXISTS `milestone` (
  `milestone_no` int NOT NULL AUTO_INCREMENT,
  `milestone_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:M',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `milestone_title` varchar(100) NOT NULL,
  `milestone_content` varchar(500) NOT NULL,
  `milestone_date` char(7) NOT NULL COMMENT '西元',
  `milestone_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_milestone_online` tinyint DEFAULT NULL COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`milestone_no`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `milestone`
--

INSERT INTO `milestone` (`milestone_no`, `milestone_id`, `del_flg`, `milestone_title`, `milestone_content`, `milestone_date`, `milestone_image`, `is_milestone_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'M001', 0, '暖心聖誕', '邀請士元火鍋店為孩子們準備豐富的火鍋大餐', '202212', 'M001_warm_christmas.', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16'),
(2, 'M002', 0, '環境小尖兵', '帶領孩子們前往海邊淨灘，為環保盡一份心力', '202302', 'M002_environment_sol', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16'),
(3, 'M003', 0, '愛心稻田', '疫情解封後，首次到田裡體驗務農的辛勞，學習感恩', '202306', 'M003_love_paddy_fiel', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16');

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_no` int NOT NULL AUTO_INCREMENT,
  `news_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:N',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `news_title` varchar(100) NOT NULL,
  `news_date` date NOT NULL,
  `news_image_first` varchar(20) NOT NULL,
  `news_image_second` varchar(20) DEFAULT NULL,
  `news_image_third` varchar(20) DEFAULT NULL,
  `news_image_fourth` varchar(20) DEFAULT NULL,
  `news_content_first` varchar(1000) NOT NULL,
  `news_content_second` varchar(1000) DEFAULT NULL,
  `news_content_third` varchar(1000) DEFAULT NULL,
  `news_content_fourth` varchar(1000) DEFAULT NULL,
  `is_news_online` tinyint NOT NULL DEFAULT '0' COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_no`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `news`
--

INSERT INTO `news` (`news_no`, `news_id`, `del_flg`, `news_title`, `news_date`, `news_image_first`, `news_image_second`, `news_image_third`, `news_image_fourth`, `news_content_first`, `news_content_second`, `news_content_third`, `news_content_fourth`, `is_news_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'N001', 0, '星火30，感謝有您', '2023-08-11', 'N001_1.png', 'N001_2.png', 'N001_3.png', 'N001_4.png', '親愛的星火兒童認養協會的家人們：我們非常興奮地宣布，星火兒童認養協會迎來了30週年的重要里程碑！在這個特殊的時刻，我們想要向所有支持者、志願者、捐助者和合作夥伴表達最深深的感謝之情。自1985年成立以來，星火一直致力於關愛孤兒和弱勢兒童，為他們提供溫暖、關懷和希望。這30年來，我們見證了無數個家庭的連結、孩子的笑容和夢想的實現。', '在這個特殊的周年慶祝活動中，我們將舉辦一系列精彩的活動，包括兒童藝術展、親子遊樂日和慈善晚宴等，希望為孩子們帶來歡樂和關懷。我們將舉辦一場慈善晚宴，以回饋社會對我們的支持。星火邀請各界人士參與晚宴，不僅是一個節日的慶典，更是一個機會，讓我們團結起來，為孩子們的未來籌集資源和支持。', '在星火的30年歷程中，我們努力實現著「每個孩子都應該有一個家」的願景。我們努力著，為孤兒和弱勢兒童找到合適的家庭，給予他們溫暖和關愛。這一路上，我們見證了無數個家庭的連結，看到了孩子們的微笑，並見證了他們的成長和成就。我們與認養家庭和孩子們建立起了深厚的情感聯繫，共同走過了許多困難和挑戰，但正是這些努力和奉獻，讓孩子們能夠擁有更美好的未來。', '在這個值得慶祝的時刻，我們要感謝每一位為星火付出的人，無論是認養家庭、捐助者、合作夥伴還是社區成員，都是我們成功的關鍵，謝謝你們的慷慨、無私和信任。最後，我們要向所有參與和支持星火的孩子們致以最深的祝福，讓我們共同慶祝星火兒童認養協會30周年的成就，感謝每一位為我們付出的人，並展望更美好的未來！', 1, '星火大老闆', '2023-08-01 19:25:22', 'sir', '2023-08-14 13:15:26'),
(15, 'N015', 0, '1123', '2023-08-10', 'N015_1.png', 'N015_2.png', 'N015_3.png', 'N015_4.png', '123', '1123', '123', '123', 0, '星火大老闆', '2023-08-14 14:08:41', 'sir', '2023-08-14 14:12:06'),
(16, 'N016', 0, '123', '2023-08-02', 'N016_1.png', 'N016_2.png', 'N016_3.png', 'N016_4.png', '123', '123', '123', '123', 0, '星火大老闆', '2023-08-14 14:09:12', '北七', '2023-08-14 14:09:12');

-- --------------------------------------------------------

--
-- 資料表結構 `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `report_no` int NOT NULL AUTO_INCREMENT,
  `report_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:R',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `report_class` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `report_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `report_year` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '西元',
  `report_file_path` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `report_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_report_online` tinyint DEFAULT NULL COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_no`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `report`
--

INSERT INTO `report` (`report_no`, `report_id`, `del_flg`, `report_class`, `report_title`, `report_year`, `report_file_path`, `report_image`, `is_report_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(5, 'R005', 0, '財務', '星火執行業務報告', '2021', 'R2023_1_finance_rep.pdf', 'R2023_1_business_rep.png', 1, '星火大老闆', '2023-08-01 19:26:00', 'sir', '2023-08-14 15:37:42'),
(6, 'R006', 0, '年度', '星火執行業務報告', '2023', 'R2023_1_business_rep.pdf', 'R2023_1_business_rep.png', 1, '星火大老闆', '2023-08-01 19:26:00', 'sir', '2023-08-14 15:37:07'),
(7, 'R007', 0, '財務', '星火執行財務報告', '2018', 'R2023_1_finance_rep.pdf', 'R2023_1_business_rep.png', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00'),
(11, 'R011', 0, '財務', '星火執行財務報告', '2022', 'R2023_1_finance_rep.pdf', 'R2023_1_business_rep.png', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00'),
(12, 'R012', 0, '財務', '星火執行財務報告', '2023', 'R2023_1_finance_rep.pdf', 'R2023_1_business_rep.png', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00');

-- --------------------------------------------------------

--
-- 資料表結構 `spark_activity`
--

DROP TABLE IF EXISTS `spark_activity`;
CREATE TABLE IF NOT EXISTS `spark_activity` (
  `spark_activity_no` int NOT NULL AUTO_INCREMENT,
  `spark_activity_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:SA',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `spark_activity_name` varchar(20) NOT NULL,
  `spark_activity_description` varchar(500) NOT NULL,
  `spark_activity_start_date` date DEFAULT NULL,
  `spark_activity_end_date` date DEFAULT NULL,
  `is_spark_activity_online` tinyint NOT NULL DEFAULT '0' COMMENT '0:未開放 1:進行中',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`spark_activity_no`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `spark_activity`
--

INSERT INTO `spark_activity` (`spark_activity_no`, `spark_activity_id`, `del_flg`, `spark_activity_name`, `spark_activity_description`, `spark_activity_start_date`, `spark_activity_end_date`, `is_spark_activity_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'SA001', 0, '夢想之星-喚醒孩子們內心的夢想', '    在本屆的圓夢計畫中，「星火」兒童認養協會將邀請孩子們提出他們的夢想計畫。透過這個計畫，我們希望這些平時少有機會表達意見的孩子們能在夢想的世界中，探索自我，勇敢地為自己發聲。我們將傾聽他們的想法，支持他們追尋夢想的過程，讓他們感受到自己的價值和重要性。這是一個讓孩子們對未來充滿希望的機會，「星火」兒童認養協會將竭盡所能，陪伴他們實現屬於他們自己的夢想。\r\n<br><br>\r\n&emsp;&emsp;我們相信，當一個孩子的夢想實現時，不僅對他們個人意義重大，也對整個社會產生積極而持久的影響。藉由這個計畫，我們共同創造一個更美好、更關懷的社會，讓每個孩子都能夠實現他們內心最璀璨的夢想！在浩瀚宇宙中，浮現幾顆神秘的星球，它們彷彿蘊藏著無盡可能，迫不及待地想要透過望遠鏡洞察星球的面貌！每顆星球代表著一組孩子們的夢想計畫，在 <span> 2023-08-01 至 2023-08-31 </span> 期間，按下「為我加油」按鈕，投給你最愛的組別，並為該組別爭取「夢想成真」獎金！讓我們', '2023-08-01', '2023-08-31', 1, '星火大老闆', '2023-08-01 19:27:08', '許咪咪', '2023-08-14 06:06:28'),
(2, 'SA002', 0, '夢想路跑', '路跑募款活動', '2023-09-01', '2023-09-30', 0, '星火大老闆', '2023-08-01 19:27:08', '許咪咪', '2023-08-12 09:01:30');

-- --------------------------------------------------------

--
-- 資料表結構 `sponsor_location`
--

DROP TABLE IF EXISTS `sponsor_location`;
CREATE TABLE IF NOT EXISTS `sponsor_location` (
  `location_no` int NOT NULL AUTO_INCREMENT,
  `location_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:SL',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `location_name` varchar(15) NOT NULL,
  `is_sponsor_location_online` tinyint DEFAULT NULL COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`location_no`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `sponsor_location`
--

INSERT INTO `sponsor_location` (`location_no`, `location_id`, `del_flg`, `location_name`, `is_sponsor_location_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'SL001', 0, '123', 0, '星火大老闆', '2023-08-01 19:28:19', 'sir', '2023-08-11 06:57:53'),
(2, 'SL002', 0, '87878787878', 1, '星火大老闆', '2023-08-01 19:28:19', 'sir', '2023-08-11 07:30:50'),
(3, 'SL003', 0, '台南星火', 1, '星火大老闆', '2023-08-01 19:28:19', '星火大老闆', '2023-08-01 19:28:19'),
(4, 'SL004', 0, '台東星火', 1, '星火大老闆', '2023-08-01 19:28:19', '星火大老闆', '2023-08-01 19:28:19');

-- --------------------------------------------------------

--
-- 資料表結構 `sponsor_order`
--

DROP TABLE IF EXISTS `sponsor_order`;
CREATE TABLE IF NOT EXISTS `sponsor_order` (
  `sponsor_order_no` int NOT NULL AUTO_INCREMENT,
  `sponsor_order_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:SO',
  `member_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:A',
  `location_id` varchar(10) NOT NULL COMMENT '識別碼:SL',
  `sponsor_date` datetime NOT NULL,
  `price` int NOT NULL,
  `payment_plan` varchar(10) NOT NULL,
  `payment_method` varchar(5) NOT NULL,
  `children_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '識別碼:C',
  `expiry_month` char(6) NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:終止 1:繼續',
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sponsor_order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `sponsor_order`
--

INSERT INTO `sponsor_order` (`sponsor_order_no`, `sponsor_order_id`, `member_id`, `location_id`, `sponsor_date`, `price`, `payment_plan`, `payment_method`, `children_id`, `expiry_month`, `order_status`, `updater`, `update_time`) VALUES
(1, 'SO001', 'A003', 'SL001', '2023-07-28 14:00:27', 2000, '月繳', '信用卡', 'C567', '202408', 0, '許咪咪', '2023-08-10 16:06:34'),
(2, 'SO002', 'A004', 'SL001', '2023-07-28 14:00:27', 2000, '月繳', '信用卡', 'C056', '202408', 0, '許咪咪', '2023-08-12 08:55:25'),
(3, 'SO003', 'A005', 'SL002', '2023-07-28 14:03:31', 6000, '季繳', '超商繳費', 'C326', '202408', 0, '許咪咪', '2023-08-14 05:03:27'),
(4, 'SO004', 'A001', 'SL003', '2023-07-29 14:03:31', 24000, '年繳', '信用卡', 'C727', '202408', 1, '許咪咪', '2023-08-09 11:46:00'),
(5, 'SO005', 'A004', 'SL004', '2023-07-30 14:00:26', 12000, '半年繳', '超商繳費', 'C111', '202408', 1, '許咪咪', '2023-08-09 03:44:25'),
(6, 'SO006', 'A004', 'SL002', '2023-07-31 14:03:31', 2000, '月繳', '信用卡', 'C555', '202408', 1, '許咪咪', '2023-08-09 03:44:25'),
(7, 'SO007', 'A006', 'SL004', '2023-08-01 14:09:08', 24000, '年繳', '信用卡', 'C395', '202409', 1, '許咪咪', '2023-08-09 03:44:25'),
(8, 'SO008', 'A007', 'SL003', '2023-08-01 14:09:08', 24000, '年繳', '信用卡', 'C797', '202409', 1, '許咪咪', '2023-08-09 03:44:26'),
(9, 'SO009', 'A002', 'SL003', '2023-08-02 14:09:08', 12000, '半年繳', '超商繳費', 'C246', '202409', 1, '許咪咪', '2023-08-09 03:44:30'),
(10, 'SO010', 'A009', 'SL001', '2023-08-03 14:12:22', 2000, '月繳', '信用卡', 'C614', '202409', 1, '許咪咪', '2023-08-09 03:44:27');

-- --------------------------------------------------------

--
-- 資料表結構 `story`
--

DROP TABLE IF EXISTS `story`;
CREATE TABLE IF NOT EXISTS `story` (
  `story_no` int NOT NULL AUTO_INCREMENT,
  `story_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:ST',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `story_title` varchar(100) NOT NULL,
  `story_date` date NOT NULL,
  `story_image` varchar(20) NOT NULL,
  `story_brief` varchar(500) NOT NULL,
  `story_detail` varchar(1000) NOT NULL,
  `story_detail_second` varchar(1000) NOT NULL,
  `story_detail_third` varchar(1000) NOT NULL,
  `is_story_online` tinyint DEFAULT NULL COMMENT '0:下線 1上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`story_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `story`
--

INSERT INTO `story` (`story_no`, `story_id`, `del_flg`, `story_title`, `story_date`, `story_image`, `story_brief`, `story_detail`, `story_detail_second`, `story_detail_third`, `is_story_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'ST001', 0, '遊戲場上的友誼結盟', '2023-04-12', 'story_1.png', '小傑和他的朋友們在遊戲場上歡聲笑語。他們一同踢足球、打籃球，緊張又充滿熱情。', '小傑和他的朋友們在遊戲場上歡聲笑語。他們一同踢足球、打籃球，緊張又充滿熱情。不論勝敗，他們彼此尊重，一同享受比賽的樂趣。遊戲場上的友誼結盟讓他們更加團結，相互支持，這份友誼將伴隨他們走向更廣闊的未來。', '在遊戲場上，小傑和朋友們共同合作，制定策略，互相幫助。他們一同努力，逐漸提升球技，更加默契。這些團隊遊戲讓他們學會了團結合作、分工協作，培養了領導能力和團隊精神。', '除了遊戲場上，小傑和朋友們也一同舉辦聚會、遠足，共同度過快樂時光。他們一同經歷了許多歡樂和挑戰，並共同成長。這段友誼結盟不僅帶給他們快樂，更教會他們相互尊重、關懷和理解，這份友誼將伴隨著他們走向更美好的未來。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(2, 'ST002', 0, '音樂天使的樂章演奏', '2023-07-16', 'story_2.png', '小菲拿著小提琴，她的心隨著音樂起舞。在舞台上，她將她的感情融入每一個音符。觀眾們被她的表演感動，熱烈的掌聲響起。', '小菲拿著小提琴，她的心隨著音樂起舞。在舞台上，她將她的感情融入每一個音符。觀眾們被她的表演感動，熱烈的掌聲響起。她和朋友們合奏美妙的樂章，彼此互相鼓勵，締造了一場音樂的盛宴。這些樂曲讓她們的友誼更加緊密，成就了音樂天使的夢想。', '在音樂課堂中，小菲和朋友們共同練習琴技，一同演奏樂曲。她們彼此磨合，合奏出優美動人的音樂。除了音樂課上，她們也組成樂團參加校內演出，讓更多人感受到音樂的美好。這些共同演奏的時光讓她們的友誼更加深厚，相互間的默契和信任更加堅定。', '在音樂比賽中，小菲和朋友們精心演繹，獲得了優異的成績。他們一同分享著勝利的喜悅，也一起品嘗著挑戰的甜蜜。這些共同的努力和成就讓他們的友誼更加持久，成就了音樂天使的美麗人生。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(3, 'ST003', 0, '探索奇妙的科學之旅', '2023-04-20', 'story_3.png', '小明和朋友們興致勃勃地走進實驗室。在老師的指導下，他們探索著科學的奧秘。他們合作實驗，發現新的現象，驚嘆於科學的魅力。', '小明和朋友們興致勃勃地走進實驗室。在老師的指導下，他們探索著科學的奧秘。他們合作實驗，發現新的現象，驚嘆於科學的魅力。這個科學之旅不僅豐富了他們的知識，更激發了他們對科學的熱愛，讓他們期待著更多的探索與發現。', '在實驗室裡，小明和朋友們動手操作，對於每一個實驗都充滿好奇。他們發現水的奇特性質、物體的浮沉規律，更了解到自然界的秘密。這些有趣的實驗讓他們學到了許多知識，並培養了觀察、思考和解決問題的能力。', '小明和朋友們組成了一個科學小組，定期進行科學實驗和探索。他們舉辦了科學展示，與其他同學分享自己的發現。這份友誼和共同的興趣讓他們更加團結，共同成長。這段奇妙的科學之旅不僅激發了他們對知識的渴望，更讓他們明白到科學是改變世界的力量。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(4, 'ST004', 0, '畫筆舞動的創意世界', '2023-04-27', 'story_4.png', '小莉手握著五彩的畫筆，她的心情隨著筆尖飛舞。她的畫筆彷彿是魔法棒，將她的想像力化為美麗的圖畫。', '小莉手握著五彩的畫筆，她的心情隨著筆尖飛舞。在白紙上，她描繪出奇幻的仙境、可愛的動物和燦爛的花朵。她的畫筆彷彿是魔法棒，將她的想像力化為美麗的圖畫。朋友們讚嘆著她的才華，她滿足地笑著，知道自己的畫筆能讓世界更加美好。', '小莉與朋友們一起分享著自己的藝術創作，他們在一起討論著彼此的想法和技巧。他們互相學習，共同進步。有時，他們也一起合作創作大型的畫作，將各自的創意融合在一起。這些歡樂的時光讓他們的友誼更加深厚，彼此間的信任和理解更加牢固。', '當展覽來臨時，小莉和朋友們齊心合力，將自己的作品展現給更多的人。觀眾們對於他們的畫作讚不絕口，讚賞著他們的創意和才華。這個創意世界不僅讓小莉感受到自己的價值，更讓她明白藝術與友誼是無價的寶藏。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(5, 'ST005', 0, '歡樂的成長旅程', '2023-04-28', 'story_5.png', '妮娜在協會裡結識了許多和她一樣的朋友們，他們參加了各種有趣的活動，例如野餐、戶外遊樂和手工......', '小明和他的朋友們攜手展開了一段歡樂的成長旅程。他們一起克服挑戰、分享快樂。在學校裡，他們一同探索知識的奧秘，互相學習和成長。在運動場上，他們比賽、合作，彼此激勵。這些寶貴的回憶和朋友間的默契讓他們一起成長，共同走過美好的童年。', '他們一起度過了無數個快樂的時光，他們彼此扶持著，在困難時互相支持，共同經歷著人生的起伏。這些美好的回憶讓他們的友誼更加堅固，成為彼此的支柱和陪伴。', '隨著時間的流逝，小明和朋友們漸漸長大。他們雖然各自走向不同的道路，但那份純真的友誼永遠不會消失。他們在人生的重要時刻互相祝福和支持，共同見證著彼此的成長。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(6, 'ST006', 0, '大自然的奇妙旅程', '2023-05-18', 'story_6.png', '晴晴從學步起，就迷戀上大自然的美麗與神奇，總是迫不及待地探索著每一片草地、每一條小溪，她收集......', '大華手牽著爸爸，踏上大自然的奇妙旅程。他們漫步在綠意盎然的森林中，小明驚嘆著樹木的高聳和鳥兒的歌唱。突然，一陣微風吹來，樹葉輕輕擁抱他的臉龐，讓他感受到大自然的溫柔。', '他們來到湖邊，小明蹲下身子，驚喜地發現湖面上漂浮著五彩繽紛的蝴蝶。他們輕輕跳躍，像舞者般在空中翩翩起舞。小明興奮地追逐著蝴蝶，迷失在大自然的魔幻世界。', '大自然的奇妙旅程不僅給大華帶來驚喜和刺激，更啟發了他的想像力和探索精神。他學會欣賞自然之美，瞭解到生命的連結和平衡。這段與大自然的親密接觸，讓他成長為一個更關懷和尊重環境的孩子。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(7, 'ST007', 0, '萌萌的鐵道世界', '2023-06-09', 'story_7.png', '每當萌萌走進鐵道世界，他的眼睛就會閃耀著興奮的光芒。他會花上整個下午建設火車軌道、設置小火車......', '萌萌眼中燃燒著興奮的火焰，他手中握著一個精緻的小火車玩具。他將它輕輕放在軌道上，火車蜿蜒前進，發出嗡嗡的聲音。小明的臉上洋溢著快樂的笑容，他與小火車一同探索著無限的遊戲世界。', '火車沿著彎曲的軌道穿梭，經過小山丘和橋樑。小明的想像力瞬間被點燃，他模擬火車經歷著驚險刺激的旅程，穿越山谷和越過障礙。他對小火車的每一次控制都充滿著自信和喜悅。', '小明邀請朋友們一同加入遊戲，他們圍坐在地上，用手與笑聲模擬著小火車的運行。他們合力建造軌道、設計站台，共同創造屬於他們的迷你鐵路世界。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(8, 'ST008', 0, '禮物中的喜悅', '2023-06-20', 'story_8.png', '星火協會在兒童節這天，發放給每位小朋友們一份小禮物，這份禮物不僅帶來滿足，更加深愛與關懷的體......', '兒童節來臨之際，一群小朋友興高采烈地聚集在一起，期待著令人心動的禮物。他們眼中閃耀著無盡的期待，好奇地猜測著禮物會是什麼。終於，禮物盒被打開，幸福的驚喜彌漫在空氣中。', '小明興奮地握著一本彩色的繪本，裡面充滿了美麗的故事和色彩繽紛的插畫。他迫不及待地翻閱著每一頁，想要探索那個神奇的故事世界。小花拿著一個樂器，她輕撥著琴弦，美妙的音符在空中飄揚，帶來了甜蜜的音樂。', '還有小杰收到一個拼圖，他專心地將每塊拼圖拼接在一起，最終呈現出一幅驚人的圖案。他為自己的成就感到自豪，而這個拼圖也將成為他無數次快樂的挑戰。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(9, 'ST009', 0, '我是這樣長大的', '2023-07-15', 'story_9.png', '小安從小就以她的畫筆將奇幻的夢境和美麗的色彩帶入現實生活，她用繽紛的色彩和獨特的構圖展現她對......', '小安手握著五彩的蠟筆，專注地在畫紙上揮灑著自己的想像。他畫出了一個夢幻的森林，樹上掛滿了燦爛的花朵，小動物們歡快地奔跑著。他的臉上洋溢著快樂的笑容，畫筆在他的指尖舞動著。', '小安展示著他的畫作，眾人驚嘆著他的藝術天賦。他的作品散發著童真和創意，彷彿一個個魔法的世界。朋友們圍繞著他，紛紛稱讚他的畫技和豐富的想像力。小明感受到他們的支持和鼓勵，更加自信地繼續創作著。', '畫筆在小明的手中成為一個無限的魔法工具，他通過每一幅畫作表達出自己的情感和世界觀。當他看著自己的作品時，他感到無比的快樂和成就。畫畫成為他忘卻壓力的途徑，也為他的童年增添了無盡的快樂和美好回憶。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(10, 'ST010', 0, '小手揉麵 共享美味', '2023-12-30', 'story_10.png', '小朋友們認真地學習製作麵包，彼此合作搓揉麵團，一同創造出美味的麵食作品。他們用小手捏出有趣的......', '在星火兒童協會的廚房裡，一群充滿活力的小朋友圍坐在長桌旁，熱情地揉著麵團。他們的小手掌沾滿了麵粉，笑聲和歡樂彌漫在空氣中。協會的導師們帶領著他們，一同展開了一場美味的冒險。', '小朋友們充滿興奮地將麵團揉搓得越來越柔軟，他們一起分享著創意和技巧，塑造出各種有趣的形狀，如動物、星星和花朵。他們彼此鼓勵，互相幫助，建立起了友誼的紐帶。', '經過烘焙，美味的麵食從烤箱中散發出迷人的香氣。小朋友們期待已久地坐在一起，品嚐他們共同製作的成果。眼神中充滿了驚喜和自豪，他們大快朵頤，享受著這份自己親手創造的美味。', 0, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08');

-- --------------------------------------------------------

--
-- 資料表結構 `thanks_letter`
--

DROP TABLE IF EXISTS `thanks_letter`;
CREATE TABLE IF NOT EXISTS `thanks_letter` (
  `thanks_letter_no` int NOT NULL AUTO_INCREMENT,
  `thanks_letter_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:TL',
  `del_flg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未刪除\r\n1:已刪除',
  `children_id` varchar(10) NOT NULL COMMENT '識別碼:C',
  `member_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:A',
  `sponsor_order_id` varchar(10) NOT NULL COMMENT '識別碼:SO',
  `receive_date` date NOT NULL,
  `file_name` varchar(20) NOT NULL,
  `is_read` tinyint DEFAULT NULL COMMENT '0:未讀 1:已讀',
  `register` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`thanks_letter_no`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `thanks_letter`
--

INSERT INTO `thanks_letter` (`thanks_letter_no`, `thanks_letter_id`, `del_flg`, `children_id`, `member_id`, `sponsor_order_id`, `receive_date`, `file_name`, `is_read`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'TL001', 0, 'C118', 'A003', 'SO023', '2023-07-01', '【019】謝謝您的愛心', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(2, 'TL002', 0, 'C200', 'A003', 'SO024', '2023-07-01', '【167】今年有新衣服穿了', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(3, 'TL003', 0, 'C050', 'A001', 'SO138', '2023-08-05', '【124】我會健康地長大哦', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(4, 'TL004', 0, 'C007', 'A004', 'SO005', '2023-08-09', '【368】我想對您說，謝謝您~', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(5, 'TL005', 0, 'C021', 'A007', 'SO067', '2023-09-16', '【183】雖然我不認識您 但是謝謝您~', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(6, 'TL006', 0, 'C156', 'A006', 'SO015', '2023-09-21', '【246】我收到了超棒的禮物', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(7, 'TL007', 0, 'C098', 'A007', 'SO132', '2023-09-08', '【503】謝謝您我的超人', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(8, 'TL008', 0, '1', '1', '1', '0000-00-00', '1', NULL, '阿菜', '2023-08-11 09:21:07', '菜阿', '2023-08-11 09:21:07'),
(9, 'TL009', 0, '1', '1', '1', '0000-00-00', '1', NULL, '阿菜', '2023-08-11 09:23:35', '菜阿', '2023-08-11 09:23:35'),
(10, 'TL010', 0, '2', '2', '2', '0000-00-00', '2', NULL, '阿菜', '2023-08-11 09:24:31', '菜阿', '2023-08-11 09:24:31'),
(11, 'TL011', 0, '1', '1', '1', '0000-00-00', '1', NULL, '星火大老闆', '2023-08-11 09:26:17', '星火大老闆', '2023-08-11 09:26:17'),
(12, 'TL012', 0, '1', '1', '1', '0000-00-00', '1', NULL, '星火大老闆', '2023-08-11 09:51:38', '星火大老闆', '2023-08-11 09:51:38'),
(13, 'TL013', 0, '111', '111', '111', '0000-00-00', '111', NULL, '星火大老闆', '2023-08-11 10:00:40', '星火大老闆', '2023-08-11 10:00:40'),
(14, 'TL014', 0, '87', '87', '87', '0000-00-00', '87', NULL, '星火大老闆', '2023-08-11 10:01:45', '星火大老闆', '2023-08-11 10:01:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
