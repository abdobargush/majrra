/*
 * Login and register form
 */
$('#login-form, #register-form').each(function () {
	
	var form = $(this);

	form.initAjaxForm({

		success: function (response) {
			location.reload();
		},
		error: function(errors) {
			form.addAlert(Object.values(errors)[0], 'danger', true);
		}

	});

});


/**
 * Validate unique and valid username
 */
$('[data-validate="register-username"]').each(function () {

	var element = $(this);

	element.rules( 'add', {
		remote: {
			url: '/auth/check',
			type: 'post',
			data: {
				identifier: function () {
					return element.val()
				}
			}
		},
		username: true,
		startWithLetter: true,
		messages: {
			remote: 'اسم المستخدم موجود بالفعل',
			startWithLetter: 'اسم المستخدم يجب أن يبدأ بحرف انجليزي'
		}
	});

});

/**
 * Validate unique email
 */
$('[data-validate="register-email"]').each(function () {

	var element = $(this);

	element.rules( 'add', {
		remote: {
			url: '/auth/check',
			type: 'post',
			data: {
				identifier: function () {
					return element.val()
				}
			}
		},
		messages: {
			remote: 'البريد الإلكتروني موجود بالفعل'
		}
	});

});