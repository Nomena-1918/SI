
create table person(
    Id serial primary key,
    namelead varchar(100),
    addres varchar(250),
    phone int,
    mail varchar(100)
);

create table devise(
    Id serial primary key,
    nomdevise varchar(100),
    taux float,
    dateCourant date
);

create table historicDevise(
    Id serial primary key,
    idDevise int,
    ancTaux float,
    ancDate date,
    foreign key (idDevise) references devise (Id)
);


create table societe(
    Id serial primary key,
    soc_name varchar(350),--'DIMPLEX'
    soc_objet text,--
    dirigeantID int,--FK_id person
    soc_creationdate date,--maintenant
    soc_adresse varchar(500),
    soc_emptotal int,
    soc_RCS float,
    soc_STAT bigint,
    soc_NIF bigint,
    datedebut date,
    devise_tenu_compte int,--FK devise
    --PCG int,--plan comptable general
    --nompcg varchar(200),
    foreign key (dirigeantID) references person(Id),
    foreign key (devise_tenu_compte) references devise(Id)
);

create table S_deviseReference(
    Id serial primary key,
    idsociete int,
    idref_devise int,
    foreign key (idsociete) references societe(Id),
    foreign key (idref_devise) references devise(Id)
);

create table S_phonelist(
    Id serial primary key,
    idsociete int,
    phonenumber int,
    foreign key (idsociete) references societe(Id)
);

create table S_emaiList(
    Id serial primary key,
    idsociete int,
    email varchar(250),
    foreign key (idsociete) references societe(Id)
);


create table plancomptable(
    Id serial primary key,
    numerocompte int,--ne doit pas depasser 5 caractères (Manipulation via bdd)
    intitule varchar(50)
);
create table compte_tier(
    Id serial primary key,
    numerocompte varchar(255),--ne doit pas depasser 13 caractères (Manipulation via bdd)
    intitule varchar(255)
);
create table journaux(
    Id serial primary key,
    code varchar(2),
    intitule varchar(255)
);

-- to verify the length of one number
CREATE OR REPLACE FUNCTION limitNumber(my_number INTEGER, length_limit INTEGER)
RETURNS BOOLEAN AS $$
BEGIN
  IF LENGTH(CAST(my_number AS TEXT)) <= length_limit THEN
    RETURN TRUE;
  ELSE
    RETURN FALSE;
  END IF;
END;
$$ LANGUAGE plpgsql;