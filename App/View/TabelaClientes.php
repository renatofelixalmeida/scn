<html>
	<head>
		<title>Preços do cliente por descrição</title>
	</head>
	<body>
		<h1>Tabela de preços do cliente por descrição</h1>
		<p>Exibe a tabela de preços do cliente ordenada por descrição.</p>
		<?php $clientes = ($GLOBALS['data']); ?>
		<?php foreach($clientes as $cliente) { ?>
		<h2><?php echo $cliente['nome']; ?> - CPF/CNPJ: <?php echo $cliente['cpfCnpj']; ?></h2>
		<h3>Tabela de preços</h3>
		<?php
			$precos = $cliente['precos'];
			usort($precos, function ($item1, $item2) {
				if ($item1['descricao'] == $item2['descricao']) return 0;
				return $item1['descricao'] < $item2['descricao'] ? -1 : 1;
			});
		?>

		<table border=1 width=50%>
			<tr><th>Descrição</th><th>Produto</th><th>Valor</th><th>Custo</th><th>Margen Mínima</th></tr>
			<?php foreach($precos as $preco) { ?>
				<tr>
					<td><?php echo $preco['descricao']; ?></td>
					<td><?php echo $preco['produto']; ?></td>
					<td align=right><?php echo number_format($preco['valor'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($preco['custo'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($preco['margenMinima'] * 100, 2, ',', '.'); ?>%</td>
				</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</body>
</html>