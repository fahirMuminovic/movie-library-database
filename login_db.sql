-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2022 at 07:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `idMovie` int(11) NOT NULL,
  `fileFullName` longtext NOT NULL,
  `movieName` longtext NOT NULL,
  `yearOfRelease` year(4) NOT NULL,
  `director` longtext NOT NULL,
  `actors` longtext NOT NULL,
  `imdbLink` longtext NOT NULL,
  `trailerLink` longtext NOT NULL,
  `sinopsis` longtext NOT NULL,
  `orderMovies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`idMovie`, `fileFullName`, `movieName`, `yearOfRelease`, `director`, `actors`, `imdbLink`, `trailerLink`, `sinopsis`, `orderMovies`) VALUES
(1, 'back-to-the-future.IPI620986c2131025.32363325.jpg', 'Back To The Future', 1985, 'Robert Zemeckis', 'Michael J. Fox, Christopher Lloyd, Lea Thompson', 'https://www.imdb.com/title/tt0088763/', 'https://www.youtube.com/watch?v=qvsgGtivCgs', 'Marty McFly, a 17-year-old high school student, is accidentally sent thirty years into the past in a time-traveling DeLorean invented by his close friend, the eccentric scientist Doc Brown.', 1),
(2, 'dune.IPI620986b4dfe556.28024474.jpg', 'Dune', 2021, 'Denis Villeneuve', 'Timothée Chalamet, Rebecca Ferguson, Oscar Isaac, Josh Brolin, Zendaya, Jason Momoa', 'https://www.imdb.com/title/tt1160419/', 'https://www.youtube.com/watch?v=n9xhJrPXop4', 'Feature adaptation of Frank Herbert\'s science fiction novel about the son of a noble family entrusted with the protection of the most valuable asset and most vital element in the galaxy.', 2),
(3, 'forest-gump.IPI61de117e27d2e0.39461216.jpg', 'Forrest Gump', 1994, 'Robert Zemeckis', 'Tom Hanks, Rebecca Williams, Sally Field, Gary Sinise', 'https://www.imdb.com/title/tt0109830/', 'https://www.youtube.com/watch?v=bLvqoHBptjg', 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.', 3),
(4, 'inception.IPI61de18e40d0625.22378688.jpg', 'Inception', 2010, 'Christopher Nolan, Gordon Piper', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page, Tom Hardy', 'https://www.imdb.com/title/tt1375666/', 'https://www.youtube.com/watch?v=Jvurpf91omw', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.', 4),
(5, 'interstellar.IPI61dec0e7c586c7.66006912.jpg', 'Interstellar', 2014, 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain, Michael Caine ', 'https://www.imdb.com/title/tt0816692/', 'https://www.youtube.com/watch?v=LY19rHKAaAg&t=2s', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', 5),
(6, 'pulp-fiction-.IPI61dec16e5260a6.98419626.jpg', 'Pulp Fiction', 1994, 'Quentin Tarantino', 'John Travolta, Bruce Willis, Samuel L. Jackson, Uma Thurman', 'https://www.imdb.com/title/tt0110912/', 'https://www.youtube.com/watch?v=s7EdQ4FqbhY', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 6),
(7, 'saving-private-ryan.IPI620986a6829054.07139102.jpg', 'Saving Private Ryan', 1998, 'Steven Spielberg', 'Tom Hanks, Matt Damon, Tom Sizemore', 'https://www.imdb.com/title/tt0120815/', 'https://www.youtube.com/watch?v=9CiW_DgxCnQ', 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.', 7),
(8, 'skyfall-007.IPI61dec27739fab0.69457520.jpg', 'Skyfall', 2012, 'Sam Mendes', 'Daniel Craig, Javier Bardem, Naomie Harris, Judi Dench', 'https://www.imdb.com/title/tt1074638/', 'https://www.youtube.com/watch?v=6kw1UVovByw', 'James Bond\'s loyalty to M is tested when her past comes back to haunt her. When MI6 comes under attack, 007 must track down and destroy the threat, no matter how personal the cost.', 8),
(9, 'spider-man--no-way-home.IPI6209868a311278.34238368.jpg', 'Spider-Man: No Way Home', 2021, 'Jon Watts', 'Tom Holland, Zendaya, Willem Dafoe, Benedict Cumberbatch, Marisa Tomei', 'https://www.imdb.com/title/tt10872600/', 'https://www.youtube.com/watch?v=rt-2cxAiPJk', 'Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.', 9),
(10, 'the-dark-knight.IPI61dec36fea2cd5.92138598.jpg', 'The Dark Knight', 2008, 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine ', 'https://www.imdb.com/title/tt0468569/', 'https://www.youtube.com/watch?v=EXeTwQWrcwY', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 10),
(11, 'the-godfather.IPI61dec3e29e15e7.28159354.jpg', 'The Godfather', 1972, 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan, Richard S. Castellano', 'https://www.imdb.com/title/tt0068646/', 'https://www.youtube.com/watch?v=sY1S34973zA', 'The Godfather follows Vito Corleone, Don of the Corleone family, as he passes the mantel to his unwilling son, Michael.', 11),
(12, 'the-matrix-resurrections.IPI61dec8bf5105a2.85427468.jpg', 'The Matrix Resurrections', 2021, 'Lana Wachowski', 'Keanu Reeves, Carrie-Anne Moss,Yahya Abdul-Mateen II, Neil Patrick Harris ', 'https://www.imdb.com/title/tt10838180/', 'https://www.youtube.com/watch?v=9ix7TUGVYIo', 'Return to a world of two realities: one, everyday life; the other, what lies behind it. To find out if his reality is a construct, to truly know himself, Mr. Anderson will have to choose to follow the white rabbit once more.', 12),
(13, 'the-shawshank-redemption.IPI61decae82f9169.34667214.jpg', 'The Shawshank Redemption', 1994, 'Frank Darabont', 'Tim Robbins, Morgan Freeman, Bob Gunton, William Sadler', 'https://www.imdb.com/title/tt0111161/', 'https://www.youtube.com/watch?v=6hB3S9bIaco', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 13),
(15, 'ready-player-one.IPI61e05fb5a77ce2.08557214.jpg', 'Ready Player One', 2018, 'Steven Spielberg', 'Tye Sheridan, Olivia Cooke, Ben Mendelsohn, Lena Waithe ', 'https://www.imdb.com/title/tt1677720/', 'https://www.youtube.com/watch?v=cSp1dM2Vj48', 'When the creator of a virtual reality called the OASIS dies, he makes a posthumous challenge to all OASIS users to find his Easter Egg, which will give the finder his fortune and control of his world.', 15),
(16, 'baby-driver.IPI61e0609057ea63.64331926.jpg', 'Baby Driver', 2017, 'Edgar Wright, David Krentz', 'Ansel Elgort, Jon Bernthal, Jon Hamm, Eiza González', 'https://www.imdb.com/title/tt3890160/', 'https://www.youtube.com/watch?v=z2z857RSfhk', 'After being coerced into working for a crime boss, a young getaway driver finds himself taking part in a heist doomed to fail.', 16),
(17, 'avatar.IPI61e1f09dac1ed4.37691470.jpg', 'Avatar', 2009, 'James Cameron', 'Sam Worthington, Zoe Saldana, Sigourney Weaver, Stephen Lang', 'https://www.imdb.com/title/tt0499549/', 'https://www.youtube.com/watch?v=5PSNL1qE6VY', 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', 16),
(18, 'jumanji.IPI61e201dc002ae3.49871309.jpg', 'Jumanji', 1995, 'Joe Johnston', 'Robin Williams,Jonathan Hyde,Kirsten Dunst,Bradley Pierce', 'https://www.imdb.com/title/tt0113497/', 'https://www.youtube.com/watch?v=yLyXEQPuLJo', 'When two kids find and play a magical board game, they release a man trapped in it for decades - and a host of dangers that can only be stopped by finishing the game.', 17),
(19, 'mad-max.IPI61ec2ee8cc4071.44834836.jpg', 'Mad Max: Fury Road', 2015, 'George Miller', 'Tom Hardy, Charlize Theron, Nicholas Hoult, Hugh Keays-Byrne', 'https://www.imdb.com/title/tt1392190/', 'https://www.youtube.com/watch?v=hEJnMQG9ev8', 'In a post-apocalyptic wasteland, a woman rebels against a tyrannical ruler in search for her homeland with the aid of a group of female prisoners, a psychotic worshiper, and a drifter named Max.', 18),
(21, 'avengers--endgame.IPI61ec323dcce8b7.14279559.jpg', 'Avengers: Endgame', 2019, 'Joe Russo, Anthony Russo', 'Robert Downey Jr., Chris Evans, Scarlett Johansson, Chris Hemsworth, Mark Ruffalo', 'https://www.imdb.com/title/tt4154796/', 'https://www.youtube.com/watch?v=TcMBFSGVi1c', 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos\' actions and restore balance to the universe.', 19),
(22, 'ghostbusters--afterlife.IPI61ec347968ee57.19116188.jpg', 'Ghostbusters: Afterlife', 2021, 'Jason Reitman', 'Finn Wolfhard, Mckenna Grace, Carrie Coon, Paul Rudd', 'https://www.imdb.com/title/tt4513678/', 'https://www.youtube.com/watch?v=HR-WxNVLZhQ', 'When a single mom and her two kids arrive in a small town, they begin to discover their connection to the original Ghostbusters and the secret legacy their grandfather left behind.', 20),
(23, 'tenet.IPI61eebc065b0514.11128898.jpg', 'Tenet', 2020, 'Christopher Nolan', 'John David Washington, Robert Pattinson, Elizabeth Debicki, Kenneth Branagh', 'https://www.imdb.com/title/tt6723592/', 'https://www.youtube.com/watch?v=AZGcmvrTX9M', 'Armed with only one word, Tenet, and fighting for the survival of the entire world, a Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.', 21),
(24, 'project-x.IPI6209866bc63ba4.12700852.jpg', 'Project X', 2012, 'Nima Nourizadeh', 'Brady Hender, Nick Nervies, Miles Teller, Thomas Mann', 'https://www.imdb.com/title/tt1636826/', 'https://www.youtube.com/watch?v=p8_U0n2oIHA', '3 high school seniors throw a birthday party to make a name for themselves. As the night progresses, things spiral out of control as word of the party spreads.', 22),
(25, 'the-maze-runner.IPI61eeed651a41f1.97552818.jpg', 'The Maze Runner', 2014, 'Wes Ball', 'Dylan O\'Brien, Aml Ameen, Will Poulter, Ki Hong Lee', 'https://www.imdb.com/title/tt1790864/', 'https://www.youtube.com/watch?v=AwwbhhjQ9Xk', 'Thomas is deposited in a community of boys after his memory is erased, soon learning they\'re all trapped in a maze that will require him to join forces with fellow \"runners\" for a shot at escape.', 23),
(26, 'deadpool.IPI61eeedea28c3d6.09950795.jpg', 'Deadpool', 2016, 'Tim Miller', 'Ryan Reynolds, Morena Baccarin, T.J. Miller, Stefan Kapičić', 'https://www.imdb.com/title/tt1431045/', 'https://www.youtube.com/watch?v=ONHBaC-pfsk', 'A wisecracking mercenary gets experimented on and becomes immortal but ugly, and sets out to track down the man who ruined his looks.', 24),
(30, 'atomic-blonde.IPI61f17aa36b4d95.95278379.jpg', 'Atomic Blonde', 2017, 'David Leitch', 'Charlize Theron, James McAvoy, Eddie Marsan, John Goodman', 'https://www.imdb.com/title/tt2406566/', 'https://www.youtube.com/watch?v=yIUube1pSC0', 'An undercover MI6 agent is sent to Berlin during the Cold War to investigate the murder of a fellow agent and recover a missing list of double agents', 25),
(31, 'tremors.IPI620985ccef5277.51156980.jpg', 'Tremors', 1990, 'Ron Underwood', 'Kevin Bacon, Fred Ward, Finn Carter, Michael Gross, Reba McEntire', 'https://www.imdb.com/title/tt0100814/', 'https://www.youtube.com/watch?v=Tlzvh0cR9q4', 'Natives of a small isolated town defend themselves against strange underground creatures which are killing them one by one.', 26),
(32, 'gravity.IPI620985c0d56fb5.02110538.jpg', 'Gravity', 2013, 'Alfonso Cuarón', 'Sandra Bullock, George Clooney, Ed Harris', 'https://www.imdb.com/title/tt1454468/', 'https://www.youtube.com/watch?v=ufsrgE0BYf0', 'Two astronauts work together to survive after an accident leaves them stranded in space.', 27),
(33, 'love-and-monsters.IPI620983b6cea513.36335166.jpg', 'Love and Monsters', 2020, 'Michael Matthews', 'Dylan O\'Brien, Jessica Henwick, Michael Rooker, Dan Ewing, Ariana Greenblatt, Ellen Hollman ', 'https://www.imdb.com/title/tt2222042/', 'https://www.youtube.com/watch?v=-19tBHrZwOM', 'Seven years after he survived the monster apocalypse, lovably hapless Joel leaves his cozy underground bunker behind on a quest to reunite with his ex.', 28),
(34, 'parasite.IPI620984c5a43d49.12730416.jpg', 'Parasite', 2019, 'Bong Joon-Ho', 'Song Kang-Ho, Lee Sun-Kyun, Cho Yeo-Jeong, Choi Woo-Shik', 'https://www.imdb.com/title/tt6751668/', 'https://www.youtube.com/watch?v=SEUXfv87Wpk', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 29),
(35, 'black-panther.IPI62098595bd7204.67901640.jpg', 'Black Panther', 2018, 'Ryan Coogler', 'Chadwick Boseman, Michael B. Jordan, Danai Gurira, Lupita Nyong\'o, Letitia Wright, Daniel Kaluuya', 'https://www.imdb.com/title/tt1825683/', 'https://www.youtube.com/watch?v=xjDjIWPwcPU', 'T\'Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to lead his people into a new future and must confront a challenger from his country\'s past.', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUsername` varchar(128) NOT NULL,
  `usersPassword` varchar(128) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT 0,
  `dateOfBirth` date DEFAULT NULL,
  `spol` varchar(50) DEFAULT NULL,
  `razlogZaZahtjev` text DEFAULT NULL,
  `profilePicture` longtext NOT NULL DEFAULT 'profile-pic-placeholder.png',
  `zahtjevZaAdmina` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUsername`, `usersPassword`, `userType`, `dateOfBirth`, `spol`, `razlogZaZahtjev`, `profilePicture`, `zahtjevZaAdmina`) VALUES
(6, 'Fahir Muminovic', 'muminovic_fahir@hotmail.com', 'Fake', 'w', 1, '1998-03-25', 'Muški', 'Test', 'profile-pic6207c0ffa3b250.95581279.jpg', 0),
(7, 'Tom Holand', 'tomholland@stark.com', 'Tomy', 'wq', 0, NULL, NULL, NULL, 'profile-pic-placeholder.png', 0),
(8, 'Adna Muminovic', 'muminovic_mevludin@hotmail.com', 'adnica', 'w', 0, NULL, NULL, NULL, 'profile-pic-placeholder.png', 0),
(12, 'Emina Muminovic', 'emina65@hotmail.com', 'emina', 'emina', 0, '1968-09-21', 'Ženski', 'Test Test Test', 'profile-pic620905b96ca164.69312162.jpg', 0),
(34, 'Test Test', 'proba@gmail.com', 'Test', 'w', 1, '2003-07-04', 'Muški', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'profile-pic6208ed83055d67.08457975.jpg', 0),
(35, 'Amra Bećarević', 'amrasmajic565@gmail.com', 'Amra', 'pass', 0, '2022-02-13', 'Ženski', 'aijshfkjasdhbkHLKG SFHNFVUHLIanidnhfli', 'profile-pic62093b8b97ba39.17428968.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`idMovie`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `idMovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
