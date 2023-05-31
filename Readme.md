# Módulo Exemplo Grid Magento 2

## Instalação do módulo

1. Copie o diretório Infobase para dentro da loja Magento 2 em app -> code
2. Rode os seguintes comandos:

- php bin/magento setup:upgrade 
- php bin/magento setup:di:compile
- php bin/magento cache:clean
- php bin/magento cache:flush
- php bin/magento setup:static-content:deploy

## Configuração do módulo

1. Entre na área admin do magento 2
2. Selecione no menu Store -> Configuration para entrar na área de configuração
3. Agora em Infobase -> Infobase Queue
4. Selecione Enable Grid -> Yes e salve o formulário
5. No menu geral clique em System -> Cache Management
6. Clique no botão Flush Magento Cache

## Funcionalidades do módulo

### No menu geral clique em Infobase -> Queue

### Adicionar novo registro 

1. Clique em Add New
2. Preencha o formulário e clique em Save

### Pesquisa de registro

1. É possível pesquisar registro em todos os campos que possuem filtro e clique em Search

### Editar registro

1. Selecione o registro que deseja alterar
2. Altere os dados que deseja e clique em Save

### Deletar registro

1. É possível deletar registro na grid selecionando o link Delete
2. É possível deletar também na tela de editar
3. E também é possível excluir vários registros selecionando os registros que deseja excluir e em Actions selecione Delete e clique e Submit

