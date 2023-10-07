;$('form input[name="cep"]').blur(function() {
  getEndereco();
});

function getEndereco() {
  var c = jQuery,
      cep = c.trim(c('#cep').val());

  if (cep != '') {

    c("#endereco").val('Aguarde pesquisando endereço...');

    c.getJSON("https://viacep.com.br/ws/"+ c("#cep").val() +"/json/?callback=?", function(dados){
            if (!("erro" in dados)){              
              c("#endereco").removeAttr('disabled', 'disabled');
              c("#bairro").removeAttr('disabled', 'disabled');
              c("#cidade").removeAttr('disabled', 'disabled');
              c("#uf").removeAttr('disabled', 'disabled');
              c("#numero").removeAttr('disabled', 'disabled');
              c("#complemento").removeAttr('disabled', 'disabled');
                //Atualiza os campos com os valores da consulta.
                c("#endereco").val(dados.logradouro);
                c("#bairro").val(dados.bairro);
                c("#cidade").val(dados.localidade);
                c("#uf").val(dados.uf);
                $("#uf option")
                    .filter(function () {
                        return this.value == dados.uf;
                    })
                    .attr("selected", true);
                c("#ibge").val(dados.ibge);
                // c("#enderecovalidado").val('1');
                c('#numero').val('').focus();
                
                
            } else {
              c("#endereco").val('Endereço não encontrado');

              c("#endereco").removeAttr('disabled', 'disabled');
              c("#bairro").removeAttr('disabled', 'disabled');
              c("#cidade").removeAttr('disabled', 'disabled');
              c("#uf").removeAttr('disabled', 'disabled');
              c("#numero").removeAttr('disabled', 'disabled');
              c("#complemento").removeAttr('disabled', 'disabled');
              
              c('#endereco').val('').focus();
      }
    });
  }
}
