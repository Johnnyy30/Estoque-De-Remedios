#  Sistema Web de Gerenciamento do Estoque de Medicamentos em Postos de Saúde
>Este projeto foi desenvolvido para fins didaticos para as materia de Programação web e Projeto interdiciplinar do curso tecnico de Redes de Computadores no Centro Federal de Educação Tecnológica de Minas Gerais(CEFET-MG). O intuito do projeto é otimizar o controle de entradas, saídas,
validade e disponibilidade dos medicamentos, promovendo uma gestão mais eficiente e segura. Assim,espera-se como resultado adigitalização dos processos, a redução de erros e perdas, além da melhoria na eficiência da gestão de medicamentos nas unidades básicas de saúde, contribuindo para a qualidade de seus
serviços.

## instrucoes de instalação
>O projeto roda em localhost por isso alguns passos sao nessecarios.
### #1 - Clone o rep
```bash
git clone git@github.com:Johnnyy30/Estoque-De-Remedios.git
cd Estoque-De-Remedios
```
### #2 - Baixe o ambiente de desenvolvimento local (XAMPP)
> [XAMPP](https://www.apachefriends.org/pt_br/download.html)

### #3 - Baixe o sistema gerenciador de banco de dados(MYSQL)
> [MYSQL](https://dev.mysql.com/downloads/)

## Instrucoes de uso
### #1 - Crie o banco de dados
### Via Terminal (Linha de Comando):
#### 1. Abra o terminal ou prompt de comando.
#### 2. Certifique-se de que o arquivo .sql está acessível.
#### 3. Execute o comando
```bash
mysql -u usuario -p Estoque_de_Remedios < estoque.sql
```
### Via MySQL Workbench:
#### 1. Abra o Workbench e conecte-se ao servidor.
#### 2. Vá em File > Open SQL Script > navegue ate a pastado arquivo e selecione o arquivo.
#### 3. Clique no ícone de raio (Execute) para rodar todos os comandos


### #2 - Execute o projeto apartir do XAMPP
#### 1. Iniciar os Serviços: Abra o "XAMPP Control Panel" e clique em "Start" ao lado de Apache e MySQL.
#### 2. Preparar o Projeto: Copie a pasta do projeto para o diretório htdocs, geralmente localizado em C:\xampp\htdocs\.
#### 3. Acessar no Navegador: Abra seu navegador (Chrome, Firefox, etc.) e digite localhost/Estoque-De-Remedios.
