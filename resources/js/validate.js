$('form').each(function() {
	$(this).validate();
})

/**
 * Add username check for jquery validation
 */
$.validator.addMethod('username', function(value, element) {
	return this.optional(element) || /^[a-zA-Z0-9_]+$/.test(value);
});

/**
 * Add start with letter
 */
$.validator.addMethod('startWithLetter', function(value, element) {
	return this.optional(element) || /^[a-zA-Z]/.test(value);
});


/**
 * Set default validation messages
 * 
 * https://stackoverflow.com/questions/2457032/jquery-validation-change-default-error-message
 */
$.extend($.validator.messages, {
	required: "هذا الحقل مطلوب",
	email: "أدخل بريد إلكتروني صالح",
	url: "أدخل رابط صالح",
	minlength: jQuery.validator.format("من فضلك أدخل {0} أحرف على الأقل"),
	equalTo: "من فضلك أدخل نفس القيمة مجددًا",
	username: "اسم المستخدم يجب أن يتكون من حروف أوأرقام أو _ فقط",
	startWithLetter: "هذا الحقل يجب أن يبدأ بحرف انجليزي"
});