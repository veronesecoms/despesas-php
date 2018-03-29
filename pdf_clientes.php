<?php
	include_once("registra_pessoa.php");
	include("./MPDF57/mpdf.php");
	$nome_filtrar = $_POST['nomefiltrar'];
	$pessoas = filtraPessoas();
	$mpdf = new mPDF();
	$mpdf->setDisplayMode("fullpage");
	$mpdf->WriteHTML("<h1 align='center'>Relatório de Clientes</h1> <hr/>");

			$html = "
			<table class='tabela'>
			<thread>
				<tr>
					<th>Nome</span></th>
					<th>Data de nascimento</span></th>
					<th>Telefone</th>
					<th>Endereço</th>
				</tr>
			</thread>
			<tbody>
			";
				foreach($pessoas as $pessoa){

					$html = $html ." <tr>
						<td align='center'> {$pessoa["nome"]} </td>
						<td align='center'> {$pessoa["data_formatada"]} </td>
						<td align='center'> {$pessoa["telefone"]} </td>
						<td align='center'> {$pessoa["endereco"]} </td>
					</tr>";
				}

				$html = $html ."
				</tbody>
				</table>
				";

	$css = file_get_contents('pdf_estilo.css');
	$mpdf->WriteHTML($css, 1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	exit();

?>