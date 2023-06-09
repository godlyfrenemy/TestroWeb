-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 08 2023 г., 23:07
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testro_db`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CountCorrectAnswers` (IN `pupil_to_find` INT, IN `test_to_find` INT)   BEGIN
	SELECT COUNT(DISTINCT questions.question_id) AS total_count FROM pupil_results 
    LEFT JOIN question_results ON pupil_results.question_result_id = question_results.question_result_id
    LEFT JOIN test_questions ON test_questions.question_id = question_results.question_id
    LEFT JOIN questions ON questions.question_id = test_questions.question_id
    WHERE test_questions.test_id = test_to_find AND pupil_results.pupil_id = pupil_to_find AND questions.correct_answer_id = question_results.result_answer_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPupilData` (IN `pupil_to_find` INT)   BEGIN
	SELECT * FROM pupils_data LEFT JOIN pupil_users
    ON pupil_users.pupil_data_id = pupils_data.pupil_data_id
    WHERE pupil_id = pupil_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPupilResultsByName` (IN `test_to_find` INT, IN `pupil_to_find` TEXT)   BEGIN
	SELECT * FROM pupil_test_completions LEFT JOIN pupil_users
    ON pupil_test_completions.pupil_id = pupil_users.pupil_id LEFT JOIN pupils_data
    ON pupils_data.pupil_data_id = pupil_users.pupil_data_id
    WHERE test_id = test_to_find AND
    (pupil_name LIKE CONCAT('%', pupil_to_find , '%') OR pupil_surname LIKE CONCAT('%', pupil_to_find , '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetQuestionAnswerMark` (IN `pupil_to_find` INT, IN `question_to_find` INT)   BEGIN
	SELECT SUM(questions.correct_answer_id = question_results.result_answer_id) * 100 / COUNT(*) AS result FROM pupil_results 
    LEFT JOIN question_results ON pupil_results.question_result_id = question_results.question_result_id
    LEFT JOIN test_questions ON test_questions.question_id = question_results.question_id
    LEFT JOIN questions ON questions.question_id = test_questions.question_id
    WHERE question_results.question_id = question_to_find AND pupil_results.pupil_id = pupil_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTeacherByLogin` (IN `login_to_find` TEXT)   BEGIN
	SELECT * FROM teacher_users WHERE STRCMP(teacher_users.teacher_login, login_to_find) = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTeacherTests` (IN `teacher_to_find` INT)   BEGIN
 SELECT * FROM tests 
 LEFT JOIN teacher_tests ON tests.test_id = teacher_tests.test_id 
 WHERE teacher_tests.teacher_id = teacher_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTeacherTestsByName` (IN `teacher_to_find` INT, IN `test_to_find` TEXT)   BEGIN
 SELECT * FROM tests 
 LEFT JOIN teacher_tests ON tests.test_id = teacher_tests.test_id 
 WHERE teacher_tests.teacher_id = teacher_to_find AND tests.test_name LIKE CONCAT('%', test_to_find, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTestInfo` (IN `in_test_id` INT, IN `in_user_id` INT)   BEGIN
	SELECT * FROM `tests` WHERE `test_id` IN (SELECT `test_id` FROM `teacher_tests` WHERE `test_id` = in_test_id  AND `teacher_id` = in_user_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTestQuestions` (IN `test_to_find` INT)   BEGIN
	SELECT * FROM questions 
    LEFT JOIN test_questions ON questions.question_id = test_questions.question_id 
    WHERE test_questions.test_id = test_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTestQuestionsCount` (IN `test_to_find` INT)   BEGIN
	SELECT COUNT(*) AS `total_count` FROM test_questions WHERE test_id = test_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTestQuestionsWithMistakes` (IN `test_to_find` INT, IN `pupil_to_find` INT)   BEGIN
	SELECT * FROM pupil_results LEFT JOIN question_results ON pupil_results.question_result_id = question_results.question_result_id LEFT JOIN questions ON questions.question_id = question_results.question_id LEFT JOIN test_questions ON questions.question_id = test_questions.question_id WHERE questions.correct_answer_id != question_results.result_answer_id AND pupil_results.pupil_id = pupil_to_find AND test_questions.test_id = test_to_find;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SaveTestResultsFile` (IN `test_to_find` INT, IN `file_path` TEXT)   BEGIN 
    set @q1 := concat("SELECT ", " 'Імя'", ", 'Прізвище'", ", 'Запитання'", ", 'Відповідь'", " UNION ALL 
    ((SELECT pupil_name pn, 
    	   pupil_surname psn,
    	   question_name,
           answer_text           
    FROM tests 
    LEFT JOIN test_questions ON tests.test_id = test_questions.test_id
    LEFT JOIN question_results ON question_results.question_id = test_questions.question_id
    LEFT JOIN questions ON questions.question_id = test_questions.question_id
    LEFT JOIN pupil_results ON pupil_results.question_result_id = question_results.question_result_id
    LEFT JOIN pupil_users ON pupil_users.pupil_id = pupil_results.pupil_id
    LEFT JOIN pupils_data ON pupils_data.pupil_data_id = pupil_users.pupil_data_id
    LEFT JOIN answers ON answers.answer_id = question_results.result_answer_id
    WHERE tests.test_id = ", test_to_find, ")
    ORDER BY pn, psn ASC)
    INTO OUTFILE '", file_path, "' 
    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY ''
    LINES TERMINATED BY '\r\n'");
    
    prepare s1 from @q1;
	execute s1;deallocate prepare s1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `answer_text` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`answer_id`, `answer_text`) VALUES
(33, 'Навколо своєї осі'),
(34, 'Навколо Сонця'),
(35, 'Навколо центру галактики'),
(36, 'Вона не крутиться'),
(37, '1'),
(38, '2'),
(39, '5'),
(40, '10'),
(62, ''),
(82, ''),
(84, ''),
(91, ''),
(92, ''),
(93, ''),
(94, ''),
(95, '');

-- --------------------------------------------------------

--
-- Структура таблицы `pupils_data`
--

CREATE TABLE `pupils_data` (
  `pupil_data_id` int(11) NOT NULL,
  `pupil_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pupil_surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pupil_form` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pupils_data`
--

INSERT INTO `pupils_data` (`pupil_data_id`, `pupil_name`, `pupil_surname`, `pupil_form`) VALUES
(1, 'Artem', 'Akymenko', '11 клас'),
(4, 'Vitalii', 'Akymenko', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pupil_results`
--

CREATE TABLE `pupil_results` (
  `pupil_result_id` int(11) NOT NULL,
  `pupil_id` int(11) NOT NULL,
  `question_result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pupil_results`
--

INSERT INTO `pupil_results` (`pupil_result_id`, `pupil_id`, `question_result_id`) VALUES
(78, 3, 85),
(80, 3, 87),
(81, 3, 88);

-- --------------------------------------------------------

--
-- Структура таблицы `pupil_test_completions`
--

CREATE TABLE `pupil_test_completions` (
  `pupil_test_completion_id` int(11) NOT NULL,
  `pupil_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `completion_times` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pupil_test_completions`
--

INSERT INTO `pupil_test_completions` (`pupil_test_completion_id`, `pupil_id`, `test_id`, `completion_times`) VALUES
(26, 3, 50, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pupil_users`
--

CREATE TABLE `pupil_users` (
  `pupil_id` int(11) NOT NULL,
  `pupil_login` text NOT NULL,
  `pupil_password` text NOT NULL,
  `pupil_data_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pupil_users`
--

INSERT INTO `pupil_users` (`pupil_id`, `pupil_login`, `pupil_password`, `pupil_data_id`) VALUES
(3, 'admin', 'ISMvKXpXpadDiUoOSoAfww==', 1),
(10, 'vitalii', '3ATAJt3Nf+KlyA6pXbkosg==', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_name` mediumtext NOT NULL DEFAULT 'Порожнє запитання',
  `correct_answer_id` int(11) DEFAULT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`question_id`, `question_name`, `correct_answer_id`, `image`) VALUES
(9, 'Навколо чого крутиться Земля?', 36, 0x89504e470d0a1a0a0000000d4948445200000200000001f408030000007c4d655a000000ae504c54450000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005ec853a50000003974524e53000305080a0e14181c1f23272a2e33373c41464c51555a5f64696c7074797d83898e93999fa6abb1b6babec1c5c9cdd1d6dce2e7ecf0f3f6fa6f4ffb52000016af494441547801edc18976e2d8962dd025fabeb5011b303d18636c040269fdff8fbdf1aaea56e5bd1919e17d241d24b1e744eae5cbf576ef69301a4fdf66b3d97c319fcd666f9397e1a0df6d568b0e5426955afdd7d96a773cfbfc3deff4b1594e87dd7a1e2a039c5aff75b13bf994bb1c37b361a7049552d5a7e9e6cb6758978fe54ba7089526b5c17cef314aee76da2b42255fb1f7b6f3188fefd5a801955ca5a7c53160bcbcddb8e540254ebe37ffa225d7ed4b0d2a416aafef3eed7257fd025402389df98977e1ef4665a8bbcaf55617ded3e7b80a75274e6fedf1febea65528fb5a8b0b93e2f05282b2a9323d315182dd530eca8efcf37bc0e4b9cc1b50f1abcd3d26d56190878a93f3f4ce44f3e635a8b814c72e936fd7858a436d71653a7c0df350116b6d02a6c76552848a50f79d29739d97a122d2fb640af98b325404fa47a694bf284385d43b32c5fc45092a84f69e29779b15a10cd577cc006f9c8732505a06cc06f7194a2a3fb9323b3edb50224f2eb3655386fab1fa3b33e736c941fd48611e308b4e5da81fe89f99559b12d41f54b6cc306f04f55b2f5766dba10ef58f6a1fcc3c7fe240fd92f37ae3233836a07ea1fac107e14f1ca8ff34bcf2711c6a50ffa6b4e343b90ea1fea27be1a3d916a1fe476ec607e4b6a1fe4bf5930f29983a5040dfe3a37a2fe1e139333eb0731b0faefcc187e6bfe0a1b5ce7c74eb3c1ed7d0a73a56f0a0720b5a179cbfded78bd978f8d4ebb49a8d7aad566f345b9d5eff7934992d371fa72badbb74f0908a7bda13b8fbe5e4b95d76f027857a6f34db7e5d694f30c403aa9d6887bb9b0d9a794895bbafcbc38d76cc1d3c9a8ec7f89db7935e092138f5c1e2d367fcb6053c9681cf987d2f9f2b8844be3dde798cd957198f64c258b9abe712a2d518bfdf1827b78e87e12c191f7fff5a432c72ddc589f1f1da7810f92de3725d3f1510a7fae49371f1fb7808853de3e1adfb39c4aff27a603c82211e40e9c838f8dba73c6ca94cbe198b57645ee5c4181c5f8ab0abb5f418831932aeea3272dea2813bc83f7f307a0b645aedcca81d8779dc4b7de1316a4b6458edcc68059b36eeaaf07262c456c8acfa8591bacd2bb83ba7ffc168ad9051b533a3749996900ced2d23b5442655cf8cd0659c477234368cd212195471199dcb388f64696c18a13932a7746264bc6901c9d3dc313a33644cf18b51f167252453fbc0c88c9129f903a3b2a920b99e5c4665880cc9bd33228716122d37f6188da08fec58331a970112afb46234fc0eb262c648048b22d2a07d6424bc3ab261c4481c9b4809677c6314dc32b2a01f3002d75707e951d9310a5f05a45ff3c608bc57912e038f11d83a48bbf299e15d87489dd296119823e5f24786f751451a0d3c863742ba6d189a3f76904e953d430b3a48b309433b35905ee380615d2a48af5ec0b05679a459cb6558c73cd2aae631a4db3352aeb865586ba454fe9b217dd7917eaf01437a453aad19d2a6802c689f194ed0461a8d184e304646943f19ceb984f469fa0cc5eb2233722b86f3ee206d8a2e4339d59025af014399226dd60c655f44b6f4ae0c2368235d860c659543d6345c86e1169126b51bc3982283ca5f0c638314c91d194230402615f70c6388f49831845b0f1995db30846b1569d10e68eeda4166392b867070900e8513cd5d9ac8b2394398201d963477ae23db6634e73790061d9a3bd79075539afb74907c0597c6ce3564df84e62648be058d9d6b7804531af36b48ba764053971a1ec31b8d1d9070b96f9af21a7814731a1b21d92634756be171ac68ca2b21c9aa371af2bb7820ce86a63648b21d4d3de1a1e4f634d54572f569ea150fa6f84d43a71c922aefd2d01c0fa77ca6a109926a4a435b3ca0c69566ae652453e54633c73c1e512fa0993592694333e7321ed32b0db591442d9af15b78542b9a3920890e3433c0c3ca7dd2cc3392e78966e67860e5338db839244dcea5910f078fac13d0c81849f3422397321edb9846bc2292257fa189a08347b7a5911992654223533cbca24b13d71292a4e8d1c48703d50e6862812479a309af0c054c68c22f23398a1e4df4a100387b9a582039de686205f55f2a571af0cb488aa247036e11eabf0d686281a498d24407ea5fb634e097900cf90b0d2ca1fe57d9a3811992e18506dc02d4ff19d080574012e45c1ae842fdd58e06c64882010daca1fe4df546b9730e09f04539af04f5efc63430c4fd75686008f51f725f94fbc2fd6d29f709f5376d1ae8e0deaa01c58226d4dfad29b7c5bd2d28b784fa85f295624115f795f728e695a07e6542b919ee6b48b931d42fe55c8a5d72b8ab4f8ab939a85f7ba6dc33eea949b927a87ff249b10fdcd3926247a87fd4a15c1df793bf52ac0bf5cfde2936c7fd0c28b687fa8d26c52e0eee664fb136d4ef6c29d6c7bd5429b687faad06c5b6b89729c53a50bfb7a55450c29d9c28b587fa8326c546b88f26c5ba507fb2a3d407ee634ea923d41f752856c13d38674a3d41fdd9815213dc439b52ae03f5677d4a1d710f0b4abd42fd80e352aa8a3b7029742d40fdc42ba5c6b0af45a905d48f14ae143ac0be19a56a503fb3a45419d67d53680ff5430d4a8d605b95524f503f75a0d00eb6bd52e89c83faa901856e7958f64ea119d48fe5af14eac1ae824fa11ad4cf2d29b4845d7d0a1da0045a147261d782422328891385aab0ea4499a0042531a5d008365528b48312a951680b9b86147a8692f9a48ce7c0a23565fc0294cc98424d58e452660b2554a5d02beca95068002575a4cc16f60c281314a1a4a694b9c09e1565f650620d0a3560cd37655ea1e45cca0c614b31a04c0d4a6e4999156ce952e60465a047996fd832a5cc02ca40dea7485080253bcaf4a14cec29d38525678a0405281313ca8c614789320728232dca6c60478f32332823ce952227d831a14c0fcacc3b458202acd850242840999950a60d2bbe29728432d4a1cc0836e4028a2ca10ce5038a2c60438332032853478abcc38627cad4a04c2d2972860d6f14f1a08c0d295384051b8aeca18c3528d38205478acca18ce57c8a0c608147910194b92345de10bf22651a50e6561459237e2d8a04392873638a7c227ecf14394185d0a3c819f19b50640b1542853239c46e4191195418378a5411bb2d458650617c53a483d81d29d2810a634b91016277a148192a8c394526889b1350c2870ae585220bc4ad44911354287d8a6c10b70645f650a13429b247dcba1459438552a4c837e236a0c80c2a9c1b252e88db0b455ea1c2712911206e538a3c4385f34991026236a748172a9c1d452a88d98a220da87056146920665b8a94a1c29953a48398bd53a40015ce94223dc4ec4089002aa4178a3c2166474a7850210d283240cc4e94384385f444911162e652e20415528f2263c4ec42892fa8903a149922661e253ea1426a51648a987994384085d4a4c81b6276a5c41e2aa426456688d98d127ba8901a149921663e25dea142aa53648e98f99478870aa94e91196276a3c41e2aa406456688d995121f502135293243cc3c4a1ca0426a51e40d31bb50e20815529b2253c4ec4c896fa890ba14192366274ab85021f529f282987d51e20215d233458688d927256e50218d283240ccf614c9418533a1481f31db51a40415ce8c225dc46c4d911a54384b8ab410b32545da50e16c285243cc6614e94385f34191126236a6c8082a9c13451cc46c48912954381e253cc4ad4f91255428398ab8885b8b223ba8506a14f944dcaa14f9820aa543911de296a7880715ca80222bc4ee4a91025418538abc2176278a34a1c258536484d8ed29f20415c681227dc46e4591095418178a3411bb378aaca0422850a688d80d29f20915428b2257c4af4b110f2a842145be11bf2a65ca50e6e614d9227e8e4f911e94b9778a2c60c18922132873178abcc0821d453650c6ca94e9c28205454e50c67a94a9c08211658a50a6de2872830d1dca74a14ced2872840d45ca4ca14c791459c38a33457650866a9499c08a3d453c284343caf460c59c320d28332bca5460c580322f50665c8a78b0a34e990d94913265de618773a3c805cac880323358f2499926948935659e61c9823213281367ca5461c980327b28030dca5c604b95327e014a6e42991dacb950e6094aee83325358b3a3cc0a4aac1850a60b6b2694b940890d2813e4614d8b426d28a92d653e614fee4699059450fe4699392c7aa78c0b25f444a11e2c9a52a80525b3a14c5080456d0a2da0440a37ca7cc226c7a3ccd9819218506806abb614ea4249ec28d48155230aada1044a0165ae395855a3d0ad00f573630a6d61d9894243a89ffba6d00896cd297480fab116a52ab0ac43a93ad44fad28f405db721e8516503f54bc516806eb3614f2f2503ff342a916ac7ba2d410ea67be2974867d059f425f503fd2a5d41277b0a55417ea277694eae00e0694da41fd408d5217077750f4295587fab325a596b88b2da556507f54f229d5c15d3c51ca2f43fdc98c5267077791bf526a0ef507458f5273dcc99a52b712d4ef4d29d6c49d74293687faad8247a96fdc8be352ea5682fa9d09c526b89b19c5e650bf51f42815947137358af965a87ff646b11deee883624ba87f54ba52ec097734a0585083fa270b8a5d72b8a3bc47b12dd43fa8f9149be1aee694eb40fdda966241157755a3dc11ea97da94dbe1cede293780fa05e748b91eeeac4fb94b11eaef4694731ddcdb897273a8bf295e28f78abb7ba15c5087fa4f4bca5d0bb8bb8247b903d47f6805949b2301e6343082fa37ce17e5820a12a0ec53ce2b41fdd59806364884150d6ca0fea276a3812612a116d0c013d4fff9a0817724c496062e25a87f79a1893612a249131ba8ff51bbd1c0071263471303a8ffe21c68a28bc468d1845781faffa634f18904d9d1c4de81025a014df490202d1a9942a1e8d2c40712654b13411b6a4d231d244a23a009b7884737a4917724cc9a467678700d9f465a4898aa4f23533cb4e28946b6489c058d045d3cb22d8df835244ec9a311af8ac735a5990512e89566be0a78547d9af14a48a0dc8966367850f52bcd8c91487d1a9ae121955c9a39e5904cef3434c003ca1d68a88784aaf934e377f078d634b44362cd69c8abe3d1cc68c8af21b10a671a72cb782c2f34f586047ba2a9af221ec95340436e1e49b6a3a9431e8fa3ebd3540f8956bdd1d47b0e8fa275a3a90d126e42631b078fa1e9d1945742c2e58e34b671f0081a171a1b22f19a018dad1d645ffd42637ba4c01bcdad1d645de34263b72a5220f74d736b07d9d6bcd0dc08a9d00c686e934396b53c9a7b474a4c19c22e8fecea5c69ceab20259c4f86702822abfa3e431820356a3786f05546360d0386f18af418310cb78e2c9a32a419d263c330bc0e32c75932b4750e69517419863f40c614df1981f702d2a21d30941932a5facd481c4b488b09c3d914901d9d0b2372aa222d760ce7ab8aac18f98ccca5899428ba0cc7eb2213724b46e9da454ab47c86134c9101954f46cb7f464a8c18d6ae84b4eb798cdc2b5262c9b0dc36522d37631ce64887dc8161055307e955fd643cd639a442e9ccd0f665a4d5e0cab8bc17900aad1b43f30648a5d286313a96900a4f8cc0a684f4e99d192bb786549830029727a44c71c5b85d5a488535a3b02d234dfa67c6efda451ae4f68c8237426a9437b42218200d8a5f8cc4a18154705eaeb4658c3428bb8c44b02822f9da475a34471ad43d46e33244c295d7b46b93430ab46f8cc8b18304cbbfdd68dbbe8814e8fa8ccaae8e84728667dec1571929f014302ac1aa82247afae67db835a4c090d1f11725244df7937773692105468cd06d5e4292f40ebca75b0f29f0c228dd16152445ffc03b0b864881312315ac1b4880dce09b0930410a8c19b15d0f77569c9c990c0b07c9f7caa87d8f0ab89fc6f2c6c4d8e4907c2346eeba6ce22e72830313655f44f20d0346ef382ac2b6e6c263d27c95917c4f3e63e06f7a0eec29bf1e99446e1dc9d7bb311697651b561487fb8009e5b5907c6d8f31392f3b0ee2551abd074cb05b0fc9d770191b6ffd5c445c1a9343c0840b8648bef21763147c4c5b0ea2567a5eb94c852992aff8ce7879db71cb41548afdf931606a2c1d245e6ec5d85df7b37e0961d587abef80e9b2cd23f926b4c2ddbef5ab0e4c145aa3e5e1ca34fa2822f9fa37da723baedf06ed127ec8a97647f39dcb14fb2e23f99a2eedba9dde57b397e74ebd5cc0df38c55aab379ccc37073760fa9deb48bed207ef25f0ceeef7f1f3f0f171387c1ebfddcb9519e3b5917cb905555cfc3e5260e853c5241821059a2e555cde9002c52d555c960e52601c50c5649b470ab45caa981c8a4881e2862a26df15a4c1f04a158f730369503bf081046fcf3e6df13a480367e2f3519c5a40c7a32d7e1fa9d0fce24308e67900689e694b30422ae4de7c66dfa98dff5639d19a37a443e3c88c0b6679fc4be993d6ac1ca48233be31cb8e4dfc457e476b7679a44365cbccbabe3af837ce8ad61c4a4889fe99d9b429e36f66b4e654414a14663eb3e7d4c5af8c02da726e202d6a3b66cc7592c3af3df9b4c5eb20357a276648b02ae31f753cdae23f2135722f1766c5470bbfd338d396e005e9519cf9cc82ef3efea072a23533a448791530edce43077f543ad09a550e2952db30d52ee33c7e22bfa335bb02d2a4b9656a7993027ec859d19acf1252a5b9652a5da64508bcd19a5315e9d2dc044c9bf36b1e32a380b69c9b4899dad2679a9c463988f57dda72ed226d4a338f6971e83b30d1f1688bff84d4c98fbe9902c1a60553f533ad79450af5760193ed32ab2284ca37ad99218daab30b93eb63904338c503ad59e79046b9e73d13c95b34105e7e4b6b7605a453f5cd65c204bba71c22e12c69cd670969d55d794c8eaf6919d199d29a5315a995eb6f7c26813bab235ac380b65c9a48b1c2f3e6cafb3acd5b885edfa72dd72e522ddf5f5f782fc7b706e2d1f6688bff8c94733ab36f5a77dbbd54109fba4b6b5e917e95d1e6427bbee6dd1ce255fea635736481d39aec3cc6ef7bf95c8205c50f5ab3ce211b9ce6ebc6656cfccfc57319b6e4b7b4e6bd80ec283fcd3fae8c9abb9d74f2b0ca59d29a6309d9527b9ebdbb8c84ffb51e778ab88729ad716bc89e426b38db7edd68ea72584ffa3507f7330c68cba585ac2a7706d3e5eeeb12f0676ea78fcdfcb5dfc8e3fe7a37da72ed22e39c52a3377899ce57dbf78fe3b77bbe5cbcebcdbb5cceaefbfdb9dfae97b3f1b0dfa91791242d8fb60403a8e4a9bbb4660c953ce52f5a33874a9ee29ed66c72508993dbd09a7d112a719c05adf92a4325cf84d6b835a8e41906b4e5d2824a9ede8db6dc7a50c9d3bad0966000953c3597d64ca092a7fc456b160e54e214f7b46693834a9cdc86d6ec8b50c933a7355f65a8e419d31ab70e953c8380b6782da8e4e95d69cbad07953cad0b6d098650c9537369cd142a794a475ab374a012a7f04e6b3639a8c4c9ad69cd3607953c735ab3864aa031ad994125d0b34f5b9ea112a87ba525d71a5402352fb4e4d3814aa0da89968ca192a874a41db70a541215de69c71a2a91726b5a11d4a19269462bd65009f54a1b823254423dfbb4e00d2aa9ba57c6cf854aace699f16b412556f5c4d8cda092abf4c9b81da112acb063cc82225482e5568c59172ad1668cd7182ad95e02c6690595704f3e63f40195741d8ff13941255ee3ccd87850c95739312e3e540a943e1993002a0df23bc623804a0567c5585ca15262c6389ca1d26214307a47a8d478f219b92d547a743c466d0695228d332336804a93ca37a355834a95d28151ba40a54c7ecb086da0d2c659323acf50e9f3c6a8f845a8141a058cc6062a95fa3e23d1854aa78ec7087c43a555fdccf00650a955f9665827072abd8a1f0ca90f9566f92d43d941a59bb36408b72a54da4d696e08957ec38086365059d0bfd1c857012a13da1e0d9c2b5019517729e635a032a3fc4d21af099521c53d45ce75a84cc92d2970284165cde0ca9f5ae4a0b2a776e08f9c7b50d934baf08f8279112aab8ab31b7f2bd8d4a0b2ac343df31fdd5675a8accbf53737fe42b01f15a11e42be373fdcf817c1d7eab904f5489c5a6f349d2f97f3b797a7660ebff3ff00e0d02d2abd78dddc0000000049454e44ae426082),
(10, 'Скільки супутників у Землі?', 37, ''),
(14, 'РџРѕСЂРѕР¶РЅС” Р·Р°РїРёС‚Р°РЅРЅСЏ', 91, '');

-- --------------------------------------------------------

--
-- Структура таблицы `question_answers`
--

CREATE TABLE `question_answers` (
  `question_answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `question_answers`
--

INSERT INTO `question_answers` (`question_answer_id`, `question_id`, `answer_id`) VALUES
(33, 9, 33),
(34, 9, 34),
(35, 9, 35),
(36, 9, 36),
(37, 10, 37),
(38, 10, 38),
(39, 10, 39),
(40, 10, 40),
(89, 14, 91),
(90, 14, 92),
(91, 14, 93),
(92, 14, 94),
(93, 14, 95);

-- --------------------------------------------------------

--
-- Структура таблицы `question_results`
--

CREATE TABLE `question_results` (
  `question_result_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `result_answer_id` int(11) DEFAULT NULL,
  `answer_time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `question_results`
--

INSERT INTO `question_results` (`question_result_id`, `question_id`, `result_answer_id`, `answer_time`) VALUES
(85, 9, 33, 19),
(87, 9, 36, 31),
(88, 10, 37, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_data`
--

CREATE TABLE `teacher_data` (
  `teacher_data_id` int(11) NOT NULL,
  `teacher_full_name` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `teacher_data`
--

INSERT INTO `teacher_data` (`teacher_data_id`, `teacher_full_name`) VALUES
(1, 'Vitalii Akymenko'),
(3, 'Vitalii Perdulkin');

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_tests`
--

CREATE TABLE `teacher_tests` (
  `teacher_test_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teacher_tests`
--

INSERT INTO `teacher_tests` (`teacher_test_id`, `teacher_id`, `test_id`) VALUES
(6, 1, 50),
(11, 1, 55);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_users`
--

CREATE TABLE `teacher_users` (
  `teacher_id` int(11) NOT NULL,
  `teacher_login` text NOT NULL,
  `teacher_password` varchar(32) NOT NULL,
  `teacher_data_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `teacher_users`
--

INSERT INTO `teacher_users` (`teacher_id`, `teacher_login`, `teacher_password`, `teacher_data_id`) VALUES
(1, 'admin', '1b3231655cebb7a1f783eddf27d254ca', 1),
(11, 'admi', '1b3231655cebb7a1f783eddf27d254ca', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `test_name` text NOT NULL DEFAULT 'Пустий тест',
  `test_data_id` int(11) NOT NULL,
  `test_mark` int(11) NOT NULL DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`, `test_data_id`, `test_mark`) VALUES
(50, 'Тест про Землю', 6, 12),
(55, 'Додавання та віднімання', 11, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `tests_data`
--

CREATE TABLE `tests_data` (
  `test_data_id` int(11) NOT NULL,
  `test_time_constraint` int(11) NOT NULL DEFAULT 5,
  `test_question_time_constraint` int(11) NOT NULL DEFAULT 0,
  `test_type_constraint_id` int(11) NOT NULL DEFAULT 1,
  `test_mistakes_correction` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tests_data`
--

INSERT INTO `tests_data` (`test_data_id`, `test_time_constraint`, `test_question_time_constraint`, `test_type_constraint_id`, `test_mistakes_correction`) VALUES
(1, 20, 30, 1, 0),
(2, 5, 0, 1, 0),
(3, 5, 0, 1, 0),
(4, 5, 0, 1, 0),
(5, 5, 0, 1, 0),
(6, 5, 30, 1, 1),
(7, 5, 0, 1, 0),
(8, 5, 0, 1, 0),
(9, 5, 0, 1, 0),
(10, 5, 0, 1, 0),
(11, 5, 0, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `test_questions`
--

CREATE TABLE `test_questions` (
  `test_question_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test_questions`
--

INSERT INTO `test_questions` (`test_question_id`, `test_id`, `question_id`) VALUES
(9, 50, 9),
(10, 50, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `test_types`
--

CREATE TABLE `test_types` (
  `test_type_id` int(11) NOT NULL,
  `test_type_name` varchar(30) NOT NULL,
  `is_ready` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `test_types`
--

INSERT INTO `test_types` (`test_type_id`, `test_type_name`, `is_ready`) VALUES
(1, 'Вікторина', 1),
(2, 'Хто перший', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Индексы таблицы `pupils_data`
--
ALTER TABLE `pupils_data`
  ADD PRIMARY KEY (`pupil_data_id`);

--
-- Индексы таблицы `pupil_results`
--
ALTER TABLE `pupil_results`
  ADD PRIMARY KEY (`pupil_result_id`),
  ADD KEY `pupil_id` (`pupil_id`),
  ADD KEY `question_result_id` (`question_result_id`) USING BTREE;

--
-- Индексы таблицы `pupil_test_completions`
--
ALTER TABLE `pupil_test_completions`
  ADD PRIMARY KEY (`pupil_test_completion_id`),
  ADD KEY `pupil_id` (`pupil_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Индексы таблицы `pupil_users`
--
ALTER TABLE `pupil_users`
  ADD PRIMARY KEY (`pupil_id`),
  ADD KEY `pupil_data_id` (`pupil_data_id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `correct_answer_id` (`correct_answer_id`);

--
-- Индексы таблицы `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`question_answer_id`) USING BTREE,
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Индексы таблицы `question_results`
--
ALTER TABLE `question_results`
  ADD PRIMARY KEY (`question_result_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `result_answer_id` (`result_answer_id`);

--
-- Индексы таблицы `teacher_data`
--
ALTER TABLE `teacher_data`
  ADD PRIMARY KEY (`teacher_data_id`);

--
-- Индексы таблицы `teacher_tests`
--
ALTER TABLE `teacher_tests`
  ADD PRIMARY KEY (`teacher_test_id`) USING BTREE,
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Индексы таблицы `teacher_users`
--
ALTER TABLE `teacher_users`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `teacher_data_id` (`teacher_data_id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `test_data_id` (`test_data_id`);

--
-- Индексы таблицы `tests_data`
--
ALTER TABLE `tests_data`
  ADD PRIMARY KEY (`test_data_id`),
  ADD KEY `test_type_constraint_id` (`test_type_constraint_id`);

--
-- Индексы таблицы `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`test_question_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Индексы таблицы `test_types`
--
ALTER TABLE `test_types`
  ADD PRIMARY KEY (`test_type_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `pupils_data`
--
ALTER TABLE `pupils_data`
  MODIFY `pupil_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pupil_results`
--
ALTER TABLE `pupil_results`
  MODIFY `pupil_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT для таблицы `pupil_test_completions`
--
ALTER TABLE `pupil_test_completions`
  MODIFY `pupil_test_completion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `pupil_users`
--
ALTER TABLE `pupil_users`
  MODIFY `pupil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `question_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `question_results`
--
ALTER TABLE `question_results`
  MODIFY `question_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT для таблицы `teacher_data`
--
ALTER TABLE `teacher_data`
  MODIFY `teacher_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `teacher_tests`
--
ALTER TABLE `teacher_tests`
  MODIFY `teacher_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `teacher_users`
--
ALTER TABLE `teacher_users`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `tests_data`
--
ALTER TABLE `tests_data`
  MODIFY `test_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `test_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `test_types`
--
ALTER TABLE `test_types`
  MODIFY `test_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `pupil_results`
--
ALTER TABLE `pupil_results`
  ADD CONSTRAINT `pupil_results_ibfk_1` FOREIGN KEY (`pupil_id`) REFERENCES `pupil_users` (`pupil_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pupil_results_ibfk_2` FOREIGN KEY (`question_result_id`) REFERENCES `question_results` (`question_result_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pupil_test_completions`
--
ALTER TABLE `pupil_test_completions`
  ADD CONSTRAINT `pupil_test_completions_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pupil_test_completions_ibfk_3` FOREIGN KEY (`pupil_id`) REFERENCES `pupil_users` (`pupil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pupil_users`
--
ALTER TABLE `pupil_users`
  ADD CONSTRAINT `pupil_users_ibfk_1` FOREIGN KEY (`pupil_data_id`) REFERENCES `pupils_data` (`pupil_data_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`correct_answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `question_answers_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `question_results`
--
ALTER TABLE `question_results`
  ADD CONSTRAINT `question_results_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_results_ibfk_2` FOREIGN KEY (`result_answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teacher_tests`
--
ALTER TABLE `teacher_tests`
  ADD CONSTRAINT `teacher_tests_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_users` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teacher_users`
--
ALTER TABLE `teacher_users`
  ADD CONSTRAINT `teacher_users_ibfk_1` FOREIGN KEY (`teacher_data_id`) REFERENCES `teacher_data` (`teacher_data_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`test_data_id`) REFERENCES `tests_data` (`test_data_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tests_data`
--
ALTER TABLE `tests_data`
  ADD CONSTRAINT `tests_data_ibfk_1` FOREIGN KEY (`test_type_constraint_id`) REFERENCES `test_types` (`test_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
