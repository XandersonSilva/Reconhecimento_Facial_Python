import tkinter as tk
import json

def ini():
    def local_clicked():
        nonlocal escolha
        escolha = 0
        root.quit()

    def remota_clicked():
        nonlocal escolha
        escolha = 1
        root.quit()

    escolha = -1

    root = tk.Tk()
    root.title('Como continuar?')

    label = tk.Label(root, text='Continuar com qual câmera?')
    label.pack()

    local_button = tk.Button(root, text='Local', command=local_clicked)
    local_button.pack()

    remota_button = tk.Button(root, text='Remota', command=remota_clicked)
    remota_button.pack()

    cont = 0
    while  escolha == -1:
        root.update()
        
        
    root.destroy()

    arquivo = '../reconhecimento/inicializar.json'
    conteudo = {'comeca': escolha}

    with open(arquivo, 'w', encoding='utf-8') as inicio:
        json.dump(conteudo, inicio)
