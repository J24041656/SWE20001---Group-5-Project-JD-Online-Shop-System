<?php
include('connect/config.php');

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--page-icon------------>
    <link rel="shortcut icon" href="images/pg-logo.png">
    <style>
        .product-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'nav-footer/nav.php'; ?>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 product-card">
                            <div class="card h-100">
                                <img src="admin/product/<?php echo $row['img']; ?>" alt="Product Image" style="width: 100%; height: 300px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <p class="card-text"><?php echo $row['description']; ?></p>
                                    <p class="card-text">RM<?php echo $row['price']; ?></p>
                                    <div class="mb-3">
                                        <label for="size-select-<?php echo $row['id']; ?>" class="form-label">Size</label>
                                        <select class="form-select size-select" id="size-select-<?php echo $row['id']; ?>" data-id="<?php echo $row['id']; ?>">
                                            <?php
                                            $fetch_size = mysqli_query($conn, "select * from shoe_size");
                                            while ($size = mysqli_fetch_array($fetch_size)) {
                                            ?>
                                                <option value="<?php echo $size['size']; ?>"><?php echo $size['size']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity-input-<?php echo $row['id']; ?>" class="form-label">Quantity</label>
                                        <input type="number" class="form-control quantity-input" id="quantity-input-<?php echo $row['id']; ?>" min="1" value="1" data-id="<?php echo $row['id']; ?>">
                                    </div>
                                    <button class="btn btn-outline-dark add-to-cart" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-description="<?php echo $row['description']; ?>" data-price="<?php echo $row['price']; ?>" data-img="<?php echo $row['img']; ?>">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </section>

    <?php include 'nav-footer/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getCurrentCart() {
                return JSON.parse(localStorage.getItem('cart')) || [];
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const cart = getCurrentCart();
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const description = this.dataset.description;
                    const price = parseFloat(this.dataset.price);
                    const img = this.dataset.img;
                    const sizeSelect = document.querySelector(`#size-select-${id}`);
                    const quantityInput = document.querySelector(`#quantity-input-${id}`);
                    const size = sizeSelect ? sizeSelect.value : 'default';
                    const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

                    const product = { id, name, description, price, img, size, quantity };

                    const existingProductIndex = cart.findIndex(item => item.id === id && item.size === size);
                    if (existingProductIndex !== -1) {
                        cart[existingProductIndex].quantity += quantity;
                    } else {
                        cart.push(product);
                    }

                    localStorage.setItem('cart', JSON.stringify(cart));
                    alert('Product added to cart!');
                });
            });
        });
    </script>
</body>
</html>
