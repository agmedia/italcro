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

/* default/template/mpgdpr/preferenceshtml.twig */
class __TwigTemplate_54bd2a9ed17449dc5667defede42cef879b53dfa0b9275f678ee9b20575151e1 extends \Twig\Template
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
        echo "<div class=\"mpgdpr-wrap\">
  <div class=\"mpgdpr-cookie\">
    <div class=\"mpgdpr-container\">
      <div class=\"mpgdpr-text\">
        <p> <strong>";
        // line 5
        echo ($context["text_heading"] ?? null);
        echo "</strong></p>
          <label><input type=\"checkbox\" checked=\"checked\" disabled=\"disabled\" value=\"m:required\" /> ";
        // line 6
        echo ($context["text_cookie_strickly"] ?? null);
        echo "</label>
          <br/><p>";
        // line 7
        echo ($context["text_cookie_strickly_detail"] ?? null);
        echo "</p>
          <label><input type=\"checkbox\" name=\"mcookie_analytics\" value=\"m:required\" /> ";
        // line 8
        echo ($context["text_cookie_analytics"] ?? null);
        echo "</label>
          <br/><p>";
        // line 9
        echo ($context["text_cookie_analytics_detail"] ?? null);
        echo "</p>
          <label><input type=\"checkbox\" name=\"mcookie_marketing\" value=\"m:required\" /> ";
        // line 10
        echo ($context["text_cookie_marketing"] ?? null);
        echo "</label>
          <br/><p>";
        // line 11
        echo ($context["text_cookie_marketing_detail"] ?? null);
        echo "</p>
      </div>
      <div class=\"set-btns\">
        <a class=\"mcookie-btn mp-prefrences-close\">";
        // line 14
        echo ($context["button_close"] ?? null);
        echo "</a>
        <a class=\"mcookie-btn mpprefrences-update\">";
        // line 15
        echo ($context["button_update"] ?? null);
        echo "</a>
      </div>
    </div>
  </div>
