<?php if($init):?>

<script {csp-script-nonce} type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=<?= $key;?>"></script>

<?php endif;?>

<script {csp-script-nonce} type="text/javascript">

grecaptcha.ready(function() {
    <?php if(!empty($options['action'])):?>
    var subCapStart = false;
    var subCapInMotion = false;
    var subCapForm = document.getElementById('<?=$options['action'] ?>');
    subCapForm.addEventListener('submit', formCapSubmit);
    function formCapSubmit(event){
        if (!subCapStart){
            event.preventDefault();
            subCapStart = true;
            grecaptcha.execute('<?= $key;?>', <?=json_encode($options);?>).then(function(token) {
                document.getElementById('<?=$id;?>').value = token;
                setTimeout(function(){subCapForm.submit();}, 500);
            });
        } else if (subCapInMotion){
            // prevents double submission when activating grecaptcha
            event.preventDefault();
        }
        subCapInMotion = true;
    }
    <?php else:?>
    grecaptcha.execute('<?= $key;?>', <?= json_encode($options);?>).then(function(token) {
        document.getElementById('<?=$id;?>').value = token;
        //document.getElementById('<?=$id;?>').oninput();
    });
    <?php endif;?>
});

</script>