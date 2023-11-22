# Dados do usuário armazenados no arquivo dados.json

Este documento descreve como os dados estão armazenados no JSON, o qual é utilizado para armazenar informações relacionadas aos possíveis usuários da aplicação.

---
## Estrutura do JSON

O JSON é uma lista de objetos, onde cada objeto representa um usuário. Cada usuário possui os seguintes campos:

- **nome:** Uma string que armazena o nome do usuário.

- **classe:** Um número inteiro que representa uma identificação numérica ou classe associada ao usuário.

- **Caminho_das_fotos:** Uma lista utilizada para armazenar caminhos de arquivos de fotos do rosto do respectivo usuário.

- **face_Encoded:** Uma lista vazia que pode ser utilizada para armazenar dados da codificação facial do usuário . Inicialmente, essa lista é vazia.

---
## Exemplo de Dados

Aqui está um exemplo de como os dados são representados no JSON:

```json
[
  {
    "nome": "Exemplo1",
    "classe": 44,
    "Caminho_das_fotos": [],
    "face_Encoded": []
  },
  {
    "nome": "Exemplo2",
    "classe": 55,
    "Caminho_das_fotos": [],
    "face_Encoded": []
  },
   {
    "nome": "Exemplo3",
    "classe": 44,
    "Caminho_das_fotos": [],
    "face_Encoded": []
  }

]
```

| Campo             | Escalabilidade | Tipo de Dado | Máscara        | Obrigatoriedade | Domínio     | Restrições | Descrição                                            |
|-------------------|----------------|--------------|----------------|-----------------|-------------|------------|----------------------------------------------------|
| nome              | -              | Texto        | -              | Sim             | -           | -          | Nome do usuário |
| classe            | -              | Númerico     | -              | Sim             | -           | -          | Identificação numérica ou classe associada.         |
| Caminho_das_fotos | Variável       |    Lista     | -              | Não especificado | -           | -          | Lista de caminhos de arquivos de fotos.            |
| face_Encoded      | Variável       |    Lista     | -              | Não especificado | -           | -          | Lista de dados relacionados à codificação facial.  |
