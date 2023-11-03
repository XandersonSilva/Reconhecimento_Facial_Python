# PARA ACESSAR A PÁGINA, É NECESSÁRIO QUE A PASTA COM OS ARQUIVOS ESTEJAM NO HTDOCS DO APACHE
# TAMBÉM É NECESSÁRIO ESTAR RODANDO O APACHE E ESTE ARQUIVO AO MESMO TEMPO, COM ISSO, PODERÁ
# ACESSAR O LOCALHOST E TESTAR.


from flask import Flask, request, abort
import sys
sys.path.append("armazenamento/scripts")

from armazenamento.scripts.encod_fotos import teste

app = Flask(__name__)

@app.route('/validate', methods=['GET'])
def validate():
    if request.full_path != "/validate?OK=OK":
         return abort(403)
    else:
        asd = teste()
        if asd == 0:
            return "<h1>Sem fotos para adicionar</h1>"
        elif asd == 1:
            return "<h1>Foto adicionada</h1>"
if __name__ == '__main__':
    app.run()