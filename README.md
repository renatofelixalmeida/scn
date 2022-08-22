# scn
Aplicação de teste seguindo os requisitos solicitados.

## Acessando no meu servidor web
O sistema está disponível em:
https://code.casanova.imb.br/index

Obs. Eu configurei o DNS hoje às 08:25 (brasília) e pode ser que demore algumas horas para propagar.

## Acessando o sistema no servidor local
Basta ter o php instalado e iniciar o servidor embarcado apontando o arquivo index.php.

Ex.: 

php -S localhost:8000 index.php

No navegador utilizar o seguinte endereço:

http://localhost:8000/index

## Requisitos atendidos
O sistema foi criado utilizando PHP 5.5+ com uma instalação padrão, sem necessidade de bibliotecas externas.

Foi utilizado o padrão MVC.

Conforme solicitado não foi utilizado um banco de dados, as tabelas são carregadas em memória dentro dos respectivos models. Utilizando essa abordagem, e como era um sistema muito simples implementei as classes apenas com o necessário para o funcionamento, não colocando métodos completos.

Todas as operações são feitas dinamicamente, alterando os dados estáticos nos respectivos models, as alterações se refletem de modo imediato nas consultas.

O sistema está disponível aqui no github, mas por falta de tempo não utilizei o sistema de versionamento durante a criação do código, desta forma teremos aqui apenas alguns commits.

## Requisitos não atendidos

Não utilizei um framework conhecido, optei por utilizar uma implementação simples de um sistema MVC que criei a algum tempo para agilizar o processo, pois o tempo era limitado.
