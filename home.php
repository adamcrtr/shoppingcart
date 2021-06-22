<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?=template_header('Home')?>

<div class="featured">
  <img src="imgs/logo.png" alt="logo" width="300" height="300" class="logo">
    
    <p>Freshly Frozen Fish</p>
</div>
<div class="recentlyadded content-wrapper container">
    <h2>Recently Added Products</h2>
    <div class="row">
    <div class="products col-12">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &pound;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&pound;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>
</div>

<?=template_footer()?>
