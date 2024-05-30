# PARA ACESSAR A PÁGINA, É NECESSÁRIO QUE A PASTA COM OS ARQUIVOS ESTEJAM NO HTDOCS DO APACHE
# TAMBÉM É NECESSÁRIO ESTAR RODANDO O APACHE E ESTE ARQUIVO AO MESMO TEMPO, COM ISSO, PODERÁ
# ACESSAR O LOCALHOST E TESTAR.

#Importações
from flask import Flask, request, abort
import sys
sys.path.append("armazenamento/scripts")
from armazenamento.scripts.encod_fotos import codificar

#Função para buscar a chave do JSON que só permite requisições com a URL com esse parâmetro (codificar.php)
def key():
    with open("key.json", "r") as thekey:
            key = thekey.read()
            return key

#App Flask
app = Flask(__name__)

#Rota da validação
@app.route('/validate', methods=['GET'])

#Função para validação e codificação
def validate():
        #Caso a requisição seja feita sem os parâmetros corretos
        if request.full_path != "/validate?OK=" + key():
            #Mensagem de ERRO
            return abort(403)
        
        #Caso a requisição seja feita com os parâmetros corretos
        else: 
            #Chama a função de codificação (encod_fotos.py)
            codificacao = codificar()

            #Retorna para o PHP alerta de sem fotos a adicionar
            if codificacao == 0:
                return '<div class=\'alert alert-warning text-center  border border-warning\'>Sem fotos para adicionar.</div>'
            
            #Retorna ao PHP alerta de sucesso
            elif codificacao == 1:
                return '<div class=\'alert alert-success text-center  border border-success\'>Foto adicionada com sucesso.</div>'
            
# Inicia o servidor Flask
if __name__ == '__main__':
    app.run(threaded=False) 