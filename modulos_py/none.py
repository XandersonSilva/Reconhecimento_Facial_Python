import json
import os
import platform
import cv2

#Limpar terminal
sistema_operacional = platform.system()

if sistema_operacional == 'Linux':
    os.system('clear')
else:
    os.system('cls')

#Definir o caminho para o arquivo json
caminhoJson = "test.json"
#Abrir o arquivo
with open(caminhoJson, encoding='utf-8') as info:
    #Transformando os dados do json em um dicionario python
    dados = json.load(info)
    
    

Ldados = []
#Jogando os dados do dicionario em indices de uma lista
for i in dados:
    Ldados.append(i)

#Procurando o caminho das fotos na estrutura de cada indice
quant = len(Ldados)
for c in range(0, quant):
    Lcaminhos = Ldados[c]['Caminho_das_fotos']
    if Lcaminhos != 0:
        for f in range (len(Lcaminhos)):
            print(Lcaminhos[f])
            
            #Teste de verificação de acesso a essas imagens
            #img = cv2.imread(Lcaminhos[f])
            #cv2.imshow("Foto ", img)
            #cv2.waitKey(0)