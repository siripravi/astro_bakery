(function(){$.fn.insertAtCaret=function(e,f){if(!f)f='';return this.each(function(){if(document.selection){this.focus();d=document.selection.createRange();d.text=e+d.text+f;return false}else if(this.selectionStart||this.selectionStart=='0'){var a=this.selectionStart;var b=this.selectionEnd;var c=this.scrollTop;var d=this.value.substring(a,b);if(e=="\t"){d=d.replace(/\n/ig,"\n\t")}this.value=this.value.substring(0,a)+(e+d+f)+this.value.substring(b,this.value.length);this.selectionStart=a+e.length;this.selectionEnd=a+e.length;this.scrollTop=c;return false}else{this.value+=e;return false}})};})();

function fixHelper(e, a) {
	var originals = a.children();
	var helper = a.clone();
	helper.children().each(function(index){
		console.log($(this).width());
		$(this).width(originals.eq(index).width());
	});
	return helper;
}

function setOrder() {
	$.post('/manage/order/', $(this).sortable('serialize'), function () {});
}

function initOrder(a) {
	$(a).sortable({
		items: 'tr.item',
		revert: false,
		delay: 200,
		opacity: '0.5',
		update: setOrder,
		helper: fixHelper,
		stop: function(){
			$(a).css('min-height', 0);
		}
	});
}

function showForm(a) {
	if ($(a).hasClass('active')) return false;
	showOptions();
	$url = a.href;
	$('.showform').removeClass('active');
	$(a).addClass('active');
	$('div.hidden').load($url, function () {
		$('div.hidden:visible').slideUp(200);
		$('div.hidden').slideDown(200, function () {
			var offset = $('div.hidden:visible').offset();
			$.scrollTo((offset.top - 60), 200);
			$('div.hidden .formelement:not(.button,.nofocus):first').focus();
		});
	});
	return false
}

function hideForm(a) {
	$.scrollTo(0, 200);
	$('.showform').removeClass('active');
	$('div.hidden:visible').slideUp(200, function () {
		$('div.hidden').html('');
	})
}

function zeropad(a) {
	var b = a + '';
	while (b.length < 2) {
		b = '0' + a;
	}
	return b;
}

function addClient(b) {
	if ($(b).val() == 'add') {
		var c = prompt('What is the name of the new client?');
		if (c) {
			$.post('/manage/add_client_ajax/', {
				clientName: c
			}, function (a) {
				$(b).append('<option value="' + a + '">' + c + '</option>');
				$(b).val(a);
			});
		} else {
			return false;
		}
	}
}

function addContact(b) {
	if ($(b).val() == 'add') {
		var c = prompt('What is the name of the new contact?');
		var d = prompt('What is the email address of the new contact');
		var e = $('#clientID').val();
		if (c && d) {
			$.post('/manage/add_contact_ajax/', {
				contactName: c,
				email: d,
				clientID: e
			}, function (a) {
				$(b).append('<option value="' + a + '">' + c + '</option>');
				$(b).val(a);
			})
		} else {
			return false;
		}
	}
}

function roundNumber(a, b) {
	var c = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
	return c;
}

function makeCurrency(num) {
	var i = parseFloat(num);
	if (isNaN(i)) i = 0.00;
	var minus = '';
	if (i < 0) minus = '-';
	i = Math.abs(i);
	i = parseInt((i + .005) * 100);
	i = i / 100;
	s = new String(i);
	if (s.indexOf('.') < 0) s += '.00';
	if (s.indexOf('.') == (s.length - 2)) s += '0';
	s = minus + s;
	return s;
}

function changeQty(el) {
	var qty = $(el).closest('tr').find('input.quantity').val();
	var oldPrice = $(el).closest('tr').find('input.unit').val();
	if (qty && oldPrice) {
		var newPrice = makeCurrency((qty * oldPrice));
		$(el).closest('tr').find('input.price').val(newPrice).removeAttr('style').show();
	}
}

function addItem() {
	cancelItem('tr.item');
	$('.ui-autocomplete').hide();
	$('tr.addrow, tr.addrow .formelement, tr.addrow a.saveitem, tr.addrow a.cancelitem').addClass('active').show();
	$('tr.addrow').find('.formelement:not(.formelement[type="checkbox"])').val('');
	$('tr.addrow').find('.formelement[type="checkbox"]').attr('checked', true);
	$('tr.addrow').find('.formelement:first').focus();
}

