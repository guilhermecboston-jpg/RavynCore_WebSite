<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* account.create.js.html.twig */
class __TwigTemplate_1be678b8dce1f9b11343c8a32fa6703a extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<script type=\"text/javascript\">
\tvar eventId = 0;
\tvar lastSend = 0;

\t\$(function() {
\t\tupdateFlag();
\t\tinitializeIndicators();

\t\t\$('#account_country').change(function() {
\t\t\tupdateFlag();
\t\t});

\t\t\$('#account_input').blur(function() {
\t\t\tcheckAccount();
\t\t});
\t\t\$('#email').blur(function() {
\t\t\tcheckEmail();
\t\t});
\t\t\$('#password').blur(function() {
\t\t\tcheckPassword();
\t\t});
\t\t\$('#password2').blur(function() {
\t\t\tcheckPassword();
\t\t});
\t\t\$('#character_name').blur(function() {
      checkName();
    });
\t\t\$('#character_name').keyup(function() {
      checkName();
    });
\t\t\$('#SuggestAccountNumber a').click(function (event) {
\t\t\tgenerateAccountNumber(event);
\t\t});
\t\t\$('#SuggestCharacterName a').click(function (event) {
      generateCharacterName(event);
    });
\t});

\t function initializeIndicators()
  {
    // Display all indicators as 'nok' (X) on page load
    \$('#account_indicator').attr('src', 'images/global/general/nok.gif').show();
    \$('#email_indicator').attr('src', 'images/global/general/nok.gif').show();
    \$('#password_indicator').attr('src', 'images/global/general/nok.gif').show();
    \$('#password2_indicator').attr('src', 'images/global/general/nok.gif').show();
    \$('#character_indicator').attr('src', 'images/global/general/nok.gif').show();
  }

\tfunction updateFlag()
\t{
\t\t// Update country flag based on selected country
\t\tvar img = \$('#account_country_img');
\t\tvar country = \$('#account_country :selected').val();
\t\tif(country.length) {
\t\t\timg.attr('src', 'images/flags/' + country + '.gif');
\t\t\timg.show();
\t\t}
\t\telse {
\t\t\timg.hide();
\t\t}
\t}

