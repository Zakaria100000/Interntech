#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


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
        user_type Smallint NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


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
# Table: Internship
#------------------------------------------------------------

CREATE TABLE Internship(
        id           Int  Auto_increment  NOT NULL ,
        duration     Int ,
        remuneration Int ,
        nb_places    Int ,
        skills       Varchar (50) ,
        date_offer   Date ,
        id_company   Int NOT NULL
	,CONSTRAINT Internship_PK PRIMARY KEY (id)

	,CONSTRAINT Internship_company_FK FOREIGN KEY (id_company) REFERENCES company(id)
)ENGINE=InnoDB;

