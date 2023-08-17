-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-08-17 01:18:42
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
  `member_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:A',
  `donate_project_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '識別碼:DP',
  `donate_project_name` varchar(50) NOT NULL,
  `donate_price` bigint NOT NULL,
  `donate_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`donate_order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `donate_order`
--

INSERT INTO `donate_order` (`donate_order_no`, `donate_order_id`, `member_id`, `donate_project_id`, `donate_project_name`, `donate_price`, `donate_time`) VALUES
(1, 'DO001', 'A001', 'DP001', '扶幼捐款', 666, '2023-07-30 00:00:00'),
(2, 'DO002', 'A004', 'DP005', '急難救助金', 500, '2023-07-31 00:00:00'),
(3, 'DO003', 'A003', 'DP003', '助養召集令', 8787, '2023-08-01 00:00:00'),
(4, 'DO004', 'A004', 'DP001', '扶幼捐款', 2000, '2023-08-01 00:00:00'),
(5, 'DO005', 'A009', 'DP006', '營養補助', 520, '2023-08-01 00:00:00'),
(6, 'DO006', 'A006', 'DP007', '夢想之星', 3000, '2023-08-01 00:00:00'),
(7, 'DO007', 'A005', 'DP002', '兒童保護', 1500, '2023-08-02 00:00:00'),
(8, 'DO008', 'A004', 'DP001', '扶幼捐款', 5555, '2023-08-03 00:00:00'),
(9, 'DO009', 'A003', 'DP003', '助養召集令', 100, '2023-08-03 00:00:00'),
(10, 'DO010', 'A006', 'DP004', '獎助學金', 99999, '2023-08-03 00:00:00'),
(11, 'DO011', 'A001', 'DP001', '扶幼捐款', 2147483647, '2023-08-16 21:36:37'),
(12, 'DO012', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:37:47'),
(13, 'DO013', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(14, 'DO014', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(15, 'DO015', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(16, 'DO016', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(17, 'DO017', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(18, 'DO018', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:38:11'),
(19, 'DO019', 'A001', 'DP004', '獎助學金', 9999999999, '2023-08-16 21:44:43');

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
  `is_donate_project_online` tinyint DEFAULT '0' COMMENT '0:下線 1:上線',
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
(1, 'DP001', 0, '扶幼捐款', '支持需要幫助的幼兒。通過捐贈金錢，我們能夠提供營養、醫療、教育和其他基本需求，讓這些幼兒擁有更好的生活和未來。', '2023-01-08', '2028-01-08', 114900, 'DP001.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(2, 'DP002', 0, '兒童保護', '支持兒童保護組織和計劃，確保兒童的安全、健康和福祉。透過捐贈金錢，您可以幫助提供緊急援助、醫療保健、教育、心理支持和法律援助。', '2023-01-08', '2028-01-08', 18800, 'DP002.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(3, 'DP003', 0, '助養召集令', '提供受助者孩童所需的經濟援助，為受助者提供穩定的支持，幫助他們改善生活狀況，獲得更好的教育和醫療資源，並提供更積極的未來展望。', '2023-04-22', '2028-04-22', 21500, 'DP003.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(4, 'DP004', 0, '獎助學金', '支持有潛力但經濟困難的學生，幫助他們實現教育目標並追求更好的未來。您可以資助學生的學費、教材、住宿費用或其他與教育相關的費用。', '2023-05-14', '2028-05-14', 247380, 'DP004.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(5, 'DP005', 0, '急難救助金', '支援在緊急情況下遭遇困境的孩童，提供迅速而有效的援助。這些情況可能包括自然災害、人道危機、健康危機、家庭悲劇或其他緊急狀況。', '2023-06-25', '2028-06-25', 107660, 'DP005.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(6, 'DP006', 0, '營養補助', '支持有營養需求但無法獲得足夠營養的人們，提供營養補助食品、營養品、營養教育和餐飲計畫等。有助於改善孩童的營養狀況，促進身體發育和健康。', '2023-07-04', '2028-07-04', 115300, 'DP006.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55'),
(7, 'DP007', 0, '夢想之星', '讓孩子們探索自我，提出他們的夢想計畫，並邀請您投給您最愛的組別，為該組爭取「夢想成真」獎金！讓我們一同以熱情激勵，為孩子們的夢想點燃璀璨星火。', '2023-08-17', '2028-07-17', 87900, 'DP007.jpg', 1, '星火大老闆', '2023-08-01 19:19:55', '星火大老闆', '2023-08-01 19:19:55');

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
  `is_dream_star_online` tinyint DEFAULT '0' COMMENT '0:下線 1:上線',
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
  `member_compilation` int DEFAULT NULL COMMENT '個人非必填',
  `member_img` varchar(50) NOT NULL,
  `member_salutation` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '先生 小姐 公司',
  `member_account` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_mobile` varchar(100) NOT NULL,
  `member_home_phone` varchar(100) DEFAULT NULL,
  `member_business_phone` varchar(100) DEFAULT NULL COMMENT '個人非必填',
  `member_address` varchar(100) NOT NULL,
  `receipt_class` char(2) NOT NULL COMMENT '個人、捐贈、統編、電子',
  `total_sponsor` int DEFAULT '0' COMMENT '人數計算',
  `total_donation` int DEFAULT '0',
  `member_id_card` char(10) NOT NULL,
  `member_birthyear` varchar(10) DEFAULT NULL,
  `member_birthmonth` varchar(10) DEFAULT NULL,
  `member_birthday` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`member_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `member_info`
--

INSERT INTO `member_info` (`member_no`, `member_id`, `member_name`, `member_compilation`, `member_img`, `member_salutation`, `member_account`, `member_password`, `member_mobile`, `member_home_phone`, `member_business_phone`, `member_address`, `receipt_class`, `total_sponsor`, `total_donation`, `member_id_card`, `member_birthyear`, `member_birthmonth`, `member_birthday`) VALUES
(9, 'A009', '王小力', NULL, 'photo_stickers_A009.png', '小姐', 'miniwang@spark.com', 'error404', '0955887374', '', '', '台北市幸福區小可愛路555號8樓1', '電子', NULL, NULL, 'B235791123', '1996', '11', '19'),
(8, 'A008', '王霸氣', NULL, 'photo_stickers_A008.png', '先生', 'mighty@spark.com', 'balabala', '0957448334', '', '', '台中市笑臉區幽默巷321號15樓3', '個人', NULL, NULL, 'H126666789', '2004', '5', '3'),
(7, 'A007', '陳薯叔', NULL, 'photo_stickers_A007.png', '先生', 'lucky@spark.com', 'pig123', '0947228477', '0589439345', '', '新竹市大吉區大吉街123號3樓2', '捐贈', NULL, NULL, 'G111899998', '1961', '11', '20'),
(6, 'A006', '陳急先鋒', NULL, 'photo_stickers_A006.png', '先生', 'vanguard@spark.com', 'a87a76a65', '0948254446', '0229435433', '', '高雄市衝峰區極急巷666號9樓2', '電子', NULL, NULL, 'F213456654', '1975', '1', '16'),
(5, 'A005', '王狸貓', NULL, 'photo_stickers_A005.png', '小姐', 'tanuki@spark.com', 'tanuki8787', '0943824234', '0284839483', '', '台北市多貓區喵喵路二段聰明巷50號8樓1', '電子', NULL, NULL, 'A123543210', '1998', '6', '14'),
(4, 'A004', '阿傻布魯股份有限公司', NULL, 'photo_stickers_A004.png', '公司', 'ashabul@tibame.com', 'bulu999', '0933849243', '', '0294832443', '嘉義市囧囧區快樂巷456號8樓2', '統編', NULL, NULL, 'H122567865', '1982', '5', '15'),
(3, 'A003', '蔡小瓜', NULL, 'photo_stickers_A003.png', '先生', 'smallgua@spark.com', 'fire444', '0954827483', '', '', '基隆市快樂區瓜瓜路987號5樓2', '電子', NULL, NULL, 'S225012321', '2000', '9', '8'),
(2, 'A002', '蔡比八', NULL, 'photo_stickers_A002.png', '先生', 'newbie@spark.com', 'too333', '0948434656', '0229439345', '', '新北市最佳新人區吃土街456號3樓1', '電子', NULL, NULL, 'A123321123', '2008', '11', '20'),
(1, 'A001', '蔡頭瓜', NULL, 'photo_stickers_A001.png', '先生', 'guagua@spark.com', 'ggg999000', '0912345678', '0398765432', '', '台北市產瓜區快樂路123號13樓1', '個人', NULL, NULL, 'T123123678', '1985', '8', '5'),
(10, 'A010', '阿里阿嘟股份有限公司', NULL, 'photo_stickers_A010.png', '公司', 'aliadu@tibame.com', '666olaola', '0988884443', '', '037487789', '花蓮縣摳摳區發財路168號2樓1', '統編', NULL, NULL, 'Z123321400', '1996', '5', '14');

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
(7, 'SM007', 0, 'SA001', '狸貓呆呆嘟', 'A004', '2023-08-01 17:45:26', '許咪咪', '2023-08-09 07:03:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `milestone`
--

INSERT INTO `milestone` (`milestone_no`, `milestone_id`, `del_flg`, `milestone_title`, `milestone_content`, `milestone_date`, `milestone_image`, `is_milestone_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'M001', 0, '暖心聖誕', '邀請士元火鍋店為孩子們準備豐富的火鍋大餐', '2022-12', 'M001_warm_christmas.png', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16'),
(2, 'M002', 0, '環境小尖兵', '帶領孩子們前往海邊淨灘，為環保盡一份心力', '2023-02', 'M002_environment_soldier.png', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16'),
(3, 'M003', 0, '愛心稻田', '疫情解封後，首次到田裡體驗務農的辛勞，學習感恩', '2023-06', 'M003_love_paddy_field.png', 1, '星火大老闆', '2023-08-01 19:24:16', '星火大老闆', '2023-08-01 19:24:16');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `news`
--

INSERT INTO `news` (`news_no`, `news_id`, `del_flg`, `news_title`, `news_date`, `news_image_first`, `news_image_second`, `news_image_third`, `news_image_fourth`, `news_content_first`, `news_content_second`, `news_content_third`, `news_content_fourth`, `is_news_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'N001', 0, '星火30，感謝有您', '2023-08-11', 'N001_1.png', 'N001_2.png', 'N001_3.png', 'N001_4.png', '親愛的星火兒童認養協會的家人們：我們非常興奮地宣布，星火兒童認養協會迎來了30週年的重要里程碑！在這個特殊的時刻，我們想要向所有支持者、志願者、捐助者和合作夥伴表達最深深的感謝之情。自1985年成立以來，星火一直致力於關愛孤兒和弱勢兒童，為他們提供溫暖、關懷和希望。這30年來，我們見證了無數個家庭的連結、孩子的笑容和夢想的實現。', '在這個特殊的周年慶祝活動中，我們將舉辦一系列精彩的活動，包括兒童藝術展、親子遊樂日和慈善晚宴等，希望為孩子們帶來歡樂和關懷。我們將舉辦一場慈善晚宴，以回饋社會對我們的支持。星火邀請各界人士參與晚宴，不僅是一個節日的慶典，更是一個機會，讓我們團結起來，為孩子們的未來籌集資源和支持。', '在星火的30年歷程中，我們努力實現著「每個孩子都應該有一個家」的願景。我們努力著，為孤兒和弱勢兒童找到合適的家庭，給予他們溫暖和關愛。這一路上，我們見證了無數個家庭的連結，看到了孩子們的微笑，並見證了他們的成長和成就。我們與認養家庭和孩子們建立起了深厚的情感聯繫，共同走過了許多困難和挑戰，但正是這些努力和奉獻，讓孩子們能夠擁有更美好的未來。', '在這個值得慶祝的時刻，我們要感謝每一位為星火付出的人，無論是認養家庭、捐助者、合作夥伴還是社區成員，都是我們成功的關鍵，謝謝你們的慷慨、無私和信任。最後，我們要向所有參與和支持星火的孩子們致以最深的祝福，讓我們共同慶祝星火兒童認養協會30周年的成就，感謝每一位為我們付出的人，並展望更美好的未來！', 1, '星火大老闆', '2023-08-01 19:25:22', 'sir', '2023-08-14 13:15:26'),
(2, 'N002', 0, '東部星火服務據點設立', '2023-08-04', 'N002_1.png', 'N002_2.png', 'N002_3.png', 'N002_4.png', '偏鄉服務不落後!!東部星火據點全新設立，為照顧偏遠地區弱勢兒童，星火協會召集各方善心人士相助，一同於東部創辦中心，提供服務，這個據點的成立不僅是一個組織的舉動，更是一個關乎著社會關懷與責任的重要時刻。', '星火協會，作為一個擁有愛心的社會團體，早已深知關懷偏遠地區的重要性。這次在東部成立的據點，將會是一個點燃希望的據點，讓孩子們不再因為地理位置而失去平等的待遇。這個據點的建立，不僅需要星火協會的努力，更需要來自各方善心人士的共同參與和支持。', '一如既往，星火協會總是信守著對兒童的承諾。無論是教育資源、醫療照護，還是心靈陪伴，我們將全力以赴。東部星火服務據點將不僅僅是一個教育機構，更是一個關懷社區、傳播愛心的平台。我們希望這個據點，能夠讓孩子們感受到社會的關愛，並且鼓勵他們發揮自己的潛能，為社會創造更美好的未來。', '許多人會問，為何選擇東部地區？我們的答案是，正因為那裡需要更多的愛與關懷。東部的山川河流雖然美麗，卻也遭受著交通不便、資源缺乏的問題。這次的據點設立，是星火協會對東部地區的一份承諾，我們將與當地居民攜手合作，為孩子們打造更好的明天。', 1, '星火大老闆', '2023-08-15 08:38:21', '星火大老闆', '2023-08-15 08:38:21'),
(4, 'N004', 0, '小心詐騙，拒絕詐騙', '2023-06-30', 'N004_1.png', 'N004_2.png', 'N004_3.png', 'N004_4.png', '近日詐騙集團猖獗，多利用各式通訊軟體或是社群媒體作為管道進行詐騙，是最為常見的手法，本會提醒各位多多注意。在這個數位時代，科技的腳步不斷加快，帶來了生活的便利和便捷。然而，與此同時，詐騙犯罪也趁機滲透，日益猖獗。近日，詐騙集團的活動如影隨形，借助各種通訊軟體和社群媒體，將詐騙的陰影伸向每個人的生活。正因如此，我們迫切需要警覺，保護自己，維護社會的安全。', '詐騙犯罪手法千變萬化，我們可能難以察覺。但不論詐騙的形式如何變化，它們背後的骗局和危害都是相同的。透過虛假信息，詐騙分子企圖誘使我們提供個人隱私、金錢或其他敏感信息。往往，當我們信以為真，陷入詐騙的陷阱時，已經來不及後悔。因此，唯有提高警惕，多一分小心，才能遠離詐騙的魔爪。', '我們不應讓自己陷入單獨防範的困境。作為一個社會，我們應該共同擁有對詐騙犯罪的警惕性。當我們接到可疑信息，收到不明來歷的電話，或是遇到任何讓人懷疑的情況，不妨主動與親友分享，尋求建議。透過分享經驗，我們不僅可以提醒身邊的人，也可以擴大對詐騙的警覺範圍，讓更多人免受其害。', '政府和相關單位也肩負著保護市民安全的重責大任。它們需要加強宣傳，提供正確的防範知識，向民眾普及詐騙犯罪的特點和手法。同時，也需要建立更加完善的制度和機制，打擊詐騙活動，嚴懲犯罪分子，讓詐騙行為付出應有的代價。', 1, '星火大老闆', '2023-08-15 10:21:02', '星火大老闆', '2023-08-15 10:21:02'),
(3, 'N003', 0, '暑假兒童營養午餐提供', '2023-06-30', 'N003_1.png', 'N003_2.png', 'N003_3.png', 'N003_4.png', '盛夏時節，陽光灑落大地，兒童們迎來了他們最期待的暑假。然而，在這個喜悅的同時，我們也不能忽略那些身處偏遠地區的弱勢兒童，他們或許缺少基本的營養支持，無法擁有像其他孩子一樣美好的假期。為此，東部星火據點的全新設立，正努力著為這些孩子帶去溫暖和關愛，為他們提供營養美味的午餐', '暑假兒童營養午餐提供，離不開各方善心人士的參與。我們呼籲社會的每一個角落，無論是個人還是機構，都能夠伸出援手。你的一份愛心，將能夠點亮一個孩子的希望。而在這個過程中，你也將感受到無比的喜悅和滿足。', '讓我們想象一下，當這些孩子拿著一份營養美味的午餐，笑容燦爛地坐下，享受著屬於他們的溫馨時光。這份溫暖將成為他們一生中珍貴的回憶，也將激勵他們繼續努力，追求更好的明天。', '為了這些孩子，為了這個社會，讓我們攜手前行。讓我們將關愛和溫暖，送到每一個需要的地方。讓我們一起，讓偏遠地區的兒童能夠擁有一個充實、快樂的暑假。讓我們的愛心，在這個夏日，綻放出最美的光芒。', 1, '星火大老闆', '2023-08-15 08:52:36', '星火大老闆', '2023-08-15 08:52:36'),
(5, 'N005', 0, '溫馨故事｜我推的孩子', '2023-06-30', 'N005_1.png', 'N005_2.png', 'N005_3.png', 'N005_4.png', '每一個在星火會員幫助之下的孩子，都將是未來閃耀的一顆晨星，即使相隔數百公里，但是藉由書信往返的真摯關懷總能傳遞滿滿的溫暖。在星星點點的夜空下，每一顆晨星都是一個未來的希望，一份渴望發光的夢想。雖然我們身處不同的地方，相隔數百公里，但藉由書信的往來，我們彼此之間的溫暖和關懷總能穿越時空，編織出一個感動人心的故事。', '在星火會員的幫助之下，我們有幸成為了孩子們生命中的一道光芒。這些孩子或許身處困境，或許生活不易，但他們的內心充滿了無限的可能性。每一封我們寄出的書信，都是一份真摯的關懷，一種讓他們感受到社會關愛的方式。', '書信，是一種連結心靈的媒介。在這個快速變遷的時代，人與人之間的聯繫似乎變得越來越疏遠。然而，當我們拿起筆尖，寫下真摯的話語，將關懷和祝福送達千里之外，那種距離的遙遠似乎也變得微不足道。這些孩子或許年幼，或許面臨著學習的困難，但他們的心靈卻是如此純潔和脆弱，我們的每一句話語都能在他們心中留下深刻的印記。', '每一次我們推著孩子們的背後，都是一次無聲的鼓勵。我們或許無法陪伴在他們的身旁，卻能夠用心寫下對他們的祝福，讓他們在孤寂時不再感到孤單。那些溫暖的字句，如同小小的火種，在他們的內心燃燒，照亮他們前行的路途。', 1, '星火大老闆', '2023-08-15 10:21:02', '星火大老闆', '2023-08-15 10:21:02'),
(6, 'N006', 0, '溫馨故事｜久久的奇妙冒險', '2023-04-27', 'N006_1.png', 'N006_2.png', 'N006_3.png', 'N006_4.png', '曾經的久久因為家境問題而長期接受協會認養人的每月認養，如今的久久已經是一名優秀的冒險家，為了感謝認養人，久久決定不當人類了', '有一個名叫久久的孩子，他的童年並不像其他孩子一樣無憂無慮。家庭的經濟問題讓他長期需要依賴協會的認養人提供每月的生活所需，然而，正是這段特殊的經歷，讓久久走上了一段充滿奇妙冒險的成長之路。', '家庭的困難並沒有讓久久灰心喪志，相反，他懂得珍惜每一份關懷與支持。在協會的幫助下，久久不僅獲得了物質的幫助，更收穫了溫暖的陪伴。這種溫暖不僅來自協會的工作人員，更來自於認養人的無私付出。他們的關愛，讓久久感受到了來自世界的溫情。', '然而，久久心中始終藏著一份感恩之情。他知道，如果沒有協會和認養人的幫助，他不可能走到今天的地步。因此，當他的冒險旅程即將進入新的階段時，久久做出了一個決定——他決定不再做人類，而是要成為一名永遠感恩的冒險家。', 1, '星火大老闆', '2023-08-15 10:27:42', '星火大老闆', '2023-08-15 10:27:42');

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
  `is_report_online` tinyint DEFAULT '0' COMMENT '0:下線 1:上線',
  `register` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_no`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `report`
--

INSERT INTO `report` (`report_no`, `report_id`, `del_flg`, `report_class`, `report_title`, `report_year`, `report_file_path`, `is_report_online`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(2, 'R002', 0, '財務', '星火執行財務報告', '2019', 'R2019__finance_rep.pdf', 1, '星火大老闆', '2023-08-01 19:26:00', 'sir', '2023-08-14 15:37:42'),
(3, 'R003', 0, '財務', '星火執行財務報告', '2020', 'R2020__finance_rep.pdf', 1, '星火大老闆', '2023-08-01 19:26:00', 'sir', '2023-08-14 15:37:07'),
(4, 'R004', 0, '財務', '星火執行財務報告', '2021', 'R2021__finance_rep.pdf', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00'),
(7, 'R007', 0, '年度', '星火執行年度報告', '2018', 'R2018__years_rep.pdf', 1, '星火大老闆', '2023-08-14 15:44:49', 'sir', '2023-08-14 15:44:49'),
(8, 'R008', 0, '年度', '星火執行年度報告', '2019', 'R2019__years_rep.pdf', 1, '星火大老闆', '2023-08-14 16:04:09', 'sir', '2023-08-14 16:04:09'),
(5, 'R005', 0, '財務', '星火執行財務報告', '2022', 'R2022__finance_rep.pdf', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00'),
(6, 'R023', 0, '財務', '星火執行財務報告', '2023', 'R2023__finance_rep.pdf', 1, '星火大老闆', '2023-08-01 19:26:00', '星火大老闆', '2023-08-01 19:26:00'),
(9, 'R009', 0, '年度', '星火執行年度報告', '2020', 'R2020__years_rep.pdf', 1, '星火大老闆', '2023-08-14 16:04:55', '星火大老闆', '2023-08-14 16:04:55'),
(10, 'R010', 0, '年度', '星火執行年度報告', '2021', 'R2021__years_rep.pdf', 1, '星火大老闆', '2023-08-15 07:55:26', 'sir', '2023-08-15 08:07:10'),
(1, 'R001', 0, '財務', '星火執行財務報告\r\n\r\n', '2018', 'R2018__finance_rep.pdf', 1, '星火大老闆', '2023-08-15 07:58:30', '星火大老闆', '2023-08-15 07:58:30'),
(11, 'R011', 0, '年度', '星火執行年度報告', '2022', 'R2022__years_rep.pdf', 1, '星火大老闆', '2023-08-15 08:06:36', 'sir', '2023-08-15 08:06:36'),
(12, 'R012', 0, '年度', '星火執行年度報告', '2023', 'R2023__years_rep.pdf', 1, '星火大老闆', '2023-08-15 08:07:58', 'sir', '2023-08-15 08:07:58');

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
  `spark_activity_description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
(1, 'SA001', 0, '夢想之星-喚醒孩子們內心的夢想', '    在本屆的圓夢計畫中，「星火」兒童認養協會將邀請孩子們提出他們的夢想計畫。透過這個計畫，我們希望這些平時少有機會表達意見的孩子們能在夢想的世界中，探索自我，勇敢地為自己發聲。我們將傾聽他們的想法，支持他們追尋夢想的過程，讓他們感受到自己的價值和重要性。這是一個讓孩子們對未來充滿希望的機會，「星火」兒童認養協會將竭盡所能，陪伴他們實現屬於他們自己的夢想。\n<br><br>\n&emsp;&emsp;我們相信，當一個孩子的夢想實現時，不僅對他們個人意義重大，也對整個社會產生積極而持久的影響。藉由這個計畫，我們共同創造一個更美好、更關懷的社會，讓每個孩子都能夠實現他們內心最璀璨的夢想！在浩瀚宇宙中，浮現幾顆神秘的星球，它們彷彿蘊藏著無盡可能，迫不及待地想要透過望遠鏡洞察星球的面貌！每顆星球代表著一組孩子們的夢想計畫，在 <span> 2023-08-01 至 2023-08-31 </span> 期間，按下「為我加油」按鈕，投給你最愛的組別，並為該組別爭取「夢想成真」獎金！讓我們讓我們一同以熱情激勵，為孩子們的夢想點燃璀璨星火。', '2023-08-01', '2023-08-31', 1, '星火大老闆', '2023-08-01 19:27:08', '許咪咪', '2023-08-14 06:06:28'),
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
  `is_sponsor_location_online` tinyint DEFAULT '0' COMMENT '0:下線 1:上線',
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
(1, 'SL001', 0, '台北星火', 1, '星火大老闆', '2023-08-01 19:28:19', 'sir', '2023-08-11 06:57:53'),
(2, 'SL002', 0, '台中星火', 1, '星火大老闆', '2023-08-01 19:28:19', 'sir', '2023-08-11 07:30:50'),
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
  `expiry_date` date NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:終止 1:繼續',
  `updater` varchar(20) NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sponsor_order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `sponsor_order`
--

INSERT INTO `sponsor_order` (`sponsor_order_no`, `sponsor_order_id`, `member_id`, `location_id`, `sponsor_date`, `price`, `payment_plan`, `payment_method`, `children_id`, `expiry_date`, `order_status`, `updater`, `update_time`) VALUES
(1, 'SO001', 'A003', 'SL001', '2023-07-28 14:00:27', 2000, '月繳', '信用卡', 'C567', '2024-07-28', 0, '許咪咪', '2023-08-10 16:06:34'),
(2, 'SO002', 'A004', 'SL001', '2023-07-28 14:00:27', 2000, '月繳', '信用卡', 'C056', '2024-07-28', 0, '許咪咪', '2023-08-12 08:55:25'),
(3, 'SO003', 'A005', 'SL002', '2023-07-28 14:03:31', 6000, '季繳', '超商繳費', 'C326', '2024-07-28', 0, '許咪咪', '2023-08-14 05:03:27'),
(4, 'SO004', 'A001', 'SL003', '2023-07-29 14:03:31', 24000, '年繳', '信用卡', 'C727', '2024-07-29', 1, '許咪咪', '2023-08-09 11:46:00'),
(5, 'SO005', 'A004', 'SL004', '2023-07-30 14:00:26', 12000, '半年繳', '超商繳費', 'C111', '2024-07-30', 1, '許咪咪', '2023-08-09 03:44:25'),
(6, 'SO006', 'A004', 'SL002', '2023-07-31 14:03:31', 2000, '月繳', '信用卡', 'C555', '2024-07-31', 1, '許咪咪', '2023-08-09 03:44:25'),
(7, 'SO007', 'A006', 'SL004', '2023-08-01 14:09:08', 24000, '年繳', '信用卡', 'C395', '2024-08-01', 1, '許咪咪', '2023-08-09 03:44:25'),
(8, 'SO008', 'A007', 'SL003', '2023-08-01 14:09:08', 24000, '年繳', '信用卡', 'C797', '2024-08-01', 1, '許咪咪', '2023-08-09 03:44:26'),
(9, 'SO009', 'A002', 'SL003', '2023-08-02 14:09:08', 12000, '半年繳', '超商繳費', 'C246', '2024-08-02', 1, '許咪咪', '2023-08-09 03:44:30'),
(10, 'SO010', 'A009', 'SL001', '2023-08-03 14:12:22', 2000, '月繳', '信用卡', 'C614', '2024-08-03', 1, '許咪咪', '2023-08-09 03:44:27');

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
  `is_story_online` tinyint DEFAULT '0' COMMENT '0:下線 1上線',
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
(1, 'ST001', 0, '遊戲場上的友誼結盟', '2023-04-12', 'story_ST001.png', '小傑和他的朋友們在遊戲場上歡聲笑語。他們一同踢足球、打籃球，緊張又充滿熱情，一同享受比賽的樂趣。', '小傑和他的朋友們在遊戲場上歡聲笑語。他們一同踢足球、打籃球，緊張又充滿熱情。不論勝敗，他們彼此尊重，一同享受比賽的樂趣。遊戲場上的友誼結盟讓他們更加團結，相互支持，這份友誼將伴隨他們走向更廣闊的未來。', '在遊戲場上，小傑和朋友們共同合作，制定策略，互相幫助。他們一同努力，逐漸提升球技，更加默契。這些團隊遊戲讓他們學會了團結合作、分工協作，培養了領導能力和團隊精神。', '除了遊戲場上，小傑和朋友們也一同舉辦聚會、遠足，共同度過快樂時光。他們一同經歷了許多歡樂和挑戰，並共同成長。這段友誼結盟不僅帶給他們快樂，更教會他們相互尊重、關懷和理解，這份友誼將伴隨著他們走向更美好的未來。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(2, 'ST002', 0, '音樂天使的樂章演奏', '2023-07-16', 'story_ST002.png', '小菲拿著小提琴，她的心隨著音樂起舞。在舞台上，她將她的感情融入每一個音符。觀眾們被她的表演感動，熱烈的掌聲響起。', '小菲拿著小提琴，她的心隨著音樂起舞。在舞台上，她將她的感情融入每一個音符。觀眾們被她的表演感動，熱烈的掌聲響起。她和朋友們合奏美妙的樂章，彼此互相鼓勵，締造了一場音樂的盛宴。這些樂曲讓她們的友誼更加緊密，成就了音樂天使的夢想。', '在音樂課堂中，小菲和朋友們共同練習琴技，一同演奏樂曲。她們彼此磨合，合奏出優美動人的音樂。除了音樂課上，她們也組成樂團參加校內演出，讓更多人感受到音樂的美好。這些共同演奏的時光讓她們的友誼更加深厚，相互間的默契和信任更加堅定。', '在音樂比賽中，小菲和朋友們精心演繹，獲得了優異的成績。他們一同分享著勝利的喜悅，也一起品嘗著挑戰的甜蜜。這些共同的努力和成就讓他們的友誼更加持久，成就了音樂天使的美麗人生。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(3, 'ST003', 0, '探索奇妙的科學之旅', '2023-04-20', 'story_ST003.png', '小明和朋友們興致勃勃地走進實驗室。在老師的指導下，他們探索著科學的奧秘。他們合作實驗，發現新的現象，驚嘆於科學的魅力。', '小明和朋友們興致勃勃地走進實驗室。在老師的指導下，他們探索著科學的奧秘。他們合作實驗，發現新的現象，驚嘆於科學的魅力。這個科學之旅不僅豐富了他們的知識，更激發了他們對科學的熱愛，讓他們期待著更多的探索與發現。', '在實驗室裡，小明和朋友們動手操作，對於每一個實驗都充滿好奇。他們發現水的奇特性質、物體的浮沉規律，更了解到自然界的秘密。這些有趣的實驗讓他們學到了許多知識，並培養了觀察、思考和解決問題的能力。', '小明和朋友們組成了一個科學小組，定期進行科學實驗和探索。他們舉辦了科學展示，與其他同學分享自己的發現。這份友誼和共同的興趣讓他們更加團結，共同成長。這段奇妙的科學之旅不僅激發了他們對知識的渴望，更讓他們明白到科學是改變世界的力量。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(4, 'ST004', 0, '畫筆舞動的創意世界', '2023-04-27', 'story_ST004.png', '小莉手握著五彩的畫筆，她的心情隨著筆尖飛舞。她的畫筆彷彿是魔法棒，將她的想像力化為美麗的圖畫。', '小莉手握著五彩的畫筆，她的心情隨著筆尖飛舞。在白紙上，她描繪出奇幻的仙境、可愛的動物和燦爛的花朵。她的畫筆彷彿是魔法棒，將她的想像力化為美麗的圖畫。朋友們讚嘆著她的才華，她滿足地笑著，知道自己的畫筆能讓世界更加美好。', '小莉與朋友們一起分享著自己的藝術創作，他們在一起討論著彼此的想法和技巧。他們互相學習，共同進步。有時，他們也一起合作創作大型的畫作，將各自的創意融合在一起。這些歡樂的時光讓他們的友誼更加深厚，彼此間的信任和理解更加牢固。', '當展覽來臨時，小莉和朋友們齊心合力，將自己的作品展現給更多的人。觀眾們對於他們的畫作讚不絕口，讚賞著他們的創意和才華。這個創意世界不僅讓小莉感受到自己的價值，更讓她明白藝術與友誼是無價的寶藏。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(5, 'ST005', 0, '歡樂的成長旅程', '2023-04-28', 'story_ST005.jpg', '妮娜在協會裡結識了許多和她一樣的朋友們，他們參加了各種有趣的活動，例如野餐、戶外遊樂和手工......', '小明和他的朋友們攜手展開了一段歡樂的成長旅程。他們一起克服挑戰、分享快樂。在學校裡，他們一同探索知識的奧秘，互相學習和成長。在運動場上，他們比賽、合作，彼此激勵。這些寶貴的回憶和朋友間的默契讓他們一起成長，共同走過美好的童年。', '他們一起度過了無數個快樂的時光，他們彼此扶持著，在困難時互相支持，共同經歷著人生的起伏。這些美好的回憶讓他們的友誼更加堅固，成為彼此的支柱和陪伴。', '隨著時間的流逝，小明和朋友們漸漸長大。他們雖然各自走向不同的道路，但那份純真的友誼永遠不會消失。他們在人生的重要時刻互相祝福和支持，共同見證著彼此的成長。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(6, 'ST006', 0, '大自然的奇妙旅程', '2023-05-18', 'story_ST006.jpg', '晴晴從學步起，就迷戀上大自然的美麗與神奇，總是迫不及待地探索著每一片草地、每一條小溪，她收集......', '大華手牽著爸爸，踏上大自然的奇妙旅程。他們漫步在綠意盎然的森林中，小明驚嘆著樹木的高聳和鳥兒的歌唱。突然，一陣微風吹來，樹葉輕輕擁抱他的臉龐，讓他感受到大自然的溫柔。', '他們來到湖邊，小明蹲下身子，驚喜地發現湖面上漂浮著五彩繽紛的蝴蝶。他們輕輕跳躍，像舞者般在空中翩翩起舞。小明興奮地追逐著蝴蝶，迷失在大自然的魔幻世界。', '大自然的奇妙旅程不僅給大華帶來驚喜和刺激，更啟發了他的想像力和探索精神。他學會欣賞自然之美，瞭解到生命的連結和平衡。這段與大自然的親密接觸，讓他成長為一個更關懷和尊重環境的孩子。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(7, 'ST007', 0, '萌萌的鐵道世界', '2023-06-09', 'story_ST007.jpg', '每當萌萌走進鐵道世界，他的眼睛就會閃耀著興奮的光芒。他會花上整個下午建設火車軌道、設置小火車......', '萌萌眼中燃燒著興奮的火焰，他手中握著一個精緻的小火車玩具。他將它輕輕放在軌道上，火車蜿蜒前進，發出嗡嗡的聲音。小明的臉上洋溢著快樂的笑容，他與小火車一同探索著無限的遊戲世界。', '火車沿著彎曲的軌道穿梭，經過小山丘和橋樑。小明的想像力瞬間被點燃，他模擬火車經歷著驚險刺激的旅程，穿越山谷和越過障礙。他對小火車的每一次控制都充滿著自信和喜悅。', '小明邀請朋友們一同加入遊戲，他們圍坐在地上，用手與笑聲模擬著小火車的運行。他們合力建造軌道、設計站台，共同創造屬於他們的迷你鐵路世界。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(8, 'ST008', 0, '禮物中的喜悅', '2023-06-20', 'story_ST008.jpg', '星火協會在兒童節這天，發放給每位小朋友們一份小禮物，這份禮物不僅帶來滿足，更加深愛與關懷的體......', '兒童節來臨之際，一群小朋友興高采烈地聚集在一起，期待著令人心動的禮物。他們眼中閃耀著無盡的期待，好奇地猜測著禮物會是什麼。終於，禮物盒被打開，幸福的驚喜彌漫在空氣中。', '小明興奮地握著一本彩色的繪本，裡面充滿了美麗的故事和色彩繽紛的插畫。他迫不及待地翻閱著每一頁，想要探索那個神奇的故事世界。小花拿著一個樂器，她輕撥著琴弦，美妙的音符在空中飄揚，帶來了甜蜜的音樂。', '還有小杰收到一個拼圖，他專心地將每塊拼圖拼接在一起，最終呈現出一幅驚人的圖案。他為自己的成就感到自豪，而這個拼圖也將成為他無數次快樂的挑戰。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(9, 'ST009', 0, '我是這樣長大的', '2023-07-15', 'story_ST009.jpg', '小安從小就以她的畫筆將奇幻的夢境和美麗的色彩帶入現實生活，她用繽紛的色彩和獨特的構圖展現她對......', '小安手握著五彩的蠟筆，專注地在畫紙上揮灑著自己的想像。他畫出了一個夢幻的森林，樹上掛滿了燦爛的花朵，小動物們歡快地奔跑著。他的臉上洋溢著快樂的笑容，畫筆在他的指尖舞動著。', '小安展示著他的畫作，眾人驚嘆著他的藝術天賦。他的作品散發著童真和創意，彷彿一個個魔法的世界。朋友們圍繞著他，紛紛稱讚他的畫技和豐富的想像力。小明感受到他們的支持和鼓勵，更加自信地繼續創作著。', '畫筆在小明的手中成為一個無限的魔法工具，他通過每一幅畫作表達出自己的情感和世界觀。當他看著自己的作品時，他感到無比的快樂和成就。畫畫成為他忘卻壓力的途徑，也為他的童年增添了無盡的快樂和美好回憶。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08'),
(10, 'ST010', 0, '小手揉麵 共享美味', '2023-12-30', 'story_ST010.jpg', '小朋友們認真地學習製作麵包，彼此合作搓揉麵團，一同創造出美味的麵食作品。他們用小手捏出有趣的......', '在星火兒童協會的廚房裡，一群充滿活力的小朋友圍坐在長桌旁，熱情地揉著麵團。他們的小手掌沾滿了麵粉，笑聲和歡樂彌漫在空氣中。協會的導師們帶領著他們，一同展開了一場美味的冒險。', '小朋友們充滿興奮地將麵團揉搓得越來越柔軟，他們一起分享著創意和技巧，塑造出各種有趣的形狀，如動物、星星和花朵。他們彼此鼓勵，互相幫助，建立起了友誼的紐帶。', '經過烘焙，美味的麵食從烤箱中散發出迷人的香氣。小朋友們期待已久地坐在一起，品嚐他們共同製作的成果。眼神中充滿了驚喜和自豪，他們大快朵頤，享受著這份自己親手創造的美味。', 1, '星火大老闆', '2023-08-01 19:29:08', '星火大老闆', '2023-08-01 19:29:08');

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
  `location` varchar(10) NOT NULL,
  `thanks_letter_file` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_thanks_letter_sent` tinyint NOT NULL DEFAULT '0' COMMENT '0:待確認 1:已寄出',
  `register` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '星火大老闆',
  `regist_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updater` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '星火大老闆',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`thanks_letter_no`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `thanks_letter`
--

INSERT INTO `thanks_letter` (`thanks_letter_no`, `thanks_letter_id`, `del_flg`, `children_id`, `member_id`, `sponsor_order_id`, `receive_date`, `location`, `thanks_letter_file`, `is_thanks_letter_sent`, `register`, `regist_time`, `updater`, `update_time`) VALUES
(1, 'TL001', 0, 'C118', 'A003', 'SO023', '2023-07-01', '台北星火中心', '今年有新衣服穿了.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火喵喵大財團', '2023-08-14 18:27:25'),
(2, 'TL002', 0, 'C001', 'A001', 'SO001', '2023-07-01', '台北星火中心', '狸貓分心.png', 1, '星火仔', '2023-08-01 19:14:11', '星火喵喵大財團', '2023-08-14 18:59:59'),
(3, 'TL003', 0, 'C050', 'A001', 'SO138', '2023-08-05', '台北星火中心', '我會健康地長大哦.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(4, 'TL004', 0, 'C007', 'A004', 'SO005', '2023-08-09', '台中星火中心', '我想對您說，謝謝您~.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(5, 'TL005', 0, 'C021', 'A007', 'SO067', '2023-09-16', '台中星火中心', '雖然我不認識您 但是謝謝您~.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(6, 'TL006', 0, 'C156', 'A006', 'SO015', '2023-09-21', '台中星火中心', '我收到了超棒的禮物.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11'),
(7, 'TL007', 0, 'C098', 'A007', 'SO132', '2023-09-08', '台南星火中心', '謝謝您我的超人.jpg', 1, '星火仔', '2023-08-01 19:14:11', '星火仔', '2023-08-01 19:14:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
