#
# TABLE STRUCTURE FOR: products
#

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `trainer_id` varchar(255) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `product_title` varchar(255) NOT NULL COMMENT 'name',
  `punchline` text NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_url` text NOT NULL,
  `suitable_for` int(11) NOT NULL COMMENT '1-industry,2-person',
  `language_id` int(11) NOT NULL,
  `price_range_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `product_img` text NOT NULL,
  `video_path` text NOT NULL,
  `audio_path` text NOT NULL,
  `youtube_link` text NOT NULL,
  `video_type` int(1) NOT NULL COMMENT '1-paid,0-free',
  `sample` text NOT NULL COMMENT 'in case of book / e-book / poster etc',
  `description` text NOT NULL,
  `delivery_time` varchar(100) NOT NULL,
  `duration` text NOT NULL COMMENT 'minutes/hours/pages',
  `special_offer` int(1) NOT NULL COMMENT '1-yes,0-no',
  `likes` varchar(15) NOT NULL,
  `view_count` varchar(15) NOT NULL,
  `product_type` int(1) NOT NULL COMMENT '1-product,2-video,3-audio,4-other',
  `status` int(1) NOT NULL COMMENT '0-out of stock,1-available,2-pre-launch',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `like_count` text NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `trainer_id` (`trainer_id`),
  KEY `category_id` (`category_id`),
  KEY `language_id` (`language_id`),
  KEY `price_range_id` (`price_range_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (5, 1, 17, Pen Drive, Sand Disk Pen Drive, PR184539, pen-drive, 2, 1, 1, 99, productsimg_201801101515570413.jpg, , , , 0, Pen Drive, Compact Design for Maximum Portability.
Store more with capacities up to 16gb 5-year limited warranty.
High-Capacity Drive Accommodates Your Favorite Media Files
SanDisk SecureAccess Software Protects Drive from Unauthorized Access, 3, , 0, , , 1, 1, 2018-01-10 13:16:53, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (9, 2, 13, Slim Fit Grey , , PR115081, slim-fit-grey-, 2, 2, 1, 100, , mediafile_201712281514450657.mp4, , , 2, , , , 3.47, 1, , , 2, 0, 2018-01-12 16:26:05, 1);
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (12, 1, 14, Audio File, , PR557250, audio-file, 1, 2, 1, 0, , Meer-E-Kaarwan.mp3, , , 1, , , , 5.00, 0, , , 2, 0, 2017-12-28 16:04:35, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (13, 2, 13, New File, , PR304595, new-file, 1, 2, 1, 0, productsimg_201712281514457897.jpg, videofile_201712281514457897.mp4, audiofile_201712281514457897.mp3, , 1, , some data, , 10, 1, , , 2, 0, 2018-01-07 11:57:14, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (15, 1, 14, Grey Blazer, , PR736816, grey-blazer, 2, 2, 1, 0, , , audiofile_201712281514463415.mp3, , 2, , aaaaaaaaaaaa, , 5, 1, , , 2, 0, 2018-01-06 17:39:14, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (16, 2, 13, Gbsfdb, , PR568298, gbsfdb, 2, 2, 1, 0, productsimg_201712281514463623.jpg, videofile_201712281514463623.mp4, audiofile_201712281514463623.mp3, , 1, , , , 4, 0, , , 3, 0, 2018-01-07 11:57:16, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (17, 1, 14, Kindergarten English Work Book, No punchline, PR731994, kindergarten-english-work-book, 2, 1, 4, 350, productsimg_201801061515215231.jpg, , , , 0, Sample, This series of 13 books for Kindergarten has been carefully prepared with young learners in view. With wonderful colourful pictures and activities on each page young children learn important skills, letters, numbers, printing, drawing and so on in a playful way.  , 2 days, , 0, , , 1, 1, 2018-01-06 10:37:11, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (18, 2, 15, Turn Up The Volume, A Down and Dirty Guide to Podcasting Paperback, PR620086, turn-up-the-volume, 2, 1, 5, 450, productsimg_201801061515215342.jpg, , , , 0, A Down and Dirty Guide to Podcasting Paperback, Turn Up the Volume equips journalism students, professionals, and others interested in producing audio content with the know-how necessary to launch a podcast for the first time. It addresses the unique challenges beginner podcasters face in producing professional level audio for online distribution. Beginners can learn how to handle the technical and conceptual challenges of launching, editing, and posting a podcast., 4 days, , 1, , , 1, 1, 2018-01-07 11:57:20, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (19, 1, 18, Why We Love The Way We Do, Why We Love the Way We Do, PR73364, why-we-love-the-way-we-do, 2, 1, 5, 433, productsimg_201801061515215537.jpg, , , , 0, Why We Love the Way We Do, Is it possible to tell if it is love or lust? How important is sex in a relationship? Why do break-ups hurt so much? How often should you message a person you fancy? How do you tell if someone is too young or too old for you?, 3 days, , 0, , , 1, 1, 2018-01-06 10:42:17, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (34, 2, 15, Asasas, , PR71838, asasas, 1, 2, 3, 250, productsimg_201801061515221051.jpg, , audiofile_201801061515221051.mp3, https://www.youtube.com/watch?v=kvE2iQWSwk4, 1, , dsdsd, , 5 min, 1, , , 3, 0, 2018-01-07 11:57:23, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (36, 1, 16, Tytyt, ty, PR437500, tytyt, 1, 2, 3, 250, productsimg_201801061515221479.jpg, , , , 0, ty, ty, tyyt, , 1, , , 2, 2, 2018-01-08 18:44:47, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (37, 1, 13, Funny, , PR209930, funny, 3, 2, 2, 0, , , , watch?v=lS7y6Lghpo8, 1, , funny video, , 2.04, 0, , , 2, 0, 2018-01-08 12:05:06, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (41, 1, 13, Abc, , PR149780, abc, 3, 2, 1, 100, productsimg_201801081515394652.jpg, videofile_201801081515394652.mp4, , , 2, , , , 1, 0, , , 2, 0, 2018-01-08 12:27:32, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (42, 1, 13, Aaa, , PR961975, aaa, 2, 2, 1, 100, productsimg_201801081515394919.jpg, videofile_201801081515394919.mp4, , , 2, , , , 1, 0, , , 2, 0, 2018-01-12 15:48:32, 1);
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (43, 1, 13, Asdf, , PR883911, asdf, 2, 2, 3, 110, productsimg_201801081515395012.jpg, videofile_201801081515395012.mp4, , , 2, , , , 1, 0, , , 2, 0, 2018-01-12 15:46:34, 2);
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (45, 1, 23, Product Test, abcd, PR497924, product-test, 1, 1, 5, 400, productsimg_201801081515416263.jpg, , , , 0, abcd, abcd, 4, , 1, , , 2, 1, 2018-01-08 18:32:30, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (46, 1, 23, Demo Product , abcde, PR95367, demo-product-, 1, 3, 4, 300, productsimg_201801081515417174.jpg, , , , 0, abcde, abcde, 3, , 0, , , 2, 1, 2018-01-08 18:44:00, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (48, 1, 23, Video Test, , PR168457, video-test, 1, 1, 3, 250, productsimg_201801091515482002.jpg, videofile_201801091515482002.wmv, , , 1, , abcd, , 3 min, 1, , , 2, 0, 2018-01-09 12:43:22, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (50, 72519440302d00a10616cf3304abef81, 13, Qaws, , PR347320, qaws, 2, 2, 14, 0, productsimg_201801091515488759.jpg, videofile_201801091515488759.mp4, , , 1, , wqsd, , 1, 0, , , 2, 0, 2018-01-12 15:43:38, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (51, 98679c6122af38e9bdea57bba242a681, 13, Training Tips, , PR296661, training-tips, 3, 1, 2, 100, , , , https://www.youtube.com/watch?v=9ahGfu991Z0, 2, , aswdasd, , 10, 0, , , 2, 0, 2018-01-12 15:45:17, 2);
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (52, 1, 25, Colour, abcd, PR355438, colour, 1, 4, 10, 2500, productsimg_201801111515659579.jpg, , , , 0, abcd, abcd, 5, , 1, , , 1, 1, 2018-01-11 14:02:59, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (53, 1, 25, Painter2, efgh, PR194702, painter2, 1, 4, 9, 2000, productsimg_201801111515659762.jpg, , , , 0, abcd, ijkl, 5, , 1, , , 1, 1, 2018-01-11 14:06:02, );
INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`) VALUES (54, 98679c6122af38e9bdea57bba242a681, 18, Ban Brown, , PR216522, ban-brown, 1, 1, 4, 350, productsimg_201801121515733895.jpg, , , , 0, , Dan Brown is the best book for industry, 4, , 0, , , 1, 1, 2018-01-12 10:41:35, );


