<?php
/* =======================
   LOAD ENV (.env)
======================= */
$env = parse_ini_file(__DIR__ . '/../.env');
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}

/* =======================
   REQUIRE DAO FILES
======================= */
require_once '../src/ClientDAO.php';
require_once '../src/ProductDAO.php';
require_once '../src/OrderDAO.php';
require_once '../src/DeliveryDAO.php';

/* =======================
   ROUTING
======================= */
$entity = $_GET['entity'] ?? 'client';
$action = $_GET['action'] ?? 'list';

/* =======================
   CLIENT
======================= */
if ($entity === 'client') {
    $dao = new ClientDAO();

    if ($action === 'list') {
        $clients = $dao->getAll();
        require '../views/client/list.php';
        exit;
    }

    if ($action === 'view') {
        $client = $dao->getById($_GET['id']);
        require '../views/client/view.php';
        exit;
    }

    if ($action === 'create') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $phone   = trim($_POST['phone'] ?? '');
            $name    = trim($_POST['name'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $email   = trim($_POST['email'] ?? '');

            if ($name === '' || strlen($name) < 2) {
                $errors[] = 'Name must be at least 2 characters';
            }

            if (!preg_match('/^[0-9+\-]{7,15}$/', $phone)) {
                $errors[] = 'Invalid phone number';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email';
            }

            if (empty($errors)) {
                $dao->create($phone, $name, $address, $email);
                header('Location: ?entity=client');
                exit;
            }
        }

        require '../views/client/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $phone = trim($_POST['phone'] ?? '');
            $name = trim($_POST['name'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (!$id) {
                $errors[] = 'Invalid client ID';
            }

            if (strlen($phone) < 10) {
                $errors[] = 'Phone must contain at least 10 digits';
            }

            if (strlen($name) < 2) {
                $errors[] = 'Name is too short';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email';
            }

            if (empty($errors)) {
                $dao->update($id, $phone, $name, $address, $email);
                header('Location: ?entity=client');
                exit;
            }
        }

        $client = $dao->getById($_GET['id']);
        require '../views/client/edit.php';
        exit;
    }

    if ($action === 'delete') {
        if ($dao->hasOrders($_GET['id'])) {
            echo "<p>❌ Cannot delete client: client has orders</p>";
            echo "<a href='?entity=client'>← Back</a>";
            exit;
        }
        $dao->delete($_GET['id']);
        header('Location: ?entity=client');
        exit;
    }
}

/* =======================
   PRODUCT
======================= */
if ($entity === 'product') {
    $dao = new ProductDAO();

    if ($action === 'list') {
        $products = $dao->getAll();
        require '../views/product/list.php';
        exit;
    }

    if ($action === 'view') {
        $product = $dao->getById($_GET['id']);
        require '../views/product/view.php';
        exit;
    }

    if ($action === 'create') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $name  = trim($_POST['name'] ?? '');
            $price = $_POST['price'] ?? '';

            if ($name === '') {
                $errors[] = 'Product name is required';
            }

            if (!is_numeric($price) || $price <= 0) {
                $errors[] = 'Price must be a positive number';
            }

            if (empty($errors)) {
                $dao->create($name, $price);
                header('Location: ?entity=product');
                exit;
            }
        }

        require '../views/product/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $name = trim($_POST['name'] ?? '');
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

            if (!$id) {
                $errors[] = 'Invalid product ID';
            }

            if (strlen($name) < 2) {
                $errors[] = 'Product name is too short';
            }

            if ($price === false || $price <= 0) {
                $errors[] = 'Invalid product price';
            }

            if (empty($errors)) {
                $dao->update($id, $name, $price);
                header('Location: ?entity=product');
                exit;
            }
        }

        $product = $dao->getById($_GET['id']);
        require '../views/product/edit.php';
        exit;
    }

    if ($action === 'delete') {
        if ($dao->hasOrders($_GET['id'])) {
            echo "<p>❌ Cannot delete product: product is used in orders</p>";
            echo "<a href='?entity=product'>← Back</a>";
            exit;
        }
        $dao->delete($_GET['id']);
        header('Location: ?entity=product');
        exit;
    }
}

