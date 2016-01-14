-- MySQL dump 10.16  Distrib 10.1.8-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: myapp
-- ------------------------------------------------------
-- Server version	10.1.8-MariaDB

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
-- Current Database: `myapp`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `myapp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `myapp`;

--
-- Table structure for table `depts`
--

DROP TABLE IF EXISTS `depts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depts` (
  `id` int(11) DEFAULT NULL,
  `head` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depts`
--

LOCK TABLES `depts` WRITE;
/*!40000 ALTER TABLE `depts` DISABLE KEYS */;
/*!40000 ALTER TABLE `depts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty_results`
--

DROP TABLE IF EXISTS `faculty_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `evtype` varchar(60) NOT NULL,
  `evaluator` int(11) DEFAULT NULL,
  `toevaluate` int(11) DEFAULT NULL,
  `tcompetencies` float(7,4) DEFAULT '0.0000',
  `eattitude` float(7,4) DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `FK_faculty_a` (`evaluator`),
  KEY `FK_faculty_b` (`toevaluate`),
  CONSTRAINT `FK_faculty_a` FOREIGN KEY (`evaluator`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_faculty_b` FOREIGN KEY (`toevaluate`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty_results`
--

LOCK TABLES `faculty_results` WRITE;
/*!40000 ALTER TABLE `faculty_results` DISABLE KEYS */;
INSERT INTO `faculty_results` VALUES (1,1516,'self',1,1,30.0000,50.0000),(2,1516,'self',2,2,0.0000,0.0000),(3,1516,'self',3,3,0.0000,0.0000),(4,1516,'self',4,4,0.0000,0.0000),(5,1516,'subtohead',1,9,0.0000,0.0000),(6,1516,'headtosub',9,1,0.0000,0.0000),(7,1516,'subtohead',2,9,0.0000,0.0000),(8,1516,'headtosub',9,2,0.0000,0.0000);
/*!40000 ALTER TABLE `faculty_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `per` int(11) NOT NULL,
  `qtext` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'eval1','LP',10,'Brought lesson plans to class'),(2,'eval1','LP',10,'Lesson plans were checked.'),(3,'eval1','LP',10,'Lesson plans were updated.'),(4,'eval1','IP',35,'Communicates to the students lesson objective/s including the concept/s they will talk about and the product/s that will show understanding'),(5,'eval1','IP',35,'The lesson motivation engages students and transitions smoothly to the learning activities in the procedure.'),(6,'eval1','IP',35,'Teacher shows clear understanding of and presents accurate content.'),(7,'eval1','IP',35,'Uses planned questions; TIEL components are evident in the lesson discussion'),(8,'eval1','IP',35,'Provides activities and/or questions that require students to think and reason critically/analytically'),(9,'eval1','IP',35,'Questions and activities are presented systematically and lead to the attainment of lesson objective/s.'),(10,'eval1','IP',35,'Employs creative teaching styles and methodologies such as \"turn and talk, partner share, call a friend, small group discussions, etc. to facilitate discussion\"'),(11,'eval1','IP',35,'Calls on students fairly using sufficient wait time'),(12,'eval1','IP',35,'Uses effective instructional audio visual materials (pictures, photos, readings, art, music, diagrams, and others) and/or technology to facilitate student learning'),(13,'eval1','IP',35,'Facilitates discussion of the subject matter and helps the students connect their lesson to their  experiences and previous lessons learned'),(14,'eval1','IP',35,'Models work/task students are to do and involves students in setting criteria for their work/task during the guided practice'),(15,'eval1','IP',35,'Assists students in summarizing/forming generalization about the lesson and self-evaluating work'),(16,'eval1','IP',35,'Shows ability to adjust lessons/strategies to respond to unforeseen situations'),(17,'eval1','IP',35,'Differentiates activities to address varied learner types'),(18,'eval1','CA',15,'Well-groomed'),(19,'eval1','CA',15,'Portrays/uses refined manners and language'),(20,'eval1','CA',15,'Uses prescribed medium of instruction with proficiency and when necessary, uses appropriate language to get the message across'),(21,'eval1','CA',15,'Speaks clearly in well modulated voice'),(22,'eval1','CA',15,'Encourages children to participate, show interest and enthusiasm for activities, and exceed their own expectations'),(23,'eval1','CA',15,'Provides opportunity for the students to clarify their understanding of the concepts/ideas taken up'),(24,'eval1','CM',15,'Secures/prepares needed materials before class'),(25,'eval1','CM',15,'Maintains order and discipline'),(26,'eval1','CM',15,'Commands respect of the students'),(27,'eval1','CM',15,'Employs systematic procedures for routine class activities like greeting the teacher, arranging chairs, picking up pieces of paper, getting attention after turn and talk or small group discussion.'),(28,'eval1','SP',20,'The class is attentive.'),(29,'eval1','SP',20,'Students are active and engaged with the different learning tasks.'),(30,'eval1','SP',20,'Students are able to share their ideas and ask questions.'),(31,'eval1','SP',20,'Students were able to accomplish the set objectives.'),(32,'eval1','PG',5,'Pursues graduate studies'),(33,'eval1','PG',5,'Attends seminars, workshops, conferences and other training programs'),(34,'eval1','PG',5,'Shares learnings with co-workers by conducting echo-seminars, workshops and other trainings'),(35,'eval1','PG',5,'Reads professional books and other materials'),(36,'eval2','TLR',35,'Treats students fairly'),(37,'eval2','TLR',35,'Is willing to help students in and out of the classroom'),(38,'eval2','TLR',35,'Supervises students in and out of the classroom settings (checks grooming, attire, behavior during assemblies, programs, recess, lunch, etc.)'),(39,'eval2','TLR',35,'Tries to help students with problematic behaviors by finding out causes of problems and referring cases to proper school authorities '),(40,'eval2','PWE',35,'Friendly, approachable and commands respect'),(41,'eval2','PWE',35,'Observes professionalism in dealing with students, parents, and co-workers'),(42,'eval2','PWE',35,'Is considerate of others in the use of school facilities (faculty room, comfort rooms, etc.) and materials such as books, projectors, etc.'),(43,'eval2','PWE',35,'Relates positively and respectfully with peers, administrators, supervisors and other members of  the school staff'),(44,'eval2','PWE',35,'Shares ideas and resources with others'),(45,'eval2','PWE',35,'Submits well-written (in accordance with defined standards) and accurate (no errors) lesson plans, syllabus, examination drafts, grades, etc. and other requirements'),(46,'eval2','PWE',35,'Willingly accepts reasonable assignments given'),(47,'eval2','PWE',35,'Shows initiative by volunteering for extra work when necessary  and/or assuming other tasks more than what is assigned'),(48,'eval2','PWE',35,'Participates actively in group decision-making process (departmental or monthly personnel  meetings, etc.)'),(49,'eval2','CD',15,'Participates/leads during prayers and other spiritual exercises'),(50,'eval2','CD',15,'Instills moral and spiritual values by example and by teaching'),(51,'eval2','CD',15,'Shows integrity and fairness in dealing with others'),(52,'eval2','SC',15,'Allots time for consultation with parents and other concerned community members'),(53,'eval2','SC',15,'Shows willingness to participate in activities that concern the school and the community'),(54,'eval3','AP',30,'syllabi/course outline/scope and sequence charts'),(55,'eval3','AP',30,'lesson plans'),(56,'eval3','AP',30,'test questions / table of specifications'),(57,'eval3','AP',30,'grading sheets'),(58,'eval3','AP',30,'class records'),(59,'eval3','AP',30,'permanent records'),(60,'eval3','AP',30,'journal'),(61,'eval3','AP',30,'school register'),(62,'eval3','AP',30,'seminar evaluation'),(63,'eval3','AP',30,'portfolio'),(64,'eval3','AP',30,'product of instruction'),(65,'eval3','AP',30,'reporting to school daily'),(66,'eval3','AP',30,'attending meetings (department, subject area,  monthly personnel, committee meetings, etc.)'),(67,'eval3','AP',30,'reporting for special school activities (PTC, programs, etc.)'),(68,'eval3','AP',30,'in service trainings/programs'),(69,'eval3','AP',30,'Starts and ends classes on time'),(70,'eval3','AP',30,'Is present in school when expected (in service trainings/programs, special school programs/activities)'),(71,'eval3','AP',30,'Is present for all classes handled'),(72,'eval3','AP',30,'Is present in meetings (deparment meetings, subject area,general faculty, committee, etc.)');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results_sts`
--

DROP TABLE IF EXISTS `results_sts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results_sts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `evtype` varchar(60) NOT NULL,
  `evaluator` int(11) NOT NULL,
  `evaluee` int(11) NOT NULL,
  `tcompetency` float(7,4) DEFAULT '0.0000',
  `eattitude` float(7,4) DEFAULT '0.0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results_sts`
--

LOCK TABLES `results_sts` WRITE;
/*!40000 ALTER TABLE `results_sts` DISABLE KEYS */;
/*!40000 ALTER TABLE `results_sts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `section` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `adviser` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachcomp`
--

DROP TABLE IF EXISTS `teachcomp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachcomp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) unsigned NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachcomp`
--

LOCK TABLES `teachcomp` WRITE;
/*!40000 ALTER TABLE `teachcomp` DISABLE KEYS */;
INSERT INTO `teachcomp` VALUES (1,10,'Lesson Planning'),(2,0,'Brought lesson plans to class'),(3,0,'Lesson plans were checked.'),(4,0,'Lesson plans were updated.'),(5,35,'Instructional Procedure'),(6,0,'Communicates to the students lesson objective/s including the concept/s they will talk about and the product/s that will show understanding'),(7,0,'The lesson motivation engages students and transitions smoothly to the learning activities in the procedure.'),(8,0,'Teacher shows clear understanding of and presents accurate content.'),(9,0,'Uses planned questions; TIEL components are evident in the lesson discussion'),(10,0,'Provides activities and/or questions that require students to think and reason critically/analytically'),(11,0,'Questions and activities are presented systematically and lead to the attainment of lesson objective/s.'),(12,0,'Employs creative teaching styles and methodologies such as \"turn and talk, partner share, call a friend, small group discussions, etc. to facilitate discussion\"'),(13,0,'Calls on students fairly using sufficient wait time'),(14,0,'Uses effective instructional audio visual materials (pictures, photos, readings, art, music, diagrams, and others) and/or technology to facilitate student learning'),(15,0,'Facilitates discussion of the subject matter and helps the students connect their lesson to their  experiences and previous lessons learned'),(16,0,'Models work/task students are to do and involves students in setting criteria for their work/task during the guided practice'),(17,0,'Assists students in summarizing/forming generalization about the lesson and self-evaluating work'),(18,0,'Shows ability to adjust lessons/strategies to respond to unforeseen situations'),(19,0,'Differentiates activities to address varied learner types'),(20,15,'Communication and Appearance'),(21,0,'Well-groomed'),(22,0,'Portrays/uses refined manners and language'),(23,0,'Uses prescribed medium of instruction with proficiency and when necessary, uses appropriate language to get the message across'),(24,0,'Speaks clearly in well modulated voice'),(25,0,'Encourages children to participate, show interest and enthusiasm for activities, and exceed their own expectations'),(26,0,'Provides opportunity for the students to clarify their understanding of the concepts/ideas taken up'),(27,15,'Classroom Management'),(28,0,'Secures/prepares needed materials before class'),(29,0,'Maintains order and discipline'),(30,0,'Commands respect of the students'),(31,0,'Employs systematic procedures for routine class activities like greeting the teacher, arranging chairs, picking up pieces of paper, getting attention after turn and talk or small group discussion.'),(32,20,'Student Participation'),(33,0,'The class is attentive.'),(34,0,'Students are active and engaged with the different learning tasks.'),(35,0,'Students are able to share their ideas and ask questions.'),(36,0,'Students were able to accomplish the set objectives.'),(37,5,'Professional Growth'),(38,0,'Pursues graduate studies'),(39,0,'Attends seminars, workshops, conferences and other training programs'),(40,0,'Shares learnings with co-workers by conducting echo-seminars, workshops and other trainings'),(41,0,'Reads professional books and other materials');
/*!40000 ALTER TABLE `teachcomp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logid` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `utype` varchar(10) NOT NULL,
  `activation` tinyint(1) DEFAULT '0',
  `dept` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sallymorganq0003','sally_hendrix_morgan','81dc9bdb52d04dc20036dbd8313ed055','faculty',1,'english'),(2,'suzannemorganq0004','suzanne_hendrix_morgan',NULL,'faculty',0,'english'),(3,'arielleroyq0005','ariel_ross_leroy',NULL,'faculty',0,'drama'),(4,'ronaldcalvinq0006','ronald_bumgarner_calvin',NULL,'faculty',0,'math'),(5,'jeremyfisherq0007','jeremy_fox_fisher',NULL,'student',0,''),(6,'hubertdaleq0008','hubert_comber_dale',NULL,'student',0,''),(7,'margaretbaxterq0009','margaret_stuart_baxter',NULL,'student',0,''),(8,'michaelmeyersq0010','michael_grimm_meyers',NULL,'student',0,''),(9,'elizagordonq0011','eliza_smith_gordon',NULL,'head',0,'english'),(10,'clarklancaster1234','clark_powers_lancaster',NULL,'admin',0,''),(11,'justinflores1234','justin_cornelio_flores','63a9f0ea7bb98050796b649e85481845','admin',1,'');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-10 20:58:23
