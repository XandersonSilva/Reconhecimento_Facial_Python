from Acesso_dados_Json import retornaCmh
import os
import platform


def limpa_terminal():
    sistema_operacional = platform.system()
    if sistema_operacional == 'Linux':
        os.system('clear')
    else:
        os.system('cls')
limpa_terminal()

def lst(diretorio):
    lista = os.listdir(diretorio)
    return lista
diretorio = '../arquivos'

def lstS_D(diretorio):
    listSdir = []
    dir = lst(diretorio)
    for e in dir:
        dirAtu = diretorio + '/' + e
        if os.path.isdir(dirAtu):
            if not 'listSdir' in locals() and not 'listSdir' in globals():
                listSdir = []
                listSdir.append(dirAtu)
            else:
                if not isinstance(listSdir, list):
                    listSdir = []
                listSdir.append(dirAtu)
            listSdir.extend(lstS_D(dirAtu))
    return listSdir
        

print(retornaCmh())
            


