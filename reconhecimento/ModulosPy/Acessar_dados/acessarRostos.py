import json
import numpy
from pathlib import Path
import sys
#Não sei debugar do geito certo então fiz assim para parar o arquivo em pontos necessarios
#print('ERRO')
#sys.exit()

# Obtém o diretório atual do arquivo
diretorio_atual = str(Path(__file__).resolve().parent)

caminhoJson = diretorio_atual + '/../../../armazenamento/Dados_Imagens/dados.json'
with open( caminhoJson, 'r', encoding='utf-8') as info:
    #Transformando os dados do json em um dicionario python
    dados = json.load(info)

Ldados = []
    #Jogando os dados do dicionario em indices de uma lista
for i in dados:
    Ldados.append(i)

def R_encods_Get():
    # Procurando os dados extraídos das fotos no registro de cada usurário
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