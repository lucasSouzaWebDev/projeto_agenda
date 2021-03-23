<?php
    if(file_exists('../config.php')){
        include_once('../config.php');
    }elseif(file_exists('config.php')){
        include_once('config.php');
    }
    include('header.php');
    include('content.php');
    // Interação com a tela de cadastro de Contato
    if(isset($_POST['formContactSubmitBtn'])){
        $contact = new Contact($_POST['inputNameformContact'], $_POST['inputCpfformContact'],$_POST['inputEmailFormContact'],$_POST['inputDateformContact']);
        // validações dos campos
        $erros = 0;
        $lastId = $contact->saveContact($contact);
        if($lastId == "cpf invalido" || $lastId == "cpf existente"){
            echo "<script>erroSaveCpfInvalido('$lastId');</script>";
            $erros++;
        }
        if($lastId == "email invalido" || $lastId == "email existente"){
            echo "<script>erroSaveEmailInvalido('$lastId');</script>";
            $erros++;
        }
        $phone = new Phone(null, null, $_POST['inputCellphoneFormContact']);
        $retornoPhone = $phone->savePhone($lastId,$phone);
        if($retornoPhone == "celularC invalido" || $retornoPhone == "celularC existente"){
            echo "<script>erroSavePhoneInvalido('$retornoPhone');</script>";
            $erros++;
        }

        if($erros === 0){
            echo "<script>setTimeout(modalSucesso(), 1);</script>";
        }
    
    }
    // Interação com a tela de cadastro de Endereço
    elseif(isset($_POST['formContactAddressSubmitBtn']) && (isset($_POST['selectContact']))){
        $verificar = Address::getAddressData($_POST['selectContact'], 0);
        $address = new Address($_POST['inputCepformContact'],$_POST['inputStreetformContact'],$_POST['inputNumberformContact'], $_POST['inputNeighborhoodformContact'],$_POST['inputCityformContact'], $_POST['inputStateformContact']);
        if($verificar != null){
            $address->updateAddress($_POST['selectContact'], $address);
        }else{
            $address->saveAddress($_POST['selectContact'], $address);
        }
    }
    // Interação com a tela de cadastro de Contato

    elseif(isset($_POST['formContactPhoneSubmitBtn']) && (isset($_POST['selectContactPhone']))){
        $phone = new Phone($_POST['inputCommercialPhoneformContact'],$_POST['inputResidentialPhoneformContact'],$_POST['inputCellphoneFormContact']);
        $erros = 0;
        $retornoPhone = $phone->updatePhone($_POST['selectContactPhone'], $phone);
        if($retornoPhone == "sem nome"){
            echo "<script>erroSavePhoneInvalido('$retornoPhone');</script>";
            $erros++;
        }
        if($retornoPhone == "comercial invalido" || $retornoPhone == "comercial existente"){
            echo "<script>erroSavePhoneInvalido('$retornoPhone');</script>";
            $erros++;
        }
        if($retornoPhone == "residencial invalido" || $retornoPhone == "residencial existente"){
            echo "<script>erroSavePhoneInvalido('$retornoPhone');</script>";
            $erros++;
        }
        if($retornoPhone == "celular invalido" || $retornoPhone == "celular existente"){
            echo "<script>erroSavePhoneInvalido('$retornoPhone');</script>";
            $erros++;
        }
        if($erros === 0){
            echo "<script>setTimeout(modalSucesso(), 1);</script>";
        }
    }

    
?>


