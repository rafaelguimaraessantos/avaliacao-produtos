<?php
// Carregar dados dos produtos
$jsonData = file_get_contents('data/products.json');
$data = json_decode($jsonData, true);
$products = $data['products'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce - Listagem de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shopping-cart me-2"></i>
                TechStore
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <div class="search-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="text-center mb-4 text-white" style="font-weight: bold;">Encontre os Melhores Produtos</h1>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-0" placeholder="Buscar produtos...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h2>Nossos Produtos</h2>
                <p class="text-muted">Encontre produtos incríveis com os melhores preços</p>
            </div>
        </div>

        <div class="row" id="productsContainer">
            <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4 product-item" data-title="<?= strtolower($product['title']) ?>" data-category="<?= strtolower($product['category']['name']) ?>">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="<?= $product['images'][0]['url'] ?>" class="card-img-top product-image" alt="<?= $product['images'][0]['alt'] ?>">
                        <span class="badge bg-primary category-badge"><?= $product['category']['name'] ?></span>
                        <?php if ($product['price']['discount_percentage'] > 0): ?>
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">-<?= $product['price']['discount_percentage'] ?>%</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $product['title'] ?></h5>
                        <p class="card-text text-muted"><?= $product['short_description'] ?></p>
                        <div class="price mb-3">
                            <span class="current-price">R$ <?= number_format($product['price']['current'], 2, ',', '.') ?></span>
                            <?php if ($product['price']['discount_percentage'] > 0): ?>
                            <span class="original-price text-muted text-decoration-line-through ms-2">R$ <?= number_format($product['price']['original'], 2, ',', '.') ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="rating">
                                <i class="fas fa-star text-warning"></i>
                                <span class="ms-1"><?= $product['ratings']['average'] ?></span>
                                <span class="text-muted">(<?= $product['ratings']['total_reviews'] ?>)</span>
                            </div>
                            <div class="stock-status">
                                <?php if ($product['stock']['quantity'] > 0): ?>
                                <span class="badge bg-success">Em estoque</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Indisponível</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-primary w-100">
                                <i class="fas fa-eye me-2"></i>Ver Mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h3>Nenhum produto encontrado</h3>
            <p class="text-muted">Tente ajustar sua busca ou verificar a ortografia</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h6 class="text-white mb-3">Formas de Pagamento</h6>
                    <div class="payment-methods">
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/cartao-luiza.svg" alt="Cartões LuizaCred" width="40" height="25">
                        </div>
                        
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/boleto.svg" alt="Boleto Bancário" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/visa.svg" alt="Cartão Visa" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/mastercard.svg" alt="Cartão MasterCard" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/diners.svg" alt="Cartão Diners" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/hipercard.svg" alt="Cartão Hipercard" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/elo.svg" alt="Cartão Elo" width="40" height="25">
                        </div>
                        <div class="payment-item">
                            <img src="https://wx.mlcdn.com.br/site/desk/footer/payment-types/aura.svg" alt="Cartão Aura" width="40" height="25">
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-white">&copy; 2024 TechStore. Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função de busca em tempo real
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-item');
            let visibleCount = 0;

            products.forEach(product => {
                const title = product.getAttribute('data-title');
                const category = product.getAttribute('data-category');
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    product.style.display = 'block';
                    visibleCount++;
                } else {
                    product.style.display = 'none';
                }
            });

            // Mostrar/ocultar mensagem de "nenhum resultado"
            const noResults = document.getElementById('noResults');
            if (visibleCount === 0) {
                noResults.style.display = 'block';
            } else {
                noResults.style.display = 'none';
            }
        });

        // Animação de entrada dos produtos
        document.addEventListener('DOMContentLoaded', function() {
            const products = document.querySelectorAll('.product-item');
            products.forEach((product, index) => {
                product.style.opacity = '0';
                product.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    product.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    product.style.opacity = '1';
                    product.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
