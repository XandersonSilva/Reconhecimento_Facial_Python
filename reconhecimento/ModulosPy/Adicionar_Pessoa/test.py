import PySimpleGUI as sg
import sys
import os

largura_maxima = 400

layout1 = [
    [sg.Text('Deseja adicionar uma pessoa só ( Uma unica imagem será selecionada ) ou uma \npasta de  fotos ( Uma  pasta de  imagem  será  selecionada para  adicionar  uma \npessoa por imagem )?')],
    [
        sg.Button('Adicionar uma pessoa'),     # Opção - 1 
        sg.Button('Adicionar várias pessoas'), # Opção - 2
        sg.Button('Cancelar')                 
     ]
]
window = sg.Window('Selecionar como prosseguir', layout1)
while True:
    event, values = window.read()
    opcao = 0
    if event == sg.WINDOW_CLOSED or event == 'Cancelar':
        break
    elif event == 'Adicionar uma pessoa':
        opcao =  1
        break
    elif event == 'Adicionar várias pessoas':
        opcao =  2
        break
window.close()

print(opcao)

try:
    initial_folder = '~'
    if opcao == 2 :
        layout2 = [
            [sg.Text('Selecione a pasta com as imagens de das pessoas a serem adicionadas:')],
            [sg.InputText(key='-FILE-'), sg.FolderBrowse(initial_folder=initial_folder)],
            [sg.Button('Selecionar'), sg.Button('Cancelar')],
    ]
    elif opcao == 1:
        layout2 = [
            [sg.Text('Selecione a  imagens de da pessoa a ser adicionada:')],
            [sg.InputText(key='-FILE-'), sg.FileBrowse(initial_folder=initial_folder)],
            [sg.Button('Selecionar'), sg.Button('Cancelar')],
    ]
    elif opcao == 0:
        layout2 = [
            [sg.Text('Opção não informada! \nPrograma encerrado!')]
        ]
    
except OSError:
    if opcao == 1:
        layout2 = [
            [sg.Text('Selecione a  imagens de da pessoa a ser adicionada:')],
            [sg.InputText(key='-FILE-'), sg.FileBrowse()],
            [sg.Button('Selecionar'), sg.Button('Cancelar')],
        ]
    elif opcao == 0 :
         layout2 = [
            [sg.Text('Houve algum erro ao executar o programa!')]
         ]

window = sg.Window('Selecionar Arquivo', layout2)

while True:
    event, values = window.read()
    if opcao != 0 and values['-FILE-']:
        pastaSelecionada = values['-FILE-']
    else:
        sys.exit() #Encerra o programa por conta de não ter sido informado um arquivo ou pasta  
    if event == sg.WINDOW_CLOSED or event == 'Cancelar':
        break
    elif event == 'Selecionar' and pastaSelecionada:
        break
window.close()




if opcao == 1 and os.path.isfile(pastaSelecionada):
    layout3 = [
            [sg.Text('Adicione as informações da pessoa da respectiva foto:')],
            [sg.Text('Nome                                                    ') ,  sg.InputText(key='-NOME-')],
            [sg.Text('Função                                                  ') ,sg.InputText(key='-FUNCAO-')],
            [sg.Text('Número de matricula ou ID de funcionario') ,sg.InputText(key='-ID-')],
            [sg.Button('Adicionar'), sg.Button('Cancelar')],
        ]
    window = sg.Window('Adicionar pessoa', layout3)
    while True:
        event, values = window.read()
        Nome   = values['-NOME-']
        Função = values['-FUNCAO-']
        ID = values['-ID-']
        if event == sg.WINDOW_CLOSED or event == 'Cancelar':
            break
        elif event == 'Adicionar' and Nome and Função and ID:
            sg.popup(f'informações: \n Nome: {Nome}\n Função: {Função}\n Número de matricula ou ID {ID}')
            break
    window.close()