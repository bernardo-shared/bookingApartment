
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- flat
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `flat`;

CREATE TABLE `flat`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(100),
    `country` VARCHAR(100),
    `city` VARCHAR(100),
    `postcode` VARCHAR(6),
    `street` VARCHAR(30),
    `number` VARCHAR(5),
    `floor` VARCHAR(5),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- room
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `room`;

CREATE TABLE `room`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(100),
    `flat_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `room_FI_1` (`flat_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- bed
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bed`;

CREATE TABLE `bed`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(10),
    `room_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `bed_FI_1` (`room_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(10),
    `email` VARCHAR(100),
    `password` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- booking
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `start_date` DATE,
    `end_date` DATE,
    `customer_id` INTEGER,
    `bed_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `booking_FI_1` (`customer_id`),
    INDEX `booking_FI_2` (`bed_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(10),
    `email` VARCHAR(100),
    `password` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
