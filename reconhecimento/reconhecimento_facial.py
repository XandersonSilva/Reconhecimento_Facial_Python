import cv2
import face_recognition as fr

webCamera = cv2.VideoCapture(0)

#Imagem do aluno
imgAluno = fr.load_image_file('reconhecimento/0.jpeg')

#REALIZAR TESTES PARA VERIFICAR SE É MELHOR COM OU SEM
#Faz as alterações de cor da imagem
#imgAluno = cv2.cvtColor(imgAluno,cv2.COLOR_BGR2RGB)

#Pega os pontos do rosto da imagem
encodeAluno = fr.face_encodings(imgAluno)[0]

while True:

    #Aperte F para finalizar o programa (na tela da webcam)
    if cv2.waitKey(1) == ord('f'):
            break

    #Ativa a camera
    camera, frame = webCamera.read()
    img2=cv2.flip(frame, 1)

    cv2.imshow("WebCam", img2)

    try:
        #Pega os pontos do rosto da camera
        RE = True
        encodeCam = fr.face_encodings(img2)[0]

    except:
        RE = False
        pass
    
    if(RE == True):
        #Realiza a comparação dos rostos e a distância entre eles
        distancia = fr.face_distance([encodeAluno],encodeCam)

        #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
        if(distancia <= 0.5):
            print('MESMA PESSOA')
            print(distancia)

        else:
            #Printa se é a mesma pessoa, e a distância dos valores dos rostos.
            print('DIFERENTE')
            print(distancia)
    else:
        print('Rosto não encontrado.')