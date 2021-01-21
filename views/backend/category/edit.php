<?php

use App\Models\Category;

partial_view('dash_header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php partial_view('dash_sidebar'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Category</h1>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?php partial_view('notification'); ?>

                    <?php
                    $category = Category::find($_SESSION['category_id']);
                    ?>

                    <form method="post" action="/dashboard/categories/edit/<?= $category->id; ?>">
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?= $category->title; ?>" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <p id="slug-text" contenteditable="true" onclick="document.execCommand('selectAll', true, null)"></p>
                            <input name="slug" type="text" class="form-control" id="slug" value="<?= $category->slug; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="active" class="form-control">
                                <option value="1" <?= $category->active === 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $category->active === 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Edit Category</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = Category::all();
                            foreach ($categories as $category) { ?>
                                <tr>
                                    <td><?= $category->id; ?></td>
                                    <td><?= $category->title; ?></td>
                                    <td><?= $category->slug; ?></td>
                                    <td><?= $category->active === 1 ? 'Active' : 'Inactive'; ?></td>
                                    <td>
                                        <a href="/dashboard/categories/edit/<?= $category->id; ?>" class="btn btn-success">Edit</a>
                                        <a href="/dashboard/categories/delete/<?= $category->id; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
                document.getElementById("slug-text").innerHTML = str;
                //return str;
            }
        </script>
    </div>
</div>

<?php partial_view('dash_footer') ?>