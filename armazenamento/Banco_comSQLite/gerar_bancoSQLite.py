#Para executar esse código é necessario ter a extenção sqlite3
import sqlite3

banco = sqlite3.connect('banco.db')
cursor = banco.cursor()


#SQL para gerar as tabelas
comandoCriacaoT = '''
    CREATE TABLE usuario(
        id integer primary key AUTOINCREMENT ,
        CPF int,
        nome varchar(50),
        email varchar(45),
        chave_de_acesso varchar,
        endereco varchar,
        funcao varchar(50), 
        imagemURL varchar, 
        turma varchar,
        periodo varchar,
        motivo varchar,
        matricula int,
        nivelAcesso boolean,
        pontos array)

    CREATE TABLE logs(
        idLog integer primary key AUTOINCREMENT ,
        hora datetime,
        CPF integer references usuario (CPF));
 '''

#Criar as tabelas do banco
cursor.execute(comandoCriacaoT)

#User admin
comando = 'insert into usuario(nome, email, endereco, chave_de_acesso, nivelAcesso) values("Administrador","admin@ifba.edu.br", "Jacobina","$2y$10$SCD4vC4VvyUwB0zXkUNW3Oim6DL8rklRhR2pn6rGixglp/djdsvnK", "TRUE");'
cursor.execute(comando)
#User controlador
comando = 'insert into usuario(nome, email, endereco, chave_de_acesso, nivelAcesso) values("Controlador","controlador@ifba.edu.br", "Jacobina","$2y$10$Fxp5t9i3Wbzqkmo2JUDNqurOnne8FMG21WJ.w/FFoqWVAOBjtwYYG", "TRUE");'
cursor.execute(comando)

#Execução do insert
banco.commit()