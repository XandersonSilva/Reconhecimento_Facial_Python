import cv2

def Rec():
    webcam = cv2.VideoCapture(0)

    fremL = []   # Lista com as imagens
    fim = 0      # Contador 
    finaliz = 3  # Valor máximo do contador
    freq = 5     # Frequência em milissegundos em que a câmera sera acessada
    while fim !=finaliz:
        #capturar uma frame e armazena-la na variável 'frame'   
        ret, frame = webcam.read()

        if cv2.waitKey(freq)==ord('q') or fim == finaliz or not ret:
            break
        fim += 1
        cv2.imshow('t', frame)
        fremL.append(frame)
        print(fim)
    webcam.release()
    return fremL
