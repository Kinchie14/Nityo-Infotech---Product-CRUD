<?php
require_once "dbcontroller.php";
$db_handle = new DBController();

$sql = "SELECT * FROM products";
$productResult = $db_handle->readData($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Ajax CRUD with php and mysql</title>

</head>

<body>
    <div class="container">
        <div class="title">
            <h1>CRUD Operation using Ajax and PHP, MySQL</h1>
        </div>
        <div id="add-product">
            <div class="txt-heading">Add Product</div>
            <table class="table table-striped-columns">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Inventory</th>
                        <th>Expiration Date</th>

                    </tr>
                </thead>
                <tbody>
                    <tr style="height: 40px; font-size: 20px; padding: 10px">
                        <td contentEditable="true" data-id="product_name"></td>
                        <td contentEditable="true" data-id="product_unit"></td>
                        <td contentEditable="true" data-id="product_price"></td>
                        <td contentEditable="true" data-id="product_inventory"></td>
                        <td contentEditable="true" data-id="product_expiry" data-type="date" datetimepicker></td>
                    </tr>
                </tbody>
            </table>
            <button id="btnSaveAction" class="btn btn-info">Insert</button>
        </div><br><br>
        <div id="list-product">
            <div class="txt-heading">Products</div><br>
            <table id="tbl" class="table table-striped-columns">
                <tbody id="ajax-response">
                    <tr>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Inventory</th>
                        <th>Inventory Cost</th>
                        <th style="text-align:right;">Expiration Date</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($productResult)) {
                        foreach ($productResult as $k => $v) {
                    ?>
                            <tr>
                                <td data-id="product_name"><?php echo $productResult[$k]["product_name"]; ?></td>
                                <td data-id="product_unit"><?php echo $productResult[$k]["product_unit"]; ?></td>
                                <td data-id="product_price"><?php echo $productResult[$k]["product_price"]; ?></td>
                                <td data-id="product_inventory"><?php echo $productResult[$k]["product_inventory"]; ?></td>
                                <td data-id="product_inventory_cost"><?php echo $productResult[$k]["product_inventory_cost"]; ?></td>
                                <td data-id="product_expiry"><?php echo $productResult[$k]["product_expiry"]; ?></td>
                                <td>
                                    <button class="edit btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                    <button type="button" class="save btn btn-success" data-id="<?php echo $productResult[$k]["id"]; ?>" style="display: none"><i class="fa fa-check" aria-hidden="true"></i></button>

                                    <button type="button" class="cancel btn btn-danger" data-id="<?php echo $productResult[0]["id"]; ?>" style="display: none"><i class="fa fa-times" aria-hidden="true"></i></button>

                                    <button class="del btn btn-warning" data-id="<?php echo $productResult[$k]["id"]; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>

                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="asset/custom.js"></script>

</body>

</html>