\tfunction checkAccount()
\t{
\t\t// Clear any pending interval timers
\t\tif(eventId != 0)
\t\t{
\t\t\tclearInterval(eventId)
\t\t\teventId = 0;
\t\t}

\t\t// Validate that account field is not empty
\t\tif(document.getElementById(\"account_input\").value == \"\")
\t\t{
\t\t\t\$('#account_error').html('Please enter account number.');
\t\t\t\$('#account_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\$('#account_indicator').show();
\t\t\treturn;
\t\t}

\t\t// Anti-flood prevention: wait at least 1.1 seconds between requests
\t\tvar date = new Date;
\t\tvar timeNow = parseInt(date.getTime());

\t\tif(lastSend != 0)
\t\t{
\t\t\tif(timeNow - lastSend < 1100)
\t\t\t{
\t\t\t\teventId = setInterval('checkAccount()', 1100)
\t\t\t\treturn;
\t\t\t}
\t\t}

\t\t// Send AJAX request to validate account
\t\tvar account = document.getElementById(\"account_input\").value;
\t\t\$.getJSON(\"tools/validate.php\", { account: account, uid: Math.random() },
\t\t\tfunction(data){
\t\t\t\tif(data.hasOwnProperty('success')) {
\t\t\t\t\t\$('#account_error').html ('');
\t\t\t\t\t\$('#account_indicator').attr('src', 'images/global/general/ok.gif');
\t\t\t\t}
\t\t\t\telse if(data.hasOwnProperty('error')) {
\t\t\t\t\t\$('#account_error').html(data.error);
\t\t\t\t\t\$('#account_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\t}

\t\t\t\t\$('#account_indicator').show();
\t\t\t}
\t\t);

\t\tlastSend = timeNow;
\t}

\tfunction checkEmail()
\t{
\t\t// Clear any pending interval timers
\t\tif(eventId != 0)
\t\t{
\t\t\tclearInterval(eventId)
\t\t\teventId = 0;
\t\t}

\t\t// Validate that email field is not empty
\t\tif(document.getElementById(\"email\").value == \"\")
\t\t{
\t\t\t\$('#email_error').html('Please enter e-mail.');
\t\t\t\$('#email_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\$('#email_indicator').show();
\t\t\treturn;
\t\t}

\t\t// Anti-flood prevention: wait at least 1.1 seconds between requests
\t\tvar date = new Date;
\t\tvar timeNow = parseInt(date.getTime());

\t\tif(lastSend != 0)
\t\t{
\t\t\tif(timeNow - lastSend < 1100)
\t\t\t{
\t\t\t\teventId = setInterval('checkEmail()', 1100)
\t\t\t\treturn;
\t\t\t}
\t\t}

\t\t// Send AJAX request to validate email
\t\tvar email = document.getElementById(\"email\").value;
\t\t\$.getJSON(\"tools/validate.php\", { email: email, uid: Math.random() },
\t\t\tfunction(data){
\t\t\t\tif(data.hasOwnProperty('success')) {
\t\t\t\t\t\$('#email_error').html ('');
\t\t\t\t\t\$('#email_indicator').attr('src', 'images/global/general/ok.gif');
\t\t\t\t}
\t\t\t\telse if(data.hasOwnProperty('error')) {
\t\t\t\t\t\$('#email_error').html(data.error);
\t\t\t\t\t\$('#email_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\t}

\t\t\t\t\$('#email_indicator').show();
\t\t\t}
\t\t);

\t\tlastSend = timeNow;
\t}

\tfunction checkPassword()
\t{
\t\t// Clear any pending interval timers
\t\tif(eventId != 0)
\t\t{
\t\t\tclearInterval(eventId)
\t\t\teventId = 0;
\t\t}

\t\t// Validate that password field is not empty
\t\tif(document.getElementById(\"password\").value == \"\")
\t\t{
\t\t\t\$('#password_error').html('Please enter the password for your new account.');
\t\t\t\$('#password_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\$('#password_indicator').show();
\t\t\treturn;
\t\t}

\t\t// Validate that password confirmation field is not empty
\t\tif(document.getElementById(\"password2\").value == \"\")
\t\t{
\t\t\t\$('#password2_error').html('Please enter the password again!');
\t\t\t\$('#password2_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\$('#password2_indicator').show();
\t\t\treturn;
\t\t}

\t\t// Anti-flood prevention: wait at least 1.1 seconds between requests
\t\tvar date = new Date;
\t\tvar timeNow = parseInt(date.getTime());

\t\tif(lastSend != 0)
\t\t{
\t\t\tif(timeNow - lastSend < 1100)
\t\t\t{
\t\t\t\teventId = setInterval('checkPassword()', 1100)
\t\t\t\treturn;
\t\t\t}
\t\t}

\t\tvar password = document.getElementById(\"password\").value;
\t\tvar password2 = document.getElementById(\"password2\").value;
\t\t\$.getJSON(\"tools/validate.php\", { password: password, password2: password2, uid: Math.random() },
\t\t\tfunction(data){
\t\t\t\tif(data.hasOwnProperty('success')) {
\t\t\t\t\t\$('#password_error').html ('');
\t\t\t\t\t\$('#password2_error').html ('');
\t\t\t\t\t\$('#password_indicator').attr('src', 'images/global/general/ok.gif');
\t\t\t\t\t\$('#password2_indicator').attr('src', 'images/global/general/ok.gif');
\t\t\t\t}
\t\t\t\telse if(data.hasOwnProperty('error')) {
\t\t\t\t\t\$('#password_error').html(data.error);
\t\t\t\t\t\$('#password2_error').html(data.error);
\t\t\t\t\t\$('#password_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\t\t\$('#password2_indicator').attr('src', 'images/global/general/nok.gif');
\t\t\t\t}

\t\t\t\t\$('#password_indicator').show();
\t\t\t\t\$('#password2_indicator').show();
\t\t\t}
\t\t);

\t\tlastSend = timeNow;
\t}

\tfunction generateAccountNumber(event)
\t{
\t\t// Prevent default link behavior
\t\tevent.preventDefault();

\t\t// Fetch a suggested account number from the server
\t\t\$.getJSON(\"tools/generate_account_number.php\", { uid: Math.random() },
\t\t\tfunction(data){
\t\t\t\tif(data.hasOwnProperty('success')) {
\t\t\t\t\t\$('#account_input').val(data.success);
\t\t\t\t}
\t\t\t}
\t\t);

\t\t// Validate the generated account number after 1 second
\t\tsetTimeout(checkAccount, 1000);
\t}

  function generateCharacterName(event)
  {
    // Prevent default link behavior
    event.preventDefault();

    // Arrays for random name generation
    var prefixes = ['Ad', 'Al', 'Ar', 'Az', 'Be', 'Br', 'Ca', 'Ce', 'Ch', 'Cl', 'Co', 'Cr', 'Cu', 'Da', 'De', 'Di', 'Do', 'Dr', 'Du', 'El', 'Em', 'En', 'Er', 'Es', 'Et', 'Ex', 'Fa', 'Fe', 'Fi', 'Fl', 'Fo', 'Fr', 'Fu', 'Ga', 'Ge', 'Gi', 'Gl', 'Go', 'Gr', 'Gu', 'Ha', 'He', 'Hi', 'Ho', 'Hu', 'Hy', 'Ia', 'Id', 'If', 'Ig', 'Il', 'Im', 'In', 'Io', 'Ir', 'Is', 'It', 'Ja', 'Je', 'Ji', 'Jo', 'Ju', 'Ka', 'Ke', 'Ki', 'Ko', 'Ku', 'La', 'Le', 'Li', 'Lo', 'Lu', 'Ma', 'Me', 'Mi', 'Mo', 'Mu', 'Na', 'Ne', 'Ni', 'No', 'Nu'];
    var middles = ['a', 'ae', 'ai', 'an', 'ar', 'as', 'at', 'au', 'e', 'ea', 'ed', 'ee', 'ef', 'eg', 'eh', 'ei', 'ek', 'el', 'em', 'en', 'er', 'es', 'et', 'eu', 'ev', 'ew', 'ex', 'ey', 'ez', 'i', 'ia', 'id', 'if', 'ig', 'ih', 'ik', 'il', 'im', 'in', 'ir', 'is', 'it', 'iu', 'ix', 'iy', 'o', 'oa', 'ob', 'od', 'of', 'og', 'oh', 'oi', 'ok', 'ol', 'om', 'on', 'op', 'or', 'os', 'ot', 'ou', 'ov', 'ox', 'oy', 'oz', 'u', 'ua', 'ub', 'ud', 'ue', 'ug', 'uh', 'ui', 'uk', 'ul', 'um', 'un', 'up', 'ur', 'us', 'ut', 'uu', 'uy', 'uz'];
    var suffixes = ['ad', 'af', 'ag', 'ah', 'ak', 'al', 'am', 'an', 'ap', 'ar', 'as', 'at', 'ax', 'ay', 'az', 'ed', 'ef', 'eg', 'eh', 'ek', 'el', 'em', 'en', 'ep', 'er', 'es', 'et', 'ex', 'ey', 'ez', 'id', 'if', 'ig', 'ih', 'ik', 'il', 'im', 'in', 'ip', 'ir', 'is', 'it', 'ix', 'iz', 'od', 'of', 'og', 'oh', 'ok', 'ol', 'om', 'on', 'op', 'or', 'os', 'ot', 'ox', 'oy', 'oz', 'ud', 'uf', 'ug', 'uh', 'uk', 'ul', 'um', 'un', 'up', 'ur', 'us', 'ut', 'ux', 'uy', 'uz'];

    // Select random elements from each array
    var p = prefixes[Math.floor(Math.random() * prefixes.length)];
    var m = middles[Math.floor(Math.random() * middles.length)];
    var s = suffixes[Math.floor(Math.random() * suffixes.length)];

    // Set the generated name to the character name field
    \$('#character_name').val(p + m + s);

    // Validate the generated character name after 100 milliseconds
    setTimeout(checkName, 100);
  }
</script>
";
    }

    public function getTemplateName()
    {
        return "account.create.js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account.create.js.html.twig", "/var/www/html/system/templates/account.create.js.html.twig");
    }
}
