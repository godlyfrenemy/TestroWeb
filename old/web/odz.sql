-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 19 2022 г., 15:09
-- Версия сервера: 8.0.27
-- Версия PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `odz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `os` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `forsale` tinyint DEFAULT NULL,
  `image_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `os`, `company`, `forsale`, `image_url`) VALUES
(1, 'Adobe Audition', 'Зустрічайте найкращий у галузі інструмент для корекції, відновлення та точного редагування аудіофайлів для роботи з відео та подкастами, а також дизайну звукових ефектів.', 'Audio editing', 'Windows macOS', 'Adobe', 1, 'IMG-62752d070ad7f9.26358620.svg'),
(2, 'Logic Pro X', 'Logic Pro перетворює ваш Mac на професійну студію звукозапису, здатну виконувати навіть найвибагливіші проекти. Створюйте та аранжуйте музику в режимі реального часу.', 'Audio editing', 'macOS', 'Apple', 1, 'IMG-62752d75d9ca72.16634774.png'),
(3, 'Hindenburg Journalist Pro', 'Працюйте розумніше та швидше з легким у навчанні, але надійним, перевіреним у польових умовах аудіоредактором, розробленим для спрощення й автоматизації вашого робочого процесу. Ми створили кожну функцію, щоб вирішити ваші проблеми з подкастингом та радіо: від шумних записів до нестабільних мікрофонів.', 'Audio editing', 'Windows macOS', 'Hindenburg', 0, 'IMG-62752de8c9f7e0.28050680.png'),
(4, 'Ableton Live', 'Ableton Live дозволяє легко створювати та програвати музику в одному інтуїтивно зрозумілому інтерфейсі. Live синхронізує все та працює в режимі реального часу, тож ви можете грати та змінювати свої музичні ідеї, не перериваючи творчого потоку. Live поставляється з універсальною колекцією інструментів, звуків і наборів для створення будь-якої музики та надає повний набір ефектів для налаштування та обробки вашого звуку.', 'Audio editing', 'Windows macOS', 'Ableton', 0, 'IMG-62752ef2693651.20131348.png'),
(5, 'AudioLab', 'AudioLab — це найдосконаліший, сучасний, швидкий аудіоредактор та конструктор рингтонів, який має усі необхідні функції: обрізка аудіо, мікшування звуку, детальне редагування тегів, об’єднання аудіо, аудіозаписувач, аудіоконвертер, музичний плеєр, редактор голосу та багато інших.', 'Audio editing', 'Android', 'HitroLab', 0, 'IMG-62752f53359264.42348889.png'),
(6, 'Adobe Lightroom', 'Якщо Photoshop здається вам занадто складним і громіздким, то вам напевно сподобається простий інтерфейс Lightroom, зручний для початківців. Чистий і простий робочий простір Lightroom дозволяє зосередитися на тому, що дійно важливо — на вашому зображенні. Ця програма більше, ніж просто фоторедактор. Це також фотоорганайзер. Lightroom дозволяє легко зберігати та організувати зображення всередині програми.', 'Photo editing', 'Windows macOS Android iOS', 'Adobe', 1, 'IMG-62752fb87fda96.84591448.svg'),
(7, 'Skylum Luminar AI', 'Luminar — це програма для редагування фотографій, яку можна використовувати окремо або як плагін для Lightroom, Photoshop і навіть Apple Photos. А також Luminar пропонує масу вбудованих інструментів та аксесуарів!', 'Photo editing', 'Windows macOS', 'Skylum', 1, 'IMG-6275300f020369.40138875.png'),
(8, 'Adobe Photoshop', 'З Photoshop можна втілити в життя будь-який задум. Створюйте чудові зображення, графіку, малюнки та тривимірні ілюстрації.', 'Photo editing', 'Windows macOS Android iOS', 'Adobe', 0, 'IMG-62753046e30736.51481642.svg'),
(9, 'Corel PaintShop Pro', 'Corel PaintShop Pro - набір потужних універсальних інструментів, які піднімуть творчий аспект будь-якого з ваших фото-і дизайн-проектів на якісно новий рівень. Повірте, результати перевершать ваші найсміливіші очікування!', 'Photo editing', 'Windows', 'Corel', 1, 'IMG-6275308e643574.47289272.png'),
(10, 'Serif Affinity Photo', 'Додаток Affinity Photo став улюбленим серед професіоналів у сфері фотографії та образотворчого мистецтва по всьому світу, яким важлива швидкість, точність та багатофункціональність. Це єдиний повнофункціональний редактор фотографій, інтегрований у системи macOS, Windows та iOS.', 'Photo editing', 'Windows macOS iOS', 'Serif', 0, 'IMG-627530d447a6d3.77167048.png'),
(11, 'Adobe Premiere Pro', 'Редагуєте відео для соціальних мереж чи працюєте над блокбастером? Premiere Pro допоможе створити власну історію за допомогою зрозумілих інструментів. Імпортуйте й редагуйте, додавайте ефекти та експортуйте відеоматеріали до будь-якого місця призначення. У цій програмі є все, що вам знадобиться для роботи.', 'Video editing', 'Windows macOS', 'Adobe', 0, 'IMG-62753a22ccc771.71818146.svg'),
(12, 'Final Cut Pro', 'Final Cut Pro  — це революційна програма для створення й редагування відео найвищої якості. Final Cut Pro поєднує ефективні засоби цифрового редагування та вбудовану підтримку майже всіх форматів відео зі зручними функціями, що заощаджують час і дають змогу зосередитися на сюжеті.', 'Video editing', 'macOS', 'Apple', 0, 'IMG-62753a6b2f3d15.95200843.png'),
(13, 'DaVinci Resolve', 'DaVinci Resolve — єдине у світі рішення для монтажу та колірної корекції, накладання візуальних ефектів, створення графіки та постобробки звуку в єдиному програмному середовищі. Його сучасний, стильний інтерфейс досить простий у використанні та інтуїтивно зрозумілий як для новачків, так і досвідчених користувачів. DaVinci Resolve дозволяє суттєво оптимізувати творчий процес, оскільки опановувати кілька додатків або перемикатися між різними системами не потрібно.', 'Video editing', 'Windows macOS Linux', 'Blackmagic Design', 1, 'IMG-62753aafce3515.27771401.png'),
(14, 'Vegas Pro', 'VEGAS Pro надає вам всі необхідні інструменти для професійного редагування відео з розширеною HDR-корекцією, можливістю вести прямі трансляції та звуковим оформленням.', 'Video editing', 'Windows', 'Magix', 1, 'IMG-62753ade048006.24082985.png'),
(15, 'Adobe Premiere Elements', 'Від автоматичного створення до поетапного редагування, робота з відео ніколи не була простіше з Adobe Premiere Elements.', 'Video editing', 'Windows macOS', 'Adobe', 0, 'IMG-62753b1e637880.12544509.png'),
(16, 'Adobe Illustrator', 'Дизайн починається тут. Малювання – це лише мала частка того, що ви можете робити за допомогою Illustrator. Створюйте логотипи, значки, веб-графіку й багато іншого.', 'Art and Design', 'Windows macOS iOS Android', 'Adobe', 1, 'IMG-627543ceab3743.18664173.svg'),
(17, 'Adobe InDesign', 'Adobe InDesign – провідний програмний пакет для роботи з макетами й дизайном сторінок для друку й цифрових носіїв. З ним ви можете створювати чудові графічні оформлення з типографікою від найкращих постачальників світу й зображеннями з Adobe Stock. Швидко поширюйте свій контент і коментарі у форматі PDF.', 'Art and Design', 'Windows macOS', 'Adobe', 1, 'IMG-62754421cdaaf6.60923886.svg'),
(18, 'CorelDraw', 'Вирушайте в подорож дизайну з професійними інструментами для векторної ілюстрації, макету, редагування фотографій, типографіки та співпраці.', 'Art and Design', 'Windows macOS', 'Corel', 0, 'IMG-6275445601cb73.52659133.png'),
(19, 'Procreate', 'Procreate — найпотужніший і інтуїтивно зрозумілий додаток для цифрових ілюстрацій. Доступний лише на iPad і наповнений функціями для художників і творчих професіоналів.', 'Art and Design', 'iOS', 'Apple', 1, 'IMG-6275448be63725.14061676.jpg'),
(20, 'Affinity Designer', 'Найкращий у своєму класі для створення концепт-артів, друкованих проектів, логотипів, значків, дизайнів інтерфейсу користувача, макетів тощо. Наша потужна програма для дизайну вже є вибором тисяч професійних ілюстраторів, веб-дизайнерів та розробників ігор, яким подобається його шовковисто-гладке поєднання інструментів векторного та растрового проектування.', 'Art and Design', 'Windows macOS iOS', 'Serif', 0, 'IMG-627544f2382076.62541277.png'),
(21, 'Gravit Designer', 'Професійний додаток для векторного дизайну, до якого можна отримати доступ з будь-якого місця на будь-якій машині. Швидкі та гнучкі інструменти графічного дизайну.', 'Art and Design', 'Windows macOS Android iOS Linux', 'Gravit Designer', 1, 'IMG-627545205e7067.90778918.png'),
(22, 'Adobe Express', 'Adobe Express дозволяє легко розпочати роботу з тисячами шаблонів. Відчуйте, що у вас є допомога надійного дизайнера з усією колекцією фотографій Adobe Stock і повною бібліотекою шрифтів Adobe під рукою.', 'Art and Design', 'Android iOS', 'Adobe', 0, 'IMG-627545570c4b39.34381111.svg'),
(24, 'Test Unit', 'Test Description', 'Photo editing', 'Windows And MacOS', 'VitaliiAkymenko', 0, 'IMG-62865c44d822f4.39840503.bmp');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(35) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rank` tinyint DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `rank`) VALUES
(1, 'superuser', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(2, 'user', '1a1dc91c907325c69271ddf0c944bc72', NULL),
(3, 'vitaliiakymenko', '46382ecbc1ef9fc64d19abd5a94447ec', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
