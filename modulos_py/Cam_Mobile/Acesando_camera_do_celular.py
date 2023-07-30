import cv2

# Criando o link com o video vindo da câmera
 
ip = "x.y.w.z"
porta =  "8080"
Link_CamM = f"https://{ip}:{porta}/video"

video = cv2.VideoCapture()
video.open(Link_CamM)

escala = (640, 480)
freq = 10

#Ainda não implementei a para utilizar as imagens que ele armazena, apenas para exibi-las
while True: 
    check, img = video.read()
    
    if cv2.waitKey(freq)==ord('q') or not check:
        break
    else:
        img = cv2.resize(img, escala)
        cv2.imshow('img', img)