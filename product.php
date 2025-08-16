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
    <style>
        .product-image {
            max-height: 400px;
            object-fit: contain;
            width: 100%;
            background-color: #f8f9fa;
        }
        .thumbnail {
            height: 80px;
            object-fit: contain;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s ease;
            background-color: #f8f9fa;
        }
        .thumbnail.active {
            border-color: #007bff;
        }
        .price {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
        }
        .specs-list {
            list-style: none;
            padding: 0;
        }
        .specs-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        .specs-list li:last-child {
            border-bottom: none;
        }
        .specs-list i {
            color: #007bff;
            margin-right: 0.5rem;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }
        .product-gallery {
            position: relative;
        }
        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .gallery-nav:hover {
            background: rgba(0,0,0,0.7);
        }
        .gallery-nav.prev {
            left: 10px;
        }
        .gallery-nav.next {
            right: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
        }
        .footer {
            background: linear-gradient(135deg, rgb(9, 23, 87) 0%, rgb(64, 53, 75) 100%);
        }
        .payment-methods {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }
        .payment-item {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
            font-size: 0.75rem;
        }
        .payment-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }
        .payment-item img {
            width: 40px;
            height: 25px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .payment-item:hover img {
            transform: scale(1.1);
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .text-blue {
            color: #007bff !important;
        }
    </style>
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
                <li class="breadcrumb-item"><a href="index.php"><?= $product['category'] ?></a></li>
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
                    <img id="mainImage" src="<?= $product['images'][0] ?>" class="product-image rounded" alt="<?= $product['title'] ?>">
                    
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
                        <img src="<?= $image ?>" 
                             class="thumbnail rounded <?= $index === 0 ? 'active' : '' ?>" 
                             onclick="selectImage(<?= $index ?>)"
                             alt="<?= $product['title'] ?> - Imagem <?= $index + 1 ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge bg-primary"><?= $product['category'] ?></span>
                </div>
                
                <h1 class="mb-3"><?= $product['title'] ?></h1>
                
                <div class="price mb-4">
                    R$ <?= number_format($product['price'], 2, ',', '.') ?>
                </div>
                
                <div class="mb-4">
                    <h5>Descrição</h5>
                    <p class="text-muted"><?= $product['full_description'] ?></p>
                </div>

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
        <div class="row mt-5">
            <div class="col">
                <h3>Produtos Relacionados</h3>
                <div class="row">
                    <?php 
                    $relatedProducts = array_filter($products, function($p) use ($product) {
                        return $p['category'] === $product['category'] && $p['id'] !== $product['id'];
                    });
                    $relatedProducts = array_slice($relatedProducts, 0, 3);
                    ?>
                    
                    <?php foreach ($relatedProducts as $related): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?= $related['images'][0] ?>" class="card-img-top" style="height: 180px; object-fit: contain; background-color: #f8f9fa;" alt="<?= $related['title'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $related['title'] ?></h5>
                                <p class="card-text text-muted"><?= $related['short_description'] ?></p>
                                <div class="price mb-3">R$ <?= number_format($related['price'], 2, ',', '.') ?></div>
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
    <script>
        let currentImageIndex = 0;
        const images = <?= json_encode($product['images']) ?>;
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
    </script>
</body>
</html>
