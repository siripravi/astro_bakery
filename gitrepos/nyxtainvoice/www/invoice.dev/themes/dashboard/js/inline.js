$(function () {
	$('.additem').live('click', function () {
		addItem();
		return false
	});
	$('.saveitem').live('click', function () {
		saveItem(this);
		return false
	});
	$('.items tr:not(.active)').live('dblclick', function () {
		$(this).find('.edititem').click()
	});
	$('.edititem').live('click', function () {
		editItem(this);
		return false
	});
	$('.deleteitem').live('click', function () {
		deleteItem(this);
		return false
	});
	$('.cancelitem').live('click', function () {
		cancelItem(this);
		return false
	});
	$('.saveblock').live('click', function () {
		saveBlock(this);
		return false
	});
	$('.editblock').live('click', function () {
		editBlock(this);
		return false
	});
	$('.cancelblock').live('click', function () {
		cancelBlock(this);
		return false
	});
	$('a.showform').live('click', function () {
		showForm(this);
		return false
	});
	$('#cancel').live('click', function () {
		hideForm(this);
		return false
	});
	$('select#clientID').live('change', function(){
		addClient(this);
		return false;
	});
	$('select#contactID').live('change', function () {
		addContact(this)
	});
	$('select#referralContactID').live('change', function () {
		addContact(this)
	});
	$('select#groupID').live('change', function () {
		if ($(this).val() == 'add') addGroup(this);
		else showChangeGroup()
	});
	$('a.editgroup').live('click', function () {
		editGroup();
		return false
	});
	$('a.deletegroup').live('click', function () {
		deleteGroup();
		return false
	});
	$('input.quantity, input.unit').live('keyup', function () {
		changeQty(this)
	});
	$('select, input:not(.button), textarea').live('focus', function () {
		$(this).addClass('highlight')
	});
	$('select, input:not(.button), textarea').live('blur', function () {
		$(this).removeClass('highlight')
	});
	$('.deploy').click(function () {
		return confirm('This will set the recurring invoice to deploy on the date you set in the edit page.\n\nProceed?')
	});
	initOrder($('tbody.itemslist'));
	$(window).keypress(function (e) {
		if (e.keyCode == 13 && !e.shiftKey && ($('table.items .formelement').hasClass('highlight') || $('div.block input.formelement').hasClass('active'))) {
			$('table.items textarea').removeClass('deeper');
			if ($('table.items .formelement').hasClass('highlight')) {
				var a = $('table.items .highlight').closest('tr').find('.saveitem');
				saveItem(a)
			}
			if ($('div.block').hasClass('active') && $('div.block.active').children('h1.title').length > 0) {
				var b = $('div.block.active').find('.saveblock');
				saveBlock(b)
			}
			return false
		} else if (e.keyCode == 13 && e.shiftKey && $('table.items textarea.formelement').hasClass('highlight')) {
			$('table.items textarea.highlight').addClass('deeper');
			return
		}
	});
	var c = $('tbody#items tr.item').length;
	if (!c) {
		addItem()
	}
	$('.itemname').autocomplete({
		minLength: 1,
		delay: 0,
		source: function(request, response){
			$.post('/manage/ac_items', { term: request.term }, function(data){
				response($.map(data, function(item){
					return {
						value: item.itemName,
						description: item.description,
						unit: item.unit,
						tax1: item.tax1,
						tax2: item.tax2
					}
				}));
			});
		},
		select: function(event, ui){
			$(this).closest('tr').find('textarea[name="description"]').val(ui.item.description);
			$(this).closest('tr').find('input[name="unit"]').val(ui.item.unit);
			$(this).closest('tr').find('input[name="tax1"]').attr('checked', ((ui.item.tax1 == 1) ? true : false));
			$(this).closest('tr').find('input[name="tax2"]').attr('checked', ((ui.item.tax2 == 1) ? true : false));
			$(this).closest('tr').find('input[name="quantity"]').focus();
		}
	});
});