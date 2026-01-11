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
            $dao->create(
                $_POST['phone'],
                $_POST['name'],
                $_POST['address'],
                $_POST['email']
            );
            header('Location: ?entity=client');
            exit;
        }
        require '../views/client/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao->update(
                $_GET['id'],
                $_POST['phone'],
                $_POST['name'],
                $_POST['address'],
                $_POST['email']
            );
            header('Location: ?entity=client');
            exit;
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
            $dao->create($_POST['name'], $_POST['price']);
            header('Location: ?entity=product');
            exit;
        }
        require '../views/product/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao->update($_GET['id'], $_POST['name'], $_POST['price']);
            header('Location: ?entity=product');
            exit;
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
            $dao->create(
                $_POST['client_id'],
                $_POST['client_address'],
                $_POST['product_id'],
                $_POST['total_amount'],
                $_POST['order_date'],
                $_POST['contract_number']
            );
            header('Location: ?entity=order');
            exit;
        }
        $clients = $clientDao->getAll();
        $products = $productDao->getAll();
        require '../views/order/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao->update(
                $_GET['id'],
                $_POST['client_id'],
                $_POST['client_address'],
                $_POST['product_id'],
                $_POST['total_amount'],
                $_POST['order_date'],
                $_POST['contract_number']
            );
            header('Location: ?entity=order');
            exit;
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
            $dao->create(
                $_POST['order_id'],
                $_POST['date'],
                $_POST['product_number']
            );
            header('Location: ?entity=delivery');
            exit;
        }
        $orders = $orderDao->getAll();
        require '../views/delivery/create.php';
        exit;
    }

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao->update(
                $_GET['id'],
                $_POST['order_id'],
                $_POST['date'],
                $_POST['product_number']
            );
            header('Location: ?entity=delivery');
            exit;
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
