<?php
// Verificar se o ID do produto foi fornecido
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$productId = (int)$_GET['id'];

// Carregar dados dos produtos
$jsonData = file_get_contents('data/products.json');
$data = json_decode($jsonData, true);
$products = $data['products'];

// Encontrar o produto pelo ID
$product = null;
foreach ($products as $p) {
    if ($p['id'] == $productId) {
        $product = $p;
        break;
    }
}

// Se o produto não for encontrado, redirecionar para a listagem
if (!$product) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['title'] ?> - TechStore</title>
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
                        <a class="nav-link" href="index.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Produtos</a></li>
                <li class="breadcrumb-item"><a href="index.php"><?= $product['category']['name'] ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $product['title'] ?></li>
            </ol>
        </nav>
    </div>

    <!-- Product Details -->
    <div class="container my-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div class="product-gallery">
                    <img id="mainImage" src="<?= $product['images'][0]['url'] ?>" class="product-detail-image rounded" alt="<?= $product['images'][0]['alt'] ?>">
                    
                    <?php if (count($product['images']) > 1): ?>
                    <button class="gallery-nav prev" onclick="changeImage(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="gallery-nav next" onclick="changeImage(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <?php endif; ?>
                </div>
                
                <?php if (count($product['images']) > 1): ?>
                <div class="row mt-3">
                    <?php foreach ($product['images'] as $index => $image): ?>
                    <div class="col-3 mb-2">
                        <img src="<?= $image['url'] ?>" 
                             class="thumbnail rounded <?= $index === 0 ? 'active' : '' ?>" 
                             onclick="selectImage(<?= $index ?>)"
                             alt="<?= $image['alt'] ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge bg-primary"><?= $product['category']['name'] ?></span>
                    <?php if ($product['price']['discount_percentage'] > 0): ?>
                    <span class="badge bg-danger ms-2">-<?= $product['price']['discount_percentage'] ?>% OFF</span>
                    <?php endif; ?>
                </div>
                
                <h1 class="mb-3"><?= $product['title'] ?></h1>
                
                <div class="product-detail-price mb-4">
                    <span class="current-price fs-1">R$ <?= number_format($product['price']['current'], 2, ',', '.') ?></span>
                    <?php if ($product['price']['discount_percentage'] > 0): ?>
                    <div class="original-price text-muted text-decoration-line-through">R$ <?= number_format($product['price']['original'], 2, ',', '.') ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="rating me-3">
                        <i class="fas fa-star text-warning"></i>
                        <span class="ms-1 fw-bold product-rating-average"><?= $product['ratings']['average'] ?></span>
                        <span class="text-muted">(<span class="product-rating-count"><?= $product['ratings']['total_reviews'] ?></span> avaliações)</span>
                    </div>
                    <div class="stock-status product-detail-stock">
                        <?php if ($product['stock']['quantity'] > 0): ?>
                        <span class="badge bg-success">Em estoque (<?= $product['stock']['quantity'] ?> unidades)</span>
                        <?php else: ?>
                        <span class="badge bg-secondary">Indisponível</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Descrição</h5>
                    <p class="text-muted"><?= $product['full_description'] ?></p>
                </div>
                
                <!-- Especificações Técnicas -->
                <div class="mb-4">
                    <h5>Especificações Técnicas</h5>
                    <div class="specs-grid">
                        <?php foreach ($product['specifications'] as $key => $value): ?>
                        <div class="spec-item">
                            <strong><?= ucfirst(str_replace('_', ' ', $key)) ?>:</strong>
                            <?php if (is_array($value)): ?>
                                <?= implode(', ', $value) ?>
                            <?php else: ?>
                                <?= $value ?>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Sistema de Avaliação -->
                <div class="mb-4">
                    <h5>Avaliações do Produto</h5>
                    
                    <!-- Média das Avaliações -->
                    <div class="rating-summary mb-3">
                        <div class="d-flex align-items-center">
                            <div class="average-rating me-3">
                                <span class="average-score fs-2 fw-bold text-warning dynamic-data"><?= $product['ratings']['average'] ?></span>
                                <span class="text-muted">/ 5</span>
                                <span class="live-indicator"></span>
                            </div>
                            <div class="stars-display">
                                <div class="stars-container" data-rating="<?= $product['ratings']['average'] ?>">
                                    <i class="fas fa-star star-icon" data-value="1"></i>
                                    <i class="fas fa-star star-icon" data-value="2"></i>
                                    <i class="fas fa-star star-icon" data-value="3"></i>
                                    <i class="fas fa-star star-icon" data-value="4"></i>
                                    <i class="fas fa-star star-icon" data-value="5"></i>
                                </div>
                            </div>
                            <div class="total-reviews ms-3">
                                <span class="text-muted">(<?= $product['ratings']['total_reviews'] ?> avaliações)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Interface de Avaliação -->
                    <div class="rating-interface mb-3">
                        <h6>Deixe sua avaliação:</h6>
                        <div class="rating-stars">
                            <div class="stars-input" data-product-id="<?= $product['id'] ?>">
                                <i class="fas fa-star star-input" data-value="1"></i>
                                <i class="fas fa-star star-input" data-value="2"></i>
                                <i class="fas fa-star star-input" data-value="3"></i>
                                <i class="fas fa-star star-input" data-value="4"></i>
                                <i class="fas fa-star star-input" data-value="5"></i>
                            </div>
                            <div class="rating-text mt-2">
                                <span class="rating-label text-muted">Clique nas estrelas para avaliar</span>
                            </div>
                        </div>
                        <button id="submitRating" class="btn btn-primary btn-sm mt-2" style="display: none;">
                            <i class="fas fa-paper-plane me-1"></i>Enviar Avaliação
                        </button>
                    </div>

                    <!-- Lista de Avaliações -->
                    <div class="reviews-list">
                        <h6>Últimas Avaliações:</h6>
                        <div id="reviewsContainer" class="reviews-container">
                            <!-- As avaliações serão carregadas via JavaScript -->
                        </div>
                    </div>
                </div>
                
                <!-- Tags -->
                <?php if (!empty($product['tags'])): ?>
                <div class="mb-4">
                    <h6>Tags:</h6>
                    <div class="tags">
                        <?php foreach ($product['tags'] as $tag): ?>
                        <span class="badge bg-light text-dark me-1"><?= $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-block mb-4">
                    <button class="btn btn-primary btn-lg me-md-2">
                        <i class="fas fa-shopping-cart me-2"></i>Adicionar ao Carrinho
                    </button>
                    <button class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-heart me-2"></i>Favoritar
                    </button>
                </div>

                <!-- Product Features -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Características Principais</h5>
                        <ul class="specs-list">
                            <li><i class="fas fa-check-circle"></i> Produto de alta qualidade</li>
                            <li><i class="fas fa-shipping-fast"></i> Entrega rápida</li>
                            <li><i class="fas fa-shield-alt"></i> Garantia de 1 ano</li>
                            <li><i class="fas fa-undo"></i> Devolução em 30 dias</li>
                            <li><i class="fas fa-headset"></i> Suporte técnico</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-4">
            <div class="col">
                <h3>Produtos Relacionados</h3>
                <div class="row">
                    <?php 
                    $relatedProducts = array_filter($products, function($p) use ($product) {
                        return $p['category']['id'] === $product['category']['id'] && $p['id'] !== $product['id'];
                    });
                    $relatedProducts = array_slice($relatedProducts, 0, 3);
                    ?>
                    
                    <?php foreach ($relatedProducts as $related): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?= $related['images'][0]['url'] ?>" class="card-img-top related-product-image" alt="<?= $related['images'][0]['alt'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $related['title'] ?></h5>
                                <p class="card-text text-muted"><?= $related['short_description'] ?></p>
                                <div class="price mb-3">
                                    <span class="current-price">R$ <?= number_format($related['price']['current'], 2, ',', '.') ?></span>
                                    <?php if ($related['price']['discount_percentage'] > 0): ?>
                                    <span class="original-price text-muted text-decoration-line-through ms-2">R$ <?= number_format($related['price']['original'], 2, ',', '.') ?></span>
                                    <?php endif; ?>
                                </div>
                                <a href="product.php?id=<?= $related['id'] ?>" class="btn btn-outline-primary">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
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
    <script src="assets/js/rating-system.js"></script>
    <script>
        // ===== SISTEMA DE GALERIA DE IMAGENS =====
        let currentImageIndex = 0;
        const images = <?= json_encode(array_column($product['images'], 'url')) ?>;
        const totalImages = images.length;

        function selectImage(index) {
            currentImageIndex = index;
            updateMainImage();
            updateThumbnails();
        }

        function changeImage(direction) {
            currentImageIndex = (currentImageIndex + direction + totalImages) % totalImages;
            updateMainImage();
            updateThumbnails();
        }

        function updateMainImage() {
            document.getElementById('mainImage').src = images[currentImageIndex];
        }

        function updateThumbnails() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach((thumb, index) => {
                if (index === currentImageIndex) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        // Navegação por teclado
        document.addEventListener('keydown', function(e) {
            if (totalImages > 1) {
                if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                }
            }
        });

        // Auto-play do slider (opcional)
        if (totalImages > 1) {
            setInterval(() => {
                changeImage(1);
            }, 5000);
        }

        // ===== INICIALIZAR SISTEMA DE AVALIAÇÃO =====
        document.addEventListener('DOMContentLoaded', function() {
            initProductRatingSystem(
                <?= $product['id'] ?>, 
                <?= $product['ratings']['average'] ?>, 
                <?= $product['ratings']['total_reviews'] ?>
            );
        });
    </script>
</body>
</html>