</div>
<style type=\"text/css\">
  .mpgdpr-wrap { position: fixed; width: 100%; top: 50px; left: 0; z-index: 9999; display: none; }
  .mpgdpr-cookie { padding: 15px 25px; background: rgb(226, 239, 247); color: #000;  margin: auto;  overflow-y: auto; position: fixed; left:15px;bottom:200px}
  .mpgdpr-cookie .mpgdpr-container { margin: auto; }
  .mpgdpr-cookie .mpgdpr-text{ display: block; vertical-align: top; }
  .mpgdpr-cookie .set-btns{ display: block; text-align: center; margin-top: 25px;margin-bottom:25px }
  .mpgdpr-cookie .mcookie-btn{ border: none; padding: 10px 15px; cursor: pointer;  background: rgb(0, 111, 185); color: #fff; display: inline-block;  margin-right: 10px}
  .mpgdpr-cookie h3{font-size: 18px; margin-top: 0; color: #fff;}

  @media(min-width: 768px){
    .mpgdpr-cookie{width: 496px; height: auto;}
    .mpgdpr-cookie .mcookie-btn{font-size: 14px;}
  }
   @media(max-width: 767px){
    .mpgdpr-cookie{height: 280px;}
    .mpgdpr-cookie .mcookie-btn{font-size: 12px;}
  }
  ";
        // line 37
        echo ($context["cbcss"] ?? null);
        echo "
</style>
<script type=\"text/javascript\">
   var mpgdpr = {
    mcookies : {
      ";
        // line 54
        echo "      get : function(name) {
        function getCookie(name) {
          if(name) {
            var value = '; ' + document.cookie;
            var parts = value.split('; ' + name + '=');
            return parts.length < 2 ? undefined : parts.pop().split(';').shift();
          }
          var cookies = document.cookie.split('; ');
          var data = {};
          for(var i in cookies) {
            var cookie = cookies[i].split('=');
            if(cookie.length==2) {
              data[cookie[0]] = cookie[1];
            }
          }
          return data;
        }
        var data = {};
        if(typeof name == 'string') {
          data[name] = getCookie(name);
        }
        
        if(typeof name == 'object') {
          for(var i in name) {
            data[name[i]] =  getCookie(name[i]); 
          } 
        }
        if(typeof name == 'undefined' || '' == name) {
          data = getCookie();
        }
        return data;
      },
      ";
        // line 105
        echo "      set: function(cookies) {
        function setCookie(name, value, expiryDays, domain, path, secure) {
          
          if(expiryDays == -1) {
            var cookie = [
              name + '=' + value,
              'expires=' + 'Thu, 01 Jan 1970 00:00:01 GMT',
              'path=' + (path || '/')
            ];
          } else {
             var exdate = new Date();
            exdate.setDate(exdate.getDate() + (expiryDays || 365));

            var cookie = [
              name + '=' + value,
              'expires=' + exdate.toUTCString(),
              'path=' + (path || '/')
            ];
          }
          if (domain) {
            cookie.push('domain=' + domain);
          }
          if (secure) {
            cookie.push('secure');
          }
          ";
        // line 130
        if (($context["logging"] ?? null)) {
            echo "console.log(\"final setting cookie : \" + cookie.join(';')+';'); ";
        }
        // line 131
        echo "          document.cookie = cookie.join(';')+';';
        }

        if(typeof cookies == 'undefined' || '' == cookies) {
          return;
        }
        if(typeof cookies == 'string') {
          var parts = cookies.split(\";\");
          ";
        // line 139
        if (($context["logging"] ?? null)) {
            // line 140
            echo "            console.log(\"cookies string : \" + cookies);
            console.log(\"parts : \");
            console.log(parts);
          ";
        }
        // line 144
        echo "          cookies = [{
            'name' : parts[0],
            'value' : parts[1],
            'expiryDays' : parts[3],
            'domain' : parts[4],
            'path' : parts[5],
            'secure' : parts[6],
          }];
        }
        ";
        // line 153
        if (($context["logging"] ?? null)) {
            // line 154
            echo "          console.log(\"set cookies : \");
          console.log(cookies)
        ";
        }
        // line 157
        echo "        for(var i in cookies) {
          setCookie(
            cookies[i]['name'], 
            cookies[i]['value'], 
            cookies[i]['expiryDays'],
            cookies[i]['domain'],
            cookies[i]['path'],
            cookies[i]['secure']
          ); 
        }
      },
      ";
        // line 181
        echo "      clear : function(cookies) {
        function clearCookie(name, domain, path) {
          mpgdpr.mcookies.set([{
            'name' : name,
            'value' : '',
            'expiryDays' : -1,
            'domain' : domain,
            'path' : path
          }]);
        }

        if(typeof cookies == 'undefined' || '' == cookies) {
          return;
        }
        if(typeof cookies == 'string') {
          var parts = cookies.split(\";\");
          ";
        // line 197
        if (($context["logging"] ?? null)) {
            // line 198
            echo "          console.log(\"cookie string :\" + cookies);
          console.log(\"parts\")
          console.log(parts)
          ";
        }
        // line 202
        echo "          cookies = [{
            'name' : parts[0],
            'domain' : parts[1],
            'path' : parts[2]
          }];
        }
        for(var i in cookies) {
          clearCookie(
            cookies[i]['name'],
            cookies[i]['domain'],
            cookies[i]['path']
          );
        }
      },
    },
    instance : null ,
    err : null,
    deniedCookiess : ";
        // line 219
        echo ($context["deniedCookiess"] ?? null);
        echo ", ";
        // line 220
        echo "    cookies : {
      analytics : ";
        // line 221
        echo ($context["cookies_analytics"] ?? null);
        echo ",
      marketing : ";
        // line 222
        echo ($context["cookies_marketing"] ?? null);
        echo ",
    },
    domains : ";
        // line 224
        echo ($context["cookie_domain"] ?? null);
        echo ", ";
        // line 225
        echo "
    handle_cookie:function() {
      \$('body').delegate('.mp-prefrences','click', function() {
        \$('.mpgdpr-wrap').fadeIn('slow');
      });

      \$('body').delegate('.mp-prefrences-close','click', function() {
        \$('.mpgdpr-wrap').fadeOut('slow');
      });

      ";
        // line 236
        echo "      \$('body').delegate('a.cc-mpdeny','click', function() {
        ";
        // line 238
        echo "        ";
        if (($context["logging"] ?? null)) {
            // line 239
            echo "        console.log(\"deny all cookies\");
        ";
        }
        // line 241
        echo "        

       ";
        // line 244
        echo "
        var disable = [];
        if(!(mpgdpr.deniedCookiess.indexOf('analytics') >= 0) && (";
        // line 246
        if (((($context["cbaction_close"] ?? null) == "cookieanalytic_block") || (($context["cbaction_close"] ?? null) == "cookieanalyticmarketing_block"))) {
            echo "true";
        } else {
            echo "false";
        }
        echo ") ) {
          disable.push('analytics');
          \$('input[name=\"mcookie_analytics\"]').prop('checked',false);
        }
        if(!(mpgdpr.deniedCookiess.indexOf('marketing') >= 0) && (";
        // line 250
        if (((($context["cbaction_close"] ?? null) == "cookiemarketing_block") || (($context["cbaction_close"] ?? null) == "cookieanalyticmarketing_block"))) {
            echo "true";
        } else {
            echo "false";
        }
        echo ") ) {
          disable.push('marketing');
          \$('input[name=\"mcookie_marketing\"]').prop('checked',false);
        }

        if(disable.length) {
          mpgdpr.mcookies.set('mpcookie_preferencesdisable;'+ disable.join(',') +';365');
          mpgdpr.deniedCookiess = disable;
        }

      });

      \$('body').delegate('a.cc-mpallow','click', function() {
        ";
        // line 263
        if (((($context["cbpptrack"] ?? null) && ($context["cbpolicy"] ?? null)) && ($context["cbpolicy_page_url"] ?? null))) {
            // line 264
            echo "        \$.get('";
            echo ($context["base"] ?? null);
            echo "index.php?route=mpgdpr/mpgdpr/acceptanceOfPp');
        ";
        }
        // line 266
        echo "      });

      \$('body').delegate('a.mpprefrences-update','click', function() {
        ";
        // line 270
        echo "        ";
        if (($context["logging"] ?? null)) {
            // line 271
            echo "        console.log(\"update preferences as  per selections\");
        ";
        }
        // line 273
        echo "        var disable = [];

        if(!\$('input[name=\"mcookie_marketing\"]').prop('checked')) disable.push('marketing');
        if(!\$('input[name=\"mcookie_analytics\"]').prop('checked')) disable.push('analytics');
        ";
        // line 277
        if (($context["logging"] ?? null)) {
            // line 278
            echo "        console.log(disable);
        console.log('mpcookie_preferencesdisable;'+disable.join(',')+';365');
        ";
        }
        // line 281
        echo "
        mpgdpr.mcookies.set('mpcookie_preferencesdisable;'+disable.join(',')+';365');

        mpgdpr.deniedCookiess = disable;
        \$('input[name=\"mcookie_analytics\"]').prop('checked', !(disable.indexOf('analytics') >= 0));
        \$('input[name=\"mcookie_marketing\"]').prop('checked', !(disable.indexOf('marketing') >= 0));

        \$('.mpgdpr-wrap').fadeToggle('slow');
      });

    },

    maintainance_cookies:function() {
    
      var analytics = mpgdpr.deniedCookiess.indexOf('analytics') >= 0;
      var marketing = mpgdpr.deniedCookiess.indexOf('marketing') >= 0;
      ";
        // line 298
        echo "      ";
        if ((((($context["cbinitial"] ?? null) == "cookieanalytic_block") || (($context["cbinitial"] ?? null) == "cookieanalyticmarketing_block")) && !twig_in_filter(($context["cookieconsent_status"] ?? null), ($context["cookieconsentstatuss"] ?? null)))) {
            echo "if(!analytics) { analytics = true; }";
        }
        // line 299
        echo "      ";
        if ((((($context["cbinitial"] ?? null) == "cookiemarketing_block") || (($context["cbinitial"] ?? null) == "cookieanalyticmarketing_block")) && !twig_in_filter(($context["cookieconsent_status"] ?? null), ($context["cookieconsentstatuss"] ?? null)))) {
            echo "if(!marketing) { marketing = true; }";
        }
        // line 300
        echo "      \$('input[name=\"mcookie_analytics\"]').prop('checked', (!analytics));
      \$('input[name=\"mcookie_marketing\"]').prop('checked', (!marketing));

      \$.each(mpgdpr.mcookies.get(), function(key, value) {
        if(analytics && mpgdpr.cookies.analytics.indexOf(key) >= 0) {
          for(var i in mpgdpr.domains) {
            mpgdpr.mcookies.clear(key+';'+mpgdpr.domains[i]+';'+'/');
          }
        }
        if(marketing && mpgdpr.cookies.marketing.indexOf(key) >= 0) {
          for(var i in mpgdpr.domains) {
            mpgdpr.mcookies.clear(key+';'+mpgdpr.domains[i]+';'+'/');
          }
        }
      });

    },
    cookieconsent:function() {
      window.cookieconsent.initialise({
        ";
        // line 320
        echo "        type: 'opt-in',
        position: '";
        // line 321
        echo ($context["position"] ?? null);
        echo "',
        ";
        // line 322
        if (($context["static"] ?? null)) {
            // line 323
            echo "        static: true,
        ";
        }
        // line 325
        echo "        palette: { \"popup\": { \"background\": \"";
        echo twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "box_bg", [], "any", false, false, false, 325);
        echo "\", \"text\": \"";
        echo twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "box_text", [], "any", false, false, false, 325);
        echo "\" }, \"button\": { \"background\": \"";
        echo twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_bg", [], "any", false, false, false, 325);
        echo "\", \"text\": \"";
        echo twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_text", [], "any", false, false, false, 325);
        echo "\", \"padding\": \"";
        echo (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "top", [], "any", false, false, false, 325) . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "unit", [], "any", false, false, false, 325));
        echo " ";
        echo (twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325) > (($context["right"] ?? null) . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "unit", [], "any", false, false, false, 325)));
        echo " ";
        echo (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "bottom", [], "any", false, false, false, 325) . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "unit", [], "any", false, false, false, 325));
        echo " ";
        echo (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "left", [], "any", false, false, false, 325) . twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["cbcolor"] ?? null), "btn_padding", [], "any", false, false, false, 325), "unit", [], "any", false, false, false, 325));
        echo "\" } },    
        \"revokable\" : !!";
        // line 326
        echo ($context["cbshowagain"] ?? null);
        echo ",
        \"showLink\" : !!";
        // line 327
        echo ($context["cbpolicy"] ?? null);
        echo ",
        content: {          
          \"message\": \"";
        // line 329
        echo ($context["text_cookielang_msg"] ?? null);
        echo "\",          
          \"deny\" : \"";
        // line 330
        echo ($context["text_cookielang_btn_deny"] ?? null);
        echo "\",
          \"allow\" : \"";
        // line 331
        echo ($context["text_cookielang_btn_accept"] ?? null);
        echo "\",
          \"prefrences\" : \"";
        // line 332
        echo ($context["text_cookielang_btn_prefrence"] ?? null);
        echo "\",
          ";
        // line 333
        if ((($context["cbpolicy_page_url"] ?? null) && ($context["cbpolicy"] ?? null))) {
            // line 334
            echo "          \"link\" : '";
            echo ($context["cbpolicy_page_text"] ?? null);
            echo "',
          \"href\" : '";
            // line 335
            echo ($context["cbpolicy_page_url"] ?? null);
            echo "',
          ";
        }
        // line 337
        echo "          \"policy\" : '";
        echo ($context["text_cookielang_btn_showagain"] ?? null);
        echo "'
        },

      },
      function(popup) {
        mpgdpr.instance = popup;
      },
      function(err, popup) {
        mpgdpr.instance = popup;
        mpgdpr.err = err;
      });
    },
  };
</script>";
    }

    public function getTemplateName()
    {
        return "default/template/mpgdpr/preferenceshtml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  499 => 337,  494 => 335,  489 => 334,  487 => 333,  483 => 332,  479 => 331,  475 => 330,  471 => 329,  466 => 327,  462 => 326,  443 => 325,  439 => 323,  437 => 322,  433 => 321,  430 => 320,  409 => 300,  404 => 299,  399 => 298,  381 => 281,  376 => 278,  374 => 277,  368 => 273,  364 => 271,  361 => 270,  356 => 266,  350 => 264,  348 => 263,  328 => 250,  317 => 246,  313 => 244,  309 => 241,  305 => 239,  302 => 238,  299 => 236,  287 => 225,  284 => 224,  279 => 222,  275 => 221,  272 => 220,  269 => 219,  250 => 202,  244 => 198,  242 => 197,  224 => 181,  211 => 157,  206 => 154,  204 => 153,  193 => 144,  187 => 140,  185 => 139,  175 => 131,  171 => 130,  144 => 105,  110 => 54,  102 => 37,  77 => 15,  73 => 14,  67 => 11,  63 => 10,  59 => 9,  55 => 8,  51 => 7,  47 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/mpgdpr/preferenceshtml.twig", "");
    }
}
