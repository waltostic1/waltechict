
--[ CREATE TABLE `tbl_admin`]--
CREATE TABLE `tbl_admin`(
    `ad_id` INT NOT NULL AUTO_INCREMENT,
    `ad_email` VARCHAR(100) NOT NULL,
    `ad_password` VARCHAR(100) NOT NULL,
    `ad_password_reset_link` VARCHAR(100) NOT NULL,
    `ad_email_verification_link` VARCHAR(100) NOT NULL,
    `ad_login_token` VARCHAR(100) NOT NULL,
    `ad_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`ad_id`),
    UNIQUE(`ad_email`)
) ENGINE = INNODB;


-- [ create package table "tbl_package"]--
CREATE TABLE `tbl_package`(
    `pkg_id` INT NOT NULL AUTO_INCREMENT,
    `pkg_name` VARCHAR(50) NOT NULL,
    `pkg_min_amount` INT NOT NULL,
    `pkg_max_amount` INT NOT NULL,
    `pkg_due_day` INT NOT NULL,
    `pkg_percentage` INT NOT NULL,
    `pkg_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`pkg_id`),
    UNIQUE(`pkg_name`),
    UNIQUE(`pkg_min_amount`),
    UNIQUE(`pkg_max_amount`)
) ENGINE = INNODB;

-- [ create cryptocurrency table "tbl_cryptocurrency"]--
CREATE TABLE `tbl_cryptocurrency`(
    `c_id` INT NOT NULL AUTO_INCREMENT,
    `c_name` VARCHAR(255) NOT NULL,
    `c_logo` VARCHAR(255) NOT NULL,
    `c_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`c_id`),
    UNIQUE(`c_id`, `c_name`),
    UNIQUE(`c_logo`)
) ENGINE = INNODB;

CREATE TABLE `tbl_user_cryptocurrency`(
    `uc_id` INT NOT NULL AUTO_INCREMENT,
    `uc_user_id` INT NOT NULL,
    `uc_username` VARCHAR(100) NOT NULL,
    `uc_bitcoin_address` VARCHAR(255) NOT NULL,
    `uc_ethereum_address` VARCHAR(255) NOT NULL,
    `uc_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`uc_id`)
) ENGINE = INNODB;

CREATE TABLE `tbl_admin_cryptocurrency`(
    `ac_id` INT NOT NULL AUTO_INCREMENT,
    `ac_admin_id` INT NOT NULL,
    `ac_admin_email` VARCHAR(100) NOT NULL,
    `ac_bitcoin_address` VARCHAR(255) NOT NULL,
    `ac_ethereum_address` VARCHAR(255) NOT NULL,
    `ac_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`ac_id`)
) ENGINE = INNODB;

ALTER TABLE `tbl_admin_cryptocurrency` ADD `ac_cryptoname_address` VARCHAR NOT NULL AFTER `ac_date`; 

-- [ create user table "tbt_user"]--
CREATE TABLE `tbl_user`(
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `ref_id` VARCHAR(10) NOT NULL,
    `ref_username` VARCHAR(50) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `total_amount` VARCHAR(11) NOT NULL,
    `country` VARCHAR(50) NOT NULL,
    `state` VARCHAR(50) NOT NULL,
    `keep_me_login` VARCHAR(255) NOT NULL,
    `photo` VARCHAR(255) NOT NULL,
    `login_token` VARCHAR(255) NOT NULL,
    `status` VARCHAR(20) NOT NULL,
    `password_reset` VARCHAR(255) NOT NULL,
    `email_verification` VARCHAR(255) NOT NULL,
    `date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`user_id`),
    UNIQUE(`username`)
) ENGINE = INNODB;

