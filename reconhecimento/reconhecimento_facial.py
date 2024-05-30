#Importações
import cv2
import face_recognition as fr
from datetime import datetime
import sqlite3
from pathlib import Path
import os
import numpy as np

# Obtém o diretório atual do arquivo
diretorio_atual = str(Path(__file__).resolve().parent)

# Conecta ao banco de dados SQLite
banco = sqlite3.connect(diretorio_atual + '/../armazenamento/Banco_comSQLite/banco.db')
cursor = banco.cursor()

#Coleta os user temporários do banco
cursor.execute('select id, periodo, cpf from usuario where periodo is not null') 
Ldata = cursor.fetchall()
qtd = len(Ldata) #Quantidade de users temporários
dia = datetime.now() #Coleta a data atual para comparação
for i in range(0, qtd):
    Idata = Ldata[i][0] #ID do user
    Data = datetime.strptime(Ldata[i][1], '%d/%m/%Y') #Data do user
    CPFData = Ldata[i][2] #CPF do user

    #Caso o usuário tenha passado da data, excluir
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

# Procura o pontos na estrutura de cada índice
pontos = []
id = []
quant = len(Ldados)
for c in range(0, quant):
    Lid = Ldados[c][0] #Lista de id
    Lpontos = Ldados[c][1] #Lista de pontos
    if Lpontos != 'None' and Lid != 'None':
        pontos.append(Lpontos)
        id.append(Lid)

#Ativa a camera
webCamera = cv2.VideoCapture(0)

#Coleta o frame da câmera
camera, frame = webCamera.read()
img2=cv2.flip(frame, 1)


#Pega os pontos do rosto da camera
try:
    #Caso encontre o rosto
    RE = True
    #Encoda o frame da câmera
    encodeCam = fr.face_encodings(img2)[0]

except:
    #Caso não encontre o rosto
    RE = False
    pass

x=0 #Valor inicial para a lista pontos

#Caso o encode tenha sido realizado
if RE == True:
    #Para cada usuário na lista pontos
    for img in pontos:

        encodeAluno = pontos[x]#Coleta a imagem da lista
        encodeAluno = np.fromstring(encodeAluno, sep=',') #Transforma em uma lista formatada para o Face_Recognition
        
        distancia = fr.face_distance([encodeAluno],encodeCam) #Tira a distância dos pontos

        #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
        if(distancia <= 0.6):
            cursor = banco.cursor()

            #Coleta o nome do user
            cursor.execute('select nome from usuario where id = ' + str(id[x])) 
            nome = cursor.fetchall()[0][0]

            #Coleta o CPF do user
            cursor.execute('select cpf from usuario where id = ' + str(id[x])) 
            CPF = str(cursor.fetchall()[0][0])

            #Print formatado
            print('=================================')
            print('IDENTIFICADO ALUNO: ' + nome)
            print(distancia)
            print('=================================')

            # Cria os LOGS e coloca na tabela
            diaH = datetime.now().strftime('%d/%m/%Y %H:%M:%S')
            cursor.execute("INSERT INTO logs (hora, cpf) VALUES (?, ?)", (diaH, CPF))
            Llogs = cursor.fetchall()
            banco.commit()

            #break #Caso retirado, é possível ver todos os users
            

        else:
            #Coleta o nome do user
            cursor.execute('select nome from usuario where id = ' + str(id[x])) 
            nome = cursor.fetchall()[0][0]
            
            #Printa se diferente, e a distância dos valores dos rostos.
            print(f'DIFERENTE: {nome} -> {distancia}')

        #Adiciona +1 para a lista de pontos
        x+=1

#ERROR
else:
    print('ERROR')