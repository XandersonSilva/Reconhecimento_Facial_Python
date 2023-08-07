# Usando um celular como webcam

    A dentro do script é ultilizado o cv2 para ler um video que esta sendo transmitido por um celular na rede local, o qual esta ultilizando o app IP Webcam disponivel na play store.

1. Funcionamento:
    * O app *IP webcam* cria um servidor de streaming de vídeo usando a rede Wi-Fi do dispositivo Android. Ele atribui um endereço IP e uma porta ao servidor, permitindo que outros dispositivos acessem o stream de vídeo.

2. Configuração :
    * Baixe e instale o aplicativo "Webcam IP" no dispositivo Android.
    * Abra o aplicativo e conceda permissões.
    * Anote o endereço IP e a porta exibidos pelo aplicativo.

3. Conexão com o Script:
No script Python, defina a variável ip como o endereço IP do dispositivo Android e a variável porta como a porta do aplicativo "Webcam IP". Esses valores permitem que o script acesse o stream de vídeo transmitido pelo dispositivo.

---

## Link do app __IP Webcam__

 [IP Webcam](https://play.google.com/store/apps/details?id=com.pas.webcam&hl=pt_BR&gl=US)