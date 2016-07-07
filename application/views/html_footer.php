<script type="text/javascript" charset="UTF-8">
	$(function(result) {
		$("#select_activity").html(result);
		$( ".selectmenu" ).selectmenu();
		$( "#dataExpiracao").datepicker({
			inline: true,
			clickInput:true,
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			//showOn: "button",
			//buttonImage: "<?php //echo base_url('assets/imgs/Calendar.png')?>",
			//buttonImageOnly: true
		});

		$( ".autocomplete" ).autocomplete({
			source: "<?php echo base_url('clientes/get_autocomplete')?>",
			minLength: 1
		});

		$( ".autocompletepre" ).autocomplete({
			source: "<?php echo base_url('cadastro/get_autocomplete')?>",
			minLength: 1
		});


		function mascara(o,f){
			v_obj=o
			v_fun=f
			setTimeout("execmascara()",1)
		}
		function execmascara(){
			v_obj.value=v_fun(v_obj.value)
		}
		function mtel(v){
			v=v.replace(/D/g,""); //Remove tudo o que não é dígito
			v=v.replace(/^(d{2})(d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
			v=v.replace(/(d)(d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
			return v;
		}
		function id( el ){
			return document.getElementById( el );
		}
		window.onload = function(){
			id('telefone').onkeypress = function(){
				mascara( this, mtel );
			}
		}

	});

</script>

	</body>
</html>

