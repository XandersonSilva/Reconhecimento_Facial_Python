import cv2

def MobileRec():
    # Criando o link com o video vindo da câmera
    
    ip = "192.168.0.100" # Ainda não pensei em como pegar o IP via input 
    porta =  "8080"
    Link_CamM = f"https://{ip}:{porta}/video"

    video = cv2.VideoCapture()
    video.open(Link_CamM)

    escala = (640, 480) # Padronização da escala das imagens
    fremL = []          # Lista com as imagens
    fim = 0             # Contador 
    finaliz = 3         # Valor máximo do contador
    freq = 5            # Frequência em milissegundos em que a câmera sera acessada

    
    while True: 
        funciona, img = video.read()

        if not funciona or cv2.waitKey(freq)==ord('q') or fim == finaliz:
            break
        else:
            #img = cv2.resize(img, escala)
            fremL.append(img)
            fim += 1
    if fremL == []:
       fremL = 'ERRO'
    return fremL

