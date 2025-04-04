-- Inserir usuários (precisa ser antes dos artigos para garantir a referência correta)
INSERT INTO usuarios(nome, email, telefone, data_nascimento, cpf) VALUES
('xavier', 'xavier@gmail.com', '1234567890', '1985-04-15', '12345678901'),
('teste', 'teste@gmail.com', '1234567891', '1990-08-25', '98765432100'),
('santos', 'santos@gmail.com', '1234567892', '1988-12-01', '12332112345'),
('wellington', 'wellington@gmail.com', '1234567893', '1992-11-30', '54321678901'),
('Abraão', 'abraao@gmail.com', '1234567894', '2000-01-01', '11223344556'),
('Moisés', 'moises@gmail.com', '1234567895', '1980-03-15', '22334455667'),
('David', 'david@gmail.com', '1234567896', '1995-06-20', '33445566778'),
('Salomão', 'salomao@gmail.com', '1234567897', '1983-09-05', '44556677889'),
('Maria', 'maria@gmail.com', '1234567898', '1998-07-25', '55667788990'),
('José', 'jose@gmail.com', '1234567899', '1992-02-10', '66778899001'),
('Pedro', 'pedro@gmail.com', '1234567900', '1990-04-18', '77889900112'),
('Paulo', 'paulo@gmail.com', '1234567901', '1987-10-30', '88990011223'),
('Raquel', 'raquel@gmail.com', '1234567902', '1993-11-12', '99001122334'),
('Ruth', 'ruth@gmail.com', '1234567903', '1994-01-05', '10111223345'),
('Eliseu', 'eliseu@gmail.com', '1234567904', '1989-03-23', '11223344567'),
('Ester', 'ester@gmail.com', '1234567905', '1996-09-14', '22334455678'),
('Isaías', 'isaias@gmail.com', '1234567906', '1984-12-12', '33445566789'),
('Davi', 'davi@gmail.com', '1234567907', '1982-08-01', '44556677890'),
('Samuel', 'samuel@gmail.com', '1234567908', '1981-07-30', '55667788901'),
('Lázaro', 'lazaro@gmail.com', '1234567909', '1997-05-12', '66778899002');



-- Inserir categorias
insert into categorias (nome) values
('Sistemas'),
('Aplicativos Web'),
('Consultoria'),
('Suporte Técnico'),
('Desenvolvimento de Software'),
('Segurança da Informação'),
('Análise de Dados'),
('Inteligência Artificial'),
('Automação de Processos'),
('Gestão de TI'),
('Desenvolvimento Mobile'),
('Redes e Infraestrutura'),
('Cloud Computing'),
('Business Intelligence'),
('Suporte a Infraestrutura'),
('Implementação de ERP'),
('Data Science'),
('DevOps'),
('Marketing Digital'),
('Transformação Digital');


