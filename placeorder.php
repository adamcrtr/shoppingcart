<?=template_header('Place Order')?>

<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>


<?php
  $order_id = null;
  $stmt = $pdo->prepare('SELECT MAX(order_id)FROM orders');
  $stmt->execute();
  $order_id_array = $stmt->fetch(PDO::FETCH_ASSOC);
  $order_id = reset($order_id_array);

  echo '<p >Your order number is: <b>' . $order_id . '</b>.<br/><br/> Thank you for ordering from Fishy Foods. </p>';

?>
</div>
<?=template_footer()?>
