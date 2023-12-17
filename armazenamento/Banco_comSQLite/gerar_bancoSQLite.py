#Para executar esse código é necessario ter a extenção sqlite3
import sqlite3

banco = sqlite3.connect('banco.db')
cursor = banco.cursor()


#SQL para gerar as tabelas
comandoCriacaoT = '''
    CREATE table usuario(
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
        pontos array, 
        presente boolean 
	);

    CREATE TABLE logs(
        idLog integer primary key AUTOINCREMENT ,
        dataLog datetime,
		hora datetime,
        CPF integer references usuario (CPF),
        motivo varchar,
        foto varchar
    );

    
 '''

#essa linha deve ser executada apenas uma vez para criar as tabelas do banco
cursor.execute(comandoCriacaoT)

#estrutura para inserir um novo usuário
comando = 'insert into usuario(nome, email, endereco, chave_de_acesso, nivelAcesso) values("Administrador","admin@ifba.edu.br", "Jacobina","$2y$10$SCD4vC4VvyUwB0zXkUNW3Oim6DL8rklRhR2pn6rGixglp/djdsvnK", "TRUE");'
cursor.execute(comando)
#comando para confirmar a execução do insert
banco.commit()

#Excluir tabela
#cursor.execute('drop table usuario')

#coletar os dados da tabela
cursor.execute('select * from usuario')
print(cursor.fetchall())