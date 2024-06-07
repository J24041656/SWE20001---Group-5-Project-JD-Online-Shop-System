<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/pg-logo.png">
    <title>Check Out</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
/*Checkout Page*/
.checkout_body{
    margin: 50px;
}
.checkoutrow {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -16px;
}

.checkoutcontainer {
    background-color: #f2f2f2;
    padding: 10px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
    margin-top: 20px;
    margin-bottom: 20px;
    flex: 50%;
    font-family: Verdana;
    margin-left: 30px;
}

.productContainer {
    flex: 30%;
    padding: 10px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
    margin-top: 20px;
    margin-left: 3%;
    font-family: Verdana;
    margin-bottom: 20px;
    margin-right: 30px;
}

.halfColumn {
    padding: 0 16px;
    flex: 50%;
}

.checkoutcontainer select, input[type=text] {
    width: 95%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.checkoutcontainer label {
    margin-bottom: 10px;
    display: block;
}

/*.icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
}*/

.Checkout_btn {
    background-color: black;
    color: white;
    font-size: 17px;
    padding: 12px;
    margin: 10px 0;
    border: none;
    border-radius: 3px;
    width: 100%;
    cursor: pointer;
}

.Checkout_btn:hover {
    opacity: 0.7;
    background-color: grey !important;
    color: white !important;
}

.productContainer th {
    padding: 30px 0;
}

.productContainer td {
    padding-right: 20px;
}

.lastCol {
    text-align: right;
}

.productContainer a {
    text-decoration: none;
    color: black;
}

.productContainer p {
    font-size: 14px;
}

.error {
    color: rgb(235, 61, 61);
    font-size: 0.9rem;
    margin-bottom: 15px;
}
</style>
</head>


<?php
session_start();
include("connect/config.php");

if (empty($_SESSION["cusID"])) {
    header("Location: login.php");
    exit();
}

$cusID = $_SESSION["cusID"];
$query = $conn->prepare("SELECT * FROM customers WHERE cusID = ?");
$query->bind_param("i", $cusID);
$query->execute();
$r = $query->get_result()->fetch_assoc();

$sql = "SELECT c.firstName, c.lastName, c.contact, c.address, ci.name AS city, s.name AS state, c.postcode 
        FROM customers c
        JOIN cities ci ON c.city_id = ci.id
        JOIN states s ON c.state_id = s.id
        WHERE c.cusID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cusID);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if ($customer) {
    $fullName = $customer['firstName'] . " " . $customer['lastName'];
    $contact = $customer['contact'];
    $address = $customer['address'];
    $city = $customer['city'];
    $state = $customer['state'];
    $postcode = $customer['postcode'];
} else {
    echo "Customer not found.";
    exit();
}

if (isset($_POST['submit'])) {
    try {
        function generateTrackingNumber() {
            $timestamp = time();
            $random = mt_rand(1000, 9999);
            $tracking_number = 'TRACK' . $timestamp . $random;
            return $tracking_number;
        }

        // Generate tracking number
        $tracking_number = generateTrackingNumber();
        
        // Get current date and time
        $placed_datetime = date("Y-m-d H:i:s");

        $user = $_POST['user'];
        $total_price = $_POST['total_price'];
        $contact = $_POST['contact'];
        $country_id = $_POST['country_id'];
        $state_id = $_POST['state_id'];
        $city_id = $_POST['city_id'];
        $postcode = $_POST['postcode'];
        $address = $_POST['address'];
        $status = 'Pending';

        $mql = "INSERT INTO orders (user, tracking_no, totalPrice,placed_datetime, contact, country_id, state_id, city_id, postcode, address, status) VALUES ('$user','$tracking_number', '$total_price', '$placed_datetime', '$contact', '$country_id', '$state_id', '$city_id', '$postcode', '$address', '$status')";

        foreach ($_SESSION['cart'] as $product_id => $product) {
            $quantity = $product['quantity'];
            $price = $product['price'];
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
            $stmt->execute();
            $stmt->close();
        }

        $conn->commit();
        unset($_SESSION['cart']);
        header("Location: order.php?tracking_number=" . $tracking_number);
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Order placement failed: " . $e->getMessage();
    }
}

include 'nav-footer/nav.php';
$stmt->close();
$conn->close();
?>