/* =======================
   ORDER
======================= */
if ($entity === 'order') {
    $dao = new OrderDAO();
    $clientDao = new ClientDAO();
    $productDao = new ProductDAO();

    if ($action === 'list') {
        $orders = $dao->getAll();
        require '../views/order/list.php';
        exit;
    }

    if ($action === 'view') {
        $order = $dao->getById($_GET['id']);
        require '../views/order/view.php';
        exit;
    }

    if ($action === 'create') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $client_id = $_POST['client_id'] ?? '';
            $product_id = $_POST['product_id'] ?? '';
            $total = $_POST['total_amount'] ?? '';
            $date = $_POST['order_date'] ?? '';
            $contract = trim($_POST['contract_number'] ?? '');

            if (!ctype_digit($client_id)) {
                $errors[] = 'Invalid client';
            }

            if (!ctype_digit($product_id)) {
                $errors[] = 'Invalid product';
            }

            if (!is_numeric($total) || $total <= 0) {
                $errors[] = 'Invalid total amount';
            }

            if (!DateTime::createFromFormat('Y-m-d', $date)) {
                $errors[] = 'Invalid date format';
            }

            if (empty($errors)) {
                $dao->create(
                    $client_id,
                    $_POST['client_address'],
                    $product_id,
                    $total,
                    $date,
                    $contract
                );
                header('Location: ?entity=order');
                exit;
            }
        }

        $clients = $clientDao->getAll();
        $products = $productDao->getAll();
        require '../views/order/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $client_id = filter_input(INPUT_POST, 'client_id', FILTER_VALIDATE_INT);
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $total_amount = filter_input(INPUT_POST, 'total_amount', FILTER_VALIDATE_FLOAT);
            $order_date = $_POST['order_date'] ?? '';
            $contract_number = trim($_POST['contract_number'] ?? '');
            $client_address = trim($_POST['client_address'] ?? '');

            if (!$id) {
                $errors[] = 'Invalid order ID';
            }

            if (!$client_id) {
                $errors[] = 'Invalid client';
            }

            if (!$product_id) {
                $errors[] = 'Invalid product';
            }

            if ($total_amount === false || $total_amount <= 0) {
                $errors[] = 'Invalid total amount';
            }

            if (!$order_date) {
                $errors[] = 'Order date is required';
            }

            if (strlen($contract_number) < 3) {
                $errors[] = 'Contract number is too short';
            }

            if (empty($errors)) {
                $dao->update(
                    $id,
                    $client_id,
                    $client_address,
                    $product_id,
                    $total_amount,
                    $order_date,
                    $contract_number
                );
                header('Location: ?entity=order');
                exit;
            }
        }

        $order = $dao->getById($_GET['id']);
        $clients = $clientDao->getAll();
        $products = $productDao->getAll();
        require '../views/order/edit.php';
        exit;
    }

    if ($action === 'delete') {
        $dao->delete($_GET['id']);
        header('Location: ?entity=order');
        exit;
    }
}

/* =======================
   DELIVERY
======================= */
if ($entity === 'delivery') {
    $dao = new DeliveryDAO();
    $orderDao = new OrderDAO();

    if ($action === 'list') {
        $deliveries = $dao->getAll();
        require '../views/delivery/list.php';
        exit;
    }

    if ($action === 'view') {
        $delivery = $dao->getById($_GET['id']);
        require '../views/delivery/view.php';
        exit;
    }

    if ($action === 'create') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $order_id = $_POST['order_id'] ?? '';
            $date = $_POST['date'] ?? '';
            $count = $_POST['product_number'] ?? '';

            if (!ctype_digit($order_id)) {
                $errors[] = 'Invalid order';
            }

            if (!DateTime::createFromFormat('Y-m-d', $date)) {
                $errors[] = 'Invalid date';
            }

            if (!ctype_digit($count) || $count <= 0) {
                $errors[] = 'Invalid product number';
            }

            if (empty($errors)) {
                $dao->create($order_id, $date, $count);
                header('Location: ?entity=delivery');
                exit;
            }
        }

        $orders = $orderDao->getAll();
        require '../views/delivery/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
            $product_number = filter_input(INPUT_POST, 'product_number', FILTER_VALIDATE_INT);
            $date = $_POST['date'] ?? '';

            if (!$id) {
                $errors[] = 'Invalid delivery ID';
            }

            if (!$order_id) {
                $errors[] = 'Invalid order';
            }

            if ($product_number === false || $product_number <= 0) {
                $errors[] = 'Invalid product quantity';
            }

            if (!$date) {
                $errors[] = 'Delivery date is required';
            }

            if (empty($errors)) {
                $dao->update(
                    $id,
                    $order_id,
                    $date,
                    $product_number
                );
                header('Location: ?entity=delivery');
                exit;
            }
        }

        $delivery = $dao->getById($_GET['id']);
        $orders = $orderDao->getAll();
        require '../views/delivery/edit.php';
        exit;
    }

    if ($action === 'delete') {
        $dao->delete($_GET['id']);
        header('Location: ?entity=delivery');
        exit;
    }
}