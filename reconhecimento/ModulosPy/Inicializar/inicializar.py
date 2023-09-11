import tkinter as tk
import json

def ini():
    escolha = 0 #Camera local setada como padrão
    iniciar = 0
    def local_clicked():
        nonlocal escolha
        escolha = 0
        root.quit()

    def remota_clicked():
        nonlocal escolha
        escolha = 1
        root.quit()

    def add_foto():
        print('Função ainda não disponivel')
        janela.quit()

    def inic():
        nonlocal iniciar
        iniciar = 1
        janela.quit()
    

    janela =  tk.Tk()
    

    janela.title('Inicializar')
    label_I = tk.Label(janela, text='Como deseja prosseguir?')
    label_I.pack()
    adicionar_Btn = tk.Button(janela, text='Adicionar novas imagens ao banco', command=add_foto)
    adicionar_Btn.pack()   
    iniciar_Btn   = tk.Button(janela, text='Iniciar programa de reconhecimento',   command=inic)
    iniciar_Btn.pack()



    janela.mainloop()

    root = tk.Tk()

    root.title('Como continuar?')

    label = tk.Label(root, text='Continuar com qual câmera?')
    label.grid(column=0, row=0)

    local_button = tk.Button(root, text='Local', command=local_clicked)
    local_button.grid(column=0, row=1)

    remota_button = tk.Button(root, text='Remota', command=remota_clicked)
    remota_button.grid(column=1, row=1)


    if iniciar == 1 :
        escolha = -1
        while  escolha == -1:
            root.mainloop()
            
            
        root.destroy()

        arquivo = 'inicializar.json'
        conteudo = {'comeca': escolha}

        with open(arquivo, 'w', encoding='utf-8') as inicio:
            json.dump(conteudo, inicio)
