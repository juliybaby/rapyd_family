-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rapyd_family
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `families`
--

DROP TABLE IF EXISTS `families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_token` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_no` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timer` varchar(200) DEFAULT NULL,
  `lastdate_pay` varchar(200) DEFAULT NULL,
  `lastdate_time` varchar(200) DEFAULT NULL,
  `payment_status` varchar(200) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `creator_id` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `wallet_id` varchar(200) DEFAULT NULL,
  `b_name` varchar(100) DEFAULT NULL,
  `b_address` varchar(100) DEFAULT NULL,
  `b_email` varchar(100) DEFAULT NULL,
  `b_country` varchar(100) DEFAULT NULL,
  `b_city` varchar(100) DEFAULT NULL,
  `b_postcode` varchar(100) DEFAULT NULL,
  `b_account_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `b_state` varchar(100) DEFAULT NULL,
  `b_identification_type` varchar(100) DEFAULT NULL,
  `b_identification_value` varchar(100) DEFAULT NULL,
  `b_bic_swift` varchar(100) DEFAULT NULL,
  `b_ach_code` varchar(100) DEFAULT NULL,
  `b_beneficiary_country` varchar(100) DEFAULT NULL,
  `b_beneficiary_entity_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `families`
--

LOCK TABLES `families` WRITE;
/*!40000 ALTER TABLE `families` DISABLE KEYS */;
INSERT INTO `families` VALUES (14,'198aae1dc2d860e6e4e5b9e66c3a62a31625718940','John Miracle','user1@gmail.com','080','ee250e3f09ec2e78df4c9394ff297adc1625718940.png','Brother',NULL,'Thursday, July 8, 2021, 12:35 am','1625718940','00:00:00','00:00:00','Not Yet','00','6','Miracle','John','ewallet_09a26046002467c0b6db2ae95a82f750','John Miracle','456 Second Street','janedoe@rapyd.net','US','US','10101','BG96611020345678','US General Bank','NY','SSC','123456789','BUINBGSF','123456789','US','individual'),(15,'ca37d5ff0f4466ff34645b8918c159711625719007','Venus  Johnson','user2@gmail.com','0809999','c84eb73a0a275b00a73921301e40dd471625719007.png','Relations',NULL,'Thursday, July 8, 2021, 12:36 am','1625719007','00:00:00','00:00:00','Not Yet','00','6','Johnson','Venus ','ewallet_e864b5cd9fc04d2c25333d5a98593291','Venus  Johnson','456 Second Street','janedoe@rapyd.net','US','US','10101','BG96611020345678','US General Bank','NY','SSC','123456789','BUINBGSF','123456789','US','individual'),(16,'667051a278c4c7575bc35f0014f6bef91625719097','Brook Philip','user3@gmail.com','090','f87878d7c10dcfc9e7d1071cb5e912251625719097.png','Friends',NULL,'Thursday, July 8, 2021, 12:38 am','1625719097','00:00:00','00:00:00','Not Yet','00','6','Philip','Brook','ewallet_c0aa732d8bc940dd62b7bbbabd41f35e','Brook Philip','456 Second Street','janedoe@rapyd.net','US','US','10101','BG96611020345678','US General Bank','NY','SSC','123456789','BUINBGSF','123456789','US','individual');
/*!40000 ALTER TABLE `families` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payers_bankinfo`
--

DROP TABLE IF EXISTS `payers_bankinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payers_bankinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_description` varchar(100) DEFAULT NULL,
  `s_merchant_reference_id` varchar(100) DEFAULT NULL,
  `s_payout_currency` varchar(100) DEFAULT NULL,
  `s_payout_method_type` varchar(100) DEFAULT NULL,
  `s_name` varchar(100) DEFAULT NULL,
  `s_address` varchar(100) DEFAULT NULL,
  `s_city` varchar(100) DEFAULT NULL,
  `s_state` varchar(100) DEFAULT NULL,
  `s_date_of_birth` varchar(100) DEFAULT NULL,
  `s_postcode` varchar(100) DEFAULT NULL,
  `s_phonenumber` varchar(100) DEFAULT NULL,
  `s_remitter_account_type` varchar(100) DEFAULT NULL,
  `s_source_of_income` varchar(100) DEFAULT NULL,
  `s_identification_type` varchar(100) DEFAULT NULL,
  `s_identification_value` varchar(100) DEFAULT NULL,
  `s_purpose_code` varchar(100) DEFAULT NULL,
  `s_account_number` varchar(100) DEFAULT NULL,
  `s_beneficiary_relationship` varchar(100) DEFAULT NULL,
  `s_sender_country` varchar(100) DEFAULT NULL,
  `s_sender_currency` varchar(100) DEFAULT NULL,
  `s_sender_entity_type` varchar(100) DEFAULT NULL,
  `creator_id` varchar(100) DEFAULT NULL,
  `timing` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payers_bankinfo`
--

LOCK TABLES `payers_bankinfo` WRITE;
/*!40000 ALTER TABLE `payers_bankinfo` DISABLE KEYS */;
INSERT INTO `payers_bankinfo` VALUES (6,'Salary Payout to Employee Bank Account','GHY-0YU-HUJ-POI','USD','us_general_bank','John Doe','123 First Street','Anytown','NY','22/02/1980','12345','621212938122','Individual','Salary','License No','123456789','ABCDEFGHI','123456789','client','US','USD','Individual','6','1625718709','ok');
/*!40000 ALTER TABLE `payers_bankinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_rapyd`
--

DROP TABLE IF EXISTS `payment_rapyd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_rapyd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(200) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `department` varchar(30) DEFAULT NULL,
  `user_token` varchar(200) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `payout_id` varchar(200) DEFAULT NULL,
  `payout_status` varchar(20) DEFAULT NULL,
  `timing` varchar(30) DEFAULT NULL,
  `payment_type1` varchar(100) DEFAULT NULL,
  `payment_type2` varchar(100) DEFAULT NULL,
  `salary_amount` varchar(30) DEFAULT NULL,
  `month_date` varchar(50) DEFAULT NULL,
  `month_period` varchar(50) DEFAULT NULL,
  `data` varchar(50) DEFAULT NULL,
  `creator_id` varchar(50) DEFAULT NULL,
  `user_ewallet_id` varchar(200) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `amount_pay` varchar(100) DEFAULT NULL,
  `recipient_id` varchar(200) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_photo` varchar(100) DEFAULT NULL,
  `sender_relation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_rapyd`
--

LOCK TABLES `payment_rapyd` WRITE;
/*!40000 ALTER TABLE `payment_rapyd` DISABLE KEYS */;
INSERT INTO `payment_rapyd` VALUES (26,'ee250e3f09ec2e78df4c9394ff297adc1625718940.png','John Miracle','Brother','198aae1dc2d860e6e4e5b9e66c3a62a31625718940','14','payout_d78dc33e2906c5e1b54df56cf19e9b15','Created','1625719154','Disburse','Payout to Bank','200','7','2021-07-08',NULL,'6','ewallet_09a26046002467c0b6db2ae95a82f750','For Wedding Gifts','200','user1@gmail.com','Esedo Fredrick','good1625718184.png','0'),(27,'c84eb73a0a275b00a73921301e40dd471625719007.png','Venus  Johnson','Relations','ca37d5ff0f4466ff34645b8918c159711625719007','15','9a5f54b3-dfa6-11eb-b38b-02240218ee6d','PEN','1625719218','Wallet','Wallet Fund Transfer','180','7','2021-07-08',NULL,'6','ewallet_e864b5cd9fc04d2c25333d5a98593291','For Buying of Provisions for her up keeps','180','user2@gmail.com','Esedo Fredrick','good1625718184.png','0'),(28,'f87878d7c10dcfc9e7d1071cb5e912251625719097.png','Brook Philip','Friends','667051a278c4c7575bc35f0014f6bef91625719097','16','payout_a6100fdb5bc0eb2407310b5be22d1ca6','Completed','1625719269','Disburse','Payout to Bank','320','7','2021-07-09',NULL,'6','ewallet_c0aa732d8bc940dd62b7bbbabd41f35e','Buying of TextBooks for Departmental Course','320','user3@gmail.com','Esedo Fredrick','good1625718184.png','0'),(29,'f87878d7c10dcfc9e7d1071cb5e912251625719097.png','Brook Philip','Friends','667051a278c4c7575bc35f0014f6bef91625719097','16','d94febed-dfa6-11eb-b38b-02240218ee6d','CLO','1625719323','Wallet','Wallet Fund Transfer','400','7','2021-07-07',NULL,'6','ewallet_c0aa732d8bc940dd62b7bbbabd41f35e','Paying For School Fees','400','user3@gmail.com','Esedo Fredrick','good1625718184.png','0');
/*!40000 ALTER TABLE `payment_rapyd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updates_data_rapyd`
--

DROP TABLE IF EXISTS `updates_data_rapyd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `updates_data_rapyd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_fund_fund` varchar(50) DEFAULT NULL,
  `total_fund_spend` varchar(50) DEFAULT NULL,
  `total_employee` varchar(50) DEFAULT NULL,
  `total_fund_available` varchar(50) DEFAULT NULL,
  `creator_id` varchar(50) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `updates_data_rapyd`
--

LOCK TABLES `updates_data_rapyd` WRITE;
/*!40000 ALTER TABLE `updates_data_rapyd` DISABLE KEYS */;
INSERT INTO `updates_data_rapyd` VALUES (6,'4900','1100','3','0.0','6','0');
/*!40000 ALTER TABLE `updates_data_rapyd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `user_rank` varchar(200) DEFAULT NULL,
  `user_verified` varchar(200) DEFAULT NULL,
  `user_banned` varchar(200) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timer1` varchar(200) DEFAULT NULL,
  `timer2` varchar(200) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `phone_no` varchar(60) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `levels` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,NULL,'$2y$04$4jKXtysIj5.j/iXEz891b..RjKiu4WTPWpq1GDPReSEWppEPjeuf.','Esedo Fredrick','admin@gmail.com','good1625718184.png','SR','1','0','Thursday, July 8, 2021, 12:23 am','1625718184',NULL,'8932733789e14746226c3934e3c388421625718184',NULL,'080','SR','0','1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `wallet_id` varchar(200) DEFAULT NULL,
  `account_status` varchar(50) DEFAULT NULL,
  `ewallet_reference_id` varchar(150) DEFAULT NULL,
  `timing` varchar(50) DEFAULT NULL,
  `fund` varchar(50) DEFAULT NULL,
  `fund_time` varchar(50) DEFAULT NULL,
  `creator_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (29,'+14155551234','','Esedo1','Fredrick','ewallet_935a7d00c2e0b3c87df5f79aca0d6728','ACT','Fredrick-Esedo1-1625718563-myapp','1625718563','1520','00:00:00','6'),(30,'+14155551234','','Fredrick2','Esedo2','ewallet_f7f93b2111414ab8abd34e05fc0db856','ACT','Esedo2-Fredrick2-1625718585-myapp','1625718585','2280','00:00:00','6');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rapyd_family'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-08  5:49:04
