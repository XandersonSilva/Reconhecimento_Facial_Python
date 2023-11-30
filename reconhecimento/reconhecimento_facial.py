import cv2
import face_recognition as fr
from datetime import datetime
import ast
import sqlite3
from pathlib import Path

# Obtém o diretório atual do arquivo
diretorio_atual = str(Path(__file__).resolve().parent)

# Conecta ao banco de dados SQLite
banco = sqlite3.connect(diretorio_atual + '/../armazenamento/Banco_comSQLite/banco.db')
cursor = banco.cursor()

# Coleta os dados da tabela usuario
cursor.execute('select id, pontos from usuario where pontos is not null')
Ldados = cursor.fetchall()
n = 0  # Variável utilizada para controle de alguma condição

# Procura o pontos na estrutura de cada índice
pontos = []
id = []
quant = len(Ldados)
for c in range(0, quant):
    Lid = Ldados[c][0]
    Lpontos = Ldados[c][1]
    if Lpontos != 'None' and Lid != 'None':
        pontos.append(Lpontos)
        id.append(Lid)
pontos = [ast.literal_eval(substring) for substring in pontos]

#Ativa a camera
webCamera = cv2.VideoCapture(0)

camera, frame = webCamera.read()
img2=cv2.flip(frame, 1)


try:
    #Pega os pontos do rosto da camera
    RE = True
    encodeCam = fr.face_encodings(img2)[0]

except:
    RE = False
    pass
b=0
if RE == True:
    for img in pontos:

        encodeAluno = pontos[b]
        j=b
        b=b+1
        
        distancia = fr.face_distance([encodeAluno],encodeCam)

        #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
        if(distancia <= 0.5):
            cursor = banco.cursor()
            cursor.execute('select nome from usuario where id = ' + str(id[j]))
            nome = cursor.fetchall()[0][0]
            cursor.execute('select cpf from usuario where id = ' + str(id[j]))
            CPF = str(cursor.fetchall()[0][0])
            print('=================================')
            print('IDENTIFICADO ALUNO: ' + nome)
            print(distancia)
            print('=================================')

            #CRIA LOGS DE ACESSO AINDA COM JSON
            # Conecta ao banco de dados SQLite

            # Coleta os dados da tabela usuario
            dia = datetime.now().strftime('%d/%m/%Y %H')
            diaH = datetime.now().strftime('%d/%m/%Y %H:%M:%S')
            cursor.execute("INSERT INTO logs (dataLog, hora, cpf) VALUES (?, ?, ?)", (dia, diaH, CPF))
            Llogs = cursor.fetchall()
            banco.commit()
            break #Caso retirado, é possível ver todos os alunos que "batem"
            

        else:
            #Printa se diferente, e a distância dos valores dos rostos.
            print('DIFERENTE')
            print(distancia)
else:
    print('ERROR')