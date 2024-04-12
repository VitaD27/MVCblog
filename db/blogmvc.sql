-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 12. dub 2024, 16:13
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `blogmvc`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(5, 10, 'post three', 'this is good', '2019-08-13 15:46:43'),
(6, 10, 'Post Three', 'this is good', '2019-08-13 15:51:23'),
(10, 12, 'Temný rytí?', 'Hlavní hrdina je v podstatn? oby?ejný chlap, který má jen hodn? pen?z a velký smysl pro spravedlnost. Postava Batmana zde ustupuje do pozadí p?ed hlavním záporákem filmu Jokerem. Toho si zahrál talentovaný Heather Ledger; dokonalé a poctivé ztvárn?ní rozpolcené, duševn? narušené postavy ho však nakonec možná stálo život, krátce po nato?ení filmu zem?el na p?edávkování prášky na spaní. \r\n\r\nVe filmu m?žeme sledovat souboj dobra se zlem. Temný rytí? ale klade otázku, zda zlo bude vždy tahat za delší konec, když dobro bude dodržovat pravidla. A jestli se ten, který prosazuje dobro, po p?ekro?ení hranice sám nestane padouchem.\r\n\r\nNa kvalit? Temného rytí?e se vzácn? shodla odborná kritika i diváci v kinech. P?es sv?j komiksový nám?t je Temný rytí? spíše drsná, realistická a dramatická ak?ní jízda, která vás v?bec nenechá vydechnout.', '2024-04-11 20:47:09'),
(11, 12, 'Pán prsten?: Spole?enstvo Prstenu', 'V dávných dobách byl vykován kouzelný prsten, který vlastnil pán Mordoru Sauron. Jeho moc za?al využívat k ší?ení zla, ale o prsten nakonec v boji p?išel, a ten na dlouhá léta zmizel. Nakonec ho našel malý hobit, kterému mocný prsten dlouho prodlužoval život. Nyní ale zlo znovu získává na síle a jeho mocný pán ho hledá. Díky jeho moci by dokázal ovládanout celý sv?t. Lidé, elfové, trpaslíci a hobiti se tak musí spojit, aby spole?n? mocný prsten zni?ili.', '2024-04-11 20:48:56'),
(12, 12, 'NIRVANA', 'Album dostupné na vinylu (LP) a CD ve 4 vydáních. Nirvana je album americké grungeové skupiny Nirvana z roku 2002. Bylo vydáno 5. listopadu 2002, dva roky po rozpadu skupiny a deset let po jejím debutovém albu Bleach. Album sestavili vdova po Kurtu Cobainovi Courtney Love a bývalý bubeník Nirvana Dave Grohl. Obsahuje dosud nevydané skladby ze studiových nahrávek a živých vystoupení skupiny. Nirvana získalo od hudebních kritik? smíšené hodnocení. N?kte?í album chválili za jeho kvalitu a nevydané skladby, jiní ho kritizovali za špatn? sestavené. Album debutovalo na t?etím míst? v žeb?í?ku Billboard 200 a b?hem prvního týdne se ho prodalo p?es 131 000 kopií. Americká asociace nahrávacího pr?myslu mu ud?lila zlatý certifikát. Nirvana obsahuje sm?s studiových a živých skladeb. Studiové skladby byly nahrány b?hem poslední studiové session kapely v lednu 1994, jen n?kolik m?síc? p?ed Cobainovou smrtí. Živé skladby byly nahrány b?hem posledního turné skupiny v roce 1994. Album otevírá skladba &#34;You Know You&#39;re Right&#34;, poslední píse?, kterou kdy Nirvana nahráli. Píse? byla vydána jako singl v roce 2002 a dostala se na první místo žeb?í?ku Billboard Modern Rock Tracks. druhá skladba alba Album zasahuje do žánr? Rock a Grunge.', '2024-04-11 20:50:11');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(10, 'Emmanuel Omonzebaguan', 'emmizy2015@gmail.com', '$2y$10$GHZKnWPt3ZQEUztMRkVogO2yaQG6cEYOiFVXDjyOLFqSi8s7NazmG', '2019-08-12 16:01:21'),
(11, 'Mat Sele', 'matsele@gmail.com', '$2y$10$LVFIESEbb9o/sVV9sX8Xwe1Gpo2lMRGhErnXN6SKf0ytxEAhmw69O', '2019-08-14 04:36:55'),
(12, 'Vít?zslav Da?í?ek', 'vitezslav.daricek@seznam.cz', '$2y$10$wf8/hgUAJwLIwoLbicDA2.s8rV7yWJA4W/3mTNk6blWnwdmzf3vyG', '2024-04-11 19:31:10');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
