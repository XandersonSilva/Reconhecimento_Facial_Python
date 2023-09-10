import os
import platform

# Lista de formatos de imagem suportados
img_formats = ['.jpeg', '.png', '.jpg', '.bmp', '.tiff', '.webp', '.svg']

# Função para limpar o terminal com base no sistema operacional
def clear_terminal():
    sistema_operacional = platform.system()
    if sistema_operacional == 'Linux':
        os.system('clear')
    else:
        os.system('cls')


# Função para listar arquivos em um diretório
def list_files(dir):
    lista = os.listdir(dir)
    return lista

# Função para separar os caminhos de imagens e diretórios com base em um limitador
def loc_dir_e_imgs(dirs_and_images, limitador):
    sub_dirs = []
    image_files = []
    for i in dirs_and_images:
        teste = i.split('/')
        for c in img_formats:
            if c in teste[-1]:
                image_files.append(i)
            elif os.path.isdir(i) and not i in sub_dirs:
                sub_dirs.append(i)
    if limitador == 1:
        return sub_dirs
    elif limitador == 2:
        return image_files
    elif limitador == 3:
        return sub_dirs, image_files
    else:
        print('--' * 16 + '# ' + 'ERRO' ' #' + '--' * 16)
        print('  Na função separate_dirs_and_images, o limitador deve informar a saída desejada\n      1 retorna a lista de diretórios\n      2 retorna a lista de imagens\n      3 retorna ambas as listas')
        print('--' * 36)

# Função para listar subdiretórios de forma recursiva
def list_subdirectories(directory):
    list_subdirs = []
    dir_list = list_files(directory)
    for e in dir_list:
        if not directory[-1] == '/':
            current_dir = directory + '/' + e
        else:
            current_dir = directory + e
        if os.path.isdir(current_dir):
            list_subdirs.append(current_dir)
            list_subdirs.extend(list_subdirectories(current_dir))
        else:
            teste = current_dir.split('/')
            for c in img_formats:
                if c in teste[-1]:
                    list_subdirs.append(current_dir)
    return list_subdirs

# Função para encontrar caminhos existentes
def existent_paths(exist_paths, to_check):
    exist = []
    for c in to_check:
        if  c in exist_paths:
            exist.append(c)
    return exist


# Apagar dirorios desatualizados
#
#    # Diretório base
#    diretorio = '../arquivos'
#
#    # Lista todos os subdiretórios de forma recursiva
#    list_subdirs = list_subdirectories(diretorio)
#
#    # Separa os caminhos existentes que são imagens
#    existing_paths = separate_dirs_and_images(list_subdirs, 2)
#
#    # Carrega dados de um arquivo JSON usando a função CmhsJson() (assumindo que existe)
#    N_Verifc = CmhsJson()
#
#    # Encontra caminhos inexistentes comparando com os caminhos existentes
#    inexistentes = non_existent(existing_paths, N_Verifc)
#
#    # Executa a função ApagaCaminho() para os caminhos inexistentes
#    for c in inexistentes:
#        ApagaCaminho(c)
#