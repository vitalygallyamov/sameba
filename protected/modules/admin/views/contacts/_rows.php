	<?php echo $form->textFieldControlGroup($data['model'],'title',array('class'=>'span8','maxlength'=>255)); ?>
	<?php echo $form->textFieldControlGroup($data['model'],'email',array('class'=>'span8','maxlength'=>255)); ?>

<fieldset>
	<legend>Телефоны</legend>
	<div class="phones">
		<div class="row-fluid">
			<div class="span3">Телефон</div>
			<div class="span4">На главной</div>
		</div>
		<?php
		foreach ($data['phones'] as $i => $phone) {
			$this->renderPartial('/phones/_rows', array('model' => $phone, 'index' => $i));
		}
		?>
	</div>
	<div class="add-button">
		<?php echo TbHtml::button('Добавить телефон', array('class' => 'add-phone')); ?>
	</div>
</fieldset>
<br><br>
<fieldset>
	<legend>Социальные сети</legend>
	<div class="socials">
		<div class="row-fluid">
			<div class="span3">Название</div>
			<?//<div class="span3">Иконка</div>?>
			<div class="span3">Ссылка</div>
		</div>
		<?php
		foreach ($data['socials'] as $i => $phone) {
			$this->renderPartial('/socials/_rows', array('model' => $phone, 'index' => $i));
		}
		?>
	</div>
	<div class="add-button">
		<?php //echo TbHtml::button('Добавить', array('class' => 'add-soc')); ?>
	</div>
</fieldset>
	
<script>
	var phones_count = $('.phones .phone').length;
	var soc_count = $('.phones .soc').length;

	$('.add-phone').on('click', function(){
		$.ajax({
			url: '<?=$this->createUrl("addPhoneRow")?>',
			data: {index: phones_count},
			success: function(row){
				$('.phones').append(row).find('.mask').mask("+7 (999) 999-99-99");
				phones_count++;
			}
		});
	});

	$('.add-soc').on('click', function(){
		$.ajax({
			url: '<?=$this->createUrl("addSocRow")?>',
			data: {index: soc_count},
			success: function(row){
				$('.socials').append(row);
				soc_count++;
			}
		});
	});

	$('.phones').on('click', '.change-on-main', function(){
		var $this = $(this);

		console.log($this);

		$('.on-main').val(0);
		$this.parent().find('.on-main').val(1);
	});

	//remove-phone
	$('.phones').on('click', '.remove-phone', function(){
		var $this = $(this);


		if(typeof $this.data('id') == 'number'){
			$.ajax({
				url: '<?=$this->createUrl("deletePhone")?>',
				data: {id: $this.data('id')},
				success: function(){
					$del = $this.closest('.phone').remove();
					checkOnMain($del);
				}
			});
		}else{
			$del = $this.closest('.phone').remove();
			checkOnMain($del);
		}
	});

	var checkOnMain = function checkOnMain($row){
		if($row.find('.change-on-main').is(':checked')){
			$('.phone').eq(0).find('.change-on-main').attr('checked', 'checked');
		}
	};

</script>