function editItem(a) {
	cancelItem('tr.item');
	$('tr.addrow').hide();
	var b = $(a).closest('tr');
	$(b).find('span.field, a.edititem, a.deleteitem').hide();
	$(b).find('.formelement, a.saveitem, a.cancelitem').addClass('active').show();
	$(b).find('.formelement:first').focus();
	$(b).addClass('active');
}

function saveItem(c) {
	var d = $(c).closest('tr');
	var e = $(d).attr('id');
	var f = $(c).attr('href');
	$(d).find('.formelement').each(function () {
		if ($(this).val() != '' && ($(this).val() == $(this).attr('title'))) {
			$(this).val('');
		}
		return true;
	});
	var g = $(d).find('input[name="itemName"]').val();
	var h = $(d).find('textarea[name="description"]').val();
	var unit = $(d).find('input[name="unit"]').val();
	var quantity = $(d).find('input[name="quantity"]').val();
	var tax1 = ($(d).find('input[name="tax1"]').is(':checked')) ? 1 : 0;
	var tax2 = ($(d).find('input[name="tax2"]').is(':checked')) ? 1 : 0;
	var i = $(d).find('input[name="price"]').val();
	if (g == '') {
		return false;
	}
	$.post(f, {
		objectID: objectID,
		itemName: g,
		description: h,
		unit: unit,
		quantity: quantity,
		tax1: tax1,
		tax2: tax2,
		price: i
	}, function (a) {
		var b = $.parseJSON(a);
		$('span.subtotal').text(b.subtotal);
		$('span.discount').text(b.discount);
		$('span.tax1').text(b.tax1);
		$('span.tax2').text(b.tax2);
		$('span.total').text(b.total);
		$('span.paid').text(b.paid);
		$('span.balance').text(b.balance);
		if (e) {
			$(d).before(b.row);
			$(d).hide().remove();
		} else {
			$('tr.addrow').before(b.row);
		}
		$('tr.addrow').hide();
		$('tr.addrow .formelement').val('');
		if (!e){
			addItem();
		}
	})
}

function deleteItem(c) {
	$('.ui-autocomplete').hide();
	var d = $('tbody#items tr.item').length;
	var e = $(c).closest('tr:not(.addrow)');
	var f = $(c).attr('href');
	var g = $(e).find('input[name="price"]').val();
	if (e.length > 0) {
		var h = $(e).attr('id').substr(14);
		if (confirm('Are you sure you want to delete this item?')) {
			$.post(f, {
				objectID: objectID,
				itemID: h
			}, function (a) {
				var b = $.parseJSON(a);
				$('span.subtotal').text(b.subtotal);
				$('span.discount').text(b.discount);
				$('span.tax1').text(b.tax1);
				$('span.tax2').text(b.tax2);
				$('span.total').text(b.total);
				$('span.paid').text(b.paid);
				$('span.balance').text(b.balance);
				$(e).fadeOut('fast', function () {
					$(this).remove();
					if (d == 1) {
						addItem();
					}
				});
			});
		}
	} else {
		$('tr.addrow').hide();
	}
}

function cancelItem(a) {
	var b = $(a).closest('tr');
	$(b).find('span, h1, .edititem, .deleteitem').show();
	$(b).find('.formelement, .saveitem, .cancelitem').removeClass('active').hide();
	$(b).removeClass('active');
	$('tr.addrow').hide();
}

function editBlock(a) {
	var b = $(a).closest('div');
	$(b).find('.blockbody, h1, .editblock, .deleteblock').hide();
	$(b).find('.formelement, .saveblock, .cancelblock').addClass('active').show();
	$(b).find('.formelement').focus();
	$(b).addClass('active');
}

function saveBlock(b) {
	var c = $(b).closest('div');
	var d = $(c).children('.blockbody, .title');
	var e = $(b).attr('href');
	$(c).find('.formelement').each(function () {
		if ($(this).val() != '' && ($(this).val() == $(this).attr('title'))) {
			$(this).val('');
		}
		return true;
	});
	var f = $(c).find('.formelement').val();
	$.post(e, {
		block: f
	}, function (a) {
		$(d).html(a).removeClass('tip');
		cancelBlock(b);
	})
}

