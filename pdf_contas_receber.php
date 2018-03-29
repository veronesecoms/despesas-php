<?php

	include("registra_recebimento.php");
	include("./MPDF57/mpdf.php");
	$contas = filtraRecebimentos();
	$mpdf = new mPDF();
	$mpdf->setDisplayMode("fullpage");
	$mpdf->WriteHTML("<h1 align='center'>Relatório de Contas a Receber</h1> <hr/>");

			$html = "
			<table class='tabela'>
			<thread>
				<tr>
					<th>Data Emissao</span></th>
					<th>Espécie</span></th>
					<th>Valor</th>
					<th>Cliente</th>
					<th>Observação</th>
				</tr>
			</thread>
			<tbody>
			";
				foreach($contas as $contas){
					$totalcontas += $contas["valor"];

					$html = $html ." <tr>
						<td align='center'> {$contas["dataemissao"]} </td>
						<td align='center'> {$contas["nome_especie"]} </td>
						<td align='center'> <span>R$</span>{$contas["valor"]} </td>
						<td align='center'> {$contas["nome"]} </td>
						<td align='center'> {$contas["observacao"]} </td>
					</tr>";

				}

				$html = $html ."
				</tbody>
				</table>
				<br><br>
				<h2>Total Contas a Receber: <span>R$</span>{$totalcontas}</h2>
				";




	$css = file_get_contents('pdf_estilo.css');
	$mpdf->WriteHTML($css, 1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	exit();

?>