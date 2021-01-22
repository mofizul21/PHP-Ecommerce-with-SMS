<?php partial_view('dash_header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php partial_view('dash_sidebar'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?php partial_view('notification'); ?>

                    <form method="post" action="/dashboard/products/edit/<?= $product->id; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?= $product->title; ?>" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)" value="">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input name="slug" type="text" class="form-control" id="slug-text" value="<?= $product->slug; ?>">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id; ?>" <?php echo $category->id === $product->category_id ? 'selected' : ''; ?>><?= $category->title; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?= $product->description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="price" type="number" class="form-control" value="<?= $product->price; ?>">
                        </div>
                        <div class="form-group">
                            <label>Sales Price</label>
                            <input name="sales_price" type="number" class="form-control" value="<?= $product->sales_price; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Photo</label>
                            <?php if($product->product_photo): ?>
                                <img src="/media/product_photo/<?= $product->product_photo->image_path; ?>" alt="<?= $product->title; ?>" width="100">
                            <?php endif; ?>
                            <br>
                            <input name="product_photo" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="active" class="form-control">
                                <option value="1" <?php echo $product->active === 1 ?? 'selected'; ?>>Active</option>
                                <option value="0" <?php echo $product->active === 0 ?? 'selected'; ?>>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Category</button>
                    </form>
                </div>
            </div>
        </main>

        <script>
            function convertToSlug(str) {
                //replace all special characters | symbols with a space
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();

                // trim spaces at start and end of string
                str = str.replace(/^\s+|\s+$/gm, '');

                // replace space with dash/hyphen
                str = str.replace(/\s+/g, '-');

                //return str;
                document.getElementById("slug-text").value = str;
            }
        </script>
    </div>
</div>

<?php partial_view('dash_footer') ?>