<?php include_once 'partials/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><img src="/media/product_photo/<?= $product->product_photo->image_path; ?>" /></div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><img src="http://placekitten.com/400/252" /></div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><img src="https://cdn.akc.org/content/article-body-image/cavkingcharlessmalldogs.jpg" /></div>
                    </div>

                    <ul class="preview-thumbnail nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><img src="/media/product_photo/<?= $product->product_photo->image_path; ?>" /></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><img src="http://placekitten.com/400/252" /></a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><img src="https://cdn.akc.org/content/article-body-image/cavkingcharlessmalldogs.jpg" /></a>
                        </li>
                    </ul>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?= $product->title; ?></h3>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <p class="product-description"><?= $product->description; ?></p>
                    <h5 class="sizes">sizes:
                        <span class="size" data-toggle="tooltip" title="small">s</span>
                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                    </h5>
                    <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                    </h5>
                    <h3>Sale Price: $<?= $product->sales_price; ?>, <span style="font-size: 14px">Price: $<?= $product->price; ?></span></h3>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'partials/footer.php'; ?>