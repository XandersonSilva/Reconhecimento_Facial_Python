import cv2
import face_recognition as fr
from datetime import datetime
import ast
import sqlite3
from pathlib import Path
import os

# Obtém o diretório atual do arquivo
diretorio_atual = str(Path(__file__).resolve().parent)

# Conecta ao banco de dados SQLite
banco = sqlite3.connect(diretorio_atual + '/../armazenamento/Banco_comSQLite/banco.db')
cursor = banco.cursor()

#Verificando usuários temporários
cursor.execute('select id, periodo, cpf from usuario where periodo is not null')
Ldata = cursor.fetchall()
qtd = len(Ldata)
dia = datetime.now()
for i in range(0, qtd):
    Idata = Ldata[i][0]
    Data = datetime.strptime(Ldata[i][1], '%d/%m/%Y')
    CPFData = Ldata[i][2]
    if Data < dia:
        Idata = str(Idata)
        CPFData = str(CPFData)
        cursor.execute("DELETE from logs where cpf=?", (CPFData,))
        cursor.execute("DELETE from usuario where id=?", (Idata,))
        foto = './armazenamento/fotos/{}.png'.format(CPFData)
        os.remove(foto)
        banco.commit()

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
        if(distancia <= 0.6):
            cursor = banco.cursor()
            cursor.execute('select nome from usuario where id = ' + str(id[j]))
            nome = cursor.fetchall()[0][0]
            cursor.execute('select cpf from usuario where id = ' + str(id[j]))
            CPF = str(cursor.fetchall()[0][0])
            print('=================================')
            print('IDENTIFICADO ALUNO: ' + nome)
            print(distancia)
            print('=================================')

            # Conecta ao banco de dados SQLite

            # Cria os LOGS e coloca na tabela
            diaH = datetime.now().strftime('%d/%m/%Y %H:%M:%S')
            cursor.execute("INSERT INTO logs (hora, cpf) VALUES (?, ?)", (diaH, CPF))
            Llogs = cursor.fetchall()
            banco.commit()
            break #Caso retirado, é possível ver todos os alunos que "batem"
            

        else:
            #Printa se diferente, e a distância dos valores dos rostos.
            print('DIFERENTE')
            print(distancia)
else:
    print('ERROR')