
CREATE TABLE `chatbot_quess` (
  `id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `reply` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `chatbot_ques` (`id`, `question`, `reply`) VALUES
(1, 'HI||Hello||Hola', 'Hello, how are you.'),
(2, 'How are you', 'Im good.'),
(3, 'what is your name||whats your name', 'My name is SciAstra Bot'),
(4, 'what should I call you', 'You can call me SciAstra Bot'),
(5, 'what is the application form deadline of NEST exam', '22-06-2023'),
(6, 'Bye||See you later||Have a Good Day', 'Goodbye! Have a nice day.'),
(7, 'what types of courses do you offer', 'https://www.sciastra.com/courses/'),
(8, 'selections from your institute', 'https://www.sciastra.com/selections/'),
(9, 'blogs', 'https://www.sciastra.com/blog/'),
(10, 'do you have the study materials available', 'https://www.sciastra.com/materials/'),
(11, 'could i see your team', 'https://www.sciastra.com/teams/'),
(12, 'how can i contact you||reach you', 'https://www.sciastra.com/contact/'),
(13, 'login', 'https://www.sciastra.com/app/'),
(14, 'what is the application form deadline of IAT exam', '02-06-2023'),
(15, 'what is the application form deadline of IISC exam', '08-06-2023'),
(16, 'what is the application form deadline of ISI/CMI exam', '18-06-2023'),
(17, 'what is the application form deadline of IIT/JAM exam', '16-06-2023'),
(18, 'what is the application form deadline of IACS exam', '22-05-2023'),
(19, 'what is the application form deadline of CUET exam', '28-05-2023'),
(20, 'what is the application form deadline of ICAR exam', '11-06-2023');


CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `added_on` datetime NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `chatbot_hints`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `chatbot_ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;