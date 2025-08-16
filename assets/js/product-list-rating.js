/**
 * Sistema de Atualização Dinâmica para Listagem de Produtos
 * 
 * Este script atualiza automaticamente as avaliações e estoque
 * dos produtos na página inicial, sincronizando com os dados
 * armazenados no localStorage.
 */

class ProductListRatingSystem {
    constructor() {
        this.init();
    }

    init() {
        this.updateAllProducts();
        this.simulateRealTimeUpdates();
    }

    // Atualizar todos os produtos na listagem
    updateAllProducts() {
        const productCards = document.querySelectorAll('.product-item');
        
        productCards.forEach(card => {
            const productId = this.getProductIdFromCard(card);
            if (productId) {
                this.updateProductCard(card, productId);
            }
        });
    }

    // Extrair ID do produto do card
    getProductIdFromCard(card) {
        const link = card.querySelector('a[href*="product.php?id="]');
        if (link) {
            const match = link.href.match(/id=(\d+)/);
            return match ? parseInt(match[1]) : null;
        }
        return null;
    }

    // Atualizar card individual do produto
    updateProductCard(card, productId) {
        // Carregar dados de avaliação
        const ratings = this.loadRatings(productId);
        const stockData = this.loadStockData(productId);
        
        // Calcular nova média
        const averageRating = this.calculateAverageRating(ratings, productId);
        const totalReviews = ratings.length + this.getInitialReviews(productId);
        
        // Atualizar elementos no card
        const averageElement = card.querySelector('.product-rating-average');
        const countElement = card.querySelector('.product-rating-count');
        const stockElement = card.querySelector('.stock-status .badge');
        
        if (averageElement) {
            averageElement.textContent = averageRating;
        }
        
        if (countElement) {
            countElement.textContent = totalReviews;
        }
        
        if (stockElement && stockData) {
            if (stockData.quantity > 0) {
                stockElement.textContent = 'Em estoque';
                stockElement.className = 'badge bg-success';
            } else {
                stockElement.textContent = 'Indisponível';
                stockElement.className = 'badge bg-secondary';
            }
        }
    }

    // Carregar avaliações do localStorage
    loadRatings(productId) {
        const stored = localStorage.getItem(`product_ratings_${productId}`);
        return stored ? JSON.parse(stored) : [];
    }

    // Carregar dados de estoque do localStorage
    loadStockData(productId) {
        const stored = localStorage.getItem(`product_stock_${productId}`);
        return stored ? JSON.parse(stored) : null;
    }

    // Calcular média das avaliações
    calculateAverageRating(ratings, productId) {
        if (ratings.length === 0) {
            return this.getInitialRating(productId);
        }
        
        const sum = ratings.reduce((acc, rating) => acc + rating.rating, 0);
        return Math.round((sum / ratings.length) * 10) / 10;
    }

    // Obter avaliação inicial do produto (do JSON)
    getInitialRating(productId) {
        // Valores padrão baseados no ID do produto
        const defaultRatings = {
            1: 4.8, 2: 4.5, 3: 4.2, 4: 4.7, 5: 4.3,
            6: 4.6, 7: 4.4, 8: 4.9, 9: 4.1
        };
        return defaultRatings[productId] || 4.5;
    }

    // Obter número inicial de avaliações
    getInitialReviews(productId) {
        // Valores padrão baseados no ID do produto
        const defaultReviews = {
            1: 127, 2: 89, 3: 156, 4: 203, 5: 67,
            6: 134, 7: 98, 8: 178, 9: 112
        };
        return defaultReviews[productId] || 100;
    }

    // Simular atualizações em tempo real
    simulateRealTimeUpdates() {
        // Atualizar produtos a cada 45 segundos
        setInterval(() => {
            this.updateAllProducts();
        }, 45000);
    }
}

// Inicializar sistema quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    new ProductListRatingSystem();
});
