-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: ipay_db
-- ------------------------------------------------------
-- Server version	5.5.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_formula_keywords`
--

DROP TABLE IF EXISTS `app_formula_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_formula_keywords` (
  `app_fkey_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_fkey_name` varchar(100) NOT NULL,
  `psa_id` int(11) DEFAULT NULL,
  `tatble_id` int(11) DEFAULT NULL,
  `cfhead_id` int(11) DEFAULT NULL,
  `leave_id` int(11) DEFAULT NULL,
  `app_fkey_isactive` int(11) NOT NULL DEFAULT '0',
  `app_fkey_query` text,
  `app_fkey_vars` text,
  `app_fkey_result` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`app_fkey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_formula_keywords`
--

LOCK TABLES `app_formula_keywords` WRITE;
/*!40000 ALTER TABLE `app_formula_keywords` DISABLE KEYS */;
INSERT INTO `app_formula_keywords` VALUES (1,'Base Amount',0,0,NULL,NULL,1,'SELECT ben_amount FROM emp_benefits WHERE ben_suspend != \'1\' and psa_id=? and emp_id=? and ben_startdate <= ? \r\nand IF(ben_enddate=\'0000-00-00\',ben_enddate <= ?,ben_enddate >= ?)','array($psa_id, $emp_id, date(\"Y-m-d\"),date(\"Y-m-d\"), date(\"Y-m-d\"))','ben_amount'),(2,'Monthly Rate',0,0,NULL,NULL,0,NULL,NULL,NULL),(3,'Weekly Rate',0,0,NULL,NULL,0,NULL,NULL,NULL),(4,'Daily Rate',0,0,NULL,NULL,0,NULL,NULL,NULL),(5,'Hourly Rate',0,0,NULL,NULL,0,NULL,NULL,NULL),(6,'No Pay Leave',0,1,NULL,NULL,1,'SELECT emp_tarec_nohrday FROM ta_emp_rec WHERE tatbl_id=? AND emp_id=? AND paystub_id=?','array(1,$emp_id,$paystub_id)','emp_tarec_nohrday'),(7,'Late',0,3,NULL,NULL,1,'SELECT emp_tarec_nohrday FROM ta_emp_rec WHERE tatbl_id=? AND emp_id=? AND paystub_id=?','array(3,$emp_id,$paystub_id)','emp_tarec_nohrday'),(8,'Undertime',0,4,NULL,NULL,1,'SELECT emp_tarec_nohrday FROM ta_emp_rec WHERE tatbl_id=? AND emp_id=? AND paystub_id=?','array(4,$emp_id,$paystub_id)','emp_tarec_nohrday'),(9,'Working Days',0,5,NULL,NULL,1,'SELECT emp_tarec_nohrday FROM ta_emp_rec WHERE tatbl_id=? AND emp_id=? AND payperiod_id=?','array(5,$emp_id,$payperiod_id)','emp_tarec_nohrday'),(10,'Custom Days',0,6,NULL,NULL,1,'SELECT emp_tarec_nohrday FROM ta_emp_rec WHERE tatbl_id=? AND emp_id=? AND paystub_id=?','array(6,$emp_id,$paystub_id)','emp_tarec_nohrday'),(11,'W/H Tax',8,0,NULL,NULL,0,NULL,NULL,NULL),(12,'SSS',7,0,NULL,NULL,0,NULL,NULL,NULL),(13,'PHIC',14,0,NULL,NULL,0,NULL,NULL,NULL),(14,'HDMF',15,0,NULL,NULL,0,NULL,NULL,NULL),(15,'Basic Pay',1,0,NULL,NULL,1,'select amount from z_formula_temp where psa_id=? and paystub_id=?','array(1,$paystub_id)','amount'),(16,'Net Pay',5,0,NULL,NULL,0,NULL,NULL,NULL),(17,'COLA',39,0,NULL,NULL,0,NULL,NULL,NULL),(18,'Employer Total Contributions',6,0,NULL,NULL,0,NULL,NULL,NULL),(19,'Total Deductions',2,0,NULL,NULL,0,NULL,NULL,NULL),(20,'Overtime',0,0,NULL,NULL,0,NULL,NULL,NULL),(21,'Total TA',17,0,NULL,NULL,0,NULL,NULL,NULL),(22,'Other Statutory Income',25,0,NULL,NULL,0,NULL,NULL,NULL),(23,'OtherStat&TaxIncome',26,0,NULL,NULL,0,NULL,NULL,NULL),(24,'Statutory Contrib',27,0,NULL,NULL,0,NULL,NULL,NULL),(25,'Other Taxable Income',28,0,NULL,NULL,0,NULL,NULL,NULL),(26,'Other Taxable Deduction',29,0,NULL,NULL,0,NULL,NULL,NULL),(27,'Taxable Income Gross',30,0,NULL,NULL,0,NULL,NULL,NULL),(28,'NonTaxable Income',31,0,NULL,NULL,0,NULL,NULL,NULL),(29,'Other Deduction',32,0,NULL,NULL,0,NULL,NULL,NULL),(30,'Other Statutory Deduction',33,0,NULL,NULL,0,NULL,NULL,NULL),(31,'Other Stat & Tax Deduction',34,0,NULL,NULL,0,NULL,NULL,NULL),(32,'Total Gross',4,0,NULL,NULL,0,NULL,NULL,NULL),(33,'Hours Per Day',0,0,NULL,NULL,1,'select fr_hrperday from factor_rate a inner join payroll_comp b on (b.fr_id=a.fr_id) where emp_id=?','array($emp_id)','fr_hrperday'),(34,'Days Per Week',0,0,NULL,NULL,1,'select fr_dayperweek from factor_rate a inner join payroll_comp b on (b.fr_id=a.fr_id) where emp_id=?','array($emp_id)','fr_dayperweek'),(35,'Days Per Year',0,0,NULL,NULL,1,'select fr_dayperyear from factor_rate a inner join payroll_comp b on (b.fr_id=a.fr_id) where emp_id=?','array($emp_id)','fr_dayperyear'),(36,'Hours Per Week',0,0,NULL,NULL,1,'select fr_hrperweek from factor_rate a inner join payroll_comp b on (b.fr_id=a.fr_id) where emp_id=?','array($emp_id)','fr_hrperweek');
/*!40000 ALTER TABLE `app_formula_keywords` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-17 13:11:20
