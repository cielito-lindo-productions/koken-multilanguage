<?php

class KokenMultilanguage extends KokenPlugin {

	function __construct()
	{
		$this->register_hook('before_closing_body', 'render');
	}

	function render()
	{
		$path = $this->get_path();
		if($this->data->cachetranslations==1)
		{
			$cachetranslations='true';
		}
		else {
			$cachetranslations='false';
		}
		if($this->data->fallbacklanguage=='')
		{
			$fallbacklanguage='en';
		}
		else {
 			$fallbacklanguage='$this->data->fallbacklanguage';
		}
		echo <<<OUT
			<!--a local min.js file is used as it contains less console-output; it can be replaced eg. by 
			//https://unpkg.com/i18nextify@2.1.0/i18nextify.js-->
			<br><script src="{$path}/assets/i18nextify_lessconsoleoutput.min.js"></script>
			<script src="https://unpkg.com/i18next-browser-languagedetector@2.0.0/i18nextBrowserLanguageDetector.js"></script>
			<script src="https://unpkg.com/i18next-localstorage-cache@1.1.1/i18nextLocalStorageCache.min.js"></script>
			<script>
				window.i18nextify.i18next.use(i18nextBrowserLanguageDetector);
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
					cookieMinutes: 60,
					cookieDomain: 'myDomain',

					// optional htmlTag with lang attribute, the default is:
					htmlTag: document.documentElement
				};
				window.i18nextify.i18next.use(window.i18nextLocalStorageCache);
				var cacheOptions =
				{
					enabled: {$cachetranslations},
					prefix: 'i18next_res_',
					expirationTime: 24 * 60 * 60 * 1000 // in seconds
				};

				var translation = window.i18nextify
				.init({
					interpolation: { prefix: '__', suffix: '__' },
					debug: 'true',
					saveMissing: 'true',
					namespace: 'translation',
					fallbackLng: '{$fallbacklanguage}',
					detector: languageDetectorOptions,
					cache: cacheOptions,
					ignoreTags: ['script','img','noscript', 'alt', 'src'],
					ignoreIds: ['ignoreMeId','noscript', 'alt', 'src'],
					ignoreClasses: ['ignoreMeClass','noscript', 'alt', 'src'],
					backend: {
					      // for all available options read the backend's repository readme file
					      loadPath: '{$path}/assets/locales/__lng__/__ns__.json'
					}
				});
			</script>
OUT;
	}
}
