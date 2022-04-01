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
	,CONSTRAINT user_center_FK FOREIGN KEY (id_center) REFERENCES center(id)
	,CONSTRAINT user_promo_FK FOREIGN KEY (id_promo) REFERENCES promo(id)
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
# Table: type
#------------------------------------------------------------
DROP TABLE IF EXISTS type;
CREATE TABLE type(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT type_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: category
#------------------------------------------------------------
DROP TABLE IF EXISTS category;
CREATE TABLE category(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT category_PK PRIMARY KEY (id)
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
# Table: sector
#------------------------------------------------------------
DROP TABLE IF EXISTS sector;
CREATE TABLE sector(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT sector_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company
#------------------------------------------------------------
DROP TABLE IF EXISTS company;
CREATE TABLE company(
        id        Int  Auto_increment  NOT NULL ,
        name      Varchar (50) ,
        email     Varchar (50) NOT NULL ,
        id_sector Int NOT NULL
	,CONSTRAINT company_PK PRIMARY KEY (id)

	,CONSTRAINT company_sector_FK FOREIGN KEY (id_sector) REFERENCES sector(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Internship
#------------------------------------------------------------
DROP TABLE IF EXISTS Internship;
CREATE TABLE Internship(
        id               Int  Auto_increment  NOT NULL ,
        title            Varchar (50) NOT NULL ,
        duration         Decimal ,
        remuneration     Decimal ,
        available_places Int ,
        skills           Varchar (50) ,
        created_time     Date ,
        id_company       Int NOT NULL ,
        id_category      Int ,
        id_type          Int
	,CONSTRAINT Internship_PK PRIMARY KEY (id)

	,CONSTRAINT Internship_company_FK FOREIGN KEY (id_company) REFERENCES company(id)
	,CONSTRAINT Internship_category_FK FOREIGN KEY (id_category) REFERENCES category(id)
	,CONSTRAINT Internship_type_FK FOREIGN KEY (id_type) REFERENCES type(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------
DROP TABLE IF EXISTS status;
CREATE TABLE status(
        id          Int  Auto_increment  NOT NULL ,
        label       Varchar (20) NOT NULL ,
        description Varchar (100) NOT NULL
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
	,CONSTRAINT application_Internship_FK FOREIGN KEY (id_Internship) REFERENCES Internship(id)
	,CONSTRAINT application_status_FK FOREIGN KEY (id_status) REFERENCES status(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: permission
#------------------------------------------------------------
DROP TABLE IF EXISTS permission;
CREATE TABLE permission(
        id         Int  Auto_increment  NOT NULL ,
        label      Varchar (50) NOT NULL ,
        CONSTRAINT permission_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: takes_place
#------------------------------------------------------------
DROP TABLE IF EXISTS takes_place;
CREATE TABLE takes_place(
        id_Internship Int NOT NULL,
        id_location TinyINT NOT NULL
	,CONSTRAINT takes_place_PK PRIMARY KEY (id_Internship,id_location)

	,CONSTRAINT takes_place_location_FK FOREIGN KEY (id_location) REFERENCES location(id)
	,CONSTRAINT takes_place_Internship_FK FOREIGN KEY (id_Internship) REFERENCES Internship(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: wishlist_internship
#------------------------------------------------------------
DROP TABLE IF EXISTS wishlist_internship;
CREATE TABLE wishlist_internship(
        id_wishlist Int NOT NULL,
        id_internship Int NOT NULL
	,CONSTRAINT wishlist_internship_PK PRIMARY KEY (id_wishlist,id_internship)

	,CONSTRAINT wishlist_internship_wishlist_FK FOREIGN KEY (id_wishlist) REFERENCES wishlist(id)
        ,CONSTRAINT wishlist_internship_Internship_FK FOREIGN KEY (id_internship) REFERENCES Internship(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: role_permission
#------------------------------------------------------------
DROP TABLE IF EXISTS role_permission;
CREATE TABLE role_permission(
        id_role Int NOT NULL,
        id_permission   Int NOT NULL,
        is_allowed Bool NOT NULL
	,CONSTRAINT role_permission_PK PRIMARY KEY (id_role,id_permission)

        ,CONSTRAINT role_permission_role_FK FOREIGN KEY (id_role) REFERENCES role(id)
	,CONSTRAINT role_permission_permission_FK FOREIGN KEY (id_permission) REFERENCES permission(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company_is_located
#------------------------------------------------------------
DROP TABLE IF EXISTS company_is_located;
CREATE TABLE company_is_located(
        id_company Int NOT NULL,
        id_location TinyINT NOT NULL
	,CONSTRAINT company_is_located_PK PRIMARY KEY (id_company,id_location)

        ,CONSTRAINT company_is_located_company_FK FOREIGN KEY (id_company) REFERENCES company(id)
	,CONSTRAINT company_is_located_location_FK FOREIGN KEY (id_location) REFERENCES location(id)
)ENGINE=InnoDB;
