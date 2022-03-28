# marcador-presenca
## CRUD para presenças - ADMIN

- Listagem com filtro por intervalo de datas - AdminPresencesListController
- Adição de presença por CPF - AddPresenceController
- Remoção de presença registrada a partir do ID - AdminRemovePresenceController
- Edição de presença registrada a partir do ID - AdminUpdatePresenceController

## Funcionário sem permissão de administrador
- Busca/Lista presenças por CPF - PresencesListController
- registra nova presença na data atual - AddPresenceController

## Tabelas
- Tabela de funcionário, onde o campo boolean `admin`  diz se o usuário possui ou não permissões de administrador
- Tabela de Presenças, linkada à tabela de funcionários pela chave estrangeira `CPF`

## Considerações
- Só é permitida a marcação da presença uma unica vez no dia
- criação de login no qual a partir do CPF é possível verificar no cadastro se é funcionário padrão ou administrador

## Testes
- unitários
- funionais

## Observações
