import face_recognition as fr
import json
import numpy as np
from acessar_paths import *
from pathlib import Path

# Obtém o diretório atual do arquivo
diretorio_atual = str(Path(__file__).resolve().parent)

def teste():
    #Informe o caminho completo do diretório das fotos
    n1 = diretorio_atual + "/../fotos"  
    n = 0
    caminhoJson = 'armazenamento/Banco_comSQLite/dados.json'
    with open( caminhoJson, 'r', encoding='utf-8') as info:
        #Transformando os dados do json em um dicionario python
        dados = json.load(info)

    Ldados = []
        #Jogando os dados do dicionario em indices de uma lista
    for i in dados:
        Ldados.append(i)
            
    def CmhsJson():
        #Procurando o caminho das fotos na estrutura de cada indice
        caminhos = []
        quant = len(Ldados)
        for c in range(0, quant):
            Lcaminhos = Ldados[c]['Caminho_das_fotos']
            if Lcaminhos != 0:
                for f in range (len(Lcaminhos)):
                    caminhos.append(Lcaminhos[f])
        return caminhos

    def ApagaCaminho(Apagar):
        quant = len(Ldados)
        for c in range(0, quant):
            Lcaminhos = Ldados[c]['Caminho_das_fotos']
            quantCmnh =  len(Lcaminhos)
            if quantCmnh > 0:
                conter = quantCmnh - 1
                while conter >= 0:
                    CmhAtu =  Ldados[c]['Caminho_das_fotos'][conter]
                    if CmhAtu == Apagar :
                        Ldados[c]['Caminho_das_fotos'].pop(conter)
                    conter -= 1
        with open (caminhoJson, 'w', encoding='utf-8') as arquivo:
            json.dump(Ldados , arquivo)
    j = []
    def addEncod(img, encodeIMG):
        quant = len(Ldados)
        for c in range(0, quant):
            Lcaminhos = Ldados[c]['Caminho_das_fotos']
            quantCmnh =  len(Lcaminhos)
            if quantCmnh > 0:
                conter = quantCmnh - 1
                while conter >= 0:
                    CmhAtu =  Ldados[c]['Caminho_das_fotos'][conter]
                    if CmhAtu == img :
                        Ldados[c]['face_Encoded'] = encodeIMG
                    conter -= 1
        with open (caminhoJson, 'w', encoding='utf-8') as arquivo:
            json.dump(Ldados , arquivo)


    diretorio_base = n1
    caminhosIMG = CmhsJson()
    ExistIMG = list_subdirectories(diretorio_base)
    IMGalvo = existent_paths(ExistIMG, caminhosIMG)

    
    ft_encod = []
    for c in IMGalvo:
        imgEnt = fr.load_image_file(c)
        encodeIMG = fr.face_encodings(imgEnt)[0]
        ft_encod.append([encodeIMG, c])

    for e in ft_encod:
        addEncod(e[1], e[0].tolist())
        ApagaCaminho(e[1])
        n = 1
    return n
