<?php 
    //BOTÃO DE DELETE
echo "
<br>
<form action='../ScriptsPHP/del_user.php' method='post'>
    <input type='checkbox' value='$row[CPF]' name='cpf' required> 
    <input type='submit' value='Deletar' class='btn btn-danger' name='del' name='$row[nome]'> <br><br>
</form>";
    //ÁREA DE EDIÇÃO DO USUÁRIO
echo"
<form action='../ScriptsPHP/edit_user.php' method='post' class='card container text-left' style='width: 30em;' enctype='multipart/form-data'>
    <div class='mb-3'>
        <select class='form-select' aria-label='Default select example' name='old2' style='display: none;' required>
            <option value='$row[CPF]'>$row[CPF]</option>
        </select>
        <br>
        <h2 style='text-align: center'>Temporário</h2>
        <label for='exampleInputEmail1' class='form-label' style='padding-top: 15px;'>Dias:</label>
        <select class='form-select' aria-label='Default select example' name='dias' required>
            <option value='1'>1</option>
            <option value='3'>3</option>
            <option value='7'>7</option>
            <option value='15'>15</option>
            <option value='30'>30</option>
        </select>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>Nome: </label>
        <input name='nome' type='text' class='form-control' id='exampleInputPassword1' placeholder='$row[nome]' required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>CPF: </label>
        <input name='CPF' type='number' class='form-control' id='exampleInputPassword1' placeholder='$row[CPF]' required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>Motivo: </label>
        <input name='motivo' type='text' class='form-control' id='exampleInputPassword1' placeholder='$row[motivo]' required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>Foto: </label>
            <br>
        <input type='file' name='foto' onchange='checkFileSize()'  id='fotoUsr' accept='image/png' required>
    </div>
        <input name='addT' type='submit' value='Adicionar' class='btn btn-info'>
        <br>
</form>";

?>