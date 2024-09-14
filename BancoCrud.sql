create database dbcrud;
use dbcrud;

create table tbcrud(
codi_cr int primary key auto_increment,
nome_cr varchar(40) not null,
email_cr varchar(40),
senh_cr varchar(8),
sexo_cr char(1),
atna_cr datetime
);
select * from tbcrud