#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `cat_code` text NOT NULL,
  `cat_url` text NOT NULL,
  `category_img` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (13, Videos, C892944, videos, categoryimg_201801101515569580.jpg, 2018-01-10 13:03:00);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (14, Audio Book, C20172, audio-book, categoryimg_201801101515569608.jpg, 2018-01-10 13:03:28);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (15, Podcast, C372375, podcast, categoryimg_201801101515569669.jpg, 2018-01-10 13:04:29);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (16, Dvd, C559417, dvd, categoryimg_201801101515569528.jpg, 2018-01-10 13:02:09);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (17, Pen Drive, C806396, pen-drive, categoryimg_201801101515569699.jpg, 2018-01-10 13:04:59);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (18, Books, C519256, books, categoryimg_201801101515569725.jpg, 2018-01-10 13:05:25);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (19, E-books, C491333, e-books, categoryimg_201801101515569752.jpg, 2018-01-10 13:05:52);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (20, Posters, C78186, posters, categoryimg_201801101515569822.jpg, 2018-01-10 13:07:02);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (21, Sales Tools, C117767, sales-tools, categoryimg_201801101515569849.jpg, 2018-01-10 13:07:29);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (22, Others, C791503, others, categoryimg_201801101515569886.png, 2018-01-10 13:08:06);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (23, Test222, C89355, test222, , 2018-01-09 12:41:49);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (24, Abc, C47546, abc, categoryimg_201801101515567676.jpg, 2018-01-10 12:31:16);
INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES (25, Painter, C364196, painter, categoryimg_201801111515659455.jpg, 2018-01-11 14:00:55);


