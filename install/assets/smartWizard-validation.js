"use strict"

$(document).ready(function () {
    // Smart Wizard         
    $('#wizard_verticle').smartWizard({
        transitionEffect: 'slideleft',
        onLeaveStep: leaveAStepCallback,
        onFinish: onFinishCallback,
    });

    function leaveAStepCallback(obj) {
        var step_num = obj.attr('rel');
        return validateSteps(step_num);
    }

    function onFinishCallback() {
        if (validateAllSteps()) {
            $('form').submit();
        }
    }

});

function validateAllSteps() {
    var isStepValid = true;

    if (validateStep1() == false) {
        isStepValid = false;
        $('#wizard_verticle').smartWizard('setError', {stepnum: 1, iserror: true});
    } else {
        $('#wizard_verticle').smartWizard('setError', {stepnum: 1, iserror: false});
    }

    if (validateStep2() == false) {
        isStepValid = false;
        $('#wizard_verticle').smartWizard('setError', {stepnum: 2, iserror: true});
    } else {
        $('#wizard_verticle').smartWizard('setError', {stepnum: 2, iserror: false});
    }

    var res = validateStep3();
    if (res.error == true) {
        isStepValid = false;
        $('#wizard_verticle').smartWizard('showMessage', res.message);
        $('#wizard_verticle').smartWizard('setError', {stepnum: 3, iserror: true});
    } else {
        $('#wizard_verticle').smartWizard('hideMessage');
        $('#wizard_verticle').smartWizard('setError', {stepnum: 3, iserror: false});
    }

    if (!isStepValid) {
        $('#wizard_verticle').smartWizard('showMessage', 'Please required all field.!');
    }
    return isStepValid;
}

function validateSteps(step) {
    var isStepValid = true;
    var minPHPVersion = '7.3';
    // validate step 1
    if (step == 1) {
        if (validateStep1() == false) {
            isStepValid = false;
            $('#wizard_verticle').smartWizard('showMessage', "Please check above server requirement.");
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: true});
        } else {
            $('#wizard_verticle').smartWizard('hideMessage');
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: false});
        }
    }

    // validate step 2
    if (step == 2) {
        var res = validateStep2();
        if (res.error == true) {
            isStepValid = false;
            $('#wizard_verticle').smartWizard('showMessage', res.message);
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: true});
        } else {
            $('#wizard_verticle').smartWizard('hideMessage');
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: false});
        }
    }

//  validate step3
    if (step == 3) {
        if (validateStep3() == false) {
            isStepValid = false;
            $('#wizard_verticle').smartWizard('showMessage', 'Please correct the errors in step' + step + ' and click next.');
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: true});
        } else {
            $('#wizard_verticle').smartWizard('hideMessage');
            $('#wizard_verticle').smartWizard('setError', {stepnum: step, iserror: false});
        }
    }

    return isStepValid;
}

function validateStep1() {
    var isValid = true;
    $('#step-1 input').each(function () {
        if ($(this).val() == 0) {
            isValid = false;
        }
    });
    return isValid;
}

function validateStep2() {
    var data = {
        'error': true,
        'message': "Please required all field."
    };
    $('#step-2 input').each(function () {
        if (!$(this).val() && $(this).val().length <= 0) {
            data = {
                'error': true,
                'message': "Please required all field."
            };
        }
    });
    var purchase_code = $("#step-2 input#purchase_code").val();
    var app_url = window.location.host + window.location.pathname;
    app_url = app_url.replace("install/index.php", "");
    app_url = app_url.replace("install/", "");
    if (purchase_code !== "" && app_url !== "") {
        data = check_purchase_code(purchase_code, app_url);
    } else {
        data = {
            'error': true,
            'message': "Please required all field."
        };
    }
    return data;
}

function check_purchase_code(purchase_code, app_url) {
    $.ajaxSetup({async: false, dataType: 'json'});
    var returnUserData = null;
    $.post('https://wrteam.in/validator/flutter_quiz_validator?purchase_code=' + purchase_code + '&domain_url=' + app_url, function (data) {
        returnUserData = data;
    });
    $.ajaxSetup({async: true});
    return returnUserData;
}

function validateStep3() {
    var data = {
        'error': false,
        'message': ""
    };

    var hostname = $("#step-3 input#hostname").val();
    var database = $("#step-3 input#database").val();
    var username = $("#step-3 input#username").val();
    var password = $("#step-3 input#password").val();
    
    if (hostname != "" && database != "" && username != "") {
        data = {
            'error': false,
            'message': ""
        };
    } else {
        data = {
            'error': true,
            'message': "Please required all field."
        };
    }
    
    return data;
}

