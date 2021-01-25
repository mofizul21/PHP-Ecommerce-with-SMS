<?php include_once 'partials/header.php'; ?>

<div class="container">
    <?php if (empty($cart)) { ?>
        <div class="alert alert-info mt-3">
            <h2>No items added in your cart!</h2>
        </div>
    <?php } else { ?>
        <div class="shopping-cart">
            <h1 class="text-center mb-4">Shopping Cart</h1>

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-removal">Remove</label>
                <label class="product-line-price">Total</label>
            </div>

            <?php foreach ($cart as $id => $product) : ?>
                <div class="product">
                    <div class="product-image">
                        <img src="/media/product_photo/<?= $product['image']; ?>">
                    </div>
                    <div class="product-details">
                        <div class="product-title"><?= $product['title']; ?></div>
                        <p class="product-description"><?= substr($product['description'], 0, 85); ?>...</p>
                    </div>
                    <div class="product-price"><?= $product['unit_price']; ?></div>
                    <div class="product-quantity">
                        <input type="number" value="<?= $product['quantity']; ?>" min="1">
                    </div>
                    <div class="product-removal">
                        <!-- <button class="remove-product">
                            Remove
                        </button> -->
                        <form action="/cart/remove" method="post">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <button class="remove-product">
                                Remove
                            </button>
                        </form>
                    </div>
                    <div class="product-line-price"><?= $product['total_price']; ?></div>
                </div>
            <?php endforeach; ?>

            <div class="totals">
                <div class="totals-item">
                    <label>Subtotal</label>
                    <div class="totals-value" id="cart-subtotal"><?= $sum; ?></div>
                </div>
                <div class="totals-item">
                    <label>Tax (5%)</label>
                    <div class="totals-value" id="cart-tax">3.60</div>
                </div>
                <div class="totals-item">
                    <label>Shipping</label>
                    <div class="totals-value" id="cart-shipping">15.00</div>
                </div>
                <div class="totals-item totals-item-total">
                    <label>Grand Total</label>
                    <div class="totals-value" id="cart-total"><?= $sum; ?></div>
                </div>
            </div>

            <a href="checkout.php"><button class="checkout">Checkout</button></a>
            <form action="/cart/destroy" method="post">
                <button class="btn btn-danger btn-lg">Empty Cart</button>
            </form>

        </div>
    <?php } ?>
</div>

<?php include_once 'partials/footer.php'; ?>