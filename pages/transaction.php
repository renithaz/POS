<?php
$selectCategories = mysqli_query($koneksi, "SELECT * FROM categories");
$rowCategories = mysqli_fetch_all($selectCategories, MYSQLI_ASSOC);

$selectProducts = mysqli_query($koneksi, " SELECT * FROM products");
$rowPros = mysqli_fetch_all($selectProducts, MYSQLI_ASSOC);
?>

<div class="row">
    <!-- ================= SISI KIRI : PRODUCT LIST ================= -->
    <div class="col-lg-8 p-4">

        <!-- Tabs Kategori -->
        <ul class="nav nav-tabs" role="tablist">
            <?php
            foreach ($rowCategories as $key => $value) {
            ?>
                <li class="nav-item">
                    <button class="nav-link <?php $key === 0 ? 'active' : '' ?>" data-bs-toggle="tab" data-bs-target="#tab-pane-<?php echo $key ?>">
                        <?php echo $value['category_name'] ?>
                    </button>
                </li>
            <?php
            }
            ?>
        </ul>

        <div class="tab-content mt-3">
            <?php
            foreach ($rowCategories as $key => $value) {
            ?>
                <!-- ================= TAB COFFEE ================= -->
                <div class="tab-pane fade <?php $key === 0 ? 'show active' : '' ?>" id="tab-pane-<?php echo $key ?>">

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">
                            <?php
                            $count = 0;
                            foreach ($rowPros as $rowPro) {
                                if ($rowPro['category_id'] == $value['id']) {
                                    $count++;
                                }
                                if ($key == 0) {
                                    $count++;
                                }
                            }
                            ?>
                            <span class="fs-5"><?php echo $count ?></span> Products
                        </div>

                        <div class="flex-grow-1 mx-3">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-light"><i class="bi bi-grid"></i></button>
                            <button class="btn btn-light"><i class="bi bi-list"></i></button>
                            <button class="btn btn-light"><i class="bi bi-funnel"></i></button>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="row g-3">
                        <?php
                        foreach ($rowPros as $rowP) {
                            if ($rowP['category_id'] == $value['id']) {
                        ?>
                                <div class="col-md-4">
                                    <div class="card product-card" ondblclick="addToChart({
                                    id: <?php $rowP['id'] ?>,
                                    name: <?= $rowP['product_name'] ?>,
                                    price: <?= $rowP['product_price'] ?>,
                                    image: <?php 'assets/img/' . $rowP['product_photo'] ?>
                                    })">
                                        <div class="d-flex align-items-center p-3">
                                            <img src="assets/img/<?php echo $rowP['product_photo'] ?>" class="rounded-circle me-3" width="48">
                                            <div>
                                                <h6 class="mb-0"><?php echo $rowP['product_name'] ?></h6>
                                                <small class="text-muted"><?php echo $value['category_name'] ?></small>
                                            </div>
                                        </div>

                                        <div class="px-3">
                                            <h5 class="fw-bold">Rp. <?php echo number_format($rowP['product_price'], 2, ',', ',') ?></h5>
                                            <p class="text-muted">Ready Stock <?php echo $rowP['qty'] ?> pcs</p>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            if ($key == 0) {
                            ?>
                                <div class="col-md-4">
                                    <div class="card product-card" ondblclick="addToChart({
                                    id: <?php $rowP['id'] ?>,
                                    name: <?= $rowP['product_name'] ?>,
                                    price: <?= $rowP['product_price'] ?>,
                                    image: <?php 'assets/img/' . $rowP['product_photo'] ?>
                                    })">
                                        <div class=" d-flex align-items-center p-3">
                                            <img src="assets/img/<?php echo $rowP['product_photo'] ?>" class="rounded-circle me-3" width="48">
                                            <div>
                                                <h6 class="mb-0"><?php echo $rowP['product_name'] ?></h6>
                                                <small class="text-muted"><?php echo $value['category_name'] ?></small>
                                            </div>
                                        </div>

                                        <div class="px-3">
                                            <h5 class="fw-bold">Rp. <?php echo number_format($rowP['product_price'], 2, ',', ',') ?></h5>
                                            <p class="text-muted">Ready Stock <?php echo $rowP['qty'] ?> pcs</p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>


            <!-- ================= TAB SNACK ================= -->
            <div class="tab-pane fade" id="snack">
                <p class="text-muted mt-3">Tidak ada data snack</p>
            </div>

        </div>
    </div>

    <!-- ================= SISI KANAN : ORDER DETAIL ================= -->
    <div class="col-lg-4 p-4">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active">Order Details</button>
            </li>
            <li class="nav-item">
                <button class="nav-link">Order Saved</button>
            </li>
        </ul>

        <div class="card p-3 mt-3">
            <small class="text-muted">Order ID <strong>#001</strong></small>

            <!-- Customer -->
            <div class="d-flex align-items-center my-3">
                <div class="avatar-circle me-3">RK</div>
                <div>
                    <small class="text-muted">Customer Name</small>
                    <div class="fw-semibold">Ravi Kamil</div>
                </div>
            </div>

            <!-- Order Item Dummy -->
            <div id="order-items"></div>
            <div id="order-item-template">
                <div class="card p-2 mb-2 order-item">
                    <div id="order-items"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <img class="rounded-circle product-img"
                                src="" width="48" height="48" alt="">
                            <div>
                                <div class="fw-semiblod product_name"></div>
                                <small class="text-muted product-price"></small>
                            </div>
                        </div>
                        <button class="btn btn-sm-remove-btn">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <div class="d-flex align-items-center gap-1">
                            <button class="btn btn-outline-primary btn-sm-qty-minus">-</button>
                            <span class="fw-semibold qty">1</span>
                            <button class="btn btn-outline-primary btn-sm-qty-plus">+</button>
                        </div>
                        <div class="fw-bold total-price"></div>
                    </div>
                </div>
            </div>


            <!-- Summary -->
            <div class="border-top pt-3">
                <div class="d-flex justify-content-between">
                    <small>Subtotal</small>
                    <small id="subtotal">Rp 0</small>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Tax</small>
                    <small id="tax">Rp 0</small>
                </div>
                <div class="d-flex justify-content-between">
                    <small>Discount</small>
                    <small id="discount">Rp 0</small>
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <small>Total</small>
                    <small id="total-bill">Rp 0</small>
                </div>
            </div>

            <!-- Button -->
            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-outline-info w-50">Save</button>
                <button class="btn btn-success w-50">Payment</button>
            </div>
        </div>
    </div>
</div>