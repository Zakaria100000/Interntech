#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: company
#------------------------------------------------------------

CREATE TABLE company(
        id            Int  Auto_increment  NOT NULL ,
        name          Varchar (50) ,
        field         Varchar (50) ,
        nb_internship Int
	,CONSTRAINT company_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: role
#------------------------------------------------------------

CREATE TABLE role(
        id   TinyINT NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: promo
#------------------------------------------------------------

CREATE TABLE promo(
        id   TinyINT NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT promo_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: center
#------------------------------------------------------------

CREATE TABLE center(
        id   TinyINT NOT NULL ,
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
        center    Varchar (50) ,
        promo     Varchar (50) ,
        id_role   TinyINT NOT NULL ,
        id_center TinyINT NOT NULL ,
        id_promo  TinyINT
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
# Table: internship_type
#------------------------------------------------------------

CREATE TABLE internship_type(
        id   TinyINT NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT internship_type_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internship_category
#------------------------------------------------------------

CREATE TABLE internship_category(
        id   TinyINT NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT internship_category_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Internship
#------------------------------------------------------------

CREATE TABLE Internship(
        id                     Int  Auto_increment  NOT NULL ,
        name                   Varchar (50) NOT NULL ,
        duration               Int ,
        remuneration           Int ,
        nb_places              Int ,
        skills                 Varchar (50) ,
        created_time           Date ,
        id_company             Int NOT NULL ,
        id_location            TinyINT NOT NULL ,
        id_internship_category TinyINT ,
        id_internship_type     TinyINT
	,CONSTRAINT Internship_PK PRIMARY KEY (id)

	,CONSTRAINT Internship_company_FK FOREIGN KEY (id_company) REFERENCES company(id)
	,CONSTRAINT Internship_location0_FK FOREIGN KEY (id_location) REFERENCES location(id)
	,CONSTRAINT Internship_internship_category1_FK FOREIGN KEY (id_internship_category) REFERENCES internship_category(id)
	,CONSTRAINT Internship_internship_type2_FK FOREIGN KEY (id_internship_type) REFERENCES internship_type(id)
)ENGINE=InnoDB;

