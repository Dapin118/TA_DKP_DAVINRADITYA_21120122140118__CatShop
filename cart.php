<?php
// Class Abstract untuk produk makanan kucing
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
    header('Location: index.php');
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'clear_cart') {
    // Menghapus data keranjang dari session
    unset($_SESSION['cart']);
    $cart = []; // Mengatur keranjang ke array kosong

    // Menyimpan keranjang belanja dalam session
    $_SESSION['cart'] = $cart;
    header('Location: index.php');
    exit;
}

function displayCart($cart)
{
    echo '<h2>Keranjang Belanja</h2>';
    if (!empty($cart)) {
        echo '<table style="border-collapse: collapse; width: 100%;">';
        echo '<tr>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Nama</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Jumlah</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Harga Satuan</th>';
        echo '<th style="border: 1px solid #000; padding: 8px;">Subtotal</th>';
        echo '</tr>';

        $totalPrice = 0;
        $itemCount = array();

        foreach ($cart as $item) {
            if ($item instanceof CatFood) {
                $productName = $item->getName();
                $itemPrice = $item->getPrice();

                if (!isset($itemCount[$productName])) {
                    $itemCount[$productName] = 1;
                } else {
                    $itemCount[$productName];
                }

                $subtotalPrice = $itemCount[$productName] * $itemPrice;
                $totalPrice += $subtotalPrice;
                if ($itemCount[$productName] === 1) {
                    echo '<tr>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">' . $productName . '</td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">' . $itemCount[$productName] . '</td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">Rp.' . $itemPrice . '</td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">Rp.' . $subtotalPrice . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td style="border: 1px solid #000; padding: 8px;"></td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">' . $itemCount[$productName] . '</td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;"></td>';
                    echo '<td style="border: 1px solid #000; padding: 8px;">Rp.' . $subtotalPrice . '</td>';
                    echo '</tr>';
                }
            }
        }

        echo '</table>';
        echo '<p class="total-price" style="margin-top: 10px;"><strong>Total: Rp.' . $totalPrice . '</strong></p>';
    } else {
        echo '<p>Keranjang belanja kosong.</p>';
    }
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
                    <li><a href="index.php">Shop</a></li>
                </ul>
                <div class="toggle_btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>

            <div class="dropdown_menu open">
                <li><a href="index.html">Home</a></li>
                <li><a href="index.php">Shop</a></li>
            </div>

            <h1> </h1>
            <div class="cart-container">
                <form method="POST">
                    <input type="hidden" name="action" value="clear_cart">
                    <button type="submit">Hapus Keranjang</button>
                </form>
                <?php displayCart($cart); ?>
            </div>


            <script>
                function updateQuantity(input, productName) {
                    var quantity = input.value;

                    // Kirim permintaan pembaruan ke sisi server menggunakan AJAX atau teknologi yang sesuai

                    // Contoh penggunaan AJAX dengan jQuery
                    $.ajax({
                        url: 'update_cart.php', // Ganti dengan URL yang sesuai
                        method: 'POST',
                        data: {
                            productName: productName,
                            quantity: quantity
                        },
                        success: function(response) {
                            // Tangani respons dari server (jika diperlukan)
                            // Misalnya, perbarui total atau tampilkan pesan sukses
                        },
                        error: function(xhr, status, error) {
                            // Tangani kesalahan yang terjadi pada permintaan AJAX (jika diperlukan)
                        }
                    });
                }
            </script>

    </body>

</html>