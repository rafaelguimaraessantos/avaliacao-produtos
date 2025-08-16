# TechStore - E-commerce de Produtos

Um projeto de e-commerce simples desenvolvido em PHP com interface responsiva usando Bootstrap.

## 🚀 Funcionalidades

- **Listagem de Produtos**: Grid responsivo com cards de produtos
- **Busca em Tempo Real**: Filtro de produtos por título e categoria
- **Página de Detalhes**: Informações completas do produto com slider de imagens
- **Design Responsivo**: Interface adaptável para desktop e mobile
- **Navegação Intuitiva**: Breadcrumbs e navegação clara

## 🛠️ Tecnologias Utilizadas

- **Backend**: PHP 8.2
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5.3.0
- **Ícones**: Font Awesome 6.0.0
- **Containerização**: Docker & Docker Compose
- **Dados**: JSON estático

## 📁 Estrutura do Projeto

```
listagem-produtos/
├── data/
│   └── products.json          # Dados dos produtos
├── index.php                  # Página de listagem
├── product.php               # Página de detalhes
├── docker-compose.yml        # Configuração Docker
├── .gitignore               # Arquivos ignorados pelo Git
└── README.md                # Documentação
```

## 🚀 Como Executar

### Pré-requisitos
- Docker
- Docker Compose

### Passos para Execução

1. **Clone o repositório**
   ```bash
   git clone <url-do-repositorio>
   cd listagem-produtos
   ```

2. **Inicie os containers**
   ```bash
   docker-compose up -d
   ```

3. **Acesse a aplicação**
   ```
   http://localhost:8080
   ```

## 📋 Funcionalidades Implementadas

### Página de Listagem (`index.php`)
- ✅ Grid responsivo de produtos
- ✅ Busca em tempo real por título e categoria
- ✅ Cards com imagem, título, descrição e preço
- ✅ Botão "Ver Mais" para cada produto
- ✅ Animações CSS suaves
- ✅ Design moderno com Bootstrap

### Página de Detalhes (`product.php`)
- ✅ Informações completas do produto
- ✅ Slider de imagens com navegação
- ✅ Thumbnails para seleção de imagens
- ✅ Navegação por teclado (setas)
- ✅ Auto-play do slider
- ✅ Produtos relacionados
- ✅ Breadcrumbs para navegação

### Dados (`data/products.json`)
- ✅ 6 produtos de exemplo
- ✅ Múltiplas imagens por produto
- ✅ Categorias organizadas
- ✅ Preços formatados

## 🎨 Características do Design

- **Responsivo**: Adaptável a diferentes tamanhos de tela
- **Moderno**: Interface limpa e profissional
- **Interativo**: Animações e transições suaves
- **Acessível**: Navegação por teclado e semântica HTML

## 🔧 Configurações Docker

O projeto utiliza:
- **PHP 8.2** com Apache
- **Porta 8080** para acesso
- **Volume montado** para desenvolvimento em tempo real

## 📝 Padrões de Commit

Este projeto segue padrões de commit semânticos:
- `feat:` Nova funcionalidade
- `fix:` Correção de bug
- `docs:` Documentação
- `style:` Formatação de código
- `refactor:` Refatoração
- `test:` Testes
- `chore:` Tarefas de manutenção

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'feat: Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👨‍💻 Autor

Desenvolvido como projeto de estudo em PHP e desenvolvimento web.