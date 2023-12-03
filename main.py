# PARA ACESSAR A PÁGINA, É NECESSÁRIO QUE A PASTA COM OS ARQUIVOS ESTEJAM NO HTDOCS DO APACHE
# TAMBÉM É NECESSÁRIO ESTAR RODANDO O APACHE E ESTE ARQUIVO AO MESMO TEMPO, COM ISSO, PODERÁ
# ACESSAR O LOCALHOST E TESTAR.


from flask import Flask, request, abort
import sys
sys.path.append("armazenamento/scripts")
from armazenamento.scripts.encod_fotos import teste

#Função para buscar a chave do JSON que só permite requisições com a URL com esse parâmetro (codificar.php)
def key():
    with open("key.json", "r") as thekey:
            key = thekey.read()
            return key

#app
app = Flask(__name__)

#Rota da validação
@app.route('/validate', methods=['GET'])

#Função para validação e codificação
def validate():
        print(request.full_path, '\n', )
        #Caso a requisição seja feita sem os parâmetros corretos
        if request.full_path != "/validate?OK=" + key():
            #Mensagem de ERRO
            return abort(403)
        
        else: 
            #Chama a função de codificação (encod_fotos.py)
            asd = teste()

            #Sem fotos para adicionar
            if asd == 0:
                return '<div class=\'alert alert-warning text-center  border border-warning\'>Sem fotos para adicionar.</div>'
            
            #Sucesso
            elif asd == 1:
                return '<div class=\'alert alert-success text-center  border border-success\'>Foto adicionada com sucesso.</div>'
            
if __name__ == '__main__':
     # Inicia o servidor Flask, desabilitando o suporte a threads 
     # por conta que o banco SQLite não suporta o uso de multiplas
     # threads "para fazer a mesma coisa (Não sei explicar não tive 
     # arquitetura de computadores)"
    app.run(threaded=False) 