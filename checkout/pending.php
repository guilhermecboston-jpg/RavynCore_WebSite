<?php
$order = htmlspecialchars($_GET['order'] ?? '', ENT_QUOTES, 'UTF-8');
?><!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8" /><title>Pagamento pendente</title></head>
<body style="font-family:sans-serif;background:#1a1a1a;color:#ccc;text-align:center;padding:3rem">
  <h1 style="color:#fc6">Pagamento pendente</h1>
  <p>Pedido: <?= $order ?></p>
  <p>As coins serão creditadas quando o pagamento for confirmado.</p>
</body>
</html>
