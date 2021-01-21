<?php

use App\Models\Product;
use App\Models\Category;

$categories = Category::all();

partial_view('dash_header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php partial_view('dash_sidebar'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Product</h1>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?php partial_view('notification'); ?>

                    <form method="post" action="/dashboard/products">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Enter title" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input name="slug" type="text" class="form-control" id="slug-text" placeholder="web-developer">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Product Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="price" type="number" class="form-control" placeholder="$99.99">
                        </div>
                        <div class="form-group">
                            <label>Sales Price</label>
                            <input name="sales_price" type="number" class="form-control" placeholder="$79.99">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Add Category</button>
                    </form>
                </div>

                <?php
                $products = Product::all();
                if ($products->count() > 0) { ?>
                    <div class="col-md-8">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Sales Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <td><?= $product->id; ?></td>
                                        <td><?= $product->title; ?></td>
                                        <td><?= $product->category_id; ?></td>
                                        <td><?= $product->description; ?></td>
                                        <td>$<?= $product->price; ?></td>
                                        <td>$<?= $product->sales_price; ?></td>
                                        <td><?= $product->active === 1 ? 'Active' : 'Inactive'; ?></td>
                                        <td>
                                            <a href="/dashboard/products/edit/<?= $product->id; ?>" class="btn btn-success">Edit</a>
                                            <a href="/dashboard/products/delete/<?= $product->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning mt-3">
                        <p>No products avaiblable.</p>
                    </div>
                <?php } ?>
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