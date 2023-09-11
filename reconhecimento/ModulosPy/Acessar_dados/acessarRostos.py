import json
import numpy

caminhoJson = '../../../armazenamento/Dados_Imagens/dados.json'
with open( caminhoJson, 'r', encoding='utf-8') as info:
    #Transformando os dados do json em um dicionario python
    dados = json.load(info)

Ldados = []
    #Jogando os dados do dicionario em indices de uma lista
for i in dados:
    Ldados.append(i)

def R_encods_Get():
    #Procurando o caminho das fotos na estrutura de cada indice
    encods = []
    quant = len(Ldados)
    
    for c in range (quant):
        R_Qant = Ldados[c]
        if R_Qant != 0:
            try:
                encods.append([numpy.array(R_Qant['face_Encoded']), R_Qant['nome']])
            except:
                print(f"{R_Qant['nome']} não está devidamente cadastrado!")
    return encods