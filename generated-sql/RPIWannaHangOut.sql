
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- event
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event`
(
    `event_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NOT NULL,
    `date` DATE NOT NULL,
    `start_time` TIME NOT NULL,
    `end_time` TIME NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `description` TEXT(1200) NOT NULL,
    `max_attendance` INTEGER NOT NULL,
    `creator_user_id` INTEGER NOT NULL,
    PRIMARY KEY (`event_id`),
    INDEX `event_fi_d5fb72` (`creator_user_id`),
    CONSTRAINT `event_fk_d5fb72`
        FOREIGN KEY (`creator_user_id`)
        REFERENCES `user` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `rcs_id` VARCHAR(32) NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `permission_level` INTEGER DEFAULT 1000,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- event_interest
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event_interest`;

CREATE TABLE `event_interest`
(
    `event_interest_id` INTEGER NOT NULL AUTO_INCREMENT,
    `interested_user_id` INTEGER NOT NULL,
    `target_event_id` INTEGER NOT NULL,
    PRIMARY KEY (`event_interest_id`),
    INDEX `event_interest_fi_68c472` (`interested_user_id`),
    INDEX `event_interest_fi_afb14a` (`target_event_id`),
    CONSTRAINT `event_interest_fk_68c472`
        FOREIGN KEY (`interested_user_id`)
        REFERENCES `user` (`user_id`),
    CONSTRAINT `event_interest_fk_afb14a`
        FOREIGN KEY (`target_event_id`)
        REFERENCES `event` (`event_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment`
(
    `comment_id` INTEGER NOT NULL AUTO_INCREMENT,
    `comment_text` TEXT(1200) NOT NULL,
    `creation_date` DATETIME,
    `edit_date` DATETIME,
    `author_user_id` INTEGER NOT NULL,
    `target_event_id` INTEGER NOT NULL,
    PRIMARY KEY (`comment_id`),
    INDEX `comment_fi_add967` (`author_user_id`),
    INDEX `comment_fi_afb14a` (`target_event_id`),
    CONSTRAINT `comment_fk_add967`
        FOREIGN KEY (`author_user_id`)
        REFERENCES `user` (`user_id`),
    CONSTRAINT `comment_fk_afb14a`
        FOREIGN KEY (`target_event_id`)
        REFERENCES `event` (`event_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
