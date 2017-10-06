<?php

class KokenMultilanguage extends KokenPlugin {

	function __construct()
	{
		$this->register_hook('before_closing_body', 'render');
	}

	function render()
	{
		$path = $this->get_path();
		if($this->data->extractstrings==1)
		{
		  $truefalse='true';
      }
      else {
      	 $truefalse='false';
      }
		if($this->data->fallbacklanguage=='')
		{
		  $fallbacklanguage='en';
      }
      else {
      	 $fallbacklanguage='$this->data->fallbacklanguage';
      }      
		echo <<<OUT
    <br><script src="{$path}/multi-language/i18nextify_lessconsoleoutput.min.js"></script>
    <script src="https://unpkg.com/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.js"></script>
    <script>
	var languageDetectorOptions = 
  	{
		// order and from where user language should be detected
		order: ['querystring', 'cookie', 'localStorage', 'navigator', 'htmlTag'],

		// keys or params to lookup language from
		lookupQuerystring: 'lng',
		lookupCookie: 'i18next',
		lookupLocalStorage: 'i18nextLng',

		// cache user language on
		caches: ['localStorage', 'cookie'],
		excludeCacheFor: ['cimode'], // languages to not persist (cookie, localStorage)

		// optional expire and domain for set cookie
		cookieMinutes: 10,
		cookieDomain: 'myDomain',

		// optional htmlTag with lang attribute, the default is:
		htmlTag: document.documentElement
	};
	var translation = window.i18nextify
	.init({
		  debug: '{$truefalse}',
		  saveMissing: '{$truefalse}',
        namespace: 'translation',
        fallbackLng: '{$fallbacklanguage}',
        ignoreTags: ['script','img'],
        ignoreIds: ['ignoreMeId'],
        ignoreClasses: ['ignoreMeClass'],
    	backend: {
	      // for all available options read the backend's repository readme file
	      loadPath: '{$path}/multi-language/locales/{{lng}}/{{ns}}.json',
	      addPath: '{$path}/multi-language/locales/add/{{lng}}/{{ns}}.missing.json'
	}
      });
    </script>
OUT;
	}
}