function cancelBlock(a) {
	var b = $(a).closest('div');
	$(b).find('.blockbody, h1, .editblock, .delete').show();
	$(b).find('.formelement, .saveblock, .cancelblock').removeClass('active').hide();
	$(b).removeClass('active');
}

function showOptions(a) {
	var b = $(a).siblings('.showoptions:hidden');
	$('.options').removeClass('active');
	$('.showoptions').hide();
	if (b.length > 0) {
		$(a).addClass('active');
		$(a).siblings('.showoptions').show();
	}
}

function addGroup(b, c) {
	var d = prompt('What is the name of the new group?');
	if (d) {
		$.post('/manage/add_group_ajax/' + c + '/', {
			groupName: d
		}, function (a) {
			$(b).append('<option value="' + a + '">' + d + '</option>');
			$(b).val(a);
			$('div#showChangeGroup').fadeIn();
		});
	}
}

function editGroup() {
	var b = $('#groupID option:selected').val();
	var c = $('#groupID option:selected').text();
	var d = prompt('Enter the new name of your group:', c);
	if (d) {
		$.post('/manage/edit_group_ajax/' + b, {
			groupName: d
		}, function (a) {
			$('select#groupID option[value="' + a + '"]').text(d);
		});
	} else {
		return false;
	}
}

function deleteGroup(b) {
	var c = $('#groupID option:selected').val();
	var d = confirm('Are you sure you want to delete this group?');
	if (d) {
		$.post('/manage/delete_group_ajax/' + c, {
			success: true
		}, function (a) {
			$('select#groupID option[value="' + a + '"]').remove();
		});
	} else {
		return false;
	}
}

function showChangeGroup() {
	if ($('select#groupID').val() > 0) {
		$('div#showChangeGroup').fadeIn();
	} else {
		$('div#showChangeGroup').hide();
	}
}

function showCompany() {
	if ($('select#clientID').val() == '-1') {
		$('div#showCompany').fadeIn();
	} else {
		$('div#showCompany').hide();
	}
}

function showFile(a) {
	$('div#showFile').fadeIn();
	$(a).parent().hide();
}

function tidyTextarea(a) {
	if ($(a).hasClass('tidied')) {
		$('div.formatbuttons').slideDown(200);
		$(a).removeClass('tidied');
	} else {
		if ($(a).val() == '' || $(a).val() == $(a).attr('title')) {
			$('div.formatbuttons').slideUp(200);
			$(a).addClass('tidied');
		} else {
			$('div.formatbuttons').show();
		}
	}
	return true;
}

function removeItemsRow(a) {
	var b = $(a).attr('href');
	$(a).closest('.parent').fadeOut('fast', function () {
		$(this).remove();
	});
	$.post(b);
	return true;
}

function deleteItemsRow(a) {
	var b = $(a).attr('href');
	if (confirm('Are you sure you want to delete this?')) {
		$(a).closest('.parent').fadeOut('fast', function () {
			$(this).remove();
		});
		$.post(b);
		return true;
	} else {
		return false;
	}
}

function removeRow(a) {
	var b = $(a).attr('href');
	$(a).closest('tr').fadeOut('fast', function () {
		$(this).remove();
	});
	$.post(b);
	return true;
}

function deleteRow(a) {
	var b = $(a).attr('href');
	if (confirm('Are you sure you want to delete this?')) {
		$(a).closest('tr').fadeOut('fast', function () {
			$(this).remove();
		});
		$.post(b);
		return true;
	} else {
		return false;
	}
}

function message(a){
	if ($('#quickmessage').length > 0){
		$('#quickmessage').text(a);
	} else {
		$('body').append('<div id="quickmessage">'+a+'</div>');
	}
	$('#quickmessage').show().animate({ 'top':'0px'}).delay(2000).animate({ 'top':'-50px'}, 400, function(){
		$(this).hide();
	});
}

