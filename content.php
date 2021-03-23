<div class="tab-content">
	<div class="tab-pane container active" id="contact">
			<form action="index.php" method="post" class="col-sm-7 formDiv needs-validation">
				<h2 class="formContactHeader">Cadastrar Contato</h2>
				<div class="form-group">
					<label for="inputNameFormContact" class="labelForm">Nome Completo:</label>
					<div class="col-sm-12">
						<input type="text" name="inputNameformContact" id="inputNameFormContact" class="form-control" required value="<?php if(isset($_POST['formContactSubmitBtn'])){echo $_POST['inputNameformContact']; } ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputCpfFormContact" class="labelForm">CPF:</label>
					<div class="col-sm-6">
						<input type="text" name="inputCpfformContact" id="inputCpfFormContact" class="form-control" value="<?php if(isset($_POST['formContactSubmitBtn'])){echo $_POST['inputCpfformContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="cpfInvalid"></div>
				</div>
				<div class="form-group">
					<label for="inputEmailFormContact" class="labelForm">E-mail:</label>
					<div class="col-sm-10">
						<input type="email" name="inputEmailFormContact" id="inputEmailFormContact" class="form-control" value="<?php if(isset($_POST['formContactSubmitBtn'])){echo $_POST['inputEmailFormContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="emailInvalid"></div>
				</div>
				<div class="form-group">
					<label for="inputCellphoneFormContact" class="labelForm">Telefone Celular:</label>
					<div class="col-sm-5">
						<input type="text" name="inputCellphoneFormContact" id="inputCellphoneFormContact" class="form-control" required value="<?php if(isset($_POST['formContactSubmitBtn'])){echo $_POST['inputCellphoneFormContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="cellPhoneInvalidC"></div>

				</div>
				<div class="form-group">
					<label for="inputDateFormContact" class="labelForm">Data de Nascimento:</label>
					<div class="col-sm-10">
						<input type="date" name="inputDateformContact" id="inputDateFormContact" class="form-control" value="<?php if(isset($_POST['formContactSubmitBtn'])){echo $_POST['inputDateformContact']; } ?>">
					</div>
				</div>
				<div class="form-group btnsForm">
					<input type="reset" name="formContactResetBtn" class="btn btn-danger" value="Limpar">
					<input type="submit" name="formContactSubmitBtn" class="btn btn-success" value="Salvar">
				</div>
			</form>
	</div>

	<!-- Tela de Endereço -->


	<div class="tab-pane container fade" id="address">
		<form action="index.php" method="post" class="col-sm-7 formDiv needs-validation">
				<h2 class="formContactHeader">Cadastrar Endereço</h2>
				<div class="form-group">
					<label class="labelForm">Selecione um contato:</label>
					<div class="col-sm-12">
						<select name="selectContact" class="custom-select" id="pegarContatosAjax" onmouseover="getContacts()" onchange="getDataAddressContact(this.value)" required>
							<option value="">Selecione</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="inputCepFormContact" class="labelForm">CEP:</label>
					<div class="col-sm-4">
						<input type="text" name="inputCepformContact" id="inputCepFormContact" class="form-control" onblur="cepSearch(this.value)" value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputCepformContact']; } ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputStreetFormContact" class="labelForm">Logradouro:</label>
					<div class="col-sm-10">
						<input type="text" name="inputStreetformContact" id="inputStreetFormContact" class="form-control" required value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputStreetformContact']; } ?>">
					</div>
				</div>
				<div class="container">
					<div class="row">
						<label for="inputNumberFormContact" class="labelForm labelNeighborhood">Número:</label>
						<div class="col-lg">
							<input type="text" name="inputNumberformContact" id="inputNumberFormContact" class="form-control" required value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputNumberformContact']; } ?>">
						</div>
						<label for="inputNeighborhoodFormContact" class="labelForm ml-sm-4">Bairro:</label>
						<div class="col-lg">
							<input type="text" name="inputNeighborhoodformContact" id="inputNeighborhoodFormContact" class="form-control" value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputNeighborhoodformContact']; } ?>">
						</div>
					</div>
					
				</div>
				<div class="container">
					<div class="row mt-3">
						<label for="inputCityFormContact" class="labelForm">Cidade:</label>
						<div class="col-lg">
							<input type="text" name="inputCityformContact" id="inputCityFormContact" class="form-control" value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputCityformContact']; } ?>">
						</div>
						<label class="labelForm">Estado:</label>
						<div class="col-lg selectState">
							<select id="selectUf" class="custom-select" name="inputStateformContact" value="<?php if(isset($_POST['formContactAddressSubmitBtn'])){echo $_POST['inputStateformContact']; } ?>">
								<option class="optionsState" value="0">Selecione</option>
								<option class="optionsState" value="AC">AC</option>
								<option class="optionsState" value="AL">AL</option>
								<option class="optionsState" value="AP">AP</option>
								<option class="optionsState" value="AM">AM</option>
								<option class="optionsState" value="BA">BA</option>
								<option class="optionsState" value="CE">CE</option>
								<option class="optionsState" value="DF">DF</option>
								<option class="optionsState" value="ES">ES</option>
								<option class="optionsState" value="GO">GO</option>
								<option class="optionsState" value="MA">MA</option>
								<option class="optionsState" value="MT">MT</option>
								<option class="optionsState" value="MS">MS</option>
								<option class="optionsState" value="MG">MG</option>
								<option class="optionsState" value="PA">PA</option>
								<option class="optionsState" value="PB">PB</option>
								<option class="optionsState" value="PR">PR</option>
								<option class="optionsState" value="PE">PE</option>
								<option class="optionsState" value="PI">PI</option>
								<option class="optionsState" value="RJ">RJ</option>
								<option class="optionsState" value="RN">RN</option>
								<option class="optionsState" value="RS">RS</option>
								<option class="optionsState" value="RO">RO</option>
								<option class="optionsState" value="RR">RR</option>
								<option class="optionsState" value="SC">SC</option>
								<option class="optionsState" value="SP">SP</option>
								<option class="optionsState" value="SE">SE</option>
								<option class="optionsState" value="TO">TO</option>
							</select>
						</div>
					</div>
				</div>
				<div class="btnsForm mt-3">
					<input type="reset" name="formContactResetBtn" class="btn btn-danger" value="Limpar">
					<input type="submit" name="formContactAddressSubmitBtn" class="btn btn-success" value="Salvar">
				</div>
			</form>
			
	</div>

	<!-- Tela de Telefone -->


	<div class="tab-pane container fade" id="phone">
		<form action="index.php" method="post" class="col-sm-7 formDiv needs-validation">
				<h2 class="formContactHeader">Cadastrar Telefone</h2>
				<div class="form-group">
					<label class="labelForm">Selecione um contato:</label>
					<div class="col-sm-12">
						<select name="selectContactPhone" class="custom-select" id="getContactsPhone" onmouseover="getContacts()" onchange="getDataPhoneContact(this.value)" required>
							<option value="">Selecione</option>
						</select>
					</div>
					<div class="row labelForm invalidInput" id="namePhoneInvalid"></div>
				</div>
				<div class="form-group">
					<label for="inputCommercialPhoneFormContact" class="labelForm">Telefone Comercial:</label>
					<div class="col-sm-5">
						<input type="text" name="inputCommercialPhoneformContact" id="inputCommercialPhoneFormContact" class="inputPhoneOptional" value="<?php if(isset($_POST['formContactPhoneSubmitBtn'])){echo $_POST['inputCommercialPhoneformContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="comercialPhoneInvalid"></div>
				</div>
				<div class="form-group">
					<label for="inputResidentialPhoneFormContact" class="labelForm">Telefone Residencial:</label>
					<div class="col-sm-5">
						<input type="text" name="inputResidentialPhoneformContact" id="inputResidentialPhoneFormContact" class="inputPhoneOptional" value="<?php if(isset($_POST['formContactPhoneSubmitBtn'])){echo $_POST['inputResidentialPhoneformContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="residencialPhoneInvalid"></div>
				</div>
				<div class="form-group">
					<label for="inputCellphoneFormContact" class="labelForm">Telefone Celular:</label>
					<div class="col-sm-5">
						<input type="text" name="inputCellphoneFormContact" id="inputCellphoneFormPhone" class="form-control inputCellphone" required value="<?php if(isset($_POST['formContactPhoneSubmitBtn'])){echo $_POST['inputCellphoneFormContact']; } ?>">
					</div>
					<div class="row labelForm invalidInput" id="cellPhoneInvalid"></div>
				</div>
				<div class="form-group btnsForm">
					<input type="reset" name="formContactResetBtn" class="btn btn-danger" value="Limpar">
					<input type="submit" name="formContactPhoneSubmitBtn" class="btn btn-success" value="Salvar">
				</div>
			</form>
	</div>

	<!-- Tela de Pesquisa -->


	<div class="tab-pane container" id="SearchResult">
		<h2>Busca de Contatos</h2>            
  		<table class="table table-hover">
    		<thead>
      			<tr>
	        		<th>id</th>      				
	        		<th>Nome Completo</th>
	        		<th>CPF</th>
	        		<th>E-mail</th>
	        		<th>Data de Nascimento</th>
	        		<th>Endereço</th>
	        		<th>Telefone(s)</th>
      			</tr>
    		</thead>
    		<tbody id="body-table-result">
    		</tbody>
  		</table>
	</div>
</div>
<div id="modal">
		<div id="header-modal">
			<h3>Dados cadastrados com Sucesso!</h3>
		</div>
		<div id="content-modal">
			<h4>Para ver as alterações basta pesquisar pelo contato.</h4>
		</div>
		<div id="footer-modal">
			<div id="div-button-footer">
				<button class="btn btn-danger float-right" id="close">Fechar</button>
			</div>
			
		</div>
</div>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>