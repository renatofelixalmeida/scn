<html>
	<head>
		<title>Preços do cliente por margem de lucro</title>
	</head>
	<body>
		<h1>Tabela de preços do cliente por margem de lucro.</h1>
		<p>Tabela de preços do cliente ordenado pela margem de lucro em reais do maior para o menor.</p>
		<?php $clientes = ($GLOBALS['data']); ?>
		<?php foreach($clientes as $cliente) { ?>
		<h2><?php echo $cliente['nome']; ?> - CPF/CNPJ: <?php echo $cliente['cpfCnpj']; ?></h2>
		<h3>Tabela de preços</h3>
		<?php
			$precos = $cliente['precos'];
			for ($i = 0; $i < count($precos); $i++){
				$precos[$i]['margem'] = $precos[$i]['valor'] / $precos[$i]['custo'] - 1;
				$precos[$i]['margemReais'] = $precos[$i]['valor'] - $precos[$i]['custo'];
				if ($precos[$i]['margem'] < $precos[$i]['margenMinima']){
					$precos[$i]['abaixo'] = 'Abaixo da margem mínima';
				} else {
					$precos[$i]['abaixo'] = 'Acima ou igual a margem mínima';
				}
			}
			usort($precos, function ($item1, $item2) {
				if ($item1['margemReais'] == $item2['margemReais']) return 0;
				return $item1['margemReais'] < $item2['margemReais'] ? -1 : 1;
			});
		?>

		<table border=1 width=80%>
			<tr><th>Descrição</th><th>Produto</th><th>Valor</th><th>Custo</th>
			<th>Margem %</th><th>Margem R$</th><th>Margen Mínima</th><th>Situação</th></tr>
			<?php for($i = count($precos) - 1; $i >= 0; $i--) { ?>
			<?php $preco = $precos[$i]; ?>
				<tr>
					<td><?php echo $preco['descricao']; ?></td>
					<td><?php echo $preco['produto']; ?></td>
					<td align=right><?php echo number_format($preco['valor'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($preco['custo'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($preco['margem'] * 100, 2, ',', '.'); ?>%</td>
					<td align=right><?php echo number_format($preco['margemReais'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($preco['margenMinima'] * 100, 2, ',', '.'); ?>%</td>
					<td><?php echo $preco['abaixo']; ?></td>
				</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</body>
</html>