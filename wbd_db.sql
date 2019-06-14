-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2019 at 12:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rss_channels`
--

CREATE TABLE `rss_channels` (
  `id` int(11) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `channel_description` text NOT NULL,
  `channel_image` varchar(255) DEFAULT NULL,
  `channel_source` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rss_channels`
--

INSERT INTO `rss_channels` (`id`, `channel_name`, `channel_description`, `channel_image`, `channel_source`, `created_at`, `updated_at`) VALUES
(1, 'Foreign Policy', 'Foreign Policy', 'https://foreignpolicy.com/wp-content/uploads/2017/12/cropped-favicon-512_2017.png?w=32', 'https://foreignpolicy.com', '2019-06-13 00:39:51', '2019-06-13 00:39:51'),
(2, 'Foreign Policy', 'Foreign Policy', NULL, 'https://thehill.com/', '2019-06-14 05:28:31', '2019-06-14 05:28:31'),
(3, ' - Blogger for Cato @ Liberty', ' - Blogger for Cato @ Liberty', NULL, 'https://www.cato.org/', '2019-06-14 05:29:08', '2019-06-14 05:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `rss_posts`
--

CREATE TABLE `rss_posts` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rss_posts`
--

INSERT INTO `rss_posts` (`id`, `channel_id`, `title`, `image`, `link`, `description`, `pubDate`, `created_at`, `updated_at`) VALUES
(39, 1, 'Hezbollah Isn’t Just in Beirut. It’s in New York, Too.', 'https://foreignpolicy.com/wp-content/uploads/2019/06/hezbollah-levitt.jpg', 'https://foreignpolicy.com/2019/06/14/hezbollah-isnt-just-in-beirut-its-in-new-york-too-canada-united-states-jfk-toronto-pearson-airports-ali-kourani-iran/', 'The trial of a senior operative reveals the extent of the terrorist organization’s reach in the United States and Canada.', '2019-06-14 03:03:42', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(40, 1, 'The Old Guard Are Killing the World’s Youngest Country', 'https://foreignpolicy.com/wp-content/uploads/2019/06/south-sudan-vertin.jpg', 'https://foreignpolicy.com/2019/06/14/south-sudan-the-old-guard-are-killing-the-worlds-youngest-country-john-garang-salva-kiir-riek-machar-splm-zach-vertin-rope-from-sky/', 'South Sudan was born amid great hope but has since descended into war. It will take a new generation of leaders to make it a successful state.', '2019-06-14 01:38:54', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(41, 1, 'Xinjiang Visit by U.N. Counterterrorism Official Provokes Outcry', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-951834580.jpg', 'https://foreignpolicy.com/2019/06/13/xinjiang-visit-by-u-n-counterterrorism-official-provokes-protest-human-rights-china-uighurs-internment-camps-east-asia-united-nations/', 'Rights activists say upcoming trip by U.N. diplomat could reinforce Beijing’s line that Uighur activists are terrorists.', '2019-06-13 16:54:43', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(42, 1, 'Top WMD Official Quietly Leaves Pentagon', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-869396352.jpg', 'https://foreignpolicy.com/2019/06/13/top-wmd-official-quietly-leaves-pentagon/', 'Guy Roberts’s abrupt departure in April comes amid a long exodus of senior officials under acting Secretary Patrick Shanahan. ', '2019-06-13 16:00:42', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(43, 1, 'U.S. Blames Iran for Latest Tanker Attack', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149672892.jpg', 'https://foreignpolicy.com/2019/06/13/us-blames-iran-for-latest-tanker-attack-strait-of-hormuz-gulf-of-iran-middle-east-pompeo-trump-tehran-tensions/', 'Pompeo says no other country could have orchestrated the explosions with “such a high degree of sophistication.” ', '2019-06-13 15:27:45', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(44, 1, 'Modi’s Nationalism Is Spoiling His Global Brand', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1146380201-1.jpg', 'https://foreignpolicy.com/2019/06/13/modis-nationalism-is-spoiling-his-global-brand/', 'India’s leader has to mix a muscular foreign policy with a softer touch.', '2019-06-13 15:08:44', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(45, 1, 'What Trump Promised Duda', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149498373.jpg', 'https://foreignpolicy.com/2019/06/13/what-trump-promised-duda/', 'A transcript of the U.S. and Polish leaders’ remarks in the Rose Garden.', '2019-06-13 12:25:29', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(46, 1, 'China Is Bluffing in the Trade War', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-813614948.jpg', 'https://foreignpolicy.com/2019/06/13/china-is-bluffing-in-the-trade-war/', 'Chinese leaders say they can effectively retaliate against Trump’s tariffs. They’re wrong.', '2019-06-13 12:21:01', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(47, 1, 'Britain’s Tories Bravely Put Party Before Country', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-519984274.jpg', 'https://foreignpolicy.com/2019/06/13/britains-tories-bravely-put-party-before-country/', 'Internal fights among the Conservatives have wrecked the U.K.—and Labour isn’t much better.', '2019-06-13 11:21:48', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(48, 1, 'Mohammed bin Salman’s Fake Anti-Extremist Campaign', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1052200664.jpg', 'https://foreignpolicy.com/2019/06/13/mohammed-bin-salmans-fake-anti-extremist-campaign/', 'The Saudi crown prince vowed to crack down on radical clerics—but the victims have mostly been advocates for moderate Islam.', '2019-06-13 11:20:15', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(49, 1, 'AI Can Thrive in Open Societies', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1055932784.jpg', 'https://foreignpolicy.com/2019/06/13/ai-can-thrive-in-open-societies/', 'The belief that China’s surveillance gives it an advantage is misleading—and dangerous.', '2019-06-13 10:50:02', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(50, 1, 'Trump’s Polish Message to NATO', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149497584.jpg', 'https://foreignpolicy.com/2019/06/13/trumps-polish-message-to-nato/', 'New security agreement rewards Poland’s commitment to defense spending. ', '2019-06-13 07:38:25', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(51, 1, 'How Hindu Nationalism Went Mainstream', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1146380201.jpg', 'https://foreignpolicy.com/2019/06/13/how-hindu-nationalism-went-mainstream/', 'And what that means for Narendra Modi’s Bharatiya Janata Party', '2019-06-13 05:38:50', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(52, 1, 'What’s Next for Hong Kong?', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149496169-HONG-KONG-PROTESTS.jpg', 'https://foreignpolicy.com/2019/06/13/what-happens-now-in-hong-kong-protests-trump-saudi-arabia-iran-shinzo-abe/', 'Plus: U.S. lawmakers push back against Saudi arms sales, Shinzo Abe visits Iran, and the other stories we\'re following today.', '2019-06-13 05:00:50', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(53, 1, 'Nuclear Disarmament’s Lessons for Climate Change.', 'https://foreignpolicy.com/wp-content/uploads/2019/06/This_is_the_Enemy_nuclear-mushroom-cloud-MCANW_poster_1980s_L0075379.jpg', 'https://foreignpolicy.com/2019/06/12/nuclear-disarmaments-lessons-for-climate-change/', 'If we can ban nukes, we can ban carbon emissions. Here’s how.', '2019-06-12 17:06:54', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(54, 1, 'Infuriating Congress, Trump Administration Keeps Pushing for Saudi Arms Sales', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1148084078.jpg', 'https://foreignpolicy.com/2019/06/12/infuriating-congress-trump-administration-pompeo-pushes-new-saudi-arms-sales-iran-khashoggi-hearing-oversight-state-department/', 'Lawmakers accused the State Department of concocting a “phony emergency.”', '2019-06-12 16:37:28', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(55, 1, 'Britain Failed Hong Kong', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149495437.jpg', 'https://foreignpolicy.com/2019/06/12/britain-failed-hong-kong/', 'The U.K. owes Hong Kongers fighting for democracy a moral debt.', '2019-06-12 14:53:42', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(56, 1, '‘Fort Trump’ for Poland? Not Quite.', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149479452.jpg', 'https://foreignpolicy.com/2019/06/12/fort-trump-for-poland-not-quite/', 'Trump will send 1,000 noncombat troops to Eastern Europe amid signs of a Russian buildup.', '2019-06-12 13:47:42', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(57, 1, 'Hong Kongers Won’t Bow to Beijing. But Their Leaders Will.', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1149444492.jpg', 'https://foreignpolicy.com/2019/06/12/hong-kongers-wont-bow-to-beijing-but-their-leaders-will/', 'The city’s leaders are answerable to the party, not the public.', '2019-06-12 12:04:49', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(58, 1, 'The United States’ Antitrust Laws Can’t Match Saudi Aramco', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1726904.jpg', 'https://foreignpolicy.com/2019/06/12/the-united-states-antitrust-laws-cant-match-saudi-aramco/', 'Congress should pass NOPEC to give America a fighting chance against oil cartels.', '2019-06-12 10:31:22', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(59, 1, 'Russians Are Getting Sick of Church', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1025696428.jpg', 'https://foreignpolicy.com/2019/06/12/russians-are-getting-sick-of-church-orthodox-putin/', 'Orthodox Christianity—and Vladimir Putin—are at the center of the country’s newest culture war.', '2019-06-12 10:06:39', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(60, 1, 'Sudan Talks Resume, Hong Kong Protests Continue', 'https://foreignpolicy.com/wp-content/uploads/2019/06/GettyImages-1147182774-SUDAN.jpg', 'https://foreignpolicy.com/2019/06/12/talks-resume-in-sudan-darfur-russia-hong-kong-protests/', 'Plus: Russia releases a journalist, Botswana decriminalizes gay sex, and the other stories we\'re following today.', '2019-06-12 04:55:43', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(61, 1, 'How to End Israel’s Political Impasse', 'https://foreignpolicy.com/wp-content/uploads/2019/06/netanyahu-votes-israel.jpg', 'https://foreignpolicy.com/2019/06/12/how-to-end-israels-political-impasse-netanyahu-avigdor-lieberman-elections-electoral-reform/', 'A dysfunctional electoral system stopped Benjamin Netanyahu from forming a government. The country needs to enact two simple reforms, or it will face perpetual stalemate.', '2019-06-12 03:50:25', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(62, 1, 'Journalist’s Release Reveals Cracks in the Putin System', 'https://foreignpolicy.com/wp-content/uploads/2019/06/Golunov.jpg', 'https://foreignpolicy.com/2019/06/11/journalists-release-reveals-cracks-in-the-putin-system-ivan-golunov-meduza/', 'The Kremlin is growing nervous over rising public resistance to the Russian president’s long rule.', '2019-06-11 18:20:12', '2019-06-14 04:19:08', '2019-06-14 04:19:08'),
(63, 1, 'How China Could Shut Down America’s Defenses', 'https://foreignpolicy.com/wp-content/uploads/2019/06/5449474.jpg', 'https://foreignpolicy.com/2019/06/11/how-china-could-shut-down-americas-defenses-rare-earth/', 'Advanced U.S. weapons are almost entirely reliant on rare-earth materials only made in China—and they could be a casualty of the trade war.', '2019-06-11 16:10:29', '2019-06-14 04:19:08', '2019-06-14 04:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `type` enum('update','delete') NOT NULL,
  `age` int(4) NOT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `age`, `time`, `created_at`, `updated_at`) VALUES
(1, 'update', 10, '2019-06-14 04:34:28', '2019-06-14 03:39:48', NULL),
(2, 'delete', 43200, '2019-06-14 04:14:34', '2019-06-13 19:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rss_channels`
--
ALTER TABLE `rss_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rss_posts`
--
ALTER TABLE `rss_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rss_channels`
--
ALTER TABLE `rss_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rss_posts`
--
ALTER TABLE `rss_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
