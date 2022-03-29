-- Center Table  
INSERT INTO `center`(`id`, `name`) VALUES 
(1,'Alger'),
(2,'Oran');

-- Promo Table
INSERT INTO `promo`(`id`, `name`) VALUES 
(1,'A1'),
(2,'A2'),
(3,'A3'),
(4,'A4'),
(5,'A5');

-- Role Table 
INSERT INTO `role`(`id`, `name`) VALUES 
(1,'Admin'),
(2,'Pilot'),
(3,'Delegate'),
(4,'Student');

-- Internship Table
INSERT INTO `internship_type`(`id`, `name`) VALUES 
(1,'Full time'),
(2,'Part time'),
(3,'Remote');

-- Internship Category Table 
INSERT INTO `internship_category`(`id`, `name`) VALUES 
(1,'UX/UI'),
(2,'Web Development'),
(3,'Mobile Development'),
(4,'Network');

-- City Table 

INSERT INTO `location`(`id`, `city`) VALUES 
(1,'Adrar'),
(2,'Chlef'),
(3,'Laghouat'),
(4,'Oum El Bouaghi'),
(5,'Batna'),
(6,'Béjaïa'),
(7,'Biskra'),
(8,'Béchar'),
(9,'Blida'),
(10,'Bouira	'),
(11,'Tamanrasset'),
(12,'Tébessa'),
(13,'Tlemcen'),
(14,'Tiaret'),
(15,'Tizi Ouzou'),
(16,'Alger'),
(17,'Djelfa'),
(18,'Jijel'),
(19,'Sétif'),
(20,'Saïda'),
(21,'Skikda'),
(22,'Sidi Bel Abbès	'),
(23,'Annaba'),
(24,'Guelma'),
(25,'Constantine'),
(26,'Médéa'),
(27,'Mostaganem'),
(28,'MSila'),
(29,'Mascara'),
(30,'Ouargla'),
(31,'Oran'),
(32,'El Bayadh'),
(33,'Illizi'),
(34,'Bordj Bou Arreridj'),
(35,'Boumerdès'),		
(36,'El Tarf'),		
(37,'Tindouf'),		
(38,'Tissemsilt'),		
(39,'El Oued'),		
(40,'Khenchela'),		
(41,'Souk Ahras'),		
(42,'Tipaza'),		
(43,'Mila'),		
(44,'Aïn Defla'),		
(45,'Naâma'),		
(46,'Aïn Témouchent'),	
(47,'Ghardaïa'),	
(48,'Relizane');		

-- Sectors Table 

(1,'Retail business'),
(2,'Consulting engineering'),
(3,'Geomatics'),
(4,'Embedded computing'),
(5,'Security'),
(6,'Financial services'),
(7,'Telecommunications'),
(8,'Health'),
(9,'Transport'),
(10,'Video game');
 
-- Application Status Table
-- Posted, In-review, Refused, Accepted
(1,'response to an offer has been made by a Student'),
(2,'Updates'),
(3,'internship validation form issued by the company'),
(4,'validation sheet signed by the pilot'),
(5,'the internship agreements have been issued to the company'),
(6,'internship agreements have been returned signed');

-- Companies Table

(1,'Yassir',9),
(2,'Hive Digit',2),
(3,'Heetch',9),
(4,'El Kendi',8),
(5,'Air Algerie',9),
(5,'Jumia',1),
(6,'Ooredoo',7);
