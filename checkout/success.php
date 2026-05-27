<?php
$order = htmlspecialchars($_GET['order'] ?? '', ENT_QUOTES, 'UTF-8');
?><!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8" /><title>Pagamento aprovado</title></head>
<body style="font-family:sans-serif;background:#1a1a1a;color:#ccc;text-align:center;padding:3rem">
  <h1 style="color:#8c8">Pagamento recebido</h1>
  <p>Pedido: <?= $order ?></p>
  <p>As RavynCore Coins serão creditadas em breve na sua conta.</p>
</body>
</html>
