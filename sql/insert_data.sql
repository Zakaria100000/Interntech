-- Role Table 
INSERT INTO `role`(`id`, `name`) VALUES 
(1,'Admin'),
(2,'Pilot'),
(3,'Delegate'),
(4,'Student');

-- Promo Table
INSERT INTO `promo`(`id`, `name`) VALUES 
(1,'A1'),
(2,'A2'),
(3,'A3'),
(4,'A4'),
(5,'A5');

-- Center Table  
INSERT INTO `center`(`id`, `name`) VALUES 
(1,'Alger'),
(2,'Oran');

-- User Table 
INSERT INTO `user`(`firstname`,`lastname`,`email`,`password`,`id_role`,`id_center`,`id_promo`) VALUES
('TAREK','Abdeldjalil','tarek.abdeljalil.dz@viacesi.fr','abdeljalil',1,2,5),
('KAHLI','Mohamed Samy','kahli.mohamedsamy.dz@viacesi.fr','mohamedsamy',1,1,5), 
('HAMIDAT','Ryma','rhamidat@cesi-algerie.com','ryma',2,1,1), 
('AFRIT','Hani','hafrit@cesi-algerie.com','hani',2,1,2), 
('TALEB','Braham','btaleb@cesi-algerie.com','braham',2,1,3), 
('SMATTI','Manel','msmatti@cesi-algerie.com','manel',2,1,4), 
('KHETAR','Faycal','Fkhettar@cesi-algerie.com','faycal',2,1,5), 
('DECHEMI','Mawel','mdechemi@cesi-algerie.com','mawel',2,2,1), 
('ZAMOUCHE','Nadir','nzamouche@cesi-algerie.com','nadir',2,2,2), 
('MENADI','Djalleleddine','dmenadi@cesi-algerie.com','djallaleddine',2,2,3), 
('HANIFI','Cherif Sami','shanifi@cesi-algerie.com','samy',2,2,4), 
('KECILI','Hichem','hkecili@cesi-algeri.com','hichem',2,2,5), 
('KIARED','Mohamed','kiared.mohamed.dz@viacesi.fr','mohamed',3,1,1), 
('MESSAOUI','Afnane','messaoui.afnane.dz@viacesi.fr','afnane',3,1,2), 
('OULD SLIMANE','Arslane Fares','ouldslimane.arslanefares.dz@viacesi.fr','arslane',3,1,3), 
('TALEB','Nabil','taleb.nabil.dz@viacesi.fr','nabil',3,1,4), 
('FIHAKHIR','Houda','fihakhir.houda.dz@viacesi.fr','houda',3,1,5), 
('IZEM','Kenzy','izem.kenzy.dz@viacesi.fr','kenzy',3,2,1),
('ALILI','Baha Eddine','alili.bahaeddine.dz@viacesi.fr','bahaeddine',3,2,2),  
('CHENNOUF','Meroua','meroua.chennouf.dz@viacesi.fr','meroua',3,2,3),
('KIAS','Lynda','kias.lynda.dz@viacesi.fr','lynda',3,2,4), 
('BENRABAH','Oualid','benrabah.oualid.dz@viacesi.fr','oualid',3,2,5), 
('BELBATI','Anes','belbati.anes.dz@viacesi.fr','anes',4,1,1),
('BABAALI','Amine','babaali.amine.dz@viacesi.fr','amine',4,1,1),
('BOUMAZOUZA','Asma','boumazouza.asma.dz@viacesi.fr','asma',4,1,2),
('BOUDI','Nahla','boudi.nahla.dz@viacesi.fr','nahla',4,1,2), 
('KETTAB','Walid','kettab.walid.dz@viacesi.fr','walid',4,1,3), 
('BENNIOU','Aymen','benniou.aymen.dz@viacesi.fr','aymen',4,1,3), 
('ELBERKENNOU','Adel','elberkennou.adel.dz@viacesi.fr','adel',4,1,3),
('BELAIDI','Omar','belaidi.omar.dz@viacesi.fr','omar',4,1,4), 
('BABACI','Yacine','babaci.yacine@viacesi.fr','yacine',4,1,4), 
('MERAKEB','Lyes','merakeb.lyes.dz@viacesi.fr','lyes',4,1,5),
('MOUSSOUNI','Ranya','moussouni.ranya.dz@viacesi.fr','ranya',4,1,5),
('HAMIDI','Mohamed','hamidi.mohamed.dz@viacesi.fr','mohamed',4,2,1),
('HAMHAMI','Mohamed Rayan','hamhami.mohamedrayan.dz@viacesi.fr','rayan',4,2,1),
('HOCINE','Yacine','hocine.yacine.dz@viacesi.fr','yacine',4,2,2),
('KERKEBANE','Abdelmalik','kerkebane.abdelmalik.dz@viacesi.fr','abdelmalik',4,2,2), 
('HADOUR','Nazim','hadour.nazim.dz@viacesi.fr','nazim',4,2,3),
('ADOUL','Amine','adoul.amine.dz@viacesi.fr','amine',4,2,3), 
('ALIZOUAOUI','Zakaria','alizouaoui.zakaria.dz@viacesi.fr','zakaria',4,2,4), 
('BENELKADI','Amine','benelkadi.amine.dz@viacesi.fr','amine',4,2,4),
('KHECHINE','Sarra','khechine.sarra.dz@viacesi.fr','sarra',4,2,5), 
('KHOUDOUR','Anis','khoudour.anis.dz@viacesi.fr','anis',4,2,5);

