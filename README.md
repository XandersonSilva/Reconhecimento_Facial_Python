<h1 align="center" style="font-weight: bold;">Sistema de catracas para o IFBA campus Jacobina</h1>

![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
	![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![Flask](https://img.shields.io/badge/flask-%23000.svg?style=for-the-badge&logo=flask&logoColor=white)
![OpenCV](https://img.shields.io/badge/opencv-%23white.svg?style=for-the-badge&logo=opencv&logoColor=white)
![NumPy](https://img.shields.io/badge/numpy-%23013243.svg?style=for-the-badge&logo=numpy&logoColor=white)

<p align="center">
 • <a href="#started">Início</a> • 
  <a href="#routes">Como rodar</a> •
 <a href="#colab">Colaboradores</a> •
</p>

<p align="center">
  <b>Este projeto consiste em um sistema de catracas com reconhecimento facial criado para ser utilizado em ambientes escolares.</b><br>
  <a href="#">Link para o artigo</a>
</p>

<h2 id="started">🚀 Início</h2>

<h3>Pré-requisitos</h3>

- [Python 3.10.12](https://www.python.org/downloads/)
- [PHP 8.0](https://www.php.net/)
- [Bootstrap 4.5.2](https://getbootstrap.com/)
- [OpenCV 4.6.0.66](https://pypi.org/project/opencv-python/)
- [Face_Recognition 1.3.0](https://pypi.org/project/face-recognition/)
- [Flask](https://pypi.org/project/Flask/)
- [Numpy 1.25.5](https://pypi.org/project/numpy/)
- [SQLITE](https://sqlite.org/)
- [Apache](https://httpd.apache.org/)


<h3 id="clone">Clonando</h3>

Como clonar o projeto

```bash
git clone https://github.com/XandersonSilva/Reconhecimento_Facial_Python
```

<h3> Instalando bibliotecas</h2>

- Opencv
```bash
pip install opencv-python==4.6.0.66
```

- Face_Recognition
```bash
pip install face-recognition
```

- Flask
```bash
pip install Flask
```

- Numpy
```bash
pip install numpy==1.25.5
```


<h2 id="routes">📍 Como rodar o projeto</h2>

<h2>Plataforma:</h2>
- <a href="#clone"> Clone o repositório pelo Github </a> 
​
- Inicie o apache
```bash
sudo start apache2
```

- Mova o projeto para a página do apache
``` bash
sudo mv /caminho/do/projeto /var/www/html/
```

- Inicie o servidor Flask

```bash
python3 /var/www/html/Reconhecimento_Facial_Python/main.py
```

A plataforma estará rodando no localhost pelo apache na porta padrão (80), o servidor Flask estará rodando no localhost na porta 5000

<h2>Reconhecimento:</h2>
- Rode o script do reconhecimento

```bash
python3 /var/www/html/Reconhecimento_Facial_Python/reconhecimento/reconhecimento.py
```


<h2 id="colab">🤝 Colaboradores</h2>

Desenvolvedores do projeto

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/SilvestreLago">
        <img src="https://avatars.githubusercontent.com/u/87388202?s=400&u=5cff68f423f0179ea01e5c6ab14c16bc9f798a31&v=4" width="100px;" alt="João foto"/><br>
        <sub>
          <b>João Silvestre</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/XandersonSilva">
        <img src="https://avatars.githubusercontent.com/u/107277411?v=4" width="100px;" alt="Xanderson foto"/><br>
        <sub>
          <b>Xanderson Silva</b>
        </sub>
      </a>
    </td>
    <td align="center">
      <a href="#">
        <img src=""width="100px;" alt="Rebeca foto"/><br>
        <sub>
          <b>Rebeca Barros</b>
        </sub>
      </a>
    </td>
  </tr>
</table>
