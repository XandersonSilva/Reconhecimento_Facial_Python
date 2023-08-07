import cv2 
import json
import face_recognition as fr
from ModulosPy.Inicializar.inicializar import ini
from ModulosPy.WebCamPC.WebCam import Rec
from ModulosPy.Cam_Mobile.Mobile_cam import MobileRec 

    

ini() #Pergunta se a câmera a ser utilizada será local(com fio) ou remota (sem fio,

#arq_dadoCamAtu = 'inicializar.json'
with open('inicializar.json', 'r') as dado:
    DadoC = json.load(dado)
Escolha = DadoC['comeca']

resolucao_P = (750,873) 

imagem_modl = "../arquivos/imagens/Dev_X/Dev_X_F02.jpg"

 
imgEnt = fr.load_image_file(imagem_modl)
#imgEnt = cv2.resize(imgEnt, resolucao_P) Casso a imagem seja grande é possível redimenssiona-la
imgEnt=  cv2.cvtColor(imgEnt, cv2.COLOR_BGR2RGB)
encodeEnt = fr.face_encodings(imgEnt)[0]
faceLoc = fr.face_locations(imgEnt)[0] #pegando a localização



while True:
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
        imgComp = fremL[f]
        cv2.waitKey(1)
        #imgComp = cv2.resize(imgComp, resolucao_P)
        if Escolha == 0:
            imgComp =  cv2.cvtColor(imgComp, cv2.COLOR_BGR2RGB)
        #cv2.imshow('test',imgComp)     #Caso seja necessario ver como a imagem esta chegando no código descomente issso
        encodeComp = fr.face_encodings(imgComp)
        

        #COMPARACAO
        try:

            compr = fr.compare_faces([encodeEnt], encodeComp[0])
            distanc = fr.face_distance([encodeEnt], encodeComp[0])
            print(compr , ' ', distanc)
        except:
            print(f"Não foi possível detectar alguém na imagem {f}")
