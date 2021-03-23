function id(identificador){
	return document.getElementById(identificador);
}

function getScreenContactsSearch(value){
let tabPanes = document.getElementsByClassName('tab-pane');
	for(i = 0; i < tabPanes.length; i++){
		if(tabPanes[i].classList.contains('active')){
			tabPanes[i].classList.remove('active');
			tabPanes[3].classList.add('active');
			break;
		}
	}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText != ""){
				id("body-table-result").innerHTML = this.responseText;
			}
		}
	}
	xmlhttp.open("GET", "Classes/Search.php?search="+value, true);
    xmlhttp.send();
}	

function clean_cep(){
	id('inputStreetFormContact').value = "";
	id('inputNeighborhoodFormContact').value = "";
	id('inputCityFormContact').value = "";
	id('selectUf').value = "";
}

function insertCepData(conteudo){
	if(conteudo != "erro" && conteudo != undefined){
		id('inputStreetFormContact').value = (conteudo.logradouro);
		id('inputNeighborhoodFormContact').value = (conteudo.bairro);
		id('inputCityFormContact').value = (conteudo.localidade);
		id('selectUf').value = (conteudo.uf);
	}else{
		clean_cep();
		alert("Dados do CEP não encontrados.")
	}
}

function getContacts(){
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      	if(id('address').classList.contains('active')){
      		id("pegarContatosAjax").innerHTML = this.responseText;
        	id("pegarContatosAjax").value = 0;
      	}else if(id("phone").classList.contains('active'))
        	id("getContactsPhone").innerHTML = this.responseText;
        	id("getContactsPhone").value = 0;
      }
    };
    xmlhttp.open("GET", "Classes/Contact.php?getContacts=1", true);
    xmlhttp.send();
}

function getDataAddressContact(id){
	clean_cep();
	document.getElementById("inputCepFormContact").value = "";
	document.getElementById("inputNumberFormContact").value = "";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText != ""){
				var jsonResult = JSON.parse(this.responseText);
				insertCepData(jsonResult);
				document.getElementById("inputCepFormContact").value = jsonResult.cep;
				$("#inputCepFormContact").mask("00.000-000");
				document.getElementById("inputNumberFormContact").value = jsonResult.numero;
			}
		}
	}
	xmlhttp.open("GET", "Classes/Address.php?getData="+id, true);
    xmlhttp.send();
}

function getDataPhoneContact(id){
	document.getElementById("inputCommercialPhoneFormContact").value = "";
	document.getElementById("inputResidentialPhoneFormContact").value = "";
	document.getElementById("inputCellphoneFormPhone").value = "";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText != ""){
				var jsonResult = JSON.parse(this.responseText);
				document.getElementById("inputCommercialPhoneFormContact").value = jsonResult.commercial_phone;
				$("#inputCepFormContact").mask("00.000-000");
				document.getElementById("inputResidentialPhoneFormContact").value = jsonResult.residential_phone;
				document.getElementById("inputCellphoneFormPhone").value = jsonResult.cell_phone;
			}
		}
	}
	xmlhttp.open("GET", "Classes/Phone.php?getDataPhone="+id, true);
    xmlhttp.send();
}
	
function cepSearch(cepReceived){
	let cep = cepReceived.replace(/\D/g, '');
	if(cep != ""){
		let validacep = /^[0-9]{8}$/;
		if(validacep.test(cep)){
			id('inputStreetFormContact').value = "...";
			id('inputNeighborhoodFormContact').value = "...";
			id('inputCityFormContact').value = "...";
			id('selectUf').value = "...";

			let script = document.createElement('script');
			script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=insertCepData';
			document.body.appendChild(script);
		}else{
			clean_cep();
			alert("CEP inválido.");
		}
	}else{
		clean_cep();
	}
}

function erroSaveCpfInvalido(erro){
	if(erro == "cpf invalido"){
		id("cpfInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>CPF Inválido.';
	}else{
		id("cpfInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>CPF existente.';
	}
}

function erroSaveEmailInvalido(erro){
	if(erro == "email invalido"){
		id("emailInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>E-mail Inválido.';
	}else{
		id("emailInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>E-mail existente.';
	}
}

function erroSavePhoneInvalido(erro){
	if(erro == "sem nome"){
		id("namePhoneInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Selecione um contato.';
	}
	if(erro == "comercial invalido"){
		id("comercialPhoneInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Telefone Inválido.';
	}else{
		id("comercialPhoneInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Telefone existente.';
	}
	if(erro == "residencial invalido"){
		id("residencialPhoneInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Telefone Inválido.';
	}else{
		id("residencialPhoneInvalid").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Telefone existente.';
	}
	if(erro == "celular invalido"){
		id("inputCellphoneFormPhone").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Celular Inválido.';
	}else{
		id("inputCellphoneFormPhone").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Celular existente.';
	}
	if(erro == "celularC invalido"){
		id("cellPhoneInvalidC").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Celular Inválido.';
	}else{
		id("cellPhoneInvalidC").innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>Celular existente.';
	}

}

function modalSucesso(){
	$("#modal").css("display", "block");
	$("#close").click(function(){
	$("#modal").css("display", "none");
	});
}

$(document).ready(function(){
	$("#inputCpfFormContact").mask("000.000.000-00");
	$("#inputCellphoneFormContact").mask("(00) 0 0000-0000");
	$("#inputCepFormContact").keyup(function(){
		$(this).mask("00.000-000");
	});
	document.getElementById("inputNumberFormContact").maxLength = 5;
	$("#inputCommercialPhoneFormContact").keyup(function(){
		$(this).mask("(00) 0000-0000");
	});
	$("#inputResidentialPhoneFormContact").keyup(function(){
		$(this).mask("(00) 0000-0000");
	});
	$("#inputCellphoneFormPhone").keyup(function(){
		$(this).mask("(00)0 0000-0000");
	});
});