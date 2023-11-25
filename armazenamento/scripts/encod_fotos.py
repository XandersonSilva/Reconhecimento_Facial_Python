import face_recognition as fr
import json
from acessar_paths import *  # Importa funções personalizadas para manipulação de caminhos
import sqlite3  # Para executar esse código é necessário ter a extensão sqlite3
from pathlib import Path
import sys


# Define uma função chamada teste()
def teste():
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
    n = 0  # Variável utilizada para controle de alguma condição

    # Define uma função interna chamada ImagensURL()
    def ImagensURL():
        # Procura o caminho das fotos na estrutura de cada índice
        caminhos = []
        quant = len(Ldados)
        for c in range(0, quant):
            Lcaminhos = Ldados[c][1]
            if Lcaminhos != 'None':
                caminhos.append(Lcaminhos)
        return caminhos

    # Define uma função interna chamada ApagaCaminho()
    def ApagaCaminho(Apagar):
        quant = len(Ldados)
        for c in range(0, quant):
            if Ldados[c][1] == Apagar:
                cursor.execute(f'update usuario set imagemURL = NULL where imagemURL = "{Apagar}"')
                banco.commit()

    j = []  # Lista vazia, parece que não está sendo utilizada no código, eu não faço ideia da utilidade dela

    # Define uma função interna chamada addEncod()
    def addEncod(img, encodeIMG):
        cursor.execute(f'update usuario set pontos = "{encodeIMG}" where imagemURL = "{img}"')
        banco.commit()

    # Obtém uma lista de caminhos das imagens
    caminhosIMG = ImagensURL()
    # Obtém a existência de caminhos em um diretório base
    ExistIMG = list_subdirectories(diretorio_base)
    # Obtém os caminhos existentes
    IMGalvo = existent_paths(ExistIMG, caminhosIMG, diretorio_base)

    ft_encod = []

    # Itera sobre os caminhos das imagens
    for c in IMGalvo:
        # Carrega a imagem utilizando a biblioteca face_recognition
        imgEnt = fr.load_image_file((diretorio_base + c))
        # Obtém as codificações faciais da imagem
        encodeIMG = fr.face_encodings(imgEnt)[0]
        ft_encod.append([encodeIMG, c])

    # Itera sobre as codificações faciais e adiciona ao banco de dados
    for e in ft_encod:
        addEncod(e[1], e[0].tolist())
        ApagaCaminho(e[1])
        n = 1  # Atualiza a variável de controle

    # Retorna o valor da variável de controle
    return n
