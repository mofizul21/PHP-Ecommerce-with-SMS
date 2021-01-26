<?php include_once 'partials/header.php'; ?>

<div class="container" style="max-width: 960px;">
    <?php if(!empty($cart)){ ?>
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>

    <div class="row g-3">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge bg-secondary rounded-pill"><?= count($cart) ?></span>
            </h4>
            <ul class="list-group mb-3">

                <?php foreach ($cart as $id => $product) : ?>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?= $product['title'] ?></h6>
                            <small class="text-muted">Quantity: <?= $product['quantity'] ?> x $<?= $product['unit_price'] ?>.00</small>
                        </div>
                        <?php $total_amnt = $product['quantity'] * $product['unit_price']; ?>
                        <span class="text-muted">$<?= number_format($total_amnt, 2); ?></span>
                    </li>
                <?php endforeach; ?>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?= number_format($sum, 2) ?></strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </form>
        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" method="post" action="/checkout">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="first_name" value="<?= $_SESSION['user']['username']; ?>" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="last_name" value="" required>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $_SESSION['user']['email']; ?>">
                    </div>

                    <div class="col-12">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="" required>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
                    </div>

                </div>
                <br>

                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>
    <?php }else{ ?>
        <div class="alert alert-info mt-3">
            <h2 class="text-center">Your cart is empty</h2>
        </div>
    <?php } ?>               
</div>

<?php include_once 'partials/footer.php'; ?>