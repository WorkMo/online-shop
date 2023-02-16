import './bootstrap';
import jQuery from 'jquery';
window.$ = jQuery;

$(function () {
	// inputフォームの増減
	inputAddDel('.product_image_form', '.image_form', '.preview');

	function inputAddDel(parents, children, preview_children) {
		// フォームを増やす
		$('.add').on("click", function () {
			var copy = $(this).parents(parents).clone(true).insertAfter($(this).parents(parents))
			copy.find(children).val('');
			copy.find(preview_children).attr('src', "");
			change();
		});
		// フォームを減らす
		$('.del').on("click", function () {
			var target = $(this).parents(parents);
			if ($(children).length > 1) {
				target.remove();
			}
			change();
		});
	}




	// プレビュー表示

	preview('.image_form', '.product_image_form', '.preview', '.preview_form', '.product_image_form', '.image_form');
	preview('.main_form', '.main_image_form', '.main_preview', '.main_preview_form', '.main_image_form', '.main_form');
	preview('.icon_form', '.icon_image_form', '.icon_preview', '.icon_preview_form', '.icon_image_form', '.icon_form');

	function preview(input, parents, children, preview_target, preview_parents, preview_children) {
		if ($(preview_target).parents(preview_parents).find(preview_children).val() !== '') {
			$(preview_target).css({ 'display': '' });
		} else {
			$(preview_target).css({ 'display': 'none' });
		}

		$(input).on('change', function (e) {
			change();
			var fileset = $(this).val();
			var place = $(this).parents(parents).find(children);
			if (fileset === '') {
				place.attr('src', "");
			} else {
				var reader = new FileReader();
				reader.onload = function (e) {
					place.attr('src', e.target.result);
				}
				reader.readAsDataURL(e.target.files[0]);
			}
		});
	}

	function change(){
		changeNumbers('.image_form', 'product_image', '.product_image_form', '.preview', 'preview', '.preview_form');
		changePreview('.main_form', '.main_image_form', '#main_preview_temp','.main_preview_form');
		changePreview('.icon_form', '.icon_image_form', '','.icon_preview_form');
	}
	// 数字を入れ替える
	function changeNumbers(target, name, parents, children, preview_name,preview_form) {
		var $i = 0;
		$(target).each(function () {
			if ($(this).val() !== "") {
				$i++;
				// inputのnameやidも変更
				$(this).attr('name', name + $i);
				$(this).attr('id', name + $i);
				$(this).parents(parents).find(children).attr("id", preview_name + $i);
				$(this).parents(parents).find(preview_form).css({ 'display': '' });
			} else {
				$(this).attr('name', name);
				$(this).attr('id', name);
				$(this).parents(parents).find(children).attr("id", preview_name);
				$(this).parents(parents).find(preview_form).css({ 'display': 'none' });
			}
		});
	}
function changePreview(target,parents,children,preview_form){
	$(target).each(function () {
		if ($(this).val() !== "") {
			$(this).parents(parents).find(preview_form).css({ 'display': '' });
		} else {
			$(this).parents(parents).find(preview_form).css({ 'display': 'none' });
			// if ($(this).parents(parents).find(children)) {
			// 	$(this).parents(parents).find(preview_form).css({ 'display': '' });
			// }
		}
	});
}


	// tempファイルが有るとき
	// tempPreview('.main_form', '.main_image_form','.main_preview_form','#main_preview_temp');
	// tempPreview('.icon_form', '.icon_image_form','.icon_preview_form','#icon_preview_form');
	// function tempPreview(target, parents, children,form_id){
	// 	$(window).on("load", function () {
	// 		$(target).each(function () {
	// 			if ($(this).val() == "")
	// 				if ($(this).parents(parents).find(form_id)) {
	// 					$(this).parents(parents).find(children).css({ 'display': '' });
	// 				}
	// 		});
	// 	})
	// 	$('.main_form').on("change", function () {
	// 		$(this).parents('.main_image_form').find('img.main_preview ').attr("id", "main_preview");
	// 		if ($(this).val() !== "") {
	// 			$(this).parents('.main_image_form').find('.main_preview_form').css({ 'display': '' });
	// 		} else {
	// 			$(this).parents('.main_image_form').find('.main_preview_form').css({ 'display': 'none' });
	// 		}
	// 	})
	// 	$('.product_main_image_temp').on('click', function () {
	// 		$(this).css({ 'display': 'none' }).attr("value", "");
	// 		$(this).parents('.main_image_form').find('#product_main_image').trigger("click").removeClass('d-none');
	// 		$(this).parents('.product_image_form,.main_image_form,.icon_image_form').find(".preview,.main_preview,.icon_preview").attr('src', "");;
	// 	})
	// }



		// $('.number').on('blur change input', function () {
		// 	const $this = $(this);
		// 	if ($this.val() !== '') {
		// 		$this.next().text((+$this.val()).toLocaleString());
		// 	}
		// });

});