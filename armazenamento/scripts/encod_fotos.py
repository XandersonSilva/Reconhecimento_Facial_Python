#Bibliotecas
import face_recognition as fr
import sqlite3
from pathlib import Path

# Define uma função chamada codificar()
def codificar():
    # Obtém o diretório atual do arquivo
    diretorio_atual = str(Path(__file__).resolve().parent)

    # Conecta ao banco de dados SQLite
    banco = sqlite3.connect(diretorio_atual + '/../Banco_comSQLite/banco.db')
    cursor = banco.cursor()

    # Cria o caminho completo do diretório das fotos dinamicamente
    diretorio_base = diretorio_atual + "/.."

    # Coleta os dados da tabela usuario
    cursor.execute('select id, imagemURL, pontos from usuario where pontos is null and  imagemURL is not null')
    Ldados = cursor.fetchall()

    qntd = len(Ldados) #Quantidade de users

    #Caso não tenha usuários para codificar
    if qntd == 0:
        #Retornar 0=Sem adição
        return(0)

    for i in range(qntd):
        encodeFt = fr.load_image_file((diretorio_base + Ldados[i][1])) #Carrega a imagem
        encodeFt = fr.face_encodings(encodeFt)[0] #Codifica a imagem

        #Transforma em uma lista para o Face_Recognition
        encodeFt = encodeFt.tolist() 
        encodeFt = ', '.join(map(str, encodeFt))

        #Sobe no banco de dados
        cursor.execute(f'update usuario set pontos = "{encodeFt}" where imagemURL = "{Ldados[i][1]}"')
        cursor.execute(f'update usuario set imagemURL = NULL where imagemURL = "{Ldados[i][1]}"')
        banco.commit()
    
    #Retorna 1=Sucesso
    return(1)