-- Location Table 
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

-- Internship type Table
INSERT INTO `type`(`id`, `name`) VALUES 
(1,'Full time'),
(2,'Part time'),
(3,'Remote');

-- Internship Category Table 
INSERT INTO `category`(`id`, `name`) VALUES 
(1,'Web Development & Design'),
(2,'Mobile Development'),
(3,'Network'),
(4,'Software Development');

-- Sectors Table 
INSERT INTO `sector`(`id`, `name`) VALUES 
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

-- Companies Table
INSERT INTO `company`(`id`,`name`,`id_sector`) VALUES
(1,'Yassir',9),
(2,'Hive Digit',2),
(3,'Heetch',9),
(4,'El Kendi',8),
(5,'Air Algerie',9),
(6,'Jumia',1),
(7,'Ooredoo',7);

-- Status 
INSERT INTO `status`(`id`, `label`, `description`) VALUES 
(1,'step 1','Response to an offer has been made by a Student'),
(2,'step 2','Updates'),
(3,'step 3','Internship validation form issued by the company'),
(4,'step 4','Validation sheet signed by the pilot'),
(5,'step 5','The internship agreements have been issued to the company'),
(6,'step 6','Internship agreements have been returned signed');

INSERT INTO `permission`(`id`, `label`) VALUES 
(1,'SFx1'), 
(2,'SFx2'), 
(3,'SFx3'), 
(4,'SFx4'), 
(5,'SFx5'), 
(6,'SFx6'), 
(7,'SFx7'), 
(8,'SFx8'), 
(9,'SFx9'),
(10,'SFx10'), 
(11,'SFx11'), 
(12,'SFx12'), 
(13,'SFx13'), 
(14,'SFx14'), 
(15,'SFx15'), 
(16,'SFx16'), 
(17,'SFx17'), 
(18,'SFx18'), 
(19,'SFx19'), 
(20,'SFx20'), 
(21,'SFx21'), 
(22,'SFx22'), 
(23,'SFx23'), 
(24,'SFx24'), 
(25,'SFx25'), 
(26,'SFx26'), 
(27,'SFx27'), 
(28,'SFx28'), 
(29,'SFx29'), 
(30,'SFx30'), 
(31,'SFx31'), 
(32,'SFx32'), 
(33,'SFx33'), 
(34,'SFx34'), 
(35,'SFx35');




