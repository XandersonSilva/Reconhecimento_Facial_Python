from Acesso_dados_Json import *
import os
import platform

img_formts = ['.jpeg','.png','.jpg', '.bmp', '.tiff', '.webp', '.svg']

def limpa_terminal():
    sistema_operacional = platform.system()
    if sistema_operacional == 'Linux':
        os.system('clear')
    else:
        os.system('cls')
limpa_terminal()

def lst(dir):
    lista = os.listdir(dir)
    return lista

    # Função para separar os caminhos de imagens e diretórios
    # Nesta função o limitador deverá informar a saída desejada
    # 1 retorna a lista de diretórios
    # 2 retorna a lista de imagens
    # 3 retorna ambas as listas
def sepDirAndImg(LtDirsAndImg, limitador):
    SubDirs = []
    arquivosImg = []
    for i in LtDirsAndImg:
        teste = i.split('/')
        for c in img_formts:
            if c in teste[-1]:
                arquivosImg.append(i)
            elif os.path.isdir(i) and not i in SubDirs:
                SubDirs.append(i)
    if limitador == 1:
        return SubDirs 
    elif limitador == 2:
        return arquivosImg
    elif limitador == 3:
        return SubDirs, arquivosImg
    else:
        print('--' * 16 + '# ' + 'ERRO' ' #' + '--' * 16 )
        print('  Na função sepDirAndImg o limitador deverá informar a saída desejada\n      1 retorna a lista de diretórios\n      2 retorna a lista de imagens\n      3 retorna ambas as listas')
        print('--' * 36)


     # Listar os arquivos e subdiretorios de um diretorio recursivamente
def lstS_D(diretorio):
    listSdirs = []
    dir = lst(diretorio)
    for e in dir:
        if not diretorio[-1] == '/':
            dirAtu = diretorio + '/' + e
        else:
            dirAtu = diretorio + e
        if os.path.isdir(dirAtu):
            listSdirs.append(dirAtu)
            listSdirs.extend(lstS_D(dirAtu))
        else:
            teste = dirAtu.split('/')
            for c in img_formts:
                if c in teste[-1]:
                    listSdirs.append(dirAtu,)
    
    return listSdirs

def inexistente(existentes, N_Verifc):
    N_Exist = []
    for c in N_Verifc:
        if not c in existentes:
            N_Exist.append(c)
    return N_Exist

diretorio = '../arquivos'

listSdirs = lstS_D(diretorio)
existentes = sepDirAndImg(listSdirs, 2)
N_Verifc = CmhsJson()
inexistentes = inexistente(existentes, N_Verifc)
for c in inexistentes:
    ApagaCaminho(c)



