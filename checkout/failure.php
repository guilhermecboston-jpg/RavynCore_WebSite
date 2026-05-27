<?php
$order = htmlspecialchars($_GET['order'] ?? '', ENT_QUOTES, 'UTF-8');
?><!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8" /><title>Pagamento não concluído</title></head>
<body style="font-family:sans-serif;background:#1a1a1a;color:#ccc;text-align:center;padding:3rem">
  <h1 style="color:#c66">Pagamento não concluído</h1>
  <p>Pedido: <?= $order ?></p>
  <p><a href="/checkout/" style="color:#fc6">Tentar novamente</a></p>
</body>
</html>
