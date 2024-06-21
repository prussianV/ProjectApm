
create database LoginVR_Rodolfos;
use LoginVR_Rodolfos;

create table tb_curso(
cd int primary key auto_increment,
nome varchar(120) not null
);

create table tb_turma(
cd int primary key auto_increment,
nome varchar(45) not null,
id_curso int not null,
foreign key (id_curso) references tb_curso(cd)
);

create table tb_aluno(
rm int primary key not null,
nm_aluno varchar(80),
dt_nasc date not null,
tp_email varchar(50) not null,
pass_aluno varchar(40) not null,
id_turma int not null,
foreign key (id_turma) references tb_turma(cd)
);

create table tb_pedido(
cd_pedido int primary key auto_increment,
data_pedido date,
vl_pedido decimal,
desc_pedido varchar(255),
id_aluno int,   
foreign key (id_aluno) references tb_aluno(rm)
);

create table funcionario(
rm int primary key not null,
nome varchar(80) not null,
data_nasc date not null,
cargo varchar(70) not null,
vl_salario decimal(8,2) not null
);


insert into tb_curso (nome) values ("Informática para a internet");
insert into tb_curso (nome) values ("Administração Etim");
insert into tb_curso (nome) values ("Meio Ambiente");
insert into tb_curso (nome) values ("Desenvolvimento de Sistemas");
insert into tb_curso (nome) values ("Administração Modular");
insert into tb_curso (nome) values ("Farmácia");


insert into tb_turma (nome,id_curso) values ("1Min","1");
insert into tb_turma (nome,id_curso) values ("2Min","1");
insert into tb_turma (nome,id_curso) values ("3Min","1");

insert into tb_turma (nome,id_curso) values ("1Mad","2");
insert into tb_turma (nome,id_curso) values ("2Mad","2");
insert into tb_turma (nome,id_curso) values ("3Mad","2");

insert into tb_turma (nome,id_curso) values ("1Mam","3");
insert into tb_turma (nome,id_curso) values ("2Mam","3");
insert into tb_turma (nome,id_curso) values ("3Mam","3");

insert into tb_turma (nome,id_curso) values ("1DS","4");
insert into tb_turma (nome,id_curso) values ("2DS","4");
insert into tb_turma (nome,id_curso) values ("3DS","4");

insert into tb_turma (nome,id_curso) values ("1Adm","5");
insert into tb_turma (nome,id_curso) values ("2Adm","5");
insert into tb_turma (nome,id_curso) values ("3Adm","5");

insert into tb_turma (nome,id_curso) values ("1Far","6");
insert into tb_turma (nome,id_curso) values ("2Far","6");
insert into tb_turma (nome,id_curso) values ("3Far","6");




select * from tb_curso;

select * from tb_turma;

select * from tb_aluno;

select * from tb_pedido;
