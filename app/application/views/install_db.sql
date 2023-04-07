-- create admin
CREATE TABLE 'admin' (
  'sn' int(11) NOT NULL AUTO_INCREMENT,
  'user_id' varchar(50) CHARACTER SET latin1 NOT NULL,
  'full_name' varchar(255) CHARACTER SET latin1 NOT NULL,
  'user_name' varchar(100) CHARACTER SET latin1 NOT NULL,
  'email' varchar(100) CHARACTER SET latin1 NOT NULL,
  'passwrd' varchar(100) CHARACTER SET latin1 NOT NULL,
  'sex' varchar(10) CHARACTER SET latin1 NOT NULL,
  'country' varchar(50) CHARACTER SET latin1 NOT NULL,
  'state' varchar(50) CHARACTER SET latin1 NOT NULL,
  'phone_no' varchar(20) CHARACTER SET latin1 NOT NULL,
  'bank_name' varchar(50) CHARACTER SET latin1 NOT NULL,
  'acc_name' varchar(100) CHARACTER SET latin1 NOT NULL,
  'acc_type' varchar(20) CHARACTER SET latin1 NOT NULL,
  'acc_no' varchar(20) CHARACTER SET latin1 NOT NULL,
  'email_v_link' varchar(255) CHARACTER SET latin1 NOT NULL,
  'is_email_verified' varchar(10) CHARACTER SET latin1 NOT NULL,
  'passwrd_rest_link' varchar(255) CHARACTER SET latin1 NOT NULL,
  'status' int(11) NOT NULL,
  'ref_id' varchar(50) CHARACTER SET latin1 NOT NULL,
  'admin_id' varchar(20) CHARACTER SET latin1 NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  'others' varchar(255) CHARACTER SET latin1 NOT NULL,
  'login_key' varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY ('sn'),
  UNIQUE KEY 'user_id' ('user_id'),
  UNIQUE KEY 'email' ('email'),
  UNIQUE KEY 'user_name' ('user_name')
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE 'package' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'type' int(11) NOT NULL,
  'currency' varchar(255) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY ('id'),
  UNIQUE KEY 'type' ('type')
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE 'system_admin' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'email' varchar(255) NOT NULL,
  'passwrd' varchar(255) NOT NULL,
  'login_key' varchar(255) NOT NULL,
  'pass_reset' varchar(255) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY ('id'),
  UNIQUE KEY 'email' ('email') USING BTREE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE 'system_info' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'currency' varchar(20) NOT NULL,
  'percentage' int(11) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY ('id'),
  UNIQUE KEY 'currency' ('currency'),
  UNIQUE KEY 'percentage' ('percentage')
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE 'transaction' (
  'sn' int(20) NOT NULL AUTO_INCREMENT,
  'txn_id' varchar(50) NOT NULL,
  'amount' int(11) NOT NULL,
  'sender_id' varchar(50) NOT NULL,
  'receiver_id' varchar(50) NOT NULL,
  'date_created' varchar(20) NOT NULL,
  'start_time' int(11) NOT NULL,
  'elapse_time' int(11) NOT NULL,
  'txn_status' int(2) NOT NULL,
  'activate_user' varchar(2) NOT NULL,
  'pop' varchar(255) NOT NULL,
  'type' varchar(255) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY ('sn'),
  UNIQUE KEY 'txn_id' ('txn_id');
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE 'user' (
  'sn' int(11) NOT NULL AUTO_INCREMENT,
  'user_id' varchar(50) NOT NULL,
  'full_name' varchar(255) NOT NULL,
  'user_name' varchar(100) NOT NULL,
  'email' varchar(100) NOT NULL,
  'passwrd' varchar(100) NOT NULL,
  'sex' varchar(10) NOT NULL,
  'country' varchar(50) NOT NULL,
  'state' varchar(50) NOT NULL,
  'phone_no' varchar(20) NOT NULL,
  'bank_name' varchar(50) NOT NULL,
  'acc_name' varchar(100) NOT NULL,
  'acc_type' varchar(20) NOT NULL,
  'acc_no' varchar(20) NOT NULL,
  'email_v_link' varchar(255) NOT NULL,
  'is_email_verified' varchar(10) NOT NULL,
  'passwrd_rest_link' varchar(255) NOT NULL,
  'status' int(11) NOT NULL,
  'ref_id' varchar(50) NOT NULL,
  'admin_id' varchar(20) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp(),
  'others' varchar(255) NOT NULL,
  'login_key' varchar(255) NOT NULL,
  PRIMARY KEY ('sn'),
  UNIQUE KEY 'user_id' ('user_id'),
  UNIQUE KEY 'user_name' ('user_name'),
  UNIQUE KEY 'email' ('email')
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


CREATE TABLE 'user_investment_pack' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'user_id' varchar(50) NOT NULL,
  'package_id' int(3) NOT NULL,
  'package_type' int(11) NOT NULL,
  'date' timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY ('id'),
  UNIQUE KEY 'user_id' ('user_id')
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'user investment package';