function formatting(a, b) {
	var c = $('textarea.format');
	if (c.val() == c.attr('title')) c.attr('style', '').val('');
	if (b == 'bold') {
		$(c).insertAtCaret('**', '**')
	}
	if (b == 'italic') {
		$(c).insertAtCaret('*', '*')
	}
	if (b == 'bullet') {
		$(c).insertAtCaret("* \n* \n* ", "\n")
	}
	if (b == 'h1') {
		$(c).insertAtCaret('# ', "\n\n")
	}
	if (b == 'h2') {
		$(c).insertAtCaret('## ', "\n\n")
	}
	if (b == 'h3') {
		$(c).insertAtCaret('### ', "\n\n")
	}
	if (b == 'url') {
		var d = prompt('Please enter a web address or email you want to link to:', '');
		if (d) {
			if (d.match('@')) {
				$(c).insertAtCaret('[', '](mailto:' + d + ')')
			} else if (d.match('^www\.')) {
				$(c).insertAtCaret('[', '](http://' + d + ')')
			} else if (!d.match('^http:\/\/(www\.)?')) {
				$(c).insertAtCaret('[', '](/' + d + ')')
			} else {
				$(c).insertAtCaret('[', '](' + d + ')')
			}
		} else {
			return false
		}
	}
	$(c).focus()
}

function startSearch(e){
	var KEY = {
		UP: 38,
		DOWN: 40,
		LEFT: 37,
		RIGHT: 39,
		DEL: 46,
		TAB: 9,
		SHIFT: 16,
		CMD1: 224,
		CMD2: 91,
		CMD3: 93,
		CTRL: 17,
		ALT: 18,
		RETURN: 13,
		ESC: 27,
		COMMA: 188,
		PAGEUP: 33,
		PAGEDOWN: 34,
		BACKSPACE: 8
	};
	var timeout;
	var activeIndex = -1;

	$('.ajaxresults').find('a.result').each(function(index){
		if ($(this).hasClass('active')){
			activeIndex = index;
		}
	});

	switch(e.keyCode){
		case KEY.UP:
			e.preventDefault();
			if (activeIndex > 0){
				activeIndex--;
			}
			setActiveSearch(activeIndex);
			break;
		case KEY.DOWN:
			e.preventDefault();
			if ((activeIndex+1) < $('.ajaxresults').find('a.result').length){
				activeIndex++;
			}
			setActiveSearch(activeIndex);
			break;
		case KEY.LEFT:
		case KEY.RIGHT:
		case KEY.SHIFT:
		case KEY.CMD1:
		case KEY.CMD2:
		case KEY.CMD3:
		case KEY.ALT:
		case KEY.CTRL:
			break;
		case KEY.RETURN:
			e.preventDefault();
			var href = $('.ajaxresults').find('a.result:eq('+activeIndex+')').attr('href');
			$('#searchquery').val('').blur().focus();
			if (href){
				window.location=href;
			}
			return false;
			break;
		case KEY.TAB:	
		case KEY.ESC:
			$('#searchquery').val('').blur().focus();
			clearSearch();
			break;
		default:
			clearTimeout(timeout);
			timeout = setTimeout(doSearch, 50);
			break;
	}
}

function setActiveSearch(a){
	if (a >= 0){
		$('.ajaxresults').find('a.result').removeClass('active');
		$('.ajaxresults').find('a.result:eq('+a+')').addClass('active');
	}
	return true;
}

function doSearch(){
	var query = $('#searchquery').val();
	if (query.length > 2){
		$('.ajaxresults').html('<img src="/static/images/loader.gif" alt="" class="loader" />').fadeIn(300);
		$.post('/manage/search_ajax', { 'query' : query }, function(d){
			$('.ajaxresults').html(d).find('.result:first').addClass('active');
		});
	} else {
		clearSearch();
	}
	return true;
}

function clearSearch(){
	$('.dropdown').hide();
	$('a.toggledropdown').parent('li').removeClass('active');
	$('.ajaxresults').fadeOut(100, function(){
		$(this).html('<img src="/static/images/loader.gif" alt="" class="loader" />');
	});
	return true;
}

function highlightRow(a){
	if (a){
		var id = a;	
	} else {
		var id = window.location.hash.substr(1);
	}
	var pos = $('#item-'+id).offset();
	if (pos){
		pos = parseInt(pos.top-50);
		$.scrollTo(pos, 300, function(){
			$('#item-'+id+' td').effect('highlight', {}, 1500);
		});
	}
}

function escapeJSON(str){
    return str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");
}
