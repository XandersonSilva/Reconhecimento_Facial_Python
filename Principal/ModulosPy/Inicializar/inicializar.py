import PySimpleGUI as sg
import json

def ini():
    #sg.theme_previewer() Comando para ver todos os temas disponiveis
    sg.theme('DarkGrey13')
    layout = [
        [sg.Text('Continuar com qual camera?')],
        [sg.Button('Local'),sg.Button('Remota')]
    ]

    window = sg.Window('Como continuar?', layout)
    escolha = ''

    while True:
        event, values = window.read()
        if event == sg.WIN_CLOSED:
            window.close
            break
        elif event == 'Local':
            print('Camera local escolhida')
            escolha = 0
            window.close
            break
        else:
            print('Camera remota escolhida')
            escolha = 1
            window.close
            break


    Arquivo = '../Principal/inicializar.json'
    conteudo = {f'comeca': escolha }

    #
    # conteudo = json.JSONEncoder(conteudo)

    with open(Arquivo,'w' ,encoding='utf-8' ) as inicio:
        json.dump(conteudo, inicio)

