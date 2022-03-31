#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: role
#------------------------------------------------------------
DROP TABLE IF EXISTS role;
CREATE TABLE role(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: promo
#------------------------------------------------------------
DROP TABLE IF EXISTS promo;
CREATE TABLE promo(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT promo_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: center
#------------------------------------------------------------
DROP TABLE IF EXISTS center;
CREATE TABLE center(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT center_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user 
#------------------------------------------------------------
DROP TABLE IF EXISTS user;
CREATE TABLE user(
        id        Int  Auto_increment  NOT NULL ,
        firstname Varchar (50) NOT NULL ,
        lastname  Varchar (50) NOT NULL ,
        email     Varchar (50) NOT NULL ,
        password  Varchar (50) NOT NULL ,
        id_role   Int NOT NULL ,
        id_center Int NOT NULL ,
        id_promo  Int
	,CONSTRAINT user_PK PRIMARY KEY (id)

	,CONSTRAINT user_role_FK FOREIGN KEY (id_role) REFERENCES role(id)
	,CONSTRAINT user_center0_FK FOREIGN KEY (id_center) REFERENCES center(id)
	,CONSTRAINT user_promo1_FK FOREIGN KEY (id_promo) REFERENCES promo(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: location
#------------------------------------------------------------
DROP TABLE IF EXISTS location;
CREATE TABLE location(
        id   TinyINT NOT NULL ,
        city Varchar (50) NOT NULL
	,CONSTRAINT location_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internship_type
#------------------------------------------------------------
DROP TABLE IF EXISTS internship_type;
CREATE TABLE internship_type(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT internship_type_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internship_category
#------------------------------------------------------------
DROP TABLE IF EXISTS internship_category;
CREATE TABLE internship_category(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT internship_category_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: wishlist
#------------------------------------------------------------
DROP TABLE IF EXISTS wishlist;
CREATE TABLE wishlist(
        id       Int  Auto_increment  NOT NULL ,
        id_user  Int NOT NULL
	,CONSTRAINT wishlist_PK PRIMARY KEY (id)

	,CONSTRAINT wishlist_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
	,CONSTRAINT wishlist_user_AK UNIQUE (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company_field
#------------------------------------------------------------
DROP TABLE IF EXISTS company_field;
CREATE TABLE company_field(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT company_field_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company
#------------------------------------------------------------
DROP TABLE IF EXISTS company;
CREATE TABLE company(
        id               Int  Auto_increment  NOT NULL ,
        name             Varchar (50) ,
        id_company_field Int NOT NULL
	,CONSTRAINT company_PK PRIMARY KEY (id)

	,CONSTRAINT company_company_field_FK FOREIGN KEY (id_company_field) REFERENCES company_field(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Internship
#------------------------------------------------------------
DROP TABLE IF EXISTS internship;
CREATE TABLE Internship(
        id                     Int  Auto_increment  NOT NULL ,
        name                   Varchar (50) NOT NULL ,
        duration               Int ,
        remuneration           Int ,
        available_places       Int ,
        skills                 Varchar (50) ,
        created_time           Date ,
        id_company             Int NOT NULL ,
        id_location            TinyINT NOT NULL ,
        id_internship_category Int ,
        id_internship_type     Int
	,CONSTRAINT Internship_PK PRIMARY KEY (id)

	,CONSTRAINT Internship_company_FK FOREIGN KEY (id_company) REFERENCES company(id)
	,CONSTRAINT Internship_location0_FK FOREIGN KEY (id_location) REFERENCES location(id)
	,CONSTRAINT Internship_internship_category1_FK FOREIGN KEY (id_internship_category) REFERENCES internship_category(id)
	,CONSTRAINT Internship_internship_type2_FK FOREIGN KEY (id_internship_type) REFERENCES internship_type(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------
DROP TABLE IF EXISTS status;
CREATE TABLE status(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: application
#------------------------------------------------------------
DROP TABLE IF EXISTS application;
CREATE TABLE application(
        id            Int  Auto_increment  NOT NULL ,
        cv            Varchar (50) NOT NULL ,
        lm            Varchar (50) NOT NULL ,
        id_user       Int NOT NULL ,
        id_Internship Int NOT NULL ,
        id_status     Int NOT NULL
	,CONSTRAINT application_PK PRIMARY KEY (id)

	,CONSTRAINT application_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
	,CONSTRAINT application_Internship0_FK FOREIGN KEY (id_Internship) REFERENCES Internship(id)
	,CONSTRAINT application_status1_FK FOREIGN KEY (id_status) REFERENCES status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internship_in_wishlist
#------------------------------------------------------------
DROP TABLE IF EXISTS internship_in_wishlit;
CREATE TABLE internship_in_wishlist(
        id          Int NOT NULL ,
        id_wishlist Int NOT NULL
	,CONSTRAINT internship_in_wishlist_PK PRIMARY KEY (id,id_wishlist)

	,CONSTRAINT internship_in_wishlist_Internship_FK FOREIGN KEY (id) REFERENCES Internship(id)
	,CONSTRAINT internship_in_wishlist_wishlist0_FK FOREIGN KEY (id_wishlist) REFERENCES wishlist(id)
)ENGINE=InnoDB;

