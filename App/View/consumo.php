<html>
	<head>
		<title>Relatório de consumo</title>
	</head>
	<body>
		<h1>Relatório de consumo por cliente</h1>
		<p>Exibe o consumo de cada cliente para cada produto utilizado.</p>
		<?php $dados = $GLOBALS['dados']; ?>
		<table width=100% border=1>
			<tr>
				<th>Cliente</th>
				<th>Produto</th>
				<th>Descrição</th>
				<th>Valor Unit.</th>
				<th>Custo Unit.</th>
				<th>Quantidade</th>
				<th>Valor total</th>
				<th>Custo total</th>
				<th>Lucro</th>
			</tr>
			<?php
				$valor = 0;
				$custo = 0;
				$qtde = 0;
				$valor_total = 0;
				$custo_total = 0;
				$lucro = 0;
			?>
			<?php foreach($dados as $dado) { ?>
				<?php 
				$valor_total += $dado['valor_total'];
				$custo_total += $dado['custo_total'];
				$lucro += $dado['lucro'];
				?>
				<tr>
					<td><?php echo $dado['cliente']; ?></td>
					<td><?php echo $dado['produto']; ?></td>
					<td><?php echo $dado['descricao']; ?></td>
					<td align=right><?php echo number_format($dado['valor'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($dado['custo'], 2, ',', '.'); ?></td>
					<td align=right><?php echo $dado['qtde']; ?></td>
					<td align=right><?php echo number_format($dado['valor_total'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($dado['custo_total'], 2, ',', '.'); ?></td>
					<td align=right><?php echo number_format($dado['lucro'], 2, ',', '.'); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<th colspan=6 align=left>Total</th>
				<th align=right><?php echo number_format($valor_total, 2, ',', '.'); ?></th>
				<th align=right><?php echo number_format($custo_total, 2, ',', '.'); ?></th>
				<th align=right><?php echo number_format($lucro, 2, ',', '.'); ?></th>
			</tr>
		</table>
	</body>
</html>