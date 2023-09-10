import cv2 
import json
import face_recognition as fr
from ModulosPy.Inicializar.inicializar import ini
from ModulosPy.WebCamPC.WebCam import Rec
from ModulosPy.Cam_Mobile.Mobile_cam import MobileRec 

ini() #Pergunta se a câmera a ser utilizada será local(com fio) ou remota (sem fio) [TEMPORARIO]

#arq_dadoCamAtu = 'inicializar.json'
with open('inicializar.json', 'r') as dado:
    DadoC = json.load(dado)
Escolha = DadoC['comeca']

imgAluno = "../armazenamento/arquivos/imagens/Dev_X/Dev_X_F02.jpg"


imgEnt = fr.load_image_file(imgAluno)

#REALIZAR TESTES PARA VERIFICAR SE É MELHOR COM OU SEM
#Faz as alterações de cor da imagem
#imgAluno = cv2.cvtColor(imgAluno,cv2.COLOR_BGR2RGB)

#Pega os pontos do rosto da imagem
encodeAluno = fr.face_encodings(imgEnt)[0]


while True:

    #Aperte F para finalizar o programa (na tela da webcam)
    if cv2.waitKey(1) == ord('f'):
        break

    if Escolha == 0:
        fremL = Rec()
    else:
        fremL = MobileRec()

    if fremL != 'ERRO':
        Quant = len(fremL)
    else:
        print('Houve algum erro ao tentar acessar a câmera')
        break

    for f in range(0, Quant):
        encodeCam = fremL[f]

        #COMPARACAO
        if fremL[f] != [] and fremL[f] != 0:
            try:

                compr = fr.compare_faces([encodeAluno], encodeCam[0])
                distancia = fr.face_distance([encodeAluno], encodeCam[0])
                #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
                if(distancia <= 0.5):
                    print('MESMA PESSOA')
                    print(distancia)

                else:
                #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
                    print('DIFERENTE')
                    print(distancia)
            except:
                print(f"Não foi possível detectar alguém na imagem")
        else:
            print('Nenhum rosto encontrado!')
