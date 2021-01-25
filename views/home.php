<?php include_once 'partials/header.php'; ?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($products as $product) : ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="/media/product_photo/<?= $product->product_photo->image_path; ?>" alt="" class="card-img-top">

                        <div class="card-body">
                            <p class="card-text"><?= $product->title; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/product/<?= $product->slug; ?>" class="btn btn-sm btn-success">View</a>
                                    
                                    <form action="/cart" method="post" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?= $product->id; ?>">
                                        <button type="submit" class="btn btn-sm btn-info">add to cart</button>
                                    </form>
                                </div>
                                <small class="text-muted">Price: $<?= $product->price; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>