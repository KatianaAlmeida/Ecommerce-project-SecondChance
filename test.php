<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Sale Section</title>
    <style>
        .best-sale-section {
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .product-container {
            display: flex;
            transition: transform 0.5s ease;
            width: 100%;
        }

        .product {
            min-width: 20%; /* Adjust width to fit 5 products in view */
            box-sizing: border-box;
            margin: 10px;
            text-align: center;
            border: 1px solid rgb(192, 192, 192);
        }

        .product img {
            width: 100%;
            height: auto;
        }

        .slide-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10; /* Ensure the buttons are above other elements */
        }

        #slide-button-prev {
            left: 10px;
        }

        #slide-button-next {
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="best-sale-section">
        <button class="slide-button" id="slide-button-prev">&lt;</button>
        <div class="product-container" id="product-container">
            <!-- Repeat these product divs for each product -->
            <div class="product">
                <img src="product1.jpg" alt="Product 1">
                <p class="product-name">Product 1</p>
                <p class="product-price">$10.00</p>
            </div>
            <div class="product">
                <img src="product2.jpg" alt="Product 2">
                <p class="product-name">Product 2</p>
                <p class="product-price">$15.00</p>
            </div>
            <div class="product">
                <img src="product3.jpg" alt="Product 3">
                <p class="product-name">Product 3</p>
                <p class="product-price">$20.00</p>
            </div>
            <div class="product">
                <img src="product4.jpg" alt="Product 4">
                <p class="product-name">Product 4</p>
                <p class="product-price">$25.00</p>
            </div>
            <div class="product">
                <img src="product5.jpg" alt="Product 5">
                <p class="product-name">Product 5</p>
                <p class="product-price">$30.00</p>
            </div>
            <div class="product">
                <img src="product6.jpg" alt="Product 6">
                <p class="product-name">Product 6</p>
                <p class="product-price">$35.00</p>
            </div>
            <!-- Add more products as needed -->
        </div>
        <button class="slide-button" id="slide-button-next">&gt;</button>
    </div>

    <script>
        const container = document.getElementById('product-container');
        const buttonNext = document.getElementById('slide-button-next');
        const buttonPrev = document.getElementById('slide-button-prev');

        let currentSlide = 0;
        const products = document.querySelectorAll('.product');
        const productWidth = products[0].offsetWidth + 20; // Adjust based on margin/padding

        buttonNext.addEventListener('click', () => {
            if ((currentSlide + 1) * productWidth < container.scrollWidth) {
                currentSlide++;
                container.style.transform = `translateX(-${currentSlide * productWidth}px)`;
            }
        });

        buttonPrev.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                container.style.transform = `translateX(-${currentSlide * productWidth}px)`;
            }
        });
    </script>
</body>
</html>