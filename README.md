Google reCAPTCHA CodeIgniter 4 Library
======================================

This is a fork repo is based on [denis303/codeigniter4-recaptcha](https://github.com/denis303/codeigniter4-recaptcha) that had some pull requests which the owner/maintainer didn't accept it.
So I had to use this repo instead.

## Installation

```composer require davodm/codeigniter4-recaptcha:dev-master```

## Configuration

In the .env file you need to add your personal ReCaptcha keys.

```
# --------------------------------------------------------------------
# ReCaptcha 2
# --------------------------------------------------------------------
recaptcha2.key = 'XXXXXXXX-XXXXXXXX'
recaptcha2.secret = 'XXXXXXXX-XXXXXXXX'

# --------------------------------------------------------------------
# ReCaptcha 3
# --------------------------------------------------------------------
recaptcha3.key = 'XXXXXXXX-XXXXXXXX'
recaptcha3.secret = 'XXXXXXXX-XXXXXXXX'
recaptcha3.scoreThreshold = 0.5
```

In the /app/Config/Validation.php file you need to add settings for validator:

```
public $ruleSets = [
    ...
    \Denis303\ReCaptcha\Validation\ReCaptchaRules::class
];
```

### Rendering ReCaptcha v2

```
helper(['form', 'reCaptcha']);

echo form_open('/form_processing_path', array('id' => 'contactForm'));

echo reCaptcha2('reCaptcha2', ['id' => 'recaptcha_v2'], ['theme' => 'dark']);

echo form_submit('submit', 'Submit');

echo form_close();
```

### Rendering ReCaptcha v3

```
helper(['form', 'reCaptcha']);

form_open('/form_processing_path', array('id' => 'contactForm'));

echo reCaptcha3('reCaptcha3', ['id' => 'recaptcha_v3'], ['action' => 'contactForm']);

echo form_submit('submit', 'Submit');

echo form_close();
```

### Checking ReCaptcha in a model:

```
public $validationRules = [
    'reCaptcha2' => 'required|reCaptcha2[]'
    'reCaptcha3' => 'required|reCaptcha3[contactForm,0.9]'
    ....
];
```

In the settings of the reCaptcha3 validator, the first parameter you specify is expectedAction.

So If you want to captcha doesn't expire, the form id attribute needs to share the same name as the action.
This allows `grecaptcha.execute` to be called on form submission to prevent token  expiration warnings.
Otherwise, it could be working without action name.

You can override a global scoreThreshold parameter in the second reCaptcha3 rule parameter.

Note that in your form you shouldn't have any `submit` field name such as button name.