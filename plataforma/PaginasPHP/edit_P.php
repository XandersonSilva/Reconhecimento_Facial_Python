<?php 
//Página para ser carregada de edição de user permanente

    //BOTÃO DE DELETE
echo "
<br>
<form action='../ScriptsPHP/del_user.php' method='post'>
    <input type='checkbox' value='$row[CPF]' name='cpf' required> 
    <input type='submit' value='Deletar' class='btn btn-danger' name='del' name='$row[nome]'> <br><br>
</form>";
    
    //ÁREA DE EDIÇÃO DO USUÁRIO
echo "
<form action='../ScriptsPHP/edit_user.php' method='post' class='card container text-left' style='width: 30em;' enctype='multipart/form-data'>
    <div class='mb-3'>
    <select class='form-select' aria-label='Default select example' name='old' style='display: none;' required>
        <option value='$row[matricula]'>$row[matricula]</option>
    </select> <select class='form-select' aria-label='Default select example' name='old2' style='display: none;' required>
    <option value='$row[CPF]'>$row[CPF]</option>
</select><br>
<h2 style='text-align: center'>Permanente</h2>
        <label for='exampleInputEmail1' class='form-label' style='padding-top: 15px;'>Tipo:</label>
        <select class='form-select' aria-label='Default select example' name='tipo' required>
            <option value='Aluno'>Aluno</option>
            <option value='Professor'>Professor</option>
            <option value='Servidor'>Servidor</option>
            <option value='Funcionário'>Funcionário</option>
            <option value='Outro'>Outro</option>
        </select>
    </div>
    <div class='mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Número de matrícula / associado:</label>
        <input name='matricula' type='number' class='form-control' id='exampleInputEmail1' placeholder='$row[matricula]' required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Cargo / Turma</label>
        <select name = 'CT' class='form-select' aria-label='Default select example' name='tipo' required>
            <option value='Professor'>Professor</option>
            <option value='Servidor'>Servidor</option>
            <option value='Funcionário'>Funcionário</option>
            <option value='Informática'>Informática</option>
            <option value='Mineração'>Mineração</option>
            <option value='Eletromecânica'>Eletromecânica</option>
            <option value='Meio ambiente'>Meio ambiente</option>
            <option value='Lic. Computação'>Lic. Computação</option>
            <option value='Outro'>Outro</option>
        </select>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>Nome: </label>
        <input name='nome' type='text' class='form-control' id='exampleInputPassword1' placeholder='$row[nome]' maxlength='50' required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>CPF: </label>
        <input name='CPF' type='number' class='form-control' id='exampleInputPassword1' placeholder='$row[CPF]'required>
    </div>
    <div class='mb-3'>
        <label for='exampleInputPassword1' class='form-label'>Foto: </label>
            <br>
        <input type='file' name='foto' onchange='checkFileSize()'  id='fotoUsr' accept='image/png' required>
    </div>
        <input name='addP' type='submit' value='Adicionar' class='btn btn-info'>
        <br>
</form>";

?>