-- Inserir artigos (agora com os ids corretos dos usuários)
insert into artigos(titulo, conteudo, categoria_id, usuario_id) values
('Introdução ao Python: Linguagem para Iniciantes', 
 'Python é uma linguagem de programação de alto nível e fácil de aprender, amplamente usada para automação, análise de dados, inteligência artificial, desenvolvimento web e muito mais. Neste artigo, vamos explorar o básico do Python, desde variáveis até estruturas de controle, e como começar a escrever seu primeiro código.', 
 1, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('PHP: Como Criar Sites Dinâmicos e Interativos', 
 'PHP é uma das linguagens mais populares para desenvolvimento de sites dinâmicos. Neste artigo, vamos ensinar como usar o PHP para criar páginas interativas, processar formulários e conectar-se a bancos de dados, além de boas práticas para escrever código seguro.', 
 2, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Java: Estruturas de Dados e Algoritmos', 
 'Java é uma das linguagens mais poderosas e versáteis, usada para desenvolvimento de software em diversos campos. Neste artigo, discutimos como implementar e utilizar diferentes estruturas de dados, como listas, pilhas e filas, além de explorar alguns algoritmos clássicos que são essenciais para programadores Java.', 
 3, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('C# para Desenvolvimento de Aplicações Desktop e Web', 
 'C# é uma linguagem moderna da Microsoft, com suporte robusto para desenvolvimento de aplicações desktop e web. Neste artigo, vamos explorar como usar o C# no ambiente .NET para criar aplicações completas, abordando desde a criação de interfaces gráficas até a construção de aplicações web com ASP.NET.', 
 4, 4), -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'

('Segurança Cibernética: Protegendo Seu Sistema contra Ameaças', 
 'A segurança cibernética é uma das maiores preocupações no mundo digital de hoje. Este artigo explora as melhores práticas para proteger sistemas contra ameaças como hackers, malwares e ataques DDoS, abordando desde criptografia até políticas de segurança.', 
 5, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('React: Criando Interfaces de Usuário Interativas', 
 'O React é uma das bibliotecas mais populares para desenvolvimento de interfaces de usuário. Neste artigo, vamos explorar como criar componentes interativos usando o React, além de como organizar seu código de maneira eficiente e otimizar o desempenho da sua aplicação web.', 
 6, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Consultoria em TI: Como Melhorar a Performance da Sua Empresa', 
 'A consultoria em TI é uma ferramenta poderosa para melhorar a eficiência operacional das empresas. Neste artigo, discutimos como identificar pontos críticos, otimizar processos e escolher soluções tecnológicas que podem transformar a forma como sua empresa opera.', 
 7, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('Como Implementar Suporte Técnico Eficaz em Sua Empresa', 
 'O suporte técnico eficaz é essencial para garantir que a infraestrutura de TI de uma empresa esteja funcionando corretamente. Neste artigo, mostramos as melhores práticas para implementar um sistema de suporte técnico, incluindo o uso de ferramentas de monitoramento e atendimento ao cliente.', 
 8, 4), -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'

('Desenvolvimento de Software Ágil: Metodologias e Práticas', 
 'O desenvolvimento ágil tem revolucionado a forma como equipes de software trabalham. Neste artigo, exploramos as principais metodologias ágeis, como Scrum e Kanban, e como implementar práticas ágeis para acelerar a entrega de software de alta qualidade.', 
 9, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('Vue.js: Framework Progressivo para a Web', 
 'O Vue.js é um framework progressivo para a construção de interfaces de usuário. Neste artigo, mostramos como começar a trabalhar com Vue.js e como ele pode ser uma excelente alternativa ao React ou Angular em projetos de desenvolvimento de aplicações web.', 
 10, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Python para Análise de Dados: Primeiros Passos', 
 'Python é uma das linguagens mais populares para análise de dados. Neste artigo, vamos apresentar os principais conceitos e bibliotecas para começar a análise de dados com Python, como Pandas e Matplotlib, para processar e visualizar dados de forma eficiente.', 
 11, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('Windows Server: Gerenciando e Otimizando sua Infraestrutura', 
 'O Windows Server é uma plataforma robusta para servidores empresariais. Neste artigo, discutimos as melhores práticas para gerenciar e otimizar a infraestrutura de TI utilizando o Windows Server, incluindo o gerenciamento de usuários, segurança e performance.', 
 12, 4), -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'

('Como Implementar uma API RESTful com Node.js', 
 'Neste artigo, vamos aprender a construir uma API RESTful usando Node.js e Express. A API pode ser utilizada por aplicativos web ou móveis para realizar operações de CRUD e se comunicar com um banco de dados de forma eficiente e escalável.', 
 13, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('Angular: Framework para Desenvolvimento de Aplicações Web Escaláveis', 
 'O Angular é um framework robusto e completo para o desenvolvimento de aplicações web. Este artigo explora como usar o Angular para criar aplicações escaláveis e manter o código organizado, utilizando recursos como módulos, diretivas e injeção de dependência.', 
 14, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Estratégias de Consultoria para Otimização de Processos Empresariais', 
 'A consultoria pode ajudar empresas a identificar áreas de ineficiência e implementar soluções para otimizar seus processos. Neste artigo, discutimos estratégias eficazes de consultoria para ajudar organizações a melhorar seus fluxos de trabalho e aumentar sua produtividade.', 
 15, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('Gerenciamento de Redes: Como Manter sua Infraestrutura de TI Segura e Funcional', 
 'Gerenciar redes de forma eficiente é essencial para o funcionamento seguro e estável de qualquer organização. Neste artigo, abordamos as melhores práticas de gerenciamento de redes, incluindo segurança, monitoramento e resolução de problemas.', 
 16, 4), -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'

('Como Criar Aplicações em Java com Spring Framework', 
 'O Spring é um dos frameworks mais utilizados para o desenvolvimento de aplicações em Java. Neste artigo, vamos mostrar como configurar um projeto com Spring e utilizar suas funcionalidades para criar aplicações robustas, escaláveis e seguras.', 
 17, 1), -- Associando com categoria 'Sistemas' e usuário 'xavier'

('Docker: Implantação e Gerenciamento de Contêineres', 
 'Docker é uma plataforma que facilita a criação, implantação e gerenciamento de aplicativos em contêineres. Neste artigo, vamos ensinar como usar o Docker para criar ambientes de desenvolvimento consistentes e implantar aplicações de forma eficiente e escalável.', 
 18, 2), -- Associando com categoria 'Aplicativos Web' e usuário 'teste'

('Consultoria em Nuvem: Como Migrar sua Empresa para a Cloud', 
 'A migração para a nuvem pode trazer benefícios significativos, como escalabilidade e redução de custos. Neste artigo, discutimos as melhores práticas para migrar sistemas empresariais para a nuvem e garantir uma transição suave e segura.', 
 19, 3), -- Associando com categoria 'Consultoria' e usuário 'santos'

('Automatizando Processos com Python: Ferramentas e Técnicas', 
 'A automação de processos pode aumentar a eficiência e reduzir erros. Neste artigo, exploramos como usar Python para automatizar tarefas repetitivas, desde o envio de e-mails até a manipulação de arquivos e integração com APIs externas.', 
 20, 4); -- Associando com categoria 'Suporte Técnico' e usuário 'wellington'
