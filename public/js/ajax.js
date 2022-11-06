$(function () {
	$('body').on('click', '#inputFName, #inputLName, #inputRole', function () {
		hideAlert();
	});

	$('body').on('click', '#save', function (e) {
		e.preventDefault();

		var form = $('#form');
		var data = form.serialize();
		var user_id = $('#user_id').val();
		var error = '';

		if ($('#inputFName').val() == false) {
			error += '<p>Please enter first name</p>';
		}

		if ($('#inputLName').val() == false) {
			error += '<p>Please enter last name</p>';
		}

		if ($('#inputRole').find('option:selected').val() == false) {
			error += '<p>Please choose role</p>';
		}

		if (error) {
			showAlert(error, 'danger');

			return false;
		} else {
			hideAlert();
		}

		$.ajax({
			type: 'POST',
			url: '/ajax?type=save',
			data: data,
			dataType: 'JSON',
			success: function (res) {
				var text = 'User saved';

				if (user_id) {
					text = 'User update';
				}

				showAlert(text, 'success');

				$('#user_id, #inputFName, #inputLName').val('');

				$('#inputRole option:eq(0)').attr('selected', true);
				$('body').find('#inputRole option').removeAttr('selected');

				loadContent();
			},
		});
	});

	$('body').on('click', '.edit', function (e) {
		e.preventDefault();

		hideAlert();

		$('body').find('#inputRole option').removeAttr('selected');

		var user_id = $(this).closest('.user').data('user-id');

		$.ajax({
			type: 'POST',
			url: '/ajax?type=getUserInfo',
			data: { user_id: user_id },
			dataType: 'JSON',
			success: function (res) {
				if (res['status'] == 'success') {
					$('#inputFName').val(res.user.fname);
					$('#inputLName').val(res.user.lname);
					$('#user_id').val(res.user.id);

					$('#inputRole option:eq(' + res.user.role_id + ')').prop(
						'selected',
						true
					);

					$([document.documentElement, document.body]).animate(
						{
							scrollTop: $('#form').offset().top,
						},
						2000
					);
				}
			},
		});
	});

	$('body').on('click', '.delete', function (e) {
		e.preventDefault();

		var user_id = $(this).closest('.user').data('user-id');

		$.ajax({
			type: 'POST',
			url: '/ajax?type=delete',
			data: { user_id: user_id },
			dataType: 'JSON',
			success: function (res) {
				if (res['status'] == 'success') {
					loadContent();
					showAlert('User has deleted', 'success');
				} else {
					showAlert('Error deleting user', 'danger');
				}
			},
		});
	});
});

function hideAlert() {
	$('.alert')
		.removeClass('alert-danger, alert-success')
		.removeClass('d-block')
		.addClass('d-none')
		.html('');
}

function showAlert(text, type) {
	if (type == 'danger') {
		$('.alert').addClass('alert-danger').removeClass('alert-success');
	} else {
		$('.alert').addClass('alert-success').removeClass('alert-danger');
	}
	$('.alert').removeClass('d-none').addClass('d-block').html(text);
}

function loadContent() {
	var users = $('#users');

	$.ajax({
		type: 'POST',
		url: '/ajax?type=loadContent',
		dataType: 'HTML',
		success: function (data) {
			users.html(data);
		},
	});
}

$(window).on('load', loadContent());
