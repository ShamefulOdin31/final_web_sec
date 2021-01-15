/* SQL Manager Lite for MySQL                              5.8.0.53936 */
/* ------------------------------------------------------------------- */
/* Host     : 192.168.56.101                                           */
/* Port     : 3306                                                     */
/* Database : blog                                                     */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8mb4' */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `blog`
    CHARACTER SET 'utf8mb4'
    COLLATE 'utf8mb4_general_ci';

USE `blog`;

/* Structure for the `members` table : */

CREATE TABLE `members` (
  `id` INTEGER(4) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `password` VARCHAR(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `salt` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `last_login` DATETIME DEFAULT NULL,
  `failed_login` INTEGER(11) DEFAULT 0,
  `email` VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=30 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci'
;

/* Structure for the `phprbac_permissions` table : */

CREATE TABLE `phprbac_permissions` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Lft` INTEGER(11) NOT NULL,
  `Rght` INTEGER(11) NOT NULL,
  `Title` CHAR(64) COLLATE utf8_bin NOT NULL,
  `Description` TEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY USING BTREE (`ID`),
  KEY `Title` USING BTREE (`Title`),
  KEY `Lft` USING BTREE (`Lft`),
  KEY `Rght` USING BTREE (`Rght`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_rolepermissions` table : */

CREATE TABLE `phprbac_rolepermissions` (
  `RoleID` INTEGER(11) NOT NULL,
  `PermissionID` INTEGER(11) NOT NULL,
  `AssignmentDate` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`RoleID`, `PermissionID`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_roles` table : */

CREATE TABLE `phprbac_roles` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Lft` INTEGER(11) NOT NULL,
  `Rght` INTEGER(11) NOT NULL,
  `Title` VARCHAR(128) COLLATE utf8_bin NOT NULL,
  `Description` TEXT COLLATE utf8_bin NOT NULL,
  PRIMARY KEY USING BTREE (`ID`),
  KEY `Title` USING BTREE (`Title`),
  KEY `Lft` USING BTREE (`Lft`),
  KEY `Rght` USING BTREE (`Rght`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `phprbac_userroles` table : */

CREATE TABLE `phprbac_userroles` (
  `UserID` INTEGER(11) NOT NULL,
  `RoleID` INTEGER(11) NOT NULL,
  `AssignmentDate` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`UserID`, `RoleID`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_bin'
;

/* Structure for the `posts` table : */

CREATE TABLE `posts` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL,
  `content` TEXT COLLATE latin1_swedish_ci NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=9 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Data for the `members` table  (LIMIT 0,500) */

INSERT INTO `members` (`id`, `username`, `password`, `salt`, `last_login`, `failed_login`, `email`) VALUES
  (23,'test','e99a64317eb687cb4586dae64aebaea9ae136d39253d2f51e3f49aa884c9fc67d033ae8aae3f132812328bb45f0fb261a5736bcd819bab17c8e1f3f50dba17bd','5fd79b8ad4414','2020-12-14 06:00:00',0,NULL),
  (25,'admin','f0004087713be245750ae2565584b1cb591d540945f981e3eca43401df3122a9cb3c2c5157afa809897bfe537c8043da3ddf41444f586ad6709068346a299858','5fd7aab855ef3','2020-12-14 14:22:38',50,NULL),
  (27,'new','f9e05ba545943025e9c97d5c2032932702c8778d30e68ee83cd51c3bcfd929f976c84399be40f90a35de42e45cc471c86ce6a5135cf9319897471bffd68d0f67','5fd7b3f38d43c',NULL,0,'new@example.com'),
  (28,'','f76362c7032bda6621601d8260344d3a04ad693178fb39bee93b427cb6b64c9972e04c7831e46416fe66db5cba84ba7bb94e74a9a514c156258b6c7fd17ec6eb','5fd7cbecbcabd',NULL,0,''),
  (29,'richard','0134e18d5836c98f1be1171f67fcd813dcd492a9504bc9f16e2578e977c0faf59536439abf13288b5f652637f14fc03c32ca9891b3d529a025c3cface9b4f56f','5fd7cc9783824',NULL,0,'text@example.com');
COMMIT;

/* Data for the `phprbac_permissions` table  (LIMIT 0,500) */

INSERT INTO `phprbac_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
  (1,0,3,'root','root'),
  (2,1,2,'admin','Administer Site');
COMMIT;

/* Data for the `phprbac_rolepermissions` table  (LIMIT 0,500) */

INSERT INTO `phprbac_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`) VALUES
  (1,1,1607969509),
  (2,2,1607969543);
COMMIT;

/* Data for the `phprbac_roles` table  (LIMIT 0,500) */

INSERT INTO `phprbac_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
  (1,0,3,'root','root'),
  (2,1,2,'admin','Administrator');
COMMIT;

/* Data for the `phprbac_userroles` table  (LIMIT 0,500) */

INSERT INTO `phprbac_userroles` (`UserID`, `RoleID`, `AssignmentDate`) VALUES
  (1,1,1607969509),
  (25,2,1607969543);
COMMIT;

/* Data for the `posts` table  (LIMIT 0,500) */

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
  (0,'Front End Developer','Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.','0000-00-00 00:00:00','2020-12-14 14:43:09'),
  (1,'Web Developer','Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure, iste.','0000-00-00 00:00:00','2020-12-14 14:43:24'),
  (2,'Graphic designer','Lorem ipsum dolor sit amet, consectetur adipisicing elit.','0000-00-00 00:00:00','2020-12-14 14:43:49');
COMMIT;

UPDATE `posts` SET id=0 WHERE id=LAST_INSERT_ID();
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;