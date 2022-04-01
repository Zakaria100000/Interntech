#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: role
#------------------------------------------------------------

CREATE TABLE role(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: promo
#------------------------------------------------------------

CREATE TABLE promo(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT promo_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: center
#------------------------------------------------------------

CREATE TABLE center(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT center_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user 
#------------------------------------------------------------

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

CREATE TABLE location(
        id   TinyINT NOT NULL ,
        city Varchar (50) NOT NULL
	,CONSTRAINT location_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type
#------------------------------------------------------------

CREATE TABLE type(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT type_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: category
#------------------------------------------------------------

CREATE TABLE category(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT category_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: wishlist
#------------------------------------------------------------

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

CREATE TABLE sector(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT sector_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company
#------------------------------------------------------------

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
	,CONSTRAINT Internship_category0_FK FOREIGN KEY (id_category) REFERENCES category(id)
	,CONSTRAINT Internship_type1_FK FOREIGN KEY (id_type) REFERENCES type(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: status
#------------------------------------------------------------

CREATE TABLE status(
        id          Int  Auto_increment  NOT NULL ,
        label       Varchar (20) NOT NULL ,
        description Varchar (100) NOT NULL
	,CONSTRAINT status_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: application
#------------------------------------------------------------

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
# Table: permission
#------------------------------------------------------------

CREATE TABLE permission(
        id         Int  Auto_increment  NOT NULL ,
        label      Varchar (50) NOT NULL ,
        is_allowed Bool NOT NULL
	,CONSTRAINT permission_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: takes_place
#------------------------------------------------------------

CREATE TABLE takes_place(
        id            TinyINT NOT NULL ,
        id_Internship Int NOT NULL
	,CONSTRAINT takes_place_PK PRIMARY KEY (id,id_Internship)

	,CONSTRAINT takes_place_location_FK FOREIGN KEY (id) REFERENCES location(id)
	,CONSTRAINT takes_place_Internship0_FK FOREIGN KEY (id_Internship) REFERENCES Internship(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: wishlist_internship
#------------------------------------------------------------

CREATE TABLE wishlist_internship(
        id          Int NOT NULL ,
        id_wishlist Int NOT NULL
	,CONSTRAINT wishlist_internship_PK PRIMARY KEY (id,id_wishlist)

	,CONSTRAINT wishlist_internship_Internship_FK FOREIGN KEY (id) REFERENCES Internship(id)
	,CONSTRAINT wishlist_internship_wishlist0_FK FOREIGN KEY (id_wishlist) REFERENCES wishlist(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: role_permission
#------------------------------------------------------------

CREATE TABLE role_permission(
        id      Int NOT NULL ,
        id_role Int NOT NULL
	,CONSTRAINT role_permission_PK PRIMARY KEY (id,id_role)

	,CONSTRAINT role_permission_permission_FK FOREIGN KEY (id) REFERENCES permission(id)
	,CONSTRAINT role_permission_role0_FK FOREIGN KEY (id_role) REFERENCES role(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company_is_located
#------------------------------------------------------------

CREATE TABLE company_is_located(
        id         TinyINT NOT NULL ,
        id_company Int NOT NULL
	,CONSTRAINT company_is_located_PK PRIMARY KEY (id,id_company)

	,CONSTRAINT company_is_located_location_FK FOREIGN KEY (id) REFERENCES location(id)
	,CONSTRAINT company_is_located_company0_FK FOREIGN KEY (id_company) REFERENCES company(id)
)ENGINE=InnoDB;

