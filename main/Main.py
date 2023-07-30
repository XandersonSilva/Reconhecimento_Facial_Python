import cv2 
import face_recognition as fr
from modulos_py.WebCamPC.WebCam import Rec


resolucao_P = (750,873) 

imagem_modl = "../arquivos/imagens_Gf/EU_F02.jpg"

 
imgEnt = fr.load_image_file(imagem_modl)
#imgEnt = cv2.resize(imgEnt, resolucao_P)
imgEnt=  cv2.cvtColor(imgEnt, cv2.COLOR_BGR2RGB)
encodeEnt = fr.face_encodings(imgEnt)[0]
faceLoc = fr.face_locations(imgEnt)[0] #pegando a localização


fim = 0

while fim != 1:
    fremL = Rec()
    Quant = len(fremL)
    print(Quant)
    for f in range(0, Quant):
        imgComp = fremL[f]
        imgComp = cv2.resize(imgComp, resolucao_P)
        imgComp =  cv2.cvtColor(imgComp, cv2.COLOR_BGR2RGB)
        encodeComp = fr.face_encodings(imgComp)
        

        #COMPARACAO
        try:
            compr = fr.compare_faces([encodeEnt], encodeComp[0])
            distanc = fr.face_distance([encodeEnt], encodeComp[0])
            print(compr , ' ', distanc)
        except:
            print(f"Não foi possível detectar alguém na imagem {f}")

    
