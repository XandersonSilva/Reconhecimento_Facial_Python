# PARA ACESSAR A PÁGINA, É NECESSÁRIO QUE A PASTA COM OS ARQUIVOS ESTEJAM NO HTDOCS DO APACHE
# TAMBÉM É NECESSÁRIO ESTAR RODANDO O APACHE E ESTE ARQUIVO AO MESMO TEMPO, COM ISSO, PODERÁ
# ACESSAR O LOCALHOST E TESTAR.


from flask import Flask, request, abort
import sys
sys.path.append("armazenamento/scripts")

from armazenamento.scripts.encod_fotos import teste

def key():
    with open("key.json", "r") as thekey:
            key = thekey.read()
            return key

app = Flask(__name__)

@app.route('/validate', methods=['GET'])
def validate():
    if request.full_path != "/validate?OK=" + key():
         return abort(403)
    else:
        asd = teste()
        if asd == 0:
            return '<div class=\'alert alert-warning text-center  border border-warning\'>Sem fotos para adicionar.</div>'
        elif asd == 1:
            return '<div class=\'alert alert-success text-center  border border-success\'>Foto adicionada com sucesso.</div>'
if __name__ == '__main__':
    app.run()