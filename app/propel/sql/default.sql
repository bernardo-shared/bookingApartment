
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
    `description` VARCHAR(100) NOT NULL,
    `country` ENUM('Spain','Germany') NOT NULL,
    `city` VARCHAR(100) NOT NULL,
    `postcode` VARCHAR(6) NOT NULL,
    `street` VARCHAR(30) NOT NULL,
    `number` VARCHAR(5) NOT NULL,
    `floor` VARCHAR(5) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

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
    INDEX `room_FI_1` (`flat_id`),
    CONSTRAINT `room_FK_1`
        FOREIGN KEY (`flat_id`)
        REFERENCES `flat` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- bed
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bed`;

CREATE TABLE `bed`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `type` ENUM('Sofa','Single','TWW') NOT NULL,
    `room_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `bed_FI_1` (`room_id`),
    CONSTRAINT `bed_FK_1`
        FOREIGN KEY (`room_id`)
        REFERENCES `room` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- customer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(10) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `salt` VARCHAR(32),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- booking
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `customer_id` INTEGER,
    `bed_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `booking_FI_1` (`customer_id`),
    INDEX `booking_FI_2` (`bed_id`),
    CONSTRAINT `booking_FK_1`
        FOREIGN KEY (`customer_id`)
        REFERENCES `customer` (`id`),
    CONSTRAINT `booking_FK_2`
        FOREIGN KEY (`bed_id`)
        REFERENCES `bed` (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(10),
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `salt` VARCHAR(32),
    `is_active` TINYINT(1),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
