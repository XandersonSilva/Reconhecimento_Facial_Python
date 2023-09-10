import cv2
import face_recognition as fr

def Rec():
    webcam = cv2.VideoCapture(0)
    if webcam.isOpened():
        valid = True
        fremL = []   # Lista com as imagens
    else:
        valid = False
        print('A câmera selecionada esta indisponivel!!!')
        fremL = 'ERRO'

    fim = 0       # Contador 
    finaliz = 2   # Valor máximo do contador
    freq = 0     # Frequência em milissegundos em que a câmera sera acessada
    while fim !=finaliz and valid:
        #capturar uma frame e armazena-la na variável 'frame'
        ret, frame = webcam.read()
        if fim == finaliz or not ret or fremL == 'ERRO':
            break
        fim += 1
        frame = cv2.flip(frame, 1)
        cv2.imshow('WebCam', frame)
        fremL.append(frame)
    webcam.release()
    #    cv2.destroyAllWindows()
    if isinstance(fremL, list): 
        cont = 0
        for f in fremL:
            try:
                fremL[cont] = fr.face_encodings(f)
            except:
                print("erro")
                fremL[cont] == 0
            cont +=1
    return fremL