<body style="background-color:white">

    <div class="checkout_body">
        <div class="row">
            <div class="checkoutcontainer">
                <div class="checkoutrow">
                    <div class="halfColumn">
                        <h3>Shipping Address</h3>
                        <label for="fname"><i class="bi bi-person-circle"></i> Full Name</label>
                        <input type="text" id="user" name="user" value="<?= htmlspecialchars($fullName); ?>">
                   
                         <label for="fname"><i class="bi bi-person-circle"></i> Contact</label>
                        <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($contact); ?>">

                        <label for="adr"><i class="bi bi-pin-map-fill"></i> Address</label>
                        <input type="text" id="adr" name="address" value="<?= htmlspecialchars($address); ?>">
           

                        <label for="country">Country</label>
                        <select id="country" name="country_id">
                          <option value="0">Select Country</option> 
                          <!-- new -->
                          <?php
                          include('connect/config.php');
                          $fetch_country = mysqli_query($conn,"SELECT * FROM countries");
                          while($country = mysqli_fetch_array($fetch_country)){
                            ?>    
                            <option <?php if($r['country_id'] == $country['id']){echo "selected";} ?> value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option><?php } ?>
                        </select>
                        <label for="state">State</label>
                        <select id="state" name="state_id">
                            <option value="0">Select State</option>
                        </select>
               
                        <div class="row">
                            <div class="halfColumn">
                             <label for="city"><i class="bi bi-building"></i> City</label>
                             <select id="city" name="city_id">
                                <option value="0">Select City</option>
                            </select>
           
                        </div>

                        <div class="halfColumn">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" id="postalcode" name="postalcode" value="<?= htmlspecialchars($postcode); ?>">
                            <!-- <div class="error" id="errPostal"></div> -->
                        </div>
                    </div>
                </div>
                <!-- Cart Show -->
                <div class="halfColumn">
                    <h3>Payment</h3>

                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cardname" placeholder="E.g: John Doe">
                    <!-- <div class="error" id="errCardName"></div> -->

                    <label for="ccnum">Credit card number</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="E.g: 1111-2222-3333-4444">
                    <!-- <div class="error" id="errCardNum"></div> -->

                    <div class="row">
                        <div class="halfColumn">
                            <label for="expdate">Exp Year</label>
                            <input type="text" id="expdate" name="expdate" placeholder="E.g: MM/YY">
                            <!-- <div class="error" id="errExpdate"></div> -->
                        </div>
                        <div class="halfColumn">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="E.g: 123">
                            <!-- <div class="error" id="errCvv"></div> -->
                        </div>
                        <p>
                            <i class="bi bi-shield-fill-check" style="color:green"></i> Your card details are protected.<br>
                            We partner with CyberSource, a VISA company to ensure that your card details are kept safe and secure. We will not have access to your card info.
                        </p>
                    </div>
                </div>
            </div>
            <input type="submit" value="Place Order" class="Checkout_btn">
        </div>

        <div class="productContainer">
            <table style="width:100%" id="shoePurchase">
                <tr>
                    <th>
                        <h4>Cart</h4>
                    </th>
                    <th colspan="2" class="lastCol">
                        <h4><i class="bi bi-cart"></i> <b id="itemNum">0</b></h4>
                    </th>
                </tr>
                <!-- Cart items will be dynamically added here -->
            </table>
            <hr>
            <p>Total <span style="float: right; color: #1B99D4; padding-right: 20px;"><b id="totalPrice" name="totalPrice">$0.00</b></span></p>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const shoePurchaseTable = document.getElementById('shoePurchase');
        const itemNum = document.getElementById('itemNum');
        const totalPrice = document.getElementById('totalPrice');

        let totalItems = 0;
        let totalCost = 0.00;

        cart.forEach(item => {
            totalItems += parseInt(item.quantity);
            totalCost += item.price * item.quantity;

            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${item.name} (x${item.quantity})</td>
            <td>$${(item.price * item.quantity).toFixed(2)}</td>
            `;
            shoePurchaseTable.appendChild(row);
        });

        itemNum.textContent = totalItems;
        totalPrice.textContent = `$${totalCost.toFixed(2)}`;
    });

    
    $(document).ready(function() {
        function fetchStates(countryId, selectedStateId = 0) {
            $.ajax({
                url: 'ajax.php',
                method: 'post',
                data: { country_id: countryId },
                success: function(result) {
                    $("#state").html('<option value="0">Select State</option>');
                    $("#city").html('<option value="0">Select City</option>')
                    $("#state").append(result);

                    if (selectedStateId) {
                        $("#state").val(selectedStateId);
                    }
                }
            });
        }

        function fetchCities(stateId, selectedCityId = 0) {
            $.ajax({
                url: 'ajax.php',
                method: 'post',
                data: { state_id: stateId, type: 'state' },
                success: function(result) {
                    $("#city").html('<option value="0">Select City</option>');
                    $("#city").append(result);

                    if (selectedCityId) {
                        $("#city").val(selectedCityId);
                    }
                }
            });
        }

    // Fetch states and cities for the initially selected country and state
        var countryId = $("#country").val();
        var stateId = <?php echo $r['state_id'] ?>;
        var cityId = <?php echo $r['city_id'] ?>;
        if (countryId != '0') {
            fetchStates(countryId, stateId);
        }
        if (stateId != '0') {
            fetchCities(stateId, cityId);
        }

        $("#country").change(function() {
            var countryId = $(this).val();
            if (countryId == '0') {
                $("#state").html('<option value="0">Select State</option>');
                $("#city").html('<option value="0">Select City</option>');
            } else {
                fetchStates(countryId);
            }
        });

        $("#state").change(function() {
            var stateId = $(this).val();
            if (stateId == '0') {
                $("#city").html('<option value="0">Select City</option>');
            } else {
                fetchCities(stateId);
            }
        });
    });

</script>             
<!-- Insert Footer -->
<?php include 'nav-footer/footer.php' ?>

</body>
</html>

