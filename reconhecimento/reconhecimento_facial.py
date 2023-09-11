import cv2 
import json
import face_recognition as fr
from ModulosPy.Inicializar.inicializar import ini
from ModulosPy.WebCamPC.WebCam import Rec
from ModulosPy.Cam_Mobile.Mobile_cam import MobileRec 
from ModulosPy.Acessar_dados.acessarRostos import R_encods_Get
ini() #Pergunta se a câmera a ser utilizada será local(com fio) ou remota (sem fio) [TEMPORARIO]

#arq_dadoCamAtu = 'inicializar.json'
with open('inicializar.json', 'r') as dado:
    DadoC = json.load(dado)
Escolha = DadoC['comeca']

#ESTRUTURA UTILIZADA PARA ENCODAR APENAS UMA IMAGEM:
#   imgAluno = "../armazenamento/arquivos/imagens/Dev_X/Dev_X_F02.jpg" #Foto em armazenamento local
#   imgEnt = fr.load_image_file(imgAluno)
#   encodeAluno = fr.face_encodings(imgEnt)[0]

#REALIZAR TESTES PARA VERIFICAR SE É MELHOR COM OU SEM
#imgAluno = cv2.cvtColor(imgAluno,cv2.COLOR_BGR2RGB)   #Faz as alterações de cor da imagem

#Pega os pontos do rosto da imagem do json
encodeAluno = R_encods_Get()

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
        for c in range(len(encodeAluno)):
            if fremL[f] != [] and fremL[f] != 0:
                try:
                    #Realiza a comparação dos rostos e a distância entre eles
                    compr = fr.compare_faces([encodeAluno[c][0]], encodeCam[0])
                    distancia = fr.face_distance([encodeAluno[c][0]], encodeCam[0])
                    #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
                    if(distancia <= 0.5):
                        print(f'{encodeAluno[c][1]} Detectado!')
                        print('Distancia: ', distancia)

                    else:
                    #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
                        print('DIFERENTE')
                        print(distancia)
                except:
                    print(f"Não foi possível detectar alguém na imagem")
            else:
                print('Nenhum rosto encontrado!')
