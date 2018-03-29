<?php

	include("registra_produto.php");
	include("./MPDF57/mpdf.php");
	$produtos = filtraProdutos();
	$mpdf = new mPDF();
	$mpdf->setDisplayMode("fullpage");
	$mpdf->WriteHTML("<h1 align='center'>Relatório de Produtos</h1> <hr/>");

			$html = "
			<table class='tabela'>
			<thread>
				<tr>
					<th>Descrição</span></th>
					<th>Custo</span></th>
					<th>Pr. Venda</th>
					<th>Ativo</th>
				</tr>
			</thread>
			<tbody>
			";
				foreach($produtos as $produtos){
					$totalcusto += $produtos["custo"];
					$totalvenda += $produtos["preco_venda"];
					if($produtos["fg_ativo"] == '1'){
						$produtos["fg_ativo"] = "Ativo";
						}
					else{
						$produtos["fg_ativo"] = "Inativo";
					}

					$html = $html ." <tr>
						<td align='center'> {$produtos["descricao"]} </td>
						<td align='center'> <span>R$</span>{$produtos["custo"]} </td>
						<td align='center'> <span>R$</span>{$produtos["preco_venda"]} </td>
						<td align='center'> {$produtos["fg_ativo"]} </td>
					</tr>";

				}

				$html = $html ."
				</tbody>
				</table>
				<br><br>
				<h2>Total custo: <span>R$</span>{$totalcusto}</h2>
				<h2>Total Preço Venda: <span>R$</span>{$totalvenda}</h2>
				";




	$css = file_get_contents('pdf_estilo.css');
	$mpdf->WriteHTML($css, 1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	exit();

?>