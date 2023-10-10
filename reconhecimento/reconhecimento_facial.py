import cv2
import face_recognition as fr
import os
import json

with open("armazenamento/Dados_Imagens/dados.json", 'r') as arquivo:
    dados = json.load(arquivo)
c=0
img=[]
Ldados = []
for i in dados:
    Ldados.append(i)
    img1 = Ldados[c]['nome']
    img.append(img1)
    c=c+1

webCamera = cv2.VideoCapture(0)

#Ativa a camera
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
    for img in img:

        with open('armazenamento/Dados_Imagens/dados.json', 'r') as arquivo:
            dados = json.load(arquivo)
        encodeAluno = dados[b]["face_Encoded"]
        b=b+1
        
        distancia = fr.face_distance([encodeAluno],encodeCam)

        #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
        if(distancia <= 0.5):
            print('=================================')
            print('IDENTIFICADO ALUNO: ' + img)
            print(distancia)
            print('=================================')
            break

        else:
            #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
            print('DIFERENTE ' + img)
            print(distancia)
else:
    print('ERROR')