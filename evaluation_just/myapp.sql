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
-- Table structure for table `apunctuality`
--

DROP TABLE IF EXISTS `apunctuality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apunctuality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) unsigned DEFAULT '0',
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apunctuality`
--

LOCK TABLES `apunctuality` WRITE;
/*!40000 ALTER TABLE `apunctuality` DISABLE KEYS */;
/*!40000 ALTER TABLE `apunctuality` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `eattitude`
--

DROP TABLE IF EXISTS `eattitude`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eattitude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) unsigned DEFAULT '0',
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eattitude`
--

LOCK TABLES `eattitude` WRITE;
/*!40000 ALTER TABLE `eattitude` DISABLE KEYS */;
INSERT INTO `eattitude` VALUES (1,35,'Teacher-Learner Relationship'),(2,0,'Treats students fairly'),(3,0,'Is willing to help students in and out of the classroom'),(4,0,'Supervises students in and out of the classroom settings (checks grooming, attire, behavior during assemblies, programs, recess, lunch, etc.)'),(5,0,'Tries to help students with problematic behaviors by finding out causes of problems and referring cases to proper school authorities '),(6,35,' Personality and Work Ethics'),(7,0,'Friendly, approachable and commands respect'),(8,0,'Observes professionalism in dealing with students, parents, and co-workers'),(9,0,'Is considerate of others in the use of school facilities (faculty room, comfort rooms, etc.) and materials such as books, projectors, etc.'),(10,0,'Relates positively and respectfully with peers, administrators, supervisors and other members of  the school staff'),(11,0,'Shares ideas and resources with others'),(12,0,'Submits well-written (in accordance with defined standards) and accurate (no errors) lesson plans, syllabus, examination drafts, grades, etc. and other requirements'),(13,0,'Willingly accepts reasonable assignments given'),(14,0,'Shows initiative by volunteering for extra work when necessary  and/or assuming other tasks more than what is assigned'),(15,0,'Participates actively in group decision-making process (departmental or monthly personnel  meetings, etc.)'),(16,15,'Christian Dimension'),(17,0,'Participates/leads during prayers and other spiritual exercises'),(18,0,'Instills moral and spiritual values by example and by teaching'),(19,0,'Shows integrity and fairness in dealing with others'),(20,15,'School and Community'),(21,0,'Allots time for consultation with parents and other concerned community members'),(22,0,'Shows willingness to participate in activities that concern the school and the community');
/*!40000 ALTER TABLE `eattitude` ENABLE KEYS */;
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
INSERT INTO `faculty_results` VALUES (1,1516,'self',1,1,10.0000,35.0000),(2,1516,'self',2,2,0.0000,0.0000),(3,1516,'self',3,3,0.0000,0.0000),(4,1516,'self',4,4,0.0000,0.0000),(5,1516,'subtohead',1,9,0.0000,35.0000),(6,1516,'headtosub',9,1,0.0000,0.0000),(7,1516,'subtohead',2,9,0.0000,0.0000),(8,1516,'headtosub',9,2,0.0000,0.0000);
/*!40000 ALTER TABLE `faculty_results` ENABLE KEYS */;
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `section` varchar(60) DEFAULT NULL,
  `subj` varchar(70) DEFAULT NULL,
  `subjteacher` varchar(60) DEFAULT NULL,
  `facultykey` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1516,'section 1 grade 6','english','sally hendrix morgan',NULL),(2,1516,'section 1 grade 6','math','ronald bumgarner calvin',NULL),(3,1516,'section 1 grade 6','drama','ariel ross leroy',NULL),(4,1516,'section 2 grade 6','english','suzanne hendrix morgan',NULL),(5,1516,'section 2 grade 6','math','ronald bumgarner calvin',NULL),(6,1516,'section 2 grade 6','drama','ariel ross leroy',NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `st_evaluation`
--

DROP TABLE IF EXISTS `st_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) DEFAULT '0',
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `st_evaluation`
--

LOCK TABLES `st_evaluation` WRITE;
/*!40000 ALTER TABLE `st_evaluation` DISABLE KEYS */;
INSERT INTO `st_evaluation` VALUES (1,30,'Teaching Skill'),(2,0,'The instructor expresses clear expectations for my learning and performance in this class.'),(3,0,'The instructor clearly explains concepts.'),(4,0,'The instructor clarifies areas of confusion.'),(5,0,'The instructor uses effective teaching methods that enhance my learning.'),(6,0,'The instructor encourages me to raise questions or make comments.'),(7,0,'The instructor is well organized and prepared.'),(8,0,'The instructor challenges me to think.'),(9,0,'The instructor is available on an individual basis outside of class when I request it.'),(10,0,'The instructor uses technology effectively to advance my learning.'),(11,0,'The instructor contributes to improving my learning.'),(12,15,'Motivation and Encouragement'),(13,0,'I attend class regularly.'),(14,0,'I come to class prepared.'),(15,0,'I actively participate in discussions and projects.'),(16,0,'I have put a great deal of effort into advancing my learning in this course.'),(17,0,'In this course, I have been challenged to learn more than I expected.'),(18,0,'I am working up to my potential in this course.'),(19,0,'I have made my best effort to participate in this course.'),(20,30,'Outcome'),(21,0,'I have learned a lot in this class.'),(22,0,'This class has increased my interest in this field of study.'),(23,0,'The instructor shows respect and concern for students.'),(24,0,'I believe that what I am being asked to learn in this course is important.'),(25,25,'Effectiveness of Methods'),(26,0,'The assignments in this course have enhanced my learning.'),(27,0,'The tests accurately assess what I have learned in this course.'),(28,0,'The instructor has high standards for achievement in this class.'),(29,0,'The instructor provides clear evaluation criteria.'),(30,0,'The instructor grades consistently with the evaluation criteria.'),(31,0,'The assignments are returned quickly enough to benefit my learning.'),(32,0,'The exam results are returned quickly enough to benefit my learning.'),(33,0,'The feedback I have received on my work has enhanced my learning.');
/*!40000 ALTER TABLE `st_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_results`
--

DROP TABLE IF EXISTS `student_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `studentkey` int(11) NOT NULL,
  `subj` varchar(100) DEFAULT NULL,
  `subjteacher` varchar(60) DEFAULT NULL,
  `facultykey` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_results`
--

LOCK TABLES `student_results` WRITE;
/*!40000 ALTER TABLE `student_results` DISABLE KEYS */;
INSERT INTO `student_results` VALUES (1,1516,5,'english','sally hendrix morgan',NULL),(2,1516,5,'math','ronald bumgarner calvin',NULL),(3,1516,5,'drama','ariel ross leroy',NULL),(4,1516,6,'english','sally hendrix morgan',NULL),(5,1516,6,'math','ronald bumgarner calvin',NULL),(6,1516,6,'drama','ariel ross leroy',NULL),(7,1516,7,'english','suzanne hendrix morgan',NULL),(8,1516,7,'math','ronald bumgarner calvin',NULL),(9,1516,7,'drama','ariel ross leroy',NULL),(10,1516,8,'english','suzanne hendrix morgan',NULL),(11,1516,8,'math','ronald bumgarner calvin',NULL),(12,1516,8,'drama','ariel ross leroy',NULL);
/*!40000 ALTER TABLE `student_results` ENABLE KEYS */;
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
-- Table structure for table `tcompetencies`
--

DROP TABLE IF EXISTS `tcompetencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tcompetencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) unsigned NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tcompetencies`
--

LOCK TABLES `tcompetencies` WRITE;
/*!40000 ALTER TABLE `tcompetencies` DISABLE KEYS */;
INSERT INTO `tcompetencies` VALUES (1,10,'Lesson Planning'),(2,0,'Brought lesson plans to class'),(3,0,'Lesson plans were checked.'),(4,0,'Lesson plans were updated.'),(5,35,'Instructional Procedure'),(6,0,'Communicates to the students lesson objective/s including the concept/s they will talk about and the product/s that will show understanding'),(7,0,'The lesson motivation engages students and transitions smoothly to the learning activities in the procedure.'),(8,0,'Teacher shows clear understanding of and presents accurate content.'),(9,0,'Uses planned questions; TIEL components are evident in the lesson discussion'),(10,0,'Provides activities and/or questions that require students to think and reason critically/analytically'),(11,0,'Questions and activities are presented systematically and lead to the attainment of lesson objective/s.'),(12,0,'Employs creative teaching styles and methodologies such as \"turn and talk, partner share, call a friend, small group discussions, etc. to facilitate discussion\"'),(13,0,'Calls on students fairly using sufficient wait time'),(14,0,'Uses effective instructional audio visual materials (pictures, photos, readings, art, music, diagrams, and others) and/or technology to facilitate student learning'),(15,0,'Facilitates discussion of the subject matter and helps the students connect their lesson to their  experiences and previous lessons learned'),(16,0,'Models work/task students are to do and involves students in setting criteria for their work/task during the guided practice'),(17,0,'Assists students in summarizing/forming generalization about the lesson and self-evaluating work'),(18,0,'Shows ability to adjust lessons/strategies to respond to unforeseen situations'),(19,0,'Differentiates activities to address varied learner types'),(20,15,'Communication and Appearance'),(21,0,'Well-groomed'),(22,0,'Portrays/uses refined manners and language'),(23,0,'Uses prescribed medium of instruction with proficiency and when necessary, uses appropriate language to get the message across'),(24,0,'Speaks clearly in well modulated voice'),(25,0,'Encourages children to participate, show interest and enthusiasm for activities, and exceed their own expectations'),(26,0,'Provides opportunity for the students to clarify their understanding of the concepts/ideas taken up'),(27,15,'Classroom Management'),(28,0,'Secures/prepares needed materials before class'),(29,0,'Maintains order and discipline'),(30,0,'Commands respect of the students'),(31,0,'Employs systematic procedures for routine class activities like greeting the teacher, arranging chairs, picking up pieces of paper, getting attention after turn and talk or small group discussion.'),(32,20,'Student Participation'),(33,0,'The class is attentive.'),(34,0,'Students are active and engaged with the different learning tasks.'),(35,0,'Students are able to share their ideas and ask questions.'),(36,0,'Students were able to accomplish the set objectives.'),(37,5,'Professional Growth'),(38,0,'Pursues graduate studies'),(39,0,'Attends seminars, workshops, conferences and other training programs'),(40,0,'Shares learnings with co-workers by conducting echo-seminars, workshops and other trainings'),(41,0,'Reads professional books and other materials');
/*!40000 ALTER TABLE `tcompetencies` ENABLE KEYS */;
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
  `section` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sallymorganq0003','sally_hendrix_morgan','81dc9bdb52d04dc20036dbd8313ed055','faculty',1,'english',NULL),(2,'suzannemorganq0004','suzanne_hendrix_morgan',NULL,'faculty',0,'english',NULL),(3,'arielleroyq0005','ariel_ross_leroy',NULL,'faculty',0,'drama',NULL),(4,'ronaldcalvinq0006','ronald_bumgarner_calvin',NULL,'faculty',0,'math',NULL),(5,'jeremyfisherq0007','jeremy_fox_fisher','81dc9bdb52d04dc20036dbd8313ed055','student',1,'','section 1 grade 6'),(6,'hubertdaleq0008','hubert_comber_dale',NULL,'student',0,'','section 1 grade 6'),(7,'margaretbaxterq0009','margaret_stuart_baxter',NULL,'student',0,'','section 2 grade 6'),(8,'michaelmeyersq0010','michael_grimm_meyers',NULL,'student',0,'','section 2 grade 6'),(9,'elizagordonq0011','eliza_smith_gordon','96e89a298e0a9f469b9ae458d6afae9f','head',1,'english',NULL),(10,'clarklancaster1234','clark_powers_lancaster',NULL,'admin',0,'',NULL),(11,'justinflores1234','justin_cornelio_flores','63a9f0ea7bb98050796b649e85481845','admin',1,'',NULL);
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

-- Dump completed on 2016-01-13 13:07:58
