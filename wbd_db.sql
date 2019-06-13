-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2019 at 08:08 AM
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
  `channel_image` varchar(255) NOT NULL,
  `channel_source` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rss_channels`
--

INSERT INTO `rss_channels` (`id`, `channel_name`, `channel_description`, `channel_image`, `channel_source`, `created_at`, `updated_at`) VALUES
(1, 'Foreign Policy', 'Foreign Policy', 'https://foreignpolicy.com/wp-content/uploads/2017/12/cropped-favicon-512_2017.png?w=32', 'https://foreignpolicy.com', '2019-06-13 00:39:51', '2019-06-13 00:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `rss_posts`
--

CREATE TABLE `rss_posts` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rss_posts`
--

INSERT INTO `rss_posts` (`id`, `channel_id`, `title`, `link`, `description`, `pubDate`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nuclear Disarmament’s Lessons for Climate Change.', 'https://foreignpolicy.com/2019/06/12/nuclear-disarmaments-lessons-for-climate-change/', 'If we can ban nukes, we can ban carbon emissions. Here’s how.', '2019-06-12 17:06:54', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(2, 1, 'Infuriating Congress, Trump Administration Keeps Pushing for Saudi Arms Sales', 'https://foreignpolicy.com/2019/06/12/infuriating-congress-trump-administration-pompeo-pushes-new-saudi-arms-sales-iran-khashoggi-hearing-oversight-state-department/', 'Lawmakers accused the State Department of concocting a “phony emergency.”', '2019-06-12 16:37:28', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(3, 1, 'Britain Failed Hong Kong', 'https://foreignpolicy.com/2019/06/12/britain-failed-hong-kong/', 'The U.K. owes Hong Kongers fighting for democracy a moral debt.', '2019-06-12 14:53:42', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(4, 1, '‘Fort Trump’ for Poland? Not Quite.', 'https://foreignpolicy.com/2019/06/12/fort-trump-for-poland-not-quite/', 'Trump will send 1,000 noncombat troops to Eastern Europe amid signs of a Russian buildup.', '2019-06-12 13:47:42', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(5, 1, 'Hong Kongers Won’t Bow to Beijing. But Their Leaders Will.', 'https://foreignpolicy.com/2019/06/12/hong-kongers-wont-bow-to-beijing-but-their-leaders-will/', 'The city’s leaders are answerable to the party, not the public.', '2019-06-12 12:04:49', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(6, 1, 'The United States’ Antitrust Laws Can’t Match Saudi Aramco', 'https://foreignpolicy.com/2019/06/12/the-united-states-antitrust-laws-cant-match-saudi-aramco/', 'Congress should pass NOPEC to give America a fighting chance against oil cartels.', '2019-06-12 10:31:22', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(7, 1, 'Russians Are Getting Sick of Church', 'https://foreignpolicy.com/2019/06/12/russians-are-getting-sick-of-church-orthodox-putin/', 'Orthodox Christianity—and Vladimir Putin—are at the center of the country’s newest culture war.', '2019-06-12 10:06:39', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(8, 1, 'Sudan Talks Resume, Hong Kong Protests Continue', 'https://foreignpolicy.com/2019/06/12/talks-resume-in-sudan-darfur-russia-hong-kong-protests/', 'Plus: Russia releases a journalist, Botswana decriminalizes gay sex, and the other stories we\'re following today.', '2019-06-12 04:55:43', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(9, 1, 'How to End Israel’s Political Impasse', 'https://foreignpolicy.com/2019/06/12/how-to-end-israels-political-impasse-netanyahu-avigdor-lieberman-elections-electoral-reform/', 'A dysfunctional electoral system stopped Benjamin Netanyahu from forming a government. The country needs to enact two simple reforms, or it will face perpetual stalemate.', '2019-06-12 03:50:25', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(10, 1, 'Journalist’s Release Reveals Cracks in the Putin System', 'https://foreignpolicy.com/2019/06/11/journalists-release-reveals-cracks-in-the-putin-system-ivan-golunov-meduza/', 'The Kremlin is growing nervous over rising public resistance to the Russian president’s long rule.', '2019-06-11 18:20:12', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(11, 1, 'How China Could Shut Down America’s Defenses', 'https://foreignpolicy.com/2019/06/11/how-china-could-shut-down-americas-defenses-rare-earth/', 'Advanced U.S. weapons are almost entirely reliant on rare-earth materials only made in China—and they could be a casualty of the trade war.', '2019-06-11 16:10:29', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(12, 1, 'Trump’s Iran Crackdown Isn’t Enough to Stop Hezbollah', 'https://foreignpolicy.com/2019/06/11/trumps-iran-crackdown-isnt-enough-to-stop-hezbollah/', 'Unless Washington targets the group more effectively, it can outlive the pressure on Tehran.', '2019-06-11 16:01:31', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(13, 1, 'Mexico’s Other Border', 'https://foreignpolicy.com/2019/06/11/mexicos-southern-border-trump-immigration-deal-tariffs-iran-sudan/', 'Plus: Observers fear spiraling violence in Sudan, a scandal erupts in Brazil, and the other stories we\'re following today.', '2019-06-11 05:00:50', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(14, 1, 'Moldova’s Governments Go Head to Head', 'https://foreignpolicy.com/2019/06/10/moldovas-governments-go-head-to-head/', 'One of Europe’s poorest countries plunges into crisis.', '2019-06-10 19:19:40', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(15, 1, 'Duda’s Ego Trip', 'https://foreignpolicy.com/2019/06/10/dudas-ego-trip/', 'The Polish president will try to convince Trump to send U.S. troops to his country. Congress should push Trump to resist.', '2019-06-10 19:06:34', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(16, 1, 'Accused of Inaction, Trump Team Set to Appoint Sudan Advisor', 'https://foreignpolicy.com/2019/06/10/accused-of-indifference-trump-team-set-to-appoint-sudan-advisor-khartoum-violence-protests-east-africa-diplomacy-state-department/', 'Former U.S. diplomat Donald Booth expected to address the bloody impasse between military and protesters as U.N. officials warn of spiraling violence.\n', '2019-06-10 17:47:49', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(17, 1, 'U.S. Grounds Turkish F-35 Pilots', 'https://foreignpolicy.com/2019/06/10/fighter-jet-turkey-pentagon-u-s-grounds-turkish-f-35-pilots/', 'Pilots no longer allowed to fly or access restricted information as spat over Russian missile defense system continues.', '2019-06-10 17:03:08', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(18, 1, 'Nobody’s Asking for Trump to Be a Genius', 'https://foreignpolicy.com/2019/06/10/nobodys-asking-for-trump-to-be-a-genius/', 'But is it too much for him to at least show some foreign-policy common sense?', '2019-06-10 16:41:44', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(19, 1, 'Duterte Turns Death Squads on Political Activists', 'https://foreignpolicy.com/2019/06/10/duterte-turns-death-squads-on-political-activists/', 'Government-backed vigilantes in the Philippines are targeting farmers and protesters. ', '2019-06-10 15:02:07', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(20, 1, 'The Fed Is Trump’s Secret Ally in the Trade War', 'https://foreignpolicy.com/2019/06/10/the-fed-is-trumps-secret-ally-in-the-trade-war/', 'By lowering interest rates, the body is cushioning the blow of tariffs and convincing the president that they are working.', '2019-06-10 13:05:17', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(21, 1, 'Kazakhstan’s Second-Ever President Can’t Tolerate Protest', 'https://foreignpolicy.com/2019/06/10/kazakhstans-second-ever-president-cant-tolerate-protest/', 'Nazarbayev’s successor has an impressive foreign profile but a raft of domestic problems.', '2019-06-10 12:00:54', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(22, 1, 'Pentagon Warns Turkey of Sanctions Over Russian Missile System', 'https://foreignpolicy.com/2019/06/10/pentagon-warns-turkey-of-sanctions-over-russian-missile-system/', 'Decision to start ‘unwinding’ Turkey from the F-35 fighter jet program is the latest sign of strained ties between the two nations.  ', '2019-06-10 07:30:19', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(23, 1, 'Hong Kong’s Last Stand', 'https://foreignpolicy.com/2019/06/10/hong-kongs-last-stand-extradition-trump-mexico-iran/', 'Plus: Mexico faces new pressure on immigration, Germany meets with Iran, and what to watch in the world this week.', '2019-06-10 03:41:09', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(24, 1, 'When Coal Comes to Paradise', 'https://foreignpolicy.com/2019/06/09/when-coal-came-to-paradise-china-coal-kenya-lamu-pollution-africa-chinese-industry-bri/', 'As China pushes clean energy policies at home, it is exporting its high-pollution coal industry to pristine places like Kenya’s Lamu Island—with Nairobi’s seal of approval. Local residents fear it will destroy the environment they depend on.', '2019-06-09 03:48:24', '2019-06-13 01:03:52', '2019-06-13 01:03:52'),
(25, 1, 'Kazakhstan’s Fake Vote Might Wake Up Civil Society', 'https://foreignpolicy.com/2019/06/08/kazakhstans-fake-vote-might-help-bring-real-democracy/', 'The nominal resignation of a longtime autocrat has sparked new hopes.', '2019-06-08 08:00:58', '2019-06-13 01:03:52', '2019-06-13 01:03:52');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rss_channels`
--
ALTER TABLE `rss_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rss_posts`
--
ALTER TABLE `rss_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
