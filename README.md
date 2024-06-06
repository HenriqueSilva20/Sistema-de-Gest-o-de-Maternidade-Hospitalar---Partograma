# Sistema de Gestão de Maternidade Hospitalar

## Visão Geral

O Sistema de Gestão de Maternidade Hospitalar é uma solução completa projetada para melhorar a eficiência, precisão e qualidade dos serviços de maternidade em hospitais. Ele integra várias funcionalidades para gerenciar todos os aspectos da maternidade, desde o acompanhamento pré-natal até o pós-parto, oferecendo uma plataforma única e centralizada para médicos, enfermeiros, administradores e pacientes.

## Importância do Sistema

A gestão eficiente da maternidade é crucial para garantir a saúde e o bem-estar tanto das mães quanto dos recém-nascidos. Este sistema é essencial por vários motivos:

- **Aprimoramento da Qualidade do Atendimento**: Facilita a comunicação e a coordenação entre a equipe médica, garantindo que as pacientes recebam o melhor cuidado possível.
- **Precisão nos Registros Médicos**: Mantém registros médicos detalhados e precisos, reduzindo erros e melhorando a tomada de decisões clínicas.
- **Eficiência Operacional**: Automatiza tarefas administrativas e operacionais, liberando mais tempo para o pessoal médico focar no cuidado dos pacientes.
- **Segurança e Conformidade**: Assegura que todas as práticas estão em conformidade com os regulamentos de saúde e segurança, protegendo os dados dos pacientes.
- **Acesso Fácil às Informações**: Proporciona acesso rápido e fácil a informações críticas, desde históricos médicos até planos de tratamento.

## Funcionalidades Principais

- **Cadastro de Administradores como: Chefes de Turno, Médicos e Recepionistas**: Podemos cadastraras pessoas que terão acesso ao sistema de acordo com o seu perfil administrador, médico ou recepcionista 
- **Cadastro de Clientes**: Cadastrar clientes que entraramna maternidade
## Instalação
Para instalar e configurar o projeto Laravel, siga os passos abaixo:

1. **Clone o repositório:**
    ```sh
    git clone https://github.com/HenriqueSilva20/Sistema-de-Gestao-de-Maternidade-Hospitalar---Partograma.git
    ```
2. **Navegue até o diretório do projeto:**
    ```sh
    cd sistema-gestao-maternidade
    ```
3. **Instale as dependências do Composer:**
    ```sh
    composer install
    ```
4. **Copie o arquivo de exemplo `.env` e configure o ambiente:**
    ```sh
    cp .env.example .env
    ```
5. **Gere a chave da aplicação:**
    ```sh
    php artisan key:generate
    ```
6. **Configure o arquivo `.env` com as informações do seu banco de dados:**
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sgmh
    DB_USERNAME=root
    DB_PASSWORD=""
    ```
7. **Execute as migrações para criar as tabelas do banco de dados:**
    ```sh
    php artisan migrate
    ```
8. **Instale as dependências do NPM:**
    ```sh
    npm install
    ```
9. **Compile os assets do frontend:**
    ```sh
    npm run dev
    ```
10. **Inicie o servidor de desenvolvimento:**
    ```sh
    php artisan serve
    ```

## Contribuição

Contribuições são bem-vindas! Siga os passos abaixo para contribuir:

1. Fork o projeto.
2. Crie uma nova branch:
    ```sh
    git checkout -b minha-nova-funcionalidade
    ```
3. Faça suas modificações e commite:
    ```sh
    git commit -m 'Adiciona nova funcionalidade'
    ```
4. Envie para o repositório remoto:
    ```sh
    git push origin minha-nova-funcionalidade
    ```
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a Licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## Contato

Para mais informações, entre em contato através do email: 949281068

---

**Sistema de Gestão de Maternidade Hospitalar** - Melhorando a qualidade do atendimento à maternidade.
