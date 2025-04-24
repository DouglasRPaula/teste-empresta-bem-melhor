# teste-empresta-bem-melhor

## Descrição do Projeto

Este projeto tem como objetivo a criação de uma API REST para simulação de empréstimos. A API foi construída utilizando PHP com o framework Laravel, e o ambiente de desenvolvimento foi configurado com o XAMPP.

## Tecnologias Utilizadas

- **PHP** com **Laravel**: Framework utilizado para a construção da API.
- **XAMPP**: Ambiente de desenvolvimento local para simulação do servidor.

## Dificuldades Encontradas

- Como se tratava de uma tecnologia com a qual eu não tinha muita experiência, foi necessário consultar a documentação frequentemente.
- A preparação do ambiente e configuração dos arquivos também representaram desafios iniciais, que foram superados ao longo do desenvolvimento.

## Como Rodar o Projeto

1. Clone o repositório em sua máquina local.
2. Configure o XAMPP e inicie o Apache.
3. Execute os comandos para instalar as dependências do Laravel:

    ```bash
    composer install
    ```
4. Execute o servidor localmente:
   php artisan serve
   
6. As rotas a serem implementadas são:
    - **GET /instituicoes**: Retorna as instituições disponíveis.
    - **GET /convenios**: Retorna os convênios disponíveis.
    - **POST /simulacao**: Realiza a simulação do empréstimo, considerando parâmetros como:
        - **valor_emprestimo** (float): O valor do empréstimo desejado (parâmetro obrigatório).
        - **instituicoes** (Array): Lista de instituições (parâmetro opcional).
        - **convenios** (Array): Lista de convênios (parâmetro opcional).
        - **parcela** (int): Quantidade de parcelas (parâmetro opcional).
    - A resposta da simulação retorna as informações de parcelas, valor da parcela, taxas e convênios.
7. A fórmula utilizada para calcular o valor das parcelas:
    - **Valor solicitado** multiplicado pelo **coeficiente** da instituição.

## Estrutura da API

### 1. Rota para instituições disponíveis

- **GET /instituicoes**

Resposta (Exemplo):
```json
{
  "1": "Instituição A",
  "2": "Instituição B",
  "3": "Instituição C"
}
```

Collection no Postman: https://.postman.co/workspace/My-Workspace~0e7269d3-351e-4086-8329-f27dcf8c0819/collection/24510695-18b89dca-023d-4168-ba95-c5527204147f?action=share&creator=24510695
