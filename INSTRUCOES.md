# Instruções de Uso - TechStore

## Como Executar o Projeto

### 1. Iniciar o Projeto
```bash
# Iniciar os containers Docker
sudo docker compose up -d

# Verificar se está rodando
sudo docker compose ps
```

### 2. Acessar a Aplicação
Abra seu navegador e acesse:
```
http://localhost:8080
```

### 3. Parar o Projeto
```bash
# Parar os containers
sudo docker compose down

# Parar e remover volumes (se necessário)
sudo docker compose down -v
```

## Comandos Úteis

### Docker
```bash
# Ver logs do container
sudo docker compose logs web

# Entrar no container
sudo docker compose exec web bash

# Reconstruir container
sudo docker compose up -d --build
```

### Git (Seguindo Padrões)
```bash
# Adicionar mudanças
git add .

# Commit seguindo padrões
git commit -m "tipo: descrição da mudança"

# Tipos de commit:
# feat: nova funcionalidade
# fix: correção de bug
# docs: documentação
# style: formatação
# refactor: refatoração
# test: testes
# chore: manutenção
```

## Funcionalidades Testadas

### Página de Listagem
- Grid responsivo de produtos
- Busca em tempo real
- Navegação para detalhes
- Animações CSS

### Página de Detalhes
- Slider de imagens
- Navegação por teclado
- Produtos relacionados
- Breadcrumbs

## Solução de Problemas

### Erro de Permissão Docker
```bash
# Adicionar usuário ao grupo docker
sudo usermod -aG docker $USER
# Reiniciar sessão
```

### Porta 8080 em Uso
```bash
# Verificar o que está usando a porta
sudo lsof -i :8080

# Ou alterar a porta no docker-compose.yml
```

### Container não Inicia
```bash
# Ver logs
sudo docker compose logs web

# Reconstruir
sudo docker compose up -d --build
```

## Próximos Passos

1. Melhorias Sugeridas:
   - Adicionar sistema de carrinho
   - Implementar filtros por categoria
   - Adicionar sistema de avaliações
   - Implementar paginação

2. Funcionalidades Avançadas:
   - Sistema de login
   - Banco de dados MySQL
   - API REST
   - Sistema de pagamentos

## Status do Projeto

- Estrutura básica implementada
- Docker configurado
- Páginas funcionais
- Design responsivo
- Documentação completa

O projeto está pronto para uso!
