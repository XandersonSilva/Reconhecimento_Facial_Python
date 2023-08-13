import json

caminhoJson = '../Dados_Imagens/dados.json'
with open( caminhoJson, 'r', encoding='utf-8') as info:
    #Transformando os dados do json em um dicionario python
    dados = json.load(info)

Ldados = []
    #Jogando os dados do dicionario em indices de uma lista
for i in dados:
    Ldados.append(i)
        
def CmhsJson():
    #Procurando o caminho das fotos na estrutura de cada indice
    caminhos = []
    quant = len(Ldados)
    for c in range(0, quant):
        Lcaminhos = Ldados[c]['Caminho_das_fotos']
        if Lcaminhos != 0:
            for f in range (len(Lcaminhos)):
                caminhos.append(Lcaminhos[f])
    return caminhos

def ApagaCaminho(Apagar):
    quant = len(Ldados)
    for c in range(0, quant):
        Lcaminhos = Ldados[c]['Caminho_das_fotos']
        quantCmnh =  len(Lcaminhos)
        if quantCmnh > 0:
            conter = quantCmnh - 1
            while conter >= 0:
                CmhAtu =  Ldados[c]['Caminho_das_fotos'][conter]
                if CmhAtu == Apagar :
                    Ldados[c]['Caminho_das_fotos'].pop(conter)
                conter -= 1
    with open (caminhoJson, 'w', encoding='utf-8') as arquivo:
        json.dump(Ldados , arquivo)
