# cada pasta vai fazer uma função, fazendo a separação de tudo

# Funcionalidades

## app/core/Core.php
### Todas as requisições http passam pelo core.php
#### responsável por verificar a url e retornar a pagina que o usuario quer acessar
##### se não informarmos nada na url ele cai dentro da LoginController e após cai dentro do Metodo index e o metodo index retorna a view renderizada