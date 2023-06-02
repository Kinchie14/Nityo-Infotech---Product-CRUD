<?php
require_once "dbcontroller.php";

$db_handle = new DBController();
if (isset($_POST['product_name'])) {
    $prod_id = "";
    $product_name = "";
    $product_unit = "";
    $product_price = "";
    $product_inventory = "";
    $product_inventory_cost = "";

    $product_expiry = "";


    if (!empty($_POST["id"])) {
        $prod_id = $db_handle->cleanData($_POST["id"]);
    }
    if (!empty($_POST["product_name"])) {
        $product_name = $db_handle->cleanData($_POST["product_name"]);
    }
    if (!empty($_POST["product_unit"])) {
        $product_unit = $db_handle->cleanData($_POST["product_unit"]);
    }
    if (!empty($_POST["product_price"])) {
        $product_price = $db_handle->cleanData($_POST["product_price"]);
    }
    if (!empty($_POST["product_inventory"])) {
        $product_inventory = $db_handle->cleanData($_POST["product_inventory"]);
    }
    if (!empty($_POST["product_inventory_cost"])) {
        $product_inventory_cost = $_POST["product_inventory"] * $_POST["product_price"];
    }
    if (!empty($_POST["product_expiry"])) {
        $product_expiry = $db_handle->cleanData($_POST["product_expiry"]);
    }


    if (isset($_POST['id'])) {
        $sql = "UPDATE products SET product_name = '$product_name', product_unit = '$product_unit', product_price = '$product_price', product_inventory = '$product_inventory', product_expiry = '$product_expiry' WHERE `products`.`id` = $prod_id";
    } else {
        $sql = "INSERT INTO products (product_name,product_unit,product_price,product_inventory,product_inventory_cost,product_expiry) VALUES ('" . $product_name . "','" . $product_unit . "','" . $product_price . "','" . $product_inventory . "','" . $product_inventory_cost . "','" . $product_expiry . "')";
    }
    $product_id = $db_handle->executeInsert($sql);

    if (!empty($product_id)) {
        $sql = "SELECT * from products WHERE id = '$product_id' ";
        $productResult = $db_handle->readData($sql);
    }
?>
    <?php
    if (!empty($productResult)) {
    ?>
        <tr>
            <td data-id="product_name"><?php echo $productResult[0]["product_name"]; ?></td>
            <td data-id="product_unit"><?php echo $productResult[0]["product_unit"]; ?></td>
            <td data-id="product_price"><?php echo $productResult[0]["product_price"]; ?></td>
            <td data-id="product_inventory"><?php echo $productResult[0]["product_inventory"]; ?></td>
            <td data-id="product_inventory"><?php echo $productResult[0]["product_inventory"] * $productResult[0]["product_price"]; ?></td>
            <td data-id="product_expiry"><?php echo $productResult[0]["product_expiry"]; ?></td>
            <td>
                <button class="edit btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                <button type="button" id="edit" class="save btn btn-success" data-id="<?php echo $productResult[0]["id"]; ?>" style="display: none"><i class="fa fa-check" aria-hidden="true"></i></button>

                <button type="button" id="edit" class="cancel btn btn-danger" data-id="<?php echo $productResult[0]["id"]; ?>" style="display: none"><i class="fa fa-times" aria-hidden="true"></i></button>

                <button class="del btn btn-warning" data-id="<?php echo $productResult[0]["id"]; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
<?php
    }
}

?>


<?php
$id = 0;
if (isset($_POST['action']) == 'del') {
    $id = $db_handle->cleanData($_POST["id"]);
}
if ($id > 0) {

    // Check record exists
    $sql = "SELECT * from products WHERE id = '$id' ";
    $productResult = $db_handle->readData($sql);

    if ($productResult > 0) {
        // Delete record
        $query = "DELETE FROM products WHERE id=" . $productResult[0]['id'];
        $db_handle->executeInsert($query);
        echo 1;
        exit;
    } else {
        echo 0;
        exit;
    }
}
?>