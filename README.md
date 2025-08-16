# 🛍️ TechStore - E-commerce Dinâmico

Um projeto completo de e-commerce desenvolvido em **PHP** com sistema avançado de avaliação de produtos em **JavaScript puro**, oferecendo uma experiência de usuário dinâmica e realista.

## 🎯 Visão Geral

O TechStore é uma plataforma de e-commerce que simula o comportamento real de uma loja online, com funcionalidades avançadas de avaliação de produtos, dados dinâmicos e interface responsiva.

## ✨ Funcionalidades Principais

### 🛒 **E-commerce Básico**
- **Listagem de Produtos**: Grid responsivo com cards interativos
- **Busca em Tempo Real**: Filtro inteligente por título e categoria
- **Página de Detalhes**: Informações completas com galeria de imagens
- **Design Responsivo**: Interface adaptável para todos os dispositivos
- **Navegação Intuitiva**: Breadcrumbs e navegação clara

### ⭐ **Sistema de Avaliação Avançado**
- **Avaliação com Estrelas**: Sistema de 1-5 estrelas interativo
- **Dados Dinâmicos**: Média e total de avaliações em tempo real
- **Sincronização Completa**: Dados atualizados em toda a página
- **Estoque Dinâmico**: Quantidade de produtos varia automaticamente
- **Simulação Realista**: Comportamento de loja real simulado
- **Notificações Elegantes**: Alertas sobre mudanças em tempo real

## 🛠️ Stack Tecnológica

### **Backend**
- **PHP 8.2** - Lógica de servidor e renderização
- **Apache** - Servidor web
- **JSON** - Armazenamento de dados estático

### **Frontend**
- **HTML5** - Estrutura semântica
- **CSS3** - Estilos e animações avançadas
- **JavaScript Puro** - Interatividade e lógica dinâmica
- **Bootstrap 5.3.0** - Framework CSS responsivo
- **Font Awesome 6.0.0** - Ícones profissionais

### **Infraestrutura**
- **Docker & Docker Compose** - Containerização
- **Git** - Controle de versão

## 🎯 **Justificativa para JavaScript Puro**

### **Por que JavaScript Puro e não um Framework?**

A escolha pelo **JavaScript puro** foi estratégica e baseada em critérios objetivos:

#### **1. Simplicidade e Performance**
- **Sem dependências externas**: Não requer frameworks como React, Vue ou Angular
- **Carregamento rápido**: Menos arquivos para baixar e processar
- **Execução eficiente**: Código direto sem camadas de abstração

#### **2. Compatibilidade Universal**
- **Funciona em todos os navegadores**: Sem necessidade de polyfills
- **Sem build process**: Não requer transpilação ou bundling
- **Deploy simples**: Funciona imediatamente em qualquer servidor

#### **3. Manutenibilidade**
- **Código direto**: Fácil de entender e modificar
- **Sem curva de aprendizado**: Qualquer desenvolvedor pode contribuir
- **Debugging simples**: Erros fáceis de identificar e corrigir

#### **4. Integração Perfeita**
- **Compatibilidade total** com PHP existente
- **Sem conflitos**: Não interfere com o backend
- **Flexibilidade**: Fácil de estender e customizar

#### **5. Requisitos do Projeto**
- **Armazenamento local**: localStorage é nativo do JavaScript
- **DOM manipulation**: JavaScript puro é ideal para manipulação direta
- **Event handling**: Sistema nativo de eventos é suficiente
- **Simulação em tempo real**: setInterval e setTimeout nativos

#### **6. Escalabilidade**
- **Modular**: Código organizado em classes e funções
- **Reutilizável**: Componentes podem ser facilmente reutilizados
- **Extensível**: Fácil adicionar novas funcionalidades

## 📁 Estrutura do Projeto

```
avaliacao-produtos/
├── assets/
│   ├── css/
│   │   └── style.css              # Estilos principais
│   └── js/
│       ├── rating-system.js       # Sistema de avaliação
│       └── product-list-rating.js # Sincronização da listagem
├── data/
│   └── products.json              # Dados dos produtos
├── img/                           # Imagens dos produtos
├── index.php                      # Página de listagem
├── product.php                    # Página de detalhes
├── docker-compose.yml             # Configuração Docker
├── SISTEMA_AVALIACAO.md           # Documentação do sistema
├── DEMONSTRACAO.md                # Guia de demonstração
└── README.md                      # Este arquivo
```

## 🚀 Como Executar

### **Opção 1: Docker (Recomendado)**

```bash
# Clone o repositório
git clone <url-do-repositorio>
cd avaliacao-produtos

# Inicie os containers
docker-compose up -d

# Acesse a aplicação
http://localhost:8080
```

### **Opção 2: PHP Local**

```bash
# Clone o repositório
git clone <url-do-repositorio>
cd avaliacao-produtos

# Instale o PHP (se necessário)
sudo apt install php8.2-cli

# Inicie o servidor PHP
php -S localhost:8000

# Acesse a aplicação
http://localhost:8000
```

## 🎮 Como Testar o Sistema

### **1. Sistema de Avaliação**
1. Acesse qualquer produto
2. Role até "Avaliações do Produto"
3. Clique nas estrelas (1-5)
4. Observe a média atualizar instantaneamente
5. Veja a sincronização em toda a página

### **2. Dados Dinâmicos**
- **A cada 30 segundos**: Estoque muda automaticamente
- **A cada 60 segundos**: Novas avaliações podem aparecer
- **Notificações**: Alertas sobre mudanças em tempo real

### **3. Sincronização**
- Avalie um produto na página de detalhes
- Volte para a listagem
- Veja os dados atualizados automaticamente

## 🔧 Funcionalidades Técnicas

### **Sistema de Avaliação**
```javascript
// Exemplo de uso
initProductRatingSystem(
    productId,        // ID do produto
    initialRating,    // Nota inicial
    initialReviews    // Total inicial de avaliações
);
```

### **Armazenamento Local**
```javascript
// Avaliações
localStorage.setItem('product_ratings_1', JSON.stringify(ratingsArray));

// Estoque
localStorage.setItem('product_stock_1', JSON.stringify(stockData));
```

### **Sincronização Automática**
- **Cross-page**: Dados mantidos entre páginas
- **Real-time**: Atualizações automáticas
- **Visual feedback**: Efeitos de destaque

## 📊 Características do Design

### **Interface**
- **Responsivo**: Adaptável a todos os dispositivos
- **Moderno**: Design limpo e profissional
- **Interativo**: Animações e transições suaves
- **Acessível**: Navegação por teclado e semântica HTML

### **Experiência do Usuário**
- **Intuitivo**: Interface clara e fácil de usar
- **Realista**: Simula comportamento de loja real
- **Engajante**: Dados dinâmicos mantêm interesse
- **Profissional**: Notificações e feedback elegantes

## 🧪 Testes e Validação

### **Cenários Testados**
- ✅ Avaliação inicial de produtos
- ✅ Múltiplas avaliações do mesmo usuário
- ✅ Cálculo correto da média
- ✅ Persistência dos dados
- ✅ Interface responsiva
- ✅ Animações e feedback visual
- ✅ Atualização dinâmica de estoque
- ✅ Avaliações automáticas
- ✅ Sistema de notificações
- ✅ Sincronização completa

### **Compatibilidade**
- ✅ Chrome (versões recentes)
- ✅ Firefox (versões recentes)
- ✅ Safari (versões recentes)
- ✅ Edge (versões recentes)
- ✅ Dispositivos móveis

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
2. Crie uma branch para sua feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -m 'feat: Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/NovaFuncionalidade`)
5. Abra um Pull Request

## 📚 Documentação Adicional

- **[SISTEMA_AVALIACAO.md](SISTEMA_AVALIACAO.md)** - Documentação técnica completa
- **[DEMONSTRACAO.md](DEMONSTRACAO.md)** - Guia de demonstração passo a passo

## 🎯 Próximas Melhorias

### **Funcionalidades Futuras**
- Sistema de usuários com login
- Comentários personalizados
- Filtros avançados de avaliação
- Backend real com banco de dados
- Sistema de moderação
- Histórico de preços dinâmico
- Produtos relacionados inteligentes

### **Otimizações**
- Lazy loading de avaliações
- Suporte a leitores de tela
- Dados estruturados para SEO
- Métricas de engajamento
- Cache inteligente

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👨‍💻 Autor

Desenvolvido como projeto de estudo em **PHP** e **JavaScript puro**, demonstrando a implementação de funcionalidades avançadas de e-commerce com foco em experiência do usuário e performance.

---

**⭐ Se este projeto foi útil, considere dar uma estrela no repositório!**