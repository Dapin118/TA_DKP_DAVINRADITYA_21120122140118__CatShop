<?php

// Class Abstract untuk produk makanan kucing

use CatFood as GlobalCatFood;

abstract class CatFood
{
    protected $name;
    protected $price;
    protected $image;

    public function __construct($name, $price, $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    abstract public function getInfo();

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }
}


// Class turunan untuk makanan kucing merek Whiskas
class Whiskas extends CatFood
{
    private $flavor;

    public function __construct($name, $price, $image, $flavor)
    {
        parent::__construct($name, $price, $image);
        $this->flavor = $flavor;
    }

    public function getInfo()
    {
        return " " . $this->getName() . " " . $this->flavor . " Rp." . $this->getPrice();
    }
}

// Class turunan untuk makanan kucing merek Me-O
class MeO extends CatFood
{
    private $size;

    public function __construct($name, $price, $image, $size)
    {
        parent::__construct($name, $price, $image);
        $this->size = $size;
    }

    public function getInfo()
    {
        return " " . $this->getName() . " " . $this->size . " Rp." . $this->getPrice();
    }
}

// Class turunan untuk makanan kucing merek Royal Canin
class RoyalCanin extends CatFood
{
    private $lifeStage;

    public function __construct($name, $price, $image, $lifeStage)
    {
        parent::__construct($name, $price, $image);
        $this->lifeStage = $lifeStage;
    }

    public function getInfo()
    {
        return " " . $this->getName() . " " . $this->lifeStage . " Rp." . $this->getPrice();
    }
}

// Class turunan untuk makanan kucing merek PetCargo
class PetCargo extends CatFood
{
    private $lifeStage;

    public function __construct($name, $price, $image, $lifeStage)
    {
        parent::__construct($name, $price, $image);
        $this->lifeStage = $lifeStage;
    }

    public function getInfo()
    {
        return " " . $this->getName() . " " . $this->lifeStage . " Rp." . $this->getPrice();
    }
}

// Class turunan untuk makanan kucing merek PetCargo
class TasKucing extends CatFood
{
    private $lifeStage;

    public function __construct($name, $price, $image, $lifeStage)
    {
        parent::__construct($name, $price, $image);
        $this->lifeStage = $lifeStage;
    }

    public function getInfo()
    {
        return " " . $this->getName() . " " . $this->lifeStage . " Rp." . $this->getPrice();
    }
}

// Fungsi untuk menampilkan daftar produk makanan kucing
function displayProducts($products)
{
    foreach ($products as $product) {
        echo '<div class="product">';
        echo '<img src="' . $product->getImage() . '" alt="' . $product->getName() . '">';
        echo '<h3>' . $product->getInfo() . '</h3>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="action" value="Beli">';
        echo '<input type="hidden" name="product_name" value="' . $product->getName() . '">';
        echo '<button type="submit">Beli</button>';
        echo '</form>';
        echo '</div>';
    }
}

// Daftar produk makanan kucing
$catProducts = [
    new Whiskas('Whiskas Salmon', 23000, 'download (2).jpeg', '1kg'),
    new MeO('Me-O Tuna', 18000, 'dMe-o.jpeg', '1kg'),
    new RoyalCanin('Royal Canin Kitten', 65000, 'download (1).jpeg', '1kg'),
    new PetCargo('PetCargo', 150000, 'petcargo.jpeg', 'All Size'),
    new TasKucing('TasAstrounut', 400000, 'Tas.jpeg', 'All Size'),
];
// Memulai sesion
session_start();

// Keranjang belanja
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

// Memeriksa apakah ada aksi penambahan produk ke keranjang
if (isset($_POST['action']) && $_POST['action'] === 'Beli') {
    $productName = $_POST['product_name'];

    foreach ($catProducts as $product) {
        if ($product->getName() === $productName) {
            $cart[] = $product;
            break;
        }
    }
    // Menyimpan keranjang belanja dalam session
    $_SESSION['cart'] = $cart;
}

if (isset($_POST['action']) && $_POST['action'] === 'clear_cart') {

    // Menghapus data keranjang dari session
    unset($_SESSION['cart']);
    $cart = []; // Mengatur keranjang ke array kosong

    // Menyimpan keranjang belanja dalam session
    $_SESSION['cart'] = $cart;
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css" />

<head>

    <head>
        <title>Makanan Kucing</title>
    </head>

<body>

    <body>
        <header>
            <div class="navbar">
                <div class="logo"><a href="#">CatShop</a></div>
                <ul class="links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="cart.php">Cart</a></li>
                </ul>
            </div>

            <div class="product-container">
                <?php displayProducts($catProducts); ?>
    </body>